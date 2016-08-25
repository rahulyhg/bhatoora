<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->helper('security');
      
    }
    
    public function subscribe() { 
        
         
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email' , 'Email', 'trim|required|xss_clean');
        
        if($this->input->post()) {
           
            if ($this->form_validation->run()) { 
                
                $name  = $this->input->post('name');
                $email = $this->input->post('email');
                
                $this->load->model('Newsletter_subscription');
                
               
                if($this->Newsletter_subscription->isNewsletterSubscribed($email)) {
                    $this->session->set_flashdata('error_message','You have already subscribed for the newsletter.');
                    
                } else {
                    $insert = array('customer_name' => $name, 'email' => $email);
                    $intLastInsertId = $this->Newsletter_subscription->addSubscription($insert);
                    if(empty($intLastInsertId)) {
                        $this->session->set_flashdata('error_message', $this->lang->line('technical_error_message'));
                    }else {
                        $this->session->set_flashdata('success_message','You have successfully subscribed for the newsletter.');
                    }
                }
                
                redirect('newsletter');
            }
            
        }
        
        $this->data['pageTitle'] = 'Newsletter';
        $this->content = 'newsletter/subscribe';
        $this->layout();
    }
    
}