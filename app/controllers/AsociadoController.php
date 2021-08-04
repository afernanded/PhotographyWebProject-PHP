<?php

namespace proyecto\app\controllers;

use proyecto\app\entity\Asociado;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\repository\AsociadosRepository;
use proyecto\app\utils\File;
use proyecto\core\App;
use proyecto\core\helpers\FlashMessage;
use proyecto\core\Response;

class AsociadoController
{
    public function index()
    {
        $asociadoRepository = App::getRepository(AsociadosRepository::class);
        $asociados = $asociadoRepository->findAll();
        $message = FlashMessage::get('message');
        $errores = FlashMessage::get('errores', []);
        $nombre = FlashMessage::get('nombre');
        $descripcion = FlashMessage::get('descripcion');

        Response::renderView('asociados', 'layout',
            compact('asociados', 'nombre', 'descripcion', 'message', 'errores'));
    }

    public function nuevo()
    {
        try {
            $asociadoRepository = App::getRepository(AsociadosRepository::class);
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('nombre', $nombre);
            FlashMessage::set('descripcion', $descripcion);
            $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $logo = new File('logo', $tiposAceptados);
            $logo->saveUploadFile(asociado::RUTA_ASOCIADOS_LOGO);
            $asociado = new Asociado($nombre, $logo->getFileName(), $descripcion);
            $asociadoRepository->guarda($asociado);

            $message = "Hay un nuevo asociado: " . $asociado->getNombre();
            App::get('logger')->add($message);
            FlashMessage::set('message',$message);
            FlashMessage::unset('nombre');
            FlashMessage::unset('descripcion');

        } catch (FileException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        } catch (QueryException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        }catch (AppException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        }
        App::get('router')->redirect('nuevo-asociado');
    }
}