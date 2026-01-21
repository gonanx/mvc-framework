<?php

class Horario extends Model
{
    // Obtener todos los horarios ordenados por hora de inicio
    public function todos()
    {
        $sql = "SELECT * FROM horarios ORDER BY hora_inicio ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Obtener un horario por su ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM horarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
