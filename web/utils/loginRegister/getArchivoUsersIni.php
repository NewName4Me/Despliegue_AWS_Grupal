<?php
function arrar_getArchivoUsuarios()
{
    global $archivoUsersIni;

    if (!file_exists($archivoUsersIni)) {
        return [];
    }

    return parse_ini_file($archivoUsersIni) ?? [];
}
