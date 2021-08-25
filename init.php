<?php

date_default_timezone_set('America/Santo_Domingo');

include './etc/SearchFilePath.php';
include './etc/functions.php';
include './controller/html/Html.controller.php';
include './controller/connection/Connection.controller.php';
include './controller/user/Session.controller.php';
include './controller/music/Music.controller.php';
include './controller/user/User.controller.php';
include './controller/listplayer/ListMusic.controller.php';
include './controller/listplayer/ListPlayer.controller.php';

$paths = SearchFilePath::getFilesFilter('.controller', 'controller');
$page = SearchFilePath::getFiles();

$exception = ['connection', 'session'];// archivos que no deben instanciarse

foreach ($paths as $path){// Creando variables de instancias
    $file = explode('/', $path);
    $file = $file[count($file)-2];
    $filename = explode('.', $file)[0];
    if(!in_array(strtolower($filename), $exception)){
        eval('$' . strtolower($filename) . ' = new ' . $filename . '();');
    }
}

$views = $page['VIEW']['FILE_DIR'];// vistas
$view = isset($_GET['view']) ? $_GET['view'] : 'home';// vista

if(!Session::Auth()){// validando las páginas que puede ver sin iniciar sesión
    $view = in_array($view, ['login', 'home', 'register', '404', '403']) ? $view : 'home';
}

// verificando existencia de vista
$view = isset($views[$view])? $view : '404';

// cargando rutas de archivos en variables
$styles = $page['STYLE']['FILE_DIR'];// hojas de estilos.
$styles['googlefonts'] = 'https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800';
$styles['fontawesome'] = 'https://use.fontawesome.com/releases/v5.0.6/css/all.css';

$scripts = $page['SCRIPT']['FILE_DIR'];// scripts.
$assets = $page['ASSETS'];// multimedia

$gennerMusical = $music->getGennersMusical();
$musics = $music->getMusics((isset($_GET['search']) ? $_GET['search'] : null));
$listsName = $listplayer->getListName();

if(isset($_GET['listmusic'])){
    if(!empty($_GET['listmusic'])){
        $listMusics = $listplayer->getListMusic($_GET['listmusic']);
        if(empty($listMusics)){
            header("location: ./?view=$view");
        }
    }else{
        header("location: ./?view=$view");
    }
}

$elementDelete = getElementsDelete([
    $listplayer->getDelete(),
    $music->getDelete()
]);