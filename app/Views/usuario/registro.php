<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/estilo.css">

</head>

<body>
    <div class="contenedor">
        <h2>Registro</h2>

        <form action="<?= BASE_URL ?>usuario/registrar" method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Correo:</label>
            <input type="email" name="correo" required>

            <label>Contraseña:</label>
            <input type="password" name="contraseña" required>

            <button type="submit">Registrarse</button>
        </form>

        <a href="<?= BASE_URL ?>usuario/login">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
    <script src="<?= BASE_URL ?>js/transiciones.js"></script>

</body>

</html>