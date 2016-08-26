<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    
    public $data = NULL;
     
    public function __construct() {
        // Call CI_Controller construct method first.
        parent::__construct();
        $this->load->model('Customer');
        $this->load->helper('security');
    }
    
    public function index() {
        $this->data['username']  = '';
        $this->data['password']  = '';
        $this->data['pageTitle'] = 'Login';
          
      //  $this->load->view('login/index', $this->data);
//        $this->data['content'] = 'login/index';
//        $this->template->load('ui_template', $this->data);
        $this->content = 'login/index'; // passing middle to function. change this for different views.
        $this->layout();
    }
    
    
    public function login() {
        
       /* Load form validation library */ 
      
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        //$this->load->view('login/index');

        /* Set validation rule for username field in the form */ 
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean'); 
         
       
        if($this->input->post()) {
            
            $this->data['username'] = $email    = $this->input->post('username');
            $this->data['password'] = $password = $this->input->post('password');
          
            
            if ($this->form_validation->run() == FALSE) { 
                //$this->load->view('login/index',$this->data);
              
                //redirect('login');
            } else {
                $this->load->model('Customer');
                
               // $objUser = new User();
                $response = $this->Customer->getCustomerDetailByEmail($email);
                
//                echo md5($password);
//                echo "<br>";
//                echo $response[0]['password'];
//                
                if(md5($password) != $response[0]['password']) {
                    $this->data['error_message'] = 'Invalid Password.';
                    $this->data['username'] = $email;
                    $this->content = 'login/index';
                    $this->layout();
                    //redirect('login');
                } else {
                    $loggedinUser = array('loggedin_email' => $response[0]['email'], 
                                'loggedin_fname' => $response[0]['fname']);
                    $this->session->set_userdata($loggedinUser);
                    redirect(base_url());
                    exit;
                }
                
                
//                echo "<pre>";
//                print_r($response);
//                exit;
                
                
            }
         
//            echo "<pre>";
//            print_r($this->input->post());
//            exit;
            
        }
        $this->content = 'login/index';
        $this->layout();
        
        //  $this->data['content'] = 'admin/category/list';
       // $this->load->view('admin/templates/admin_template',$this->data);
    }
    
    
    public function signup() {
        
       /* Load form validation library */ 
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
       
        
        
        $this->data['pageTitle'] = 'Sign Up';
      
     
        /* Set validation rule in the form */ 
        $this->form_validation->set_rules('username', 'Email Id', 'required|valid_email|callback_is_user_exists');
        $this->form_validation->set_rules('fname', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[5]');
        $this->form_validation->set_rules('contactno', 'Contact Number', 'required|min_length[10]|max_length[11]|numeric');
         
       
        if($this->input->post()) {
            
            $this->data['username']  = $email     = $this->input->post('username');
            $this->data['password']  = $password  = $this->input->post('password');
            $this->data['fname']     = $fname     = $this->input->post('fname');
            $this->data['address']   = $address   = $this->input->post('address');
            $this->data['contactno'] = $contactno = $this->input->post('contactno');
             
            if ($this->form_validation->run()) { 

                $insertData = array('fname' => $fname, 'email' => $email, 'password' => md5($password), 'contactno' => $contactno
                        ,'address' => $address);
                $intLastInsertId = $this->Customer->register($insertData);
                
                if(empty($intLastInsertId)) {
                    $this->session->set_flashdata('error_message', $this->lang->line('technical_error_message'));
                } else {
                    $this->session->set_flashdata('success_message',$this->lang->line('activation_email_successful'));
                }
                
                redirect('signup');
            } 
            
        }
        
        $this->content = 'login/signup';
        $this->layout();
        
        //  $this->data['content'] = 'admin/category/list';
       // $this->load->view('admin/templates/admin_template',$this->data);
    }
    
    public function is_user_exists($email) {
        
        if($this->Customer->isEmailExists($email)) {
            $this->form_validation->set_message('is_user_exists', '{field} already exists.');
            return FALSE;
        } else {
            return true;
        }
    }
    
    public function logout() {
         $this->session->sess_destroy();
         redirect(base_url());
    }
    
    
    public function facebook_login() {
        
        if($this->input->post()) {
//            echo "<pre>";
//            print_r($this->input->post());
//            exit;
//            
            $email = $this->input->post('email');
            $fb_id = $this->input->post('fb_id');
            $name  = $this->input->post('name');
            
            $this->load->model('Customer');
            
            if(!$this->Customer->isEmailExists($email)) {
                
                $insert = array('fname' => $name, 'email' => $email, 'social_identifier' => 'FACEBOOK',
                     'social_identifier_id' => $fb_id);
                $intLastInsertId = $this->Customer->register($insert);
                
                if(empty($intLastInsertId)) {
                   // $this->session->set_flashdata('error_message', $this->lang->line('technical_error_message'));
                    $msg = $this->lang->line('technical_error_message');
                    $response = array('success' => false, 'msg' => $msg );
                    echo json_encode($response);
                    exit;
               }
                
            }
            
            /* Create Login Session */
            $this->Customer->createLoginSession($email);
            
            
            $response = array('success' => true);
            echo json_encode($response);
            exit;
            
            
        }
    }
    
}