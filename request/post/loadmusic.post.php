<?php
$sound = [];

$ext = explode('.', $_FILES['fileMusic']['name']);
$ext = $ext[count($ext)-1];

$sound['nameMusic'] = $_POST['txtTitle'];
$sound['formatMusic'] = $_FILES['fileMusic']['type'];
$sound['fileNameMusic']= md5($_POST['txtTitle'] . time());
$sound['fileSizeMusic'] = $_FILES['fileMusic']['size'];
$sound['descriptionMusic'] = $_POST['txtDescription'];
$sound['authorMusic'] = $_POST['txtAuthor'];
$sound['idGenner'] = $_POST['genner'];
$sound['idUser'] = Session::getUserID();

$message = 'Archivo cargado con exito.';
$color = 'success';

if(in_array(strtoupper($ext), ['WAV', 'AIFF','AU','FLAC','MPEG-4','SHORTEN','TTA','ATRAC','APPLE', 'LOSSLESS','MP3','VORBIS','MUSEPACK','AAC','WMA','OPUS','OGG','DSD','MQA'])){
    $music->newMusic($sound);
    $fileName = "{$assets['SOUND']['PATH_DIR']}/{$sound['fileNameMusic']}.$ext";
    move_uploaded_file($_FILES['fileMusic']['tmp_name'], $fileName);
}else{
    $message = 'Formato no válido!';
    $color = 'danger';
}

header("location: ./?view=$view&message=$message&action=$color");