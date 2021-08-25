<?php

include './init.php';

$html->setTitle('RDMusicWorld');
$html->setIconPage($assets['IMAGE']['FILE_DIR']['music']);
$html->loadStyles($styles);
$html->loadScripts($scripts);

ob_start();
if(!empty($_POST)){
    include $page['REQUEST']['POST']['FILE_DIR'][$view];
}else{
    include $views[$view];
}
$view_page = ob_get_clean();

$html->loadHTML($view_page, $view);

$html->output();