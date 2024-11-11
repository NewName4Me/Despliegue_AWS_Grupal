<?php

function showListOfPublications()
{
    $rutaBaseUsuarios = __DIR__ . '/../../users/';
    $listaUsuarios = array_diff(scandir($rutaBaseUsuarios), ['.', '..', 'users.ini', 'visits.ini']);
    $publicaciones = [];

    //recoro las carpetas de users
    foreach ($listaUsuarios as $nombreUsuario) {
        $rutaCarpetaUsuario = $rutaBaseUsuarios . DIRECTORY_SEPARATOR . $nombreUsuario;

        $archivosUsuario = scandir($rutaCarpetaUsuario);

        //recorro todos los archivos dentro de cada carpeta de usuario
        foreach ($archivosUsuario as $archivo) {

            //si el archivo es JSON meto su contenido en el array
            if (pathinfo($archivo, PATHINFO_EXTENSION) === 'json') {
                $rutaArchivoJSON = $rutaCarpetaUsuario . '/' . $archivo;
                $contenido = file_get_contents($rutaArchivoJSON);
                $publicacion = json_decode($contenido, true);

                //le doy a la fecha un formato más legible
                $fechaLegible = date('Y-m-d H:i:s', floor($publicacion['date'] / 1000));

                $publicaciones[] = [
                    'title' => htmlspecialchars($publicacion['title']),
                    'userName' => htmlspecialchars($publicacion['userName']),
                    'content' => htmlspecialchars($publicacion['content']),
                    'img' => $publicacion['img'] ?? '',
                    'date' => htmlspecialchars($fechaLegible),
                    'comentarios' => $publicacion['comentarios'],
                    'fecha' => $publicacion['date'],
                ];
            }
        }
    }

    //ordeno el array de publicaciones por fecha realizada
    usort($publicaciones, function ($a, $b) {
        return $b['fecha'] <=> $a['fecha'];
    });

    return $publicaciones;
}
