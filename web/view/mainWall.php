<?php
require('../utils/validations/checkUserValidated.php');
require('../utils/mainWall/showListOfPublications.php');
require('../utils/mainWall/showListOfUsers.php');
$publicaciones = showListOfPublications();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/mainWall.css">
    <link rel="stylesheet" href="../public/css/comun.css">
    <title>Principal</title>
</head>

<body>
    <header>
        <nav>
            <a href="#">Main Wall</a>
            <a href="../view/myWall.php?user=<?= $_SESSION["userName"] ?>">My Wall</a>
        </nav>
    </header>

    <div class="modalCerrarSesion">
        <figure>
            <form action="../utils/sesion/cerrarSesion.php">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16" id="door">
                        <path fill="#212121" d="M7.50960968,1.99999909 L7.59806,2.00971 L12.5981,3.00971 C12.8025875,3.05061625 12.9569266,3.21283578 12.9923162,3.41242007 L13,3.49999909 L13,12.4969 C13,12.7054125 12.8712219,12.8885828 12.6824666,12.9624697 L12.5981,12.9872 L7.59806,13.9872 C7.45117,14.0166 7.29885,13.9785 7.18301,13.8836 C7.09033,13.8076 7.0288116,13.701584 7.00791144,13.58552 L7,13.4969 L7,2.49999909 L7.00791144,2.41138361 C7.0288116,2.2953236 7.09033,2.189306 7.18301,2.11333 C7.275682,2.037354 7.3917012,1.997826 7.50960968,1.99999909 Z M6,3 L6,4 L4,4 L4,11.9969 L6,11.9969 L6,12.9969 L3.5,12.9969 C3.25454222,12.9969 3.0503921,12.8199914 3.00805575,12.5867645 L3,12.4969 L3,3.5 C3,3.25454222 3.17687704,3.0503921 3.41012499,3.00805575 L3.5,3 L6,3 Z M8,3.10991 L8,12.887 L12,12.087 L12,3.90991 L8,3.10991 Z M9.5,7.49841 C9.77614,7.49841 10,7.72227 10,7.99841 C10,8.27456 9.77614,8.49841 9.5,8.49841 C9.22386,8.49841 9,8.27456 9,7.99841 C9,7.72227 9.22386,7.49841 9.5,7.49841 Z"></path>
                    </svg>
                </button>
            </form>
        </figure>
    </div>

    <label for="showFormUpload">+</label>
    <input type="checkbox" name="showFormUpload" id="showFormUpload">
    <section id="modalPublicacion">
        <h2>Crear una publicacion</h2>
        <form action="../controller/publicationUploadController.php" method="POST" enctype="multipart/form-data">
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" required>
            <label for="content">Contenido</label>
            <textarea name="content" id="content" required></textarea>
            <label for="img">Subir imagen</label>
            <input type="file" name="img" id="img">

            <button type="submit" name="uploadPublication">Publicar</button>
        </form>
    </section>

    <main>
        <article class="publication">
            <?php foreach ($publicaciones as $publicacion): ?>
                <div class="publicacionIndividual">
                    <section class="cabeceraPublicacion">
                        <p class="userName"><?= $publicacion['userName'] ?></p>
                        <p class="date"><?= $publicacion['date'] ?></p>
                    </section>
                    <p class="title"><?= $publicacion['title'] ?></p>
                    <p class="content"><?= $publicacion['content'] ?></p>

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
                    <div class="Addcomentario">
                        <form action="../controller/addComentController.php" method="GET">
                            <input type="hidden" name="publicationId" value="<?= $publicacion["fecha"]  ?>">
                            <input type="hidden" name="user" value="<?= $publicacion["userName"]  ?>">
                            <input type="text" name="comentBody" placeholder="Añadir Comentario">
                            <input type="submit" value="Publicar" name="addComentario">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </article>
    </main>


    <section class="modalListaUsuarios">
        <h2>Lista de Usuarios</h2>
        <ul>
            <?php foreach (showListOfUsers() as $user): ?>
                <li>
                    <form action="../view/myWall.php" method="GET">
                        <input type="hidden" name="user" value="<?= $user ?>">
                        <button type="submit"><?= $user ?></button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <?php if (isset($_SESSION["publicacionEliminada"]) && $_SESSION["publicacionEliminada"] == true): ?>
        <section class="publicacionEliminada" id="publicacionEliminada">
            <h3>La publicación se ha eliminado correctamente</h3>
        </section>
        <script>
            setTimeout(() => {
                document.getElementById('publicacionEliminada').style.display = 'none';
            }, 2000);
        </script>
        <?php $_SESSION["publicacionEliminada"] = false; ?>
    <?php endif ?>
</body>

</html>