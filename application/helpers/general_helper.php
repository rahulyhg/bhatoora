<?php

function calenderToDb($date) {
    
   
    if(strstr($date,'/')) {  
        $arrSegments = explode("/", $date);
        return $arrSegments[2] .'-'.$arrSegments[0] .'-'.$arrSegments[1];
    }
    return '';
}


?>