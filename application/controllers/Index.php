<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {
    
    public function constructor() {
        
    }
    
    
    public function home() {
        $data = array();
        $this->content = 'home'; // passing middle to function. change this for different views.
        $this->layout();
    }
    
    
    
    
    
    
    
}


?>

