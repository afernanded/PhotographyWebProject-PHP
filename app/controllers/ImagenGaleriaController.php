<?php

namespace proyecto\app\controllers;


use proyecto\app\entity\ImagenGaleria;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\exceptions\ValidationException;
use proyecto\app\repository\CategoriaRepository;
use proyecto\app\utils\File;
use proyecto\core\helpers\FlashMessage;
use proyecto\core\Response;
use proyecto\app\repository\ImagenGaleriaRepository;
use proyecto\core\App;

class ImagenGaleriaController
{
    public function index()
    {
        $imagenRepository = App::getRepository(ImagenGaleriaRepository::class);
        $categoriaRepository = App::getRepository(CategoriaRepository::class);
        $imagenes = $imagenRepository->findAll();
        $categorias = $categoriaRepository->findAll();

        $message = FlashMessage::get('message');
        $errores = FlashMessage::get('errores', []);
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
        Response::renderView('galeria', 'layout',
            compact('imagenes', 'categorias', 'imagenRepository', 'categoriaRepository', 'descripcion', 'errores', 'categoriaSeleccionada', 'message'));
    }

    public function nueva()
    {
        try {
            $imagenRepository = App::getRepository(ImagenGaleriaRepository::class);
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            $categoria = trim(htmlspecialchars($_POST['categoria']));
            if (empty($categoria)){
                throw new ValidationException('No se ha recibido la categoria');
            }
            FlashMessage::set('descripcion', $descripcion);
            FlashMessage::set('categoriaSeleccionada', $categoria);
            $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $imagen = new File('imagen', $tiposAceptados);
            $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
            $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);
            $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
            $imagenRepository->guarda($imagenGaleria);

            $message = "Se ha guardado una nueva imagen: " . $imagenGaleria->getNombre();
            App::get('logger')->add($message);
            FlashMessage::set('message',$message);
            FlashMessage::unset('descripcion');
            FlashMessage::unset('categoriaSeleccionada');

        } catch (FileException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        } catch (QueryException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        } catch (AppException $exception){
            FlashMessage::set('errores', [$exception->getMessage()]);
        }catch (ValidationException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        }
        App::get('router')->redirect('imagenes-galeria');
    }

    public function show($id)
    {
        $imagen = App::getRepository(ImagenGaleriaRepository::class)->find($id);
        Response::renderView('show-imagen-galeria', 'layout',
            compact('imagen'));
    }
}