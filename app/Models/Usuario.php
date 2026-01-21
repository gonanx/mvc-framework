<?php

class Usuario extends Model
{

    public function crear($nombre, $correo, $contraseña)
    {
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $correo, $contraseña]);
    }

    public function buscarPorCorreo($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch();
    }
}
