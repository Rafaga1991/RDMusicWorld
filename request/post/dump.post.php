<?php

if (Session::Auth()) {
    if (isset($_POST['delete']) && isset($_POST['origin'])) {
        switch ($_POST['origin']) {
            case 'listplayer':
                $listplayer->deleteList($_POST['delete']);
                break;
            case 'music':
                $music->deleteMusic($_POST['delete']);
                break;
        }
    }
}

header("location: ./?view=$view");
