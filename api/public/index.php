<?php
// backend/public/index.php

// 1. Load Composer with path verification
$autoloadPath = realpath(__DIR__ . '/../vendor/autoload.php');
if (!file_exists($autoloadPath)) {
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Run "composer install" in backend directory']));
}
require_once $autoloadPath;

// 2. CORS Headers
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// 3. Preflight Handling
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 4. Initialize Router
use App\Core\Router;
$router = new Router();

// ===== Routes ===== //
// Auth
$router->addRoute('POST', '/api/register', 'AuthController@register');
$router->addRoute('POST', '/api/login', 'AuthController@login');

// Events
$router->addRoute('GET', '/api/events', 'EventController@getAll');
$router->addRoute('GET', '/api/events/{id}', 'EventController@get');
$router->addRoute('POST', '/api/events', 'EventController@create');
$router->addRoute('PUT', '/api/events/{id}', 'EventController@update');
$router->addRoute('DELETE', '/api/events/{id}', 'EventController@delete');
$router->addRoute('POST', '/api/events/{id}/register', 'EventController@register');
$router->addRoute('POST', '/api/events/{id}/unregister', 'EventController@unregister');
$router->addRoute('POST', '/api/events/{id}/comments', 'EventController@addComment');

// Admin
$router->addRoute('GET', '/api/admin/events', 'AdminController@getEvents');
$router->addRoute('DELETE', '/api/admin/comments/{id}', 'AdminController@deleteComment');
$router->addRoute('GET', '/api/admin/stats', 'AdminController@getStats');

// 5. Dispatch
$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);