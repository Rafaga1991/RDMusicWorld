<?php

if(Session::Auth()){
    if(isset($_POST['idMusic'])){
        $music->like(
            [
                'idUser' => Session::getUserID(),
                'idMusic' => $_POST['idMusic']
            ]
        );
    }elseif(isset($_POST['delete'])){
        $music->deleteMusic($_POST['delete']);
        header("location: ./?view=$view");
    }
}

?>