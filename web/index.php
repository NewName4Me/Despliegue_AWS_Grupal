<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/comun.css">
    <link rel="stylesheet" href="./public/css/index.css">
    <title>Our Wall</title>
</head>

<body>
    <h2><?php echo $_SESSION["mensajeDeError"] ?? '' ?></h2>
    <main>
        <section>
            <h2>Login</h2>
            <form action="./controller/loginController.php" method="POST">
                <label for="userName">Nombre de usuario:</label>
                <input type="text" name="userName" id="userName" placeholder="nombre usuario">
                <label for="userPassword">Contraseña:</label>
                <input type="password" name="userPassword" id="userPassword" placeholder="contraseña">
                <input type="submit" name="login" id="login" value="Iniciar sesión">
            </form>

        </section>
        <div></div>
        <section>
            <h2>Registrar</h2>
            <form action="./controller/registerController.php" method="POST">
                <label for="userName">Nombre de usuario:</label>
                <input type="text" name="userName" id="userName" placeholder="nombre usuario">
                <label for="userPassword">Contraseña:</label>
                <input type="password" name="userPassword" id="userPassword" placeholder="contraseña">
                <label for="userPasswordRepeat">Repetir contraseña:</label>
                <input type="password" name="userPasswordRepeat" id="userPasswordRepeat" placeholder="repetir contraseña">
                <input type="submit" name="register" id="register" value="Registrarse">
            </form>
        </section>
    </main>

    <!-- <script>
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    </script> -->
</body>

</html>