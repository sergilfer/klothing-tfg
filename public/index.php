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
$router->get('/', [new PaginasController(), 'index']);
$router->get('/nosotros', [new PaginasController(), 'nosotros']);
$router->get('/seccion', [new PaginasController(), 'seccion']);
$router->get('/anuncio', [new PaginasController(), 'anuncio']);
$router->get('/marcas', [new PaginasController(), 'marcas']);
$router->get('/detalles', [new PaginasController(), 'detalles']);
$router->get('/contacto', [new PaginasController(), 'contacto']);
$router->post('/contacto', [new PaginasController(), 'contacto']);

// Iniciar Sesión
$router->get('/login', [new LoginController(), 'login']);
$router->post('/login', [new LoginController(), 'login']);
$router->get('/logout', [new LoginController(), 'logout']);

// Recuperar Password
$router->get('/olvide', [new LoginController(), 'olvide']);
$router->post('/olvide', [new LoginController(), 'olvide']);
$router->get('/recuperar', [new LoginController(), 'recuperar']);
$router->post('/recuperar', [new LoginController(), 'recuperar']);

// Crear Cuenta
$router->get('/register', [new LoginController(), 'register']);
$router->post('/register', [new LoginController(), 'register']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [new LoginController(), 'confirmar']);

$router->get('/mensaje', [new LoginController(), 'mensaje']);



$router->comprobarRutas();
