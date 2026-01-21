<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Disponibilidad</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/estilo.css">
</head>

<body class="page-loaded con-header">

    <?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="contenedor contenedor-disponibilidad contenedor-espaciado">

        <h2>Horarios disponibles</h2>

        <?php if (!empty($error)): ?>
            <p><?= $error ?></p>
            <a href="<?= BASE_URL ?>reserva/landing">Volver</a>
        <?php else: ?>

            <div class="tarjeta">

                <p><strong>Mesa para:</strong> <?= $personas ?> personas</p>
                <p><strong>Fecha:</strong> <?= $fecha ?></p>

                <form action="<?= BASE_URL ?>reserva/reservar" method="POST">

                    <label for="horario_id">Selecciona un horario:</label>
                    <select name="horario_id" id="horario_id" required>
                        <?php foreach ($horarios as $h): ?>
                            <option value="<?= $h["id"] ?>">
                                <?= $h["hora_inicio"] ?> - <?= $h["hora_fin"] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="hidden" name="fecha" value="<?= $fecha ?>">
                    <input type="hidden" name="personas" value="<?= $personas ?>">

                    <button type="submit">Reservar</button>
                </form>

            </div>

            <br>
            <a href="<?= BASE_URL ?>reserva/landing">Volver</a>

        <?php endif; ?>

    </div>

    <script src="<?= BASE_URL ?>js/transiciones.js"></script>
</body>

</html>