<?php ob_start();

class MY_Controller extends CI_Controller

{

    public $data = array();
    public $template = array();
    public $content = '';
    
    function __construct() {
        parent::__construct();
        $this->data['site_title'] = config_item('site_name');
        $this->load->helper('language');
        $this->data['errors'] = array();
    }
    
    //Load layout    
    public function layout() {
        // making temlate and send data to view.
        $this->template['header']      = $this->load->view('layouts/header', $this->data, true);
        $this->template['content']     = $this->load->view($this->content, $this->data, true);
        $this->template['footer']      = $this->load->view('layouts/footer', $this->data, true);
        $this->load->view('layouts/index', $this->template);
    }
   
}


class Admin_Controller extends CI_Controller {

    public $data = array();
    public $template = array();
    
    function __construct() {
        parent::__construct();
        $this->data['site_title'] = config_item('site_name');
        $this->load->helper('language');
        $this->data['errors'] = array();
        
    
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
          //redirect them to the login page
          redirect('auth/login', 'refresh');
        }
        $this->data['page_title'] = config_item('site_name');
        
    }
    
        
//    function __construct()
//    {
//        parent::__construct();
//        $this->load->library('ion_auth');
//        if (!$this->ion_auth->logged_in())
//        {
//          //redirect them to the login page
//          redirect('admin/user/login', 'refresh');
//        }
//        $this->data['page_title'] = 'CI App - Dashboard';
//    }
//    
//    protected function render($the_view = NULL, $template = 'admin_master')
//    {
//        parent::render($the_view, $template);
//    }
    
     //Load layout    
    public function layout() { 
        // making temlate and send data to view.
        $this->template['header']      = $this->load->view('admin/layouts/header', $this->data, true);
        $this->template['left_menu']   = $this->load->view('admin/layouts/left_menu', $this->data, true);
        $this->template['content']     = $this->load->view($this->content, $this->data, true);
        $this->template['footer']      = $this->load->view('admin/layouts/footer', $this->data, true);
        $this->load->view('admin/layouts/index', $this->template);
    }

}
 

?>