<?php

namespace proyecto\app\controllers;

use proyecto\app\entity\Mensaje;
use proyecto\app\exceptions\AppException;
use proyecto\app\exceptions\FileException;
use proyecto\app\exceptions\QueryException;
use proyecto\app\exceptions\ValidationException;
use proyecto\app\repository\MensajeRepository;
use proyecto\app\utils\MyMail;
use proyecto\core\App;
use proyecto\core\helpers\FlashMessage;
use proyecto\core\Response;

class MensajeController
{
    public function index()
    {
        $message = FlashMessage::get('message');
        $errores = FlashMessage::get('errores', []);

        Response::renderView('contact', 'layout',
            compact('message', 'errores'));
    }

    public function nuevo()
    {
        try {
            $mensajeRepository = App::getRepository(MensajeRepository::class);
            $name = trim(htmlspecialchars($_POST['name']));
            $lastName = trim(htmlspecialchars($_POST['lastName']));
            $email = trim(htmlspecialchars($_POST['email']));
            $subject = trim(htmlspecialchars($_POST['subject']));
            $message = trim(htmlspecialchars($_POST['message']));
            if (empty($name)) {
                throw new ValidationException('El nombre no se puede quedar vacio');
            }
            if (empty($email)) {
                throw new ValidationException('El mail no se puede quedar vacio');
            } else {
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    throw new ValidationException('El mail introducido no es válido');
                }
            }
            if (empty($subject)) {
                throw new ValidationException('El asunto no se puede quedar vacio');
            }
            if (empty($errores)) {
                $mensaje = new Mensaje($name, $lastName, $subject, $email, $message);
                $mensajeRepository->guarda($mensaje);

                $message = "Se ha guardado un nuevo mensaje: " . $mensaje->getAsunto();
                App::get('logger')->add($message);
                $mail = new MyMail();
                $mail->send($mensaje->getAsunto(), $mensaje->getEmail(), $mensaje->getNombre(), $mensaje->getTexto());
                FlashMessage::set('message', $message);
            }
        } catch (FileException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        } catch (QueryException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        } catch (AppException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        } catch (ValidationException $exception) {
            FlashMessage::set('errores', [$exception->getMessage()]);
        }

        App::get('router')->redirect('nuevo-mensaje');
    }
}