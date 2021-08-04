<?php

namespace proyecto\app\controllers;

use proyecto\app\repository\AsociadosRepository;
use proyecto\app\repository\ImagenGaleriaRepository;
use proyecto\core\App;
use proyecto\core\Response;

class PagesController
{
    public function index()
    {
        $arrayImagenes = App::getRepository(ImagenGaleriaRepository::class)->findAll();;
        $arrayAsociados = App::getRepository(AsociadosRepository::class)->findAll();;

        Response::renderView('index', 'layout',
        compact('arrayImagenes', 'arrayAsociados'));
    }

    public function about()
    {
        Response::renderView('about', 'layout-with-footer');
    }

    public function blog()
    {
        Response::renderView('blog', 'layout-with-footer');
    }

    public function post()
    {
        Response::renderView('single_post', 'layout-with-footer');
    }
}