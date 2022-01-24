<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseHasData extends Model
{
    public $timestamps = false;

    protected $table = 'response_has_data';

    protected $fillable = [
        'response_id',
        'data_id'
    ];

    protected $casts = [
        'response_id' => 'integer',
        'data_id' => 'integer',
    ];

    public function hasData()
    {
        return $this->belongsTo(\App\Models\Data::class,'data_id');
    }
}
