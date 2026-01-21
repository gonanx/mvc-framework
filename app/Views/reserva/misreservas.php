<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis reservas</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/estilo.css">
</head>

<body class="page-loaded con-header">

    <?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="contenedor contenedor-espaciado">

        <h2>Mis reservas</h2>

        <?php if (empty($reservas)): ?>

            <div class="tarjeta">
                <p>No tienes reservas realizadas.</p>
                <a href="<?= BASE_URL ?>reserva/landing">
                    <button>Hacer una reserva</button>
                </a>
            </div>

        <?php else: ?>

            <?php foreach ($reservas as $r): ?>
                <div class="tarjeta" style="margin-bottom: 25px;">

                    <p><strong>Fecha:</strong>
                        <?= $r["fecha"] ?>
                    </p>
                    <p><strong>Personas:</strong>
                        <?= $r["personas"] ?>
                    </p>
                    <p><strong>Mesa:</strong>
                        <?= $r["mesa_id"] ?>
                    </p>
                    <p><strong>Horario:</strong>
                        <?= $r["hora_inicio"] ?> -
                        <?= $r["hora_fin"] ?>
                    </p>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</body>

</html>