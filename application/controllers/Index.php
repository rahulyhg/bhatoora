<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    
    public function constructor() {
        
    }
    
    
    public function home() {
        $data = array();
        $data['content'] = 'home';
        $this->load->view('templates/ui_template',$data);
    }
    
    
    
    
    
    
    
}


?>
