<?php

class Controller
{

    protected function vista($ruta, $datos = [])
    {
        extract($datos);
        require "../app/views/$ruta.php";
    }
}
