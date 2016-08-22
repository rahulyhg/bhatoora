<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    function login() {
//        $this->data['content'] = 'user_login.php';
//        $this->_render_page('templates/ui_template', $this->data);
        
        $this->load->view('user_login');
    }
}
