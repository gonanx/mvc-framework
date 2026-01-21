<?php

require_once "../app/models/Usuario.php";

class UsuarioController extends Controller
{

    public function registro()
    {
        $this->vista("usuario/registro");
    }

    public function registrar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

            $usuario = new Usuario();
            $existe = $usuario->buscarPorCorreo($correo);

            if ($existe) {
                echo "El correo ya está registrado";
                return;
            }

            $usuario->crear($nombre, $correo, $contraseña);

            header("Location: " . BASE_URL . "usuario/login");
            exit;
        }
    }

    public function login()
    {
        $this->vista("usuario/login");
    }

    public function autenticar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $correo = $_POST["correo"];
            $contraseña = $_POST["contraseña"];

            $usuario = new Usuario();
            $datos = $usuario->buscarPorCorreo($correo);

            if (!$datos || !password_verify($contraseña, $datos["contraseña"])) {
                echo "Credenciales incorrectas";
                return;
            }

            session_start();
            $_SESSION["usuario_id"] = $datos["id"];

            header("Location: " . BASE_URL . "reserva/landing");
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL . "usuario/login");
        exit;
    }
}
