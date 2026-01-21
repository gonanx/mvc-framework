-- Crear base de datos
CREATE DATABASE reservas
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE reservas;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    creado_en DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla mesas
CREATE TABLE mesas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    capacidad TINYINT NOT NULL CHECK (capacidad BETWEEN 1 AND 8),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla horarios (horarios fijos compartidos)
CREATE TABLE horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dia_semana TINYINT NOT NULL, -- 0=Domingo, 1=Lunes...
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL
);

-- Tabla reservas_mesas
CREATE TABLE reservas_mesas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    mesa_id INT NOT NULL,
    horario_id INT NOT NULL,
    fecha DATE NOT NULL,
    cantidad_personas TINYINT NOT NULL CHECK (cantidad_personas BETWEEN 1 AND 8),
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'confirmada',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (mesa_id) REFERENCES mesas(id),
    FOREIGN KEY (horario_id) REFERENCES horarios(id)
);

-- Insertar mesas de ejemplo
INSERT INTO mesas (nombre, capacidad) VALUES
('Mesa 1', 2),
('Mesa 2', 4),
('Mesa 3', 6),
('Mesa 4', 8);

-- Insertar horarios de ejemplo
INSERT INTO horarios (dia_semana, hora_inicio, hora_fin) VALUES
(1, '13:00', '14:00'),
(1, '14:00', '15:00'),
(1, '20:00', '22:00'),
(2, '13:00', '14:00'),
(2, '14:00', '15:00'),
(2, '20:00', '22:00');
