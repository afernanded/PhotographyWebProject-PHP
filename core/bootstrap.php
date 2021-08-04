<?php

use proyecto\app\repository\UsuarioRepository;
use proyecto\app\utils\MyLogs;
use proyecto\app\utils\MyMail;
use proyecto\core\App;
use proyecto\core\Router;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);

$router = Router::load(__DIR__ . '/../app/' . $config['routes']['filename']);
App::bind('router', $router);

$logger = MyLogs::load(__DIR__ . '/../logs/' . $config['logs']['filename'], $config['logs']['level']);
App::bind('logger', $logger);

if (isset($_SESSION['loguedUser'])) {
    $appUser = App::getRepository(UsuarioRepository::class)->find($_SESSION['loguedUser']);
} else {
    $appUser = null;
}

App::bind('appUser', $appUser);