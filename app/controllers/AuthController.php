<?php


namespace proyecto\app\controllers;


use proyecto\app\entity\Usuario;
use proyecto\app\exceptions\ValidationException;
use proyecto\app\repository\UsuarioRepository;
use proyecto\core\App;
use proyecto\core\helpers\FlashMessage;
use proyecto\core\Response;
use proyecto\core\Security;

class AuthController
{
    public function login()
    {
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username');
        Response::renderView('login', 'layout', compact('errores', 'username'));
    }

    public function checkLogin()
    {
        try {
            if (!isset($_POST['username']) || empty($_POST['username'])) {
                throw new ValidationException('Debes introducir el usuario y la contraseña.');
            }
            FlashMessage::set('username', $_POST['username']);

            if (!isset($_POST['password']) || empty($_POST['password'])) {
                throw new ValidationException('Debes introducir el usuario y la contraseña.');
            }

            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy([
                'username' => $_POST['username'],
                //'password' => $_POST['password'],
            ]);

            if (!is_null($usuario) && Security::checkPassword($_POST['password'], $usuario->getPassword())) {
                $_SESSION['loguedUser'] = $usuario->getId();
                FlashMessage::unset('username');
                App::get('router')->redirect('');
            }
            throw new ValidationException('El usuario y la contraseña introducidos no existen');
        } catch (ValidationException $exception) {
            FlashMessage::set('login-error', [$exception->getMessage()]);
            App::get('router')->redirect('login');
        }
    }

    public function logout()
    {
        if (isset($_SESSION['loguedUser'])) {
            $_SESSION[loguedUser] = null;
            unset($_SESSION['loguedUser']);
        }
        App::get('router')->redirect('login');
    }

    public function registro()
    {
        $errores = FlashMessage::get('registro-error', []);
        $username = FlashMessage::get('username');

        Response::renderView('registro', 'layout', compact('errores', 'username'));
    }

    public function checkRegistro()
    {
        try {
            if (!isset($_POST['username']) || empty($_POST['username'])) {
                throw new ValidationException('El nombre de usuario no puede quedar vacío');
            }

            FlashMessage::set('username', $_POST['username']);

            if (!isset($_POST['password']) || empty($_POST['password'])) {
                throw new ValidationException('El password no puede quedar vacío');
            }

            if (!isset($_POST['re-password']) || empty($_POST['re-password']) || $_POST['password'] !== $_POST['re-password']) {
                throw new ValidationException('El password no puede quedar vacío');
            }

            $password = Security::encrypt($_POST['password']);

            $usuario = new Usuario();
            $usuario->setUsername($_POST['username']);
            $usuario->setRole('ROLE_USER');
            $usuario->setPassword($password);

            App::getRepository(UsuarioRepository::class)->save($usuario);

            FlashMessage::get('username');

            App::get('router')->redirect('login');
        } catch (ValidationException $exception) {
            FlashMessage::set('registro-error', [$exception->getMessage()]);
            App::get('router')->redirect('registro');
        }
    }
}