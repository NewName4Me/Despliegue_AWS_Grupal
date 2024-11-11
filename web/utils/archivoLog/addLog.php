<?php
$archivoLog = __DIR__ . '/../../console.log';

function addMsgToLog($msg)
{
    global $archivoLog;

    $fecha = date('Y-m-d H:i:s');
    $contenido = "$fecha - $msg\n";
    file_put_contents($archivoLog, $contenido, FILE_APPEND);
}
