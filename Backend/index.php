<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Factory;
use App\Core\RouteHandler;
use App\Routes\Web;

// Allow all origins, methods, and headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS, POST, GET');
header('Access-Control-Allow-Headers: *');

// Display errors in case of any error
ini_set('display_errors', 1);

// Create a database object
$database = new \App\Core\Database();

// Create a translator object and a validation factory
$translator = new \Illuminate\Translation\Translator(new \Illuminate\Translation\ArrayLoader(), 'en');
$validationFactory = new Factory($translator);

// Swap the default validator with the created validation factory
Validator::swap($validationFactory);


// Create a router object
$router   = new League\Route\Router;

// Create a RouteHandler object with the router
$routeHandler = new RouteHandler($router);

// Create a new Web object with the router
$api = new Web($router);

// Map the routes for the API
$api->mapRoutes();

// Run the routes
$routeHandler->run();
