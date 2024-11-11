<?php
session_start();
require('../utils/archivoLog/addLog.php');

// PETICIONES
$uploadSolicitado = $_POST["uploadPublication"] ?? null;
$userName = $_SESSION["userName"];

// DATOS
$title = $_POST["title"] ?? '';
$content = $_POST["content"] ?? '';
$img = $_FILES["img"]["tmp_name"] ?? '';

if (!empty($img) && file_exists($img)) {
    $imgData = file_get_contents($img);
    $img = base64_encode($imgData);
}

if (isset($uploadSolicitado)) {
    crearObjetoPublicacion();
}

function crearObjetoPublicacion()
{
    global $userName;
    global $title;
    global $content;
    global $img;

    $date = round(microtime(true) * 1000);

    $publicationObj = array(
        'userName' => $userName,
        'title' => $title,
        'img' => $img,
        'content' => $content,
        'comentarios' => [],
        'date' => $date
    );

    addPublicationToUserFolder($publicationObj);
}

function addPublicationToUserFolder($publicationObj)
{
    global $userName;

    $usersDirectory = __DIR__ . '/../users/';
    $userFolderPath = $usersDirectory . $publicationObj['userName'];

    if (!file_exists($userFolderPath)) {
        mkdir($userFolderPath, 0777, true);
    }

    $publicationFilePath = $userFolderPath . DIRECTORY_SEPARATOR . $publicationObj['date'] . '.json';

    file_put_contents($publicationFilePath, json_encode($publicationObj, JSON_PRETTY_PRINT));

    addMsgToLog('Success: Publacion ' . $publicationObj['date'] . 'por el usuario ' . $userName . ' publicada');

    header('Location:../view/mainWall.php');
    exit;
}
