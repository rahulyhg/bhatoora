<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends Admin_Controller
{
    
    function __construct()
    {
      parent::__construct();
    }

    public function index()
    {

//        $data = array();
//        $this->data['content'] = 'admin/dashboard';
//        $this->data['user']    = $this->ion_auth->user()->row();
//        $this->load->view('admin/templates/admin_template',$this->data);
       
        $this->data['user']    = $this->ion_auth->user()->row();
        
        $this->content = 'admin/dashboard';
        $this->layout();
          
    }
}

?>
