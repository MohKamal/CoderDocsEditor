<?php
/**
 * Routes for routing between requests
 * use $router object to define the routes
 * get and post
 */

$router->get('/', function () {
    HomeController::Index();
});

$router->get('/torrent', function () {
    HomeController::torrent();
});

$router->get('/pre-sections', function () {
    return PreTemplateController::get();
});

$router->get('/pre-elements', function () {
    return PreTemplateController::getElements();
});

$router->get('/documentation', function () {
    return View::show('App/doc');
});

$router->post('/add-sections', function ($request) {
    return SectionController::store($request);
});

Auth::routes($router);