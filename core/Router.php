<?php

namespace proyecto\core;

use proyecto\app\exceptions\AuthenticationException;
use proyecto\app\exceptions\NotFoundException;

class Router
{
    private $routes;

    /**
     * Router constructor.
     *
     */
    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }

    public function get($uri, $controller, $role = 'ROLE_ANONYMOUS')
    {
        $this->routes['GET'][$uri] = ['controller' => $controller, 'role' => $role];
    }

    public function post($uri, $controller, $role = 'ROLE_ANONYMOUS')
    {
        $this->routes['POST'][$uri] = ['controller' => $controller, 'role' => $role];
    }


    public static function load($file)
    {
        $router = new Router();
        require $file;
        return $router;
    }

    public function define($tablaRutas)
    {
        $this->routes = $tablaRutas;
    }

    public function callAction($controller, $action, $parameters)
    {
        try {
            $controller = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
            $objController = new $controller();

            if (method_exists($objController, $action)) {
                call_user_func_array(array($objController, $action), $parameters);
                return true;
            } else {
                throw new NotFoundException("El controlador $controller no responde a la action $action");
            }
        } catch (\TypeError $typeError) {
            return false;
        }
    }

    private function getParametersRoute($route, $matches)
    {
        preg_match_all('/:([^\/]+)/', $route, $parameterNames);

        $parameterNames = array_flip($parameterNames[1]);
        return array_intersect_key($matches, $parameterNames);
    }

    public function direct($uri, $method)
    {
        foreach ($this->routes[$method] as $route => $routeData) {
            $controller = $routeData['controller'];
            $minRole = $routeData['role'];
            $urlRule = $this->prepareRoute($route);

            if (preg_match($urlRule, $uri, $matches) === 1) {

                if (Security::isUserGranted($minRole) === false) {
                    if (!is_null(App::get('appUser'))) {
                        throw new AuthenticationException('Acceso no autorizado');
                    } else {
                        $this->redirect('login');
                    }
                } else {
                    $parameters = $this->getParametersRoute($route, $matches);
                    list($controller, $action) = explode('@', $controller);
                    if ($this->callAction($controller, $action, $parameters) === true) {
                        return;
                    }
                }
            }
        }
        throw new NotFoundException('No se ha definido la ruta para la uri solicitada');
    }

    public
    function redirect($path)
    {
        header('location: /' . $path);
        exit();
    }

    private
    function prepareRoute($route)
    {
        $urlRule = preg_replace('/:([^\/]+)/', '(?<\1>[^/]+)', $route);
        $urlRule = str_replace('/', '\/', $urlRule);
        return '/^' . $urlRule . '\/*$/s';
    }
}