<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/estilo.css">

</head>

<body class="centrado page-loaded"> 
    <div class="contenedor">
        <h2>Iniciar sesión</h2>

        <form action="<?= BASE_URL ?>usuario/autenticar" method="POST">
            <label>Correo:</label>
            <input type="email" name="correo" required>

            <label>Contraseña:</label>
            <input type="password" name="contraseña" required>

            <button type="submit">Entrar</button>
        </form>

        <a href="<?= BASE_URL ?>usuario/registro">Crear cuenta nueva</a>
    </div>
    <script src="<?= BASE_URL ?>js/transiciones.js"></script>

</body>

</html>