<?php

function checkUserExists($user, $file)
{
    return array_key_exists($user['name'], $file);
}
