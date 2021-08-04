<?php

use proyecto\app\exceptions\AppException;
use proyecto\core\App;
use proyecto\core\Request;


try {
    require __DIR__.'/../core/bootstrap.php';
    App::get('router')->direct(Request::uri(),Request::method());
} catch (AppException $appException) {
    $appException->handleError();
}
