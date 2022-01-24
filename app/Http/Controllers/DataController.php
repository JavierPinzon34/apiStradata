<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Response;
use App\Models\ResponseHasData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataController extends Controller
{
    public function index(Request $request) {
        $dataSearch['uuid'] = Str::uuid();
        $dataSearch['searched_name'] = $request->name;
        $dataSearch['searched_percentage'] = $request->percentage;
        $search = Response::create($dataSearch);
        DB::commit();
        $search->save();

        try {
            $data = Data::all();
            //return $data;
            $response = [];
            $name = trim($request->name," ");
            $name = strtolower($name);
            $name = str_replace("ci","si",$name);
            $name = str_replace("ce","se",$name);
            $name = str_replace("gi","ji",$name);
            $name = str_replace("ge","je",$name);
            $name = str_replace("z","s",$name);
            $name = str_replace("v","b",$name);
            foreach ($data as $value) {
                $name1 = trim($value->name," ");
                $name1 = strtolower($name1);
                $name1 = str_replace("ci","si",$name1);
                $name1 = str_replace("ce","se",$name1);
                $name1 = str_replace("gi","ji",$name1);
                $name1 = str_replace("ge","je",$name1);
                $name1 = str_replace("z","s",$name1);
                $name1 = str_replace("v","b",$name1);
                similar_text($name1,$name,$percent);
                $value->coincidence = $percent;
                if ($percent >= $request->percentage) {
                    array_push($response, $value);
                    $dataResponse['response_id'] = $search->id;
                    $dataResponse['data_id'] = $value->id;
                    $res = ResponseHasData::create($dataResponse);
                    DB::commit();
                    $res->save();
                }
            }

            if (count($response) > 0) {
                $search->state = 'with_results';
            } else {
                $search->state = 'without_results';
            }
            DB::commit();
            $search->save();

            return $response;

        } catch (\Throwable $th) {

            $search->state = 'error';

            DB::commit();
            $search->save();
        }
    }

    public function search($uuid) {
        return Response::with('data')->where('uuid', $uuid)->get();
    }
}
