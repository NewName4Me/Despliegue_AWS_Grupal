<?php
session_start();
require('../utils/loginRegister/getArchivoUsersIni.php');
require('../utils/loginRegister/checkUserExists.php');
require('../utils/archivoLog/addLog.php');

//INICIALIZACIONES
$_SESSION["mensajeDeError"] = '';
$archivoUsersIni = __DIR__ . '/../users/users.ini';

//PETICIONES
$loginSolicitado = $_REQUEST["login"] ?? null;

//DATOS
$name = $_REQUEST["userName"] ?? null;
$password = $_REQUEST["userPassword"] ?? null;

if (isset($loginSolicitado)) {
    logearUser();
}

function logearUser()
{
    global $name;
    global $password;
    $arrayDeUsuarios = arrar_getArchivoUsuarios();

    //si el usuario no existe le redijimos a la pagina principal de vuelta
    if (!array_key_exists($name, $arrayDeUsuarios) || $arrayDeUsuarios[$name] != $password) {
        $_SESSION["mensajeDeError"] = "Nombre de Usuario o Contraseña Incorrectos";
        addMsgToLog('Error al logear usuario: Nombre o contraseña incorrectos');
        header('Location:..');
        exit;
    }

    //esta parte del codigo solo se ejecutara si el usuario es valido
    $_SESSION["usuarioValidado"] = true;
    $_SESSION["userName"] = $name;
    $_SESSION["publicacionEliminada"] = false;
    addMsgToLog('Succes: usuario logeado => ' . $name);
    header('Location: ../view/mainWall.php');
    exit;
}
