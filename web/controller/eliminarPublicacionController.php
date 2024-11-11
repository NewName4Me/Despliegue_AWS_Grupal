<?php
session_start();
require('../utils/archivoLog/addLog.php');

$userName = $_SESSION["userName"] ?? '';
$eliminarPeticion = $_REQUEST["eliminar"] ?? null;
$id = $_REQUEST["id"];

if (isset($eliminarPeticion)) {
    eliminarPublicacion($id);
}

function eliminarPublicacion($id)
{
    global $userName;
    $rutaArchivoAEliminar = __DIR__ . '/../users/' . $userName . '/' . $id . '.json';

    if (file_exists($rutaArchivoAEliminar)) {
        unlink($rutaArchivoAEliminar);
    }

    $_SESSION["publicacionEliminada"] = true;
    addMsgToLog('Deleted: Publicacion ' . $rutaArchivoAEliminar . ' eliminada');
    header('Location: ../view/mainWall.php');
    exit;
}
