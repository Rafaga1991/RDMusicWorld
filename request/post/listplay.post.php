<?php
    if(Session::Auth()){
        if(isset($_POST['txtListName'])){
            $listplayer->newList($_POST['txtListName']);
        }elseif(isset($_POST['deleteList'])){
            $listplayer->deleteList($_POST['deleteList']);
        }elseif(isset($_POST['idMusic']) && isset($_POST['idList'])){
            $listplayer->addMusicToList($_POST['idList'], $_POST['idMusic']);
            $view = "$view&listmusic=" . md5($_POST['idList']);
        }
    }

    header("location: ./?view=$view");
?>