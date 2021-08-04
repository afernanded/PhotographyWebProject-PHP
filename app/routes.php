<?php
$router->get('', 'PagesController@index');
$router->get('about', 'PagesController@about');
$router->get('blog', 'PagesController@blog');
$router->get('post', 'PagesController@post');

$router->get('nuevo-asociado', 'AsociadoController@index', 'ROLE_USER');
$router->post('asociado/nuevo', 'AsociadoController@nuevo', 'ROLE_ADMIN');

$router->get('nuevo-mensaje', 'MensajeController@index');
$router->post('mensaje/nuevo', 'MensajeController@nuevo');

$router->get('imagenes-galeria', 'ImagenGaleriaController@index', 'ROLE_USER');
$router->get('imagenes-galeria/:id', 'ImagenGaleriaController@show', 'ROLE_USER');
$router->post('imagenes-galeria/nueva', 'ImagenGaleriaController@nueva', 'ROLE_ADMIN');

$router->get('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout', 'ROLE_USER');
$router->post('check-login', 'AuthController@checkLogin');

$router->get('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');


