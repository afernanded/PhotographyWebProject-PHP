<?php


namespace proyecto\core;


class Security
{
    public static function isUserGranted($role)
    {
        if ($role === 'ROLE_ANONYMOUS') {
            return true;
        }

        $usuario = App::get('appUser');
        if (is_null($usuario)) {
            return false;
        }

        $valor_role = App::get('config')['security']['roles'][$role];
        $valor_role_usuario = App::get('config')['security']['roles'][$usuario->getRole()];
        return ($valor_role_usuario >= $valor_role);
    }

    public static function encrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function checkPassword($password, $bdPassword)
    {
        return password_verify($password, $bdPassword);
    }
}