<!-- FRAMEWORK LARAVEL -->
<!-- Usa la arquitectura Modelo Vista Controlador -->
<?php

use Illuminate\Contracts\Http\Kernel; // Importando la Clase Kernel 
use Illuminate\Http\Request; // Importando la Clase Request 

define('LARAVEL_START', microtime(true)); // Declarando la constante LARAVEL_START para medir el tiempo de inicio de la aplicación.

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) { // Comprobando si el archivo maintenance.php existe y lo carga si es necesario
    require $maintenance; // Mostrar contenido pre-renderizado de la pagina
} // El archivo maintenance.php al inicio no existe, desde que se usa la pagina se va agregando contenido

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php'; // Cargnado el archivo autoload.php para generar un cargador de clases que tiene el archivo 

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php'; // Cargando el archivo app.php para inicializar la aplicación Laravel y obtener una instancia en para almacenarla en $app.
$kernel = $app->make(Kernel::class); // Creando una instancia del objeto $kernel, que maneja las solicitudes HTTP entrantes a la aplicación. De ahi se almacena en $kernel

$response = $kernel->handle( // Manejando la solicitud HTTP entrante utilizando el objeto $kernel y devuelve una respuesta HTTP al cliente
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response); // Finalizando la solicitud HTTP y liberando cualquier recurso utilizado por la aplicación

// Fin de la aplicacion
