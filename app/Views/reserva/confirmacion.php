<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva confirmada</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/estilo.css">
</head>

<body class="page-loaded con-header">

    <?php include __DIR__ . '/../layout/header.php'; ?>

    <?php
    $horarioModel = new Horario();
    $horario = $horarioModel->obtenerPorId($reserva["horario"]);
    ?>

    <div class="contenedor contenedor-espaciado">

        <h2>Reserva confirmada</h2>

        <div class="tarjeta">

            <p style="font-size: 22px; font-weight: bold; color: #5a0f1b; margin-bottom: 10px;">
                ¡Tu reserva ha sido realizada con éxito!
            </p>

            <p style="margin-bottom: 20px; color: #4a3f35;">
                Hemos asignado automáticamente la mejor mesa disponible.
            </p>

            <div style="text-align: left; margin: 0 auto; max-width: 260px; font-size: 16px;">

                <p><strong>Fecha:</strong> <?= htmlspecialchars($reserva["fecha"]) ?></p>
                <p><strong>Personas:</strong> <?= htmlspecialchars($reserva["personas"]) ?></p>
                <p><strong>Horario:</strong>
                    <?= htmlspecialchars($horario["hora_inicio"]) ?> -
                    <?= htmlspecialchars($horario["hora_fin"]) ?>
                </p>
                <p><strong>Mesa asignada:</strong> Mesa <?= htmlspecialchars($reserva["mesa"]) ?></p>

            </div>

            <br>

            <a href="<?= BASE_URL ?>reserva/landing">
                <button>Volver al inicio</button>
            </a>

        </div>

    </div>

</body>

</html>