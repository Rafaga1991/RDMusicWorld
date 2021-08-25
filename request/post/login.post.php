<?php

$redirect = "./?view=$view";
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($user->isAccess($_POST)) {
        $redirect = './';
    }
}
header("location: $redirect");

?>