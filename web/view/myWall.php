<?php
// Asegúrate de que la sesión esté iniciada
require('../utils/userPublication/displayUserPublication.php');
require('../utils/visitas/aumentarVisitas.php');
require('../utils/visitas/getNumeroVisitas.php');

// Obtener publicaciones del usuario
$publicaciones = obtenerPublicacionesDeUsuario();
$nVisitas = getNumeroVisitas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/mywall.css">
    <link rel="stylesheet" href="../public/css/comun.css">
    <title>My Wall</title>
</head>

<body>
    <header>
        <nav>
            <a href="../view/mainWall.php">Main Wall</a>
            <a href="#">My Wall</a>
        </nav>
    </header>

    <div class="modalMostrarVisitas">
        <p>Visitas del perfil: <?php echo $nVisitas; ?></p>
    </div>

    <article class="publication">
        <?php foreach ($publicaciones as $publicacion): ?>
            <div class="publicacionIndividual">
                <section class="cabeceraPublicacion">
                    <p class="userName"><?= htmlspecialchars($publicacion['userName']) ?></p>
                    <p class="date"><?= htmlspecialchars($publicacion['date']) ?></p>
                </section>
                <p class="title"><?= htmlspecialchars($publicacion['title']) ?></p>
                <p class="content"><?= htmlspecialchars($publicacion['content']) ?></p>
                <?php if (!empty($publicacion['img'])): ?>
                    <div class="imgCont">
                        <img src="data:image/jpeg;base64,<?= $publicacion['img'] ?>" alt="Imagen de la publicación" class="imgPublicacion">
                    </div>
                <?php endif; ?>
                <div class="comentarios">
                    <h2>Comentarios</h2>
                    <ul>
                        <?php foreach ($publicacion['comentarios'] as $comentario): ?>
                            <li class="comentario"><?= htmlspecialchars($comentario) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Muestro solo la opción de eliminar si estoy en mi usuario -->
                <?php if ($user == $_SESSION["userName"]): ?>
                    <form action="../controller/eliminarPublicacionController.php" method="GET">
                        <input type="hidden" name="id" value="<?= $publicacion['fecha'] ?>">
                        <input type="submit" class="deleteBtn" value="Eliminar" name="eliminar">
                    </form>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
    </article>
</body>

</html>