<?php
$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/search', 'ListingController@search');
$router->get('/listings/{id}', 'ListingController@show');

$router->get('/dashboard', 'DashboardController@index', ['admin']);
$router->get('/dashboard/listings', 'DashboardController@getListings', ['admin']);
$router->get('/dashboard/listings/create', 'DashboardController@createListing', ['admin']);
$router->get('/dashboard/listings/edit/{id}', 'DashboardController@editListing', ['admin']);
// users
$router->get('/dashboard/users', 'DashboardController@getUsers', ['admin']);
$router->get('/dashboard/users/create', 'DashboardController@createUser', ['admin']);
$router->get('/dashboard/users/edit/{id}', 'DashboardController@editUser', ['admin']);

$router->post('/dashboard/users/create', 'DashboardController@storeUser', ['admin']);
$router->put('/dashboard/users/edit/{id}', 'DashboardController@updateUser', ['admin']);
$router->delete('/dashboard/users/{id}', 'DashboardController@destroyUser', ['admin']);

$router->post('/dashboard/listings', 'DashboardController@storeListing', ['admin']);
$router->put('/dashboard/listings/{id}', 'DashboardController@updateListing', ['admin']);
$router->delete('/dashboard/listings/{id}', 'DashboardController@destroy', ['admin']);


$router->get('/auth/register', 'UserController@create', ['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);

$router->post('/auth/register', 'UserController@store', ['guest']);
$router->post('/auth/logout', 'UserController@logout', ['auth']);
$router->post('/auth/login', 'UserController@authenticate', ['guest']);
