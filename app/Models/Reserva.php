<?php

class Reserva extends Model
{
    // Verificar si una mesa está disponible en un horario y fecha
    public function mesaDisponible($mesa_id, $horario_id, $fecha)
    {
        $sql = "SELECT id FROM reservas_mesas 
                WHERE mesa_id = ? AND horario_id = ? AND fecha = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mesa_id, $horario_id, $fecha]);

        // Si NO hay registros → mesa libre
        return $stmt->rowCount() === 0;
    }

    // Crear reserva
    public function crear($usuario_id, $mesa_id, $horario_id, $fecha, $personas)
    {
        // Validación básica
        if (!$usuario_id || !$mesa_id || !$horario_id || !$fecha || !$personas) {
            return false;
        }

        $sql = "INSERT INTO reservas_mesas 
            (usuario_id, mesa_id, horario_id, fecha, cantidad_personas) 
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $usuario_id,
            $mesa_id,
            $horario_id,
            $fecha,
            $personas
        ]);
    }

    public function reservasPorUsuario($usuario_id)
    {
        $sql = "SELECT r.id, r.fecha, r.personas, r.mesa_id, 
                   h.hora_inicio, h.hora_fin
            FROM reservas r
            INNER JOIN horarios h ON r.horario_id = h.id
            WHERE r.usuario_id = ?
            ORDER BY r.fecha ASC, h.hora_inicio ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}