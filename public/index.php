<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . './../includes/app.php';

use MVC\Router;
use Controllers\PaginasController;
use Controllers\LoginController;
use Controllers\RopaController;
use Controllers\MarcaController;

$router = new Router();

//ZONA PRIVADA (SOLO ADMINS)
$router->get('/admin', [new RopaController(), 'index']);
$router->get('/ropa/crear', [new RopaController(), 'crear']);
$router->post('/ropa/crear', [new RopaController(), 'crear']);
$router->get('/ropa/actualizar', [new RopaController(), 'actualizar']);
$router->post('/ropa/actualizar', [new RopaController(), 'actualizar']);
$router->post('/ropa/eliminar', [new RopaController(), 'eliminar']);

$router->get('/marca/crear', [new MarcaController(), 'crear']);
$router->post('/marca/crear', [new MarcaController(), 'crear']);
$router->get('/marca/actualizar', [new MarcaController(), 'actualizar']);
$router->post('/marca/actualizar', [new MarcaController(), 'actualizar']);
$router->post('/marca/eliminar', [new MarcaController(), 'eliminar']);

// ZONA PUBLICA (ABIERTA A CUALQUIER USUARIO)
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/seccion', [PaginasController::class, 'seccion']);
$router->get('/anuncios', [PaginasController::class, 'anuncios']);
$router->get('/marcas', [PaginasController::class, 'marcas']);
$router->get('/detalles', [PaginasController::class, 'detalles']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//ZONA DE USUARIOS (LOGIN Y LOGOUT)
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router -> comprobarRutas();