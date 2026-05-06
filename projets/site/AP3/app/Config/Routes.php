<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::Index');
$routes->get('/home', 'Home::home');
$routes->get('/tarifs', 'Home::tarifs');
$routes->get('/calendrier', 'Home::calendrier');
$routes->get('/contact', 'Home::contact' , ['filter' => 'login']);

$routes->group('Adherents', ['filter' => 'login:1'], function($routes) { 
    $routes->get('/', 'AdherentsController::Liste');
    $routes->Post('Ajouter', 'AdherentsController::Ajouter');
    $routes->get('AjouterAdherent', 'AdherentsController::create');
    $routes->get('ModifierAdherent/(:num)', 'AdherentsController::modifier/$1');
    $routes->post('update', 'AdherentsController::update');

  $routes->post('supprimer', 'AdherentsController::supprimer'); 
});
$routes->post('Auth/ConnexionInscription', 'Auth::login');
$routes->group('api', ['filter' => 'jwt'], function ($routes) {
$routes->resource('Adherents');
$routes->post('Adherents/update/(:num)', 'AdherentsController::update/$1');
});

$routes->get('/ConnexionInscription', 'AuthController::ConnexionInscription');
$routes->post('/connexion', 'AuthController::login');
$routes->post('/Inscription', 'AuthController::Inscription');
$routes->get('/deconnexion', 'AuthController::logout');

$routes->get('/Profil', 'AdherentsController::Profil');

$routes->get('/noaccess', function() {
    return view('auth/noaccess');
});

$routes->get('/nologin', function() {
    return view('auth/ConnexionInscription');
});