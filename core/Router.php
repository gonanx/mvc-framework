<?php

class Router
{

    public function ejecutar()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = trim($url, '/');
        $partes = explode('/', $url);

        $controlador = !empty($partes[0]) ? ucfirst($partes[0]) . "Controller" : "UsuarioController";
        $accion = $partes[1] ?? "login";
        $parametros = array_slice($partes, 2);

        $archivo = "../app/controllers/$controlador.php";

        if (file_exists($archivo)) {
            require_once $archivo;
            $obj = new $controlador();

            if (method_exists($obj, $accion)) {
                call_user_func_array([$obj, $accion], $parametros);
            } else {
                echo "Acción no encontrada";
            }
        } else {
            echo "Controlador no encontrado";
        }
    }
}
