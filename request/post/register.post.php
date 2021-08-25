<?php

$newUser = false;
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rpassword'])) {
    if (!$user->exists($_POST['username'])) {
        if (strpos('_' . $_POST['username'], ' ') <= 0) {
            if ($_POST['password'] == $_POST['rpassword']) {
                $user->newUser($_POST);
                $message = 'Usuario creado con exito!';
                $newUser = true;
            } else {
                $message = "Las claves no coinciden.";
            }
        } else {
            $message = "El nombre de usuario <b>\"{$_POST['username']}\"</b> no debe tener espacios.";
        }
    } else {
        $message = "El usuario <b>{$_POST['username']}</b> existe.";
    }
}

header("location: ./?view=$view&newuser=$newUser&message=$message");

?>