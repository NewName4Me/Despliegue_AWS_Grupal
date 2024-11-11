<?php

function getNumeroVisitas()
{

    $archivoUsersVisitas = __DIR__ . '/../../users/visits.ini';
    $user = $_GET["user"] ?? $_SESSION["userName"];

    $visitas = parse_ini_file($archivoUsersVisitas);
    return $visitas[$user];
}
