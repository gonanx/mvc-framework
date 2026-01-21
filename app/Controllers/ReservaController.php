<?php

require_once "../app/models/Mesa.php";
require_once "../app/models/Horario.php";
require_once "../app/models/Reserva.php";

class ReservaController extends Controller
{

    // Página principal después del login
    public function landing()
    {
        session_start();
        if (!isset($_SESSION["usuario_id"])) {
            header("Location: " . BASE_URL . "usuario/login");
            exit;
        }

        $this->vista("reserva/landing");
    }

    // Mostrar horarios disponibles según fecha y cantidad de personas
    public function disponibilidad()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $personas = $_POST["personas"];
            $fecha = $_POST["fecha"];

            $mesaModel = new Mesa();
            $horarioModel = new Horario();
            $reservaModel = new Reserva();

            // 1. Obtener todas las mesas con esa capacidad
            $mesas = $mesaModel->mesasPorCapacidad($personas);

            if (empty($mesas)) {
                $this->vista("reserva/disponibilidad", [
                    "error" => "No hay mesas para esa cantidad de personas.",
                    "personas" => $personas,
                    "fecha" => $fecha,
                    "horarios" => []
                ]);
                return;
            }

            // 2. Obtener todos los horarios
            $horarios = $horarioModel->todos();

            // 3. Filtrar horarios disponibles (al menos una mesa libre)
            $horariosDisponibles = [];

            foreach ($horarios as $h) {
                foreach ($mesas as $m) {
                    if ($reservaModel->mesaDisponible($m["id"], $h["id"], $fecha)) {
                        $horariosDisponibles[] = $h;
                        break;
                    }
                }
            }

            $this->vista("reserva/disponibilidad", [
                "personas" => $personas,
                "fecha" => $fecha,
                "horarios" => $horariosDisponibles
            ]);
        }
    }

    // Crear reserva
    public function reservar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $horario_id = $_POST["horario_id"];
            $fecha = $_POST["fecha"];
            $personas = $_POST["personas"];

            $mesaModel = new Mesa();
            $reservaModel = new Reserva();

            // Buscar mesas con esa capacidad
            $mesas = $mesaModel->mesasPorCapacidad($personas);

            // Buscar la primera mesa libre
            $mesaLibre = null;

            foreach ($mesas as $m) {
                if ($reservaModel->mesaDisponible($m["id"], $horario_id, $fecha)) {
                    $mesaLibre = $m["id"];
                    break;
                }
            }

            if (!$mesaLibre) {
                echo "No hay mesas disponibles para ese horario.";
                return;
            }

            session_start();
            $usuario_id = $_SESSION["usuario_id"];

            // Crear reserva (CORREGIDO: ahora incluye $personas)
            $reservaModel->crear(
                $usuario_id,
                $mesaLibre,
                $horario_id,
                $fecha,
                $personas
            );

            // Guardar datos de la reserva para mostrarlos en la confirmación
            $_SESSION["reserva_confirmada"] = [
                "fecha" => $fecha,
                "personas" => $personas,
                "horario" => $horario_id,
                "mesa" => $mesaLibre
            ];

            header("Location: " . BASE_URL . "reserva/confirmacion");
            exit;
        }
    }
    // Página de confirmación
    public function confirmacion()
    {
        session_start();
        if (!isset($_SESSION["usuario_id"])) {
            header("Location: " . BASE_URL . "usuario/login");
            exit;
        }

        $datos = $_SESSION["reserva_confirmada"] ?? null;

        $this->vista("reserva/confirmacion", [
            "reserva" => $datos
        ]);
    }

    public function misReservas()
    {
        session_start();
        if (!isset($_SESSION["usuario_id"])) {
            header("Location: " . BASE_URL . "usuario/login");
            exit;
        }

        $usuario_id = $_SESSION["usuario_id"];

        $reservaModel = new Reserva();
        $reservas = $reservaModel->reservasPorUsuario($usuario_id);

        include __DIR__ . "/../views/reserva/misreservas.php";
    }


}