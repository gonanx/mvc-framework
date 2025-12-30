<?php
namespace Core;

class Router
{
    public function dispatch(): void
    {
        // -------------------------------------------------
        // 1. Obtener la URL
        // -------------------------------------------------
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');

        $segments = explode('/', $url);

        // -------------------------------------------------
        // 2. Definir controlador, método y parámetros
        // -------------------------------------------------
        $controllerName = !empty($segments[0])
            ? ucfirst($segments[0]) . 'Controller'
            : 'HomeController';

        $method = $segments[1] ?? 'index';

        $params = array_slice($segments, 2);

        // -------------------------------------------------
        // 3. Ruta al controlador
        // -------------------------------------------------
        $controllerClass = 'App\\Controllers\\' . $controllerName;



        if (!class_exists($controllerClass)) {
            die("❌ Clase $controllerClass no existe");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            die("❌ Método $method no existe en $controllerName");
        }

        // -------------------------------------------------
        // 4. Ejecutar controlador y método
        // -------------------------------------------------
        call_user_func_array([$controller, $method], $params);
    }
}