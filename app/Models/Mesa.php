<?php

class Mesa extends Model
{

    // Obtener mesas con capacidad suficiente
    public function mesasPorCapacidad($personas)
    {
        $sql = "SELECT * FROM mesas WHERE capacidad = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$personas]);
        return $stmt->fetchAll();
    }
}
