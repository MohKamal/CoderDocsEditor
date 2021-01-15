<?php
/**
 * Routes for routing between requests
 * use $router object to define the routes
 * get and post
 */

$router->get('/', function () {
    HomeController::Index();
});

$router->get('/pre-sections', function () {
    return \Showcase\Controllers\PreTemplateController::get();
});

$router->get('/pre-elements', function () {
    return \Showcase\Controllers\PreTemplateController::getElements();
});

$router->get('/documentation', function () {
    return View::show('App/doc');
});

$router->post('/add-sections', function ($request) {
    return \Showcase\Controllers\SectionController::store($request);
});

Auth::routes($router);