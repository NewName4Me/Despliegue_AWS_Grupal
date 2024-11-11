<?php

function showListOfUsers()
{
    $rutaBaseUsuarios = __DIR__ . '/../../users/';
    $usersList = array_diff(scandir($rutaBaseUsuarios), ['.', '..', 'users.ini', 'visits.ini']);
    return $usersList;
}
