# Server Prueba Astradata

Repositorio contenedor del servicio web (BackEnd)
## Herramientas
- Composer (versión 2.1.3)
- PHP (versión 7.4.19)
- Base de datos (MySql 5.7.33)
## Instalar dependencias

```bash
composer install
```

## Configurar .env

```bash
cp .env.example .env
```
## Generar llave secreta JWT

```bash
php artisan jwt:secret
```

## Generar llave para la aplicación laravel

```bash
php artisan key:generate
```
## Generar base de datos

```bash
php artisan migrate --seed
```
## Importar datos en la tabla data

Archivo adjunto en la raíz del repositorio en formato csv (Datos.csv)


# Ejecutar servidor local
```
$ php artisan serve
```
