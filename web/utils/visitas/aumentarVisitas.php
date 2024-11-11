<?php
$archivoUsersVisitas = __DIR__ . '/../../users/visits.ini';
$user = $_GET["user"] ?? $_SESSION["userName"];

// Aumentar visitas en visits.ini si es necesario
function aumentarVisitasSiEsAdecuado($user, $archivoUsersVisitas)
{
    if ($_SESSION["userName"] != $user) {
        $usuariosVisitas = parse_ini_file($archivoUsersVisitas);

        // Aumentar contador de visitas
        if (isset($usuariosVisitas[$user])) {
            $usuariosVisitas[$user] = (int)$usuariosVisitas[$user] + 1;
        } else {
            $usuariosVisitas[$user] = 1; // Si no existe, iniciar en 1
        }

        // Escribir de nuevo el contenido actualizado al archivo visits.ini
        file_put_contents($archivoUsersVisitas, "");

        foreach ($usuariosVisitas as $usuario => $visitas) {
            file_put_contents($archivoUsersVisitas, "$usuario=$visitas\n", FILE_APPEND);
        }
    }
}

// Llama a la función para aumentar visitas
aumentarVisitasSiEsAdecuado($user, $archivoUsersVisitas);
