<?php
function crearUsuarioVisitas($archivo, $user)
{
    $archivoVisitas = fopen($archivo, "a");
    $txt = "\n" . $user['name'] . "=" . 0;
    fwrite($archivoVisitas, $txt);
    fclose($archivoVisitas);
}
