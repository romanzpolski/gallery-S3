<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\ImagesController;
use Illuminate\Http\Request;


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('images/{page}', function ($page) {
        return (new ImagesController())->getImages($page);
    });

    $router->get('image/view/{id}', function ($id) {
        return (new ImagesController())->viewImage($id);
    });

    $router->get('image/getData/{id}', function ($id) {
        return (new ImagesController())->getData($id);
    });

    $router->get('image/download/{id}', function ($id) {
        return (new ImagesController())->downloadImage($id);
    });

    $router->post('image/upload', function (Request $request) {
        return (new ImagesController())->uploadImage($request);
    });

});

$router->get('/', function () use ($router) {
    return view('home', ['name' => 'James']);
});
