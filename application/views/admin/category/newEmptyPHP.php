<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    
    public $data = NULL;
     
    public function __construct() {
        // Call CI_Controller construct method first.
        parent::__construct();
        $this->load->model('Customer');
        $this->load->helper('security');
        $this->load->library('form_validation');
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
        
        $this->data['pageTitle'] = "Login";
        
       /* Load form validation library */ 
      
        $this->load->helper(array('form'));
       

        //$this->load->view('login/index');

        /* Set validation rule for username field in the form */ 
       // $this->form_validation->set_error_delimiters('<p class="error">', '</li>');
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
        
        $this->data['pageTitle'] = "Register";
        
        if($this->input->get()) { 
            
            $this->data['username']    = $email     = $this->input->get('username');
            $this->data['password']    = $password  = $this->input->get('password');
            $this->data['fname']       = $fname     = $this->input->get('fname');
            
            if($this->Customer->isEmailExists($email)) {
                $this->form_validation->set_message('username', '{field} already exists.');
                $this->session->set_flashdata('error_message', 'User already exists.');
            } 
            else {
                $insertData = array('fname' => $fname, 'email' => $email, 'password' => md5($password),'signup_via'=>'WEB');
                $intLastInsertId = $this->Customer->register($insertData);
                $this->Customer->createLoginSession($email);
                redirect('books/listbooks');
            }
        }

        $this->content = 'login/signup';
        $this->layout();

    }

    
    public function signupapp() { 
        
       if($this->input->get()) { 
            
                $email       = $this->input->get('username');
                $name        = $this->input->get('name');
                $password    = $this->input->get('password');

                $password = md5($password);



                if($this->Customer->isEmailExists($email)) {

                $response = array('success' => 'NOT' ,'msg' => 'Email already exists');
                echo json_encode($response);
                exit;
                } 

 
         
                $current_date =  date('Y-m-d H:i:s');

                $insertData = array('email' => $email, 'registration_dt' => $current_date, 'signup_via'=>'APP',
                         'fname' => $name, 'password' => $password );


                $intLastInsertId = $this->Customer->register($insertData);

                if(empty($intLastInsertId)) {

                   $response = array('success'=> 'NOT' ,'msg' => 'There has been a technical error');
                   echo json_encode($response);
                   exit;

                }


                $response = array('success'=> 'OK' ,'msg' => 'Thanks for your registration');
                echo json_encode($response);
                exit;
            
        }
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
         redirect('login');
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
    
    
    
    public function loginviaapp() {
        
        if($this->input->get()) {
            
            $email    = $this->input->get('email');
            $password = $this->input->get('password');
            
            if(empty($email)) {
                $msg = "Please enter your email ID";
                $response = array('success' => false, 'msg' => $msg );
                echo json_encode($response);
                exit;
            }
            
            if(empty($password)) {
                $msg = "Please enter your password";
                $response = array('success' => false, 'msg' => $msg );
                echo json_encode($response);
                exit;
            }
            
            $this->load->model('Customer');
            
            $response = $this->Customer->getCustomerDetailByEmail($email);
            
            if(count($response) <> 1) {
                $msg = "User does not exist.";
                $response = array('success' => false, 'msg' => $msg );
                echo json_encode($response);
                exit;
            }

//                
            if(md5($password) != $response[0]['password']) {
                $msg = "Incorrect Password";
                $response = array('success' => false, 'msg' => $msg );
                echo json_encode($response);
                exit;
            } 
            
            $response = array('success' => true, 'session_email' => $email, 'session_firstname' =>  $response[0]['fname']);
            echo json_encode($response);
            exit;
            
        }

    }
    
    
}