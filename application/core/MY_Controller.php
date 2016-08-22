<?php ob_start();

class MY_Controller extends CI_Controller

{

    public $data = array();
    
    function __construct() {
        parent::__construct();
        $this->data['site_title'] = config_item('site_name');
        $this->load->helper('language');
        $this->data['errors'] = array();
    }
}


class Admin_Controller extends MY_Controller {
//	function __construct() {
//		parent::__construct();
//		$this->load->helper('form');
//		$this->load->library(array('form_validation', 'ion_auth'));
//
//	}
        
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
          //redirect them to the login page
          redirect('admin/user/login', 'refresh');
        }
        $this->data['page_title'] = 'CI App - Dashboard';
    }
    
    protected function render($the_view = NULL, $template = 'admin_master')
    {
        parent::render($the_view, $template);
    }

}
 
class Public_Controller extends MY_Controller
{
 
  function __construct()
  {
    parent::__construct();
  }
}

?>