<?php

function getElementsDelete(array $elements){
    $data = [];
    foreach($elements as $element){
        foreach($element as $value){
            array_push($data, $value);
        }
    }
    krsort($data);
    return $data;
}