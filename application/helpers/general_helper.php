<?php

function calenderToDb($date) {
    
   
    if(strstr($date,'/')) {  
        $arrSegments = explode("/", $date);
        return $arrSegments[2] .'-'.$arrSegments[0] .'-'.$arrSegments[1];
    }
    return '';
}


function cleanFileName($string) {
    $string = strtolower($string);
    $string = str_replace('&', '_', $string);
    $string = str_replace('?', '_', $string);
    $string = str_replace(' ', '_', $string);
    return $string;
}


?>