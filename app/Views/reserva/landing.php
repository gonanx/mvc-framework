<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservar mesa</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/estilo.css">
</head>

<body class="page-loaded con-header">

    <?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="contenedor contenedor-espaciado">
        <h2>Buscar disponibilidad</h2>

        <form action="<?= BASE_URL ?>reserva/disponibilidad" method="POST">

            <label>Número de personas:</label>
            <input type="number" name="personas" min="1" max="8" required>

            <label>Fecha:</label>
            <input type="date" name="fecha" required>

            <button type="submit">Buscar</button>
        </form>

        <br>

        <a href="<?= BASE_URL ?>usuario/logout">Cerrar sesión</a>
    </div>

    <script src="<?= BASE_URL ?>js/transiciones.js"></script>
</body>

</html>