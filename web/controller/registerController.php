<?php
session_start();
require('../utils/loginRegister/getArchivoUsersIni.php');
require('../utils/loginRegister/checkUserExists.php');
require('../utils/visitas/crearUsuarioVisitas.php');
require('../utils/archivoLog/addLog.php');

//INICIALIZACIONES
$_SESSION["mensajeDeError"] = '';
$archivoUsersIni = __DIR__ . '/../users/users.ini';
$archivoUsersVisitas = __DIR__ . '/../users/visits.ini';

//PETICIONES
$registerSolicitado = $_REQUEST["register"] ?? null;

//DATOS
$name = $_REQUEST["userName"] ?? null;
$password = $_REQUEST["userPassword"] ?? null;
$passwordRepeat = $_REQUEST["userPasswordRepeat"] ?? null;

if (isset($registerSolicitado)) {
    createUserObj();
}

function createUserObj()
{
    global $name;
    global $password;
    global $passwordRepeat;

    if ($password != $passwordRepeat) {
        $mensajeDeError = 'Ambas contraseñas deben ser iguales';
        $_SESSION["mensajeDeError"] = $mensajeDeError;
        addMsgToLog('Error al registrar usuario: Ambas contraseñas deben ser iguales');
        header('Location:..');
        exit;
    }

    $user = array('name' => $name, 'password' => $password);
    registerUser($user);
}

function registerUser($user)
{
    $arrayDeUsuario = arrar_getArchivoUsuarios();

    // Si el usuario existe mostramos un error dado que no podemos tener dos llamados igual
    if (checkUserExists($user, $arrayDeUsuario)) {
        $mensajeDeError = 'Usuario ya existente';
        $_SESSION["mensajeDeError"] = $mensajeDeError;
        addMsgToLog('Error al registrar usuario: Usuario ya existente');
        header('Location: ..');
        exit;
    }

    // Añadimos el usuario al archivo ini
    global $archivoUsersIni;
    $archivoUsuarios = fopen($archivoUsersIni, "a");
    $txt = "\n" . $user['name'] . "=" . $user['password'];
    fwrite($archivoUsuarios, $txt);
    fclose($archivoUsuarios);

    //añadimos el usuario a visistPerUser.ini
    global $archivoUsersVisitas;
    crearUsuarioVisitas($archivoUsersVisitas, $user);

    createUserFolder();

    // Redirigimos a la página principal
    $_SESSION["usuarioValidado"] = true;
    $_SESSION["mensajeDeError"] = "Usuario Registrado Correctamente";
    header('Location: ..');
    exit;
}

function createUserFolder()
{
    $usersDirectory = __DIR__ . '/../users/';
    global $name;

    $userFolderPath = $usersDirectory . $name;
    mkdir($userFolderPath, 0777, true);
    addMsgToLog('Success: Carpeta creada usuario => ' . $name);
}
