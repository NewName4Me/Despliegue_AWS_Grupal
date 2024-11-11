<?php
require('../utils/archivoLog/addLog.php');

$addComentSolicitado = $_REQUEST["addComentario"] ?? null;

if (isset($addComentSolicitado)) {
    $data = getDataFromForm();
    $filePath = findFileById($data);

    if ($filePath) {
        addCommentToJson($filePath, $data['body']);

        header('Location:../view/mainWall.php');
        exit;
    }
}

function getDataFromForm()
{
    $publicationId = $_GET['publicationId'];
    $user = $_GET['user'];
    $comentBody = $_GET['comentBody'];

    addMsgToLog('Comentario añadido a la publicacion ' . $publicationId);

    return array(
        'id' => $publicationId,
        'user' => $user,
        'body' => $comentBody
    );
}

function findFileById($data)
{
    $usersDirectory = __DIR__ . '/../users/';
    $userFolderPath = $usersDirectory . $data['user'];

    if (is_dir($userFolderPath)) {
        $userPublications = array_diff(scandir($userFolderPath), ['.', '..']);
        foreach ($userPublications as $publicationFile) {
            if (strpos($publicationFile, $data['id']) !== false) {
                return $userFolderPath . '/' . $publicationFile;
            }
        }
    }
    return null;
}

function addCommentToJson($filePath, $comment)
{
    $fileContent = file_get_contents($filePath);
    $fileJson = json_decode($fileContent, true);

    $fileJson['comentarios'][] = $comment;

    file_put_contents(
        $filePath,
        json_encode($fileJson, JSON_PRETTY_PRINT)
    );
}
