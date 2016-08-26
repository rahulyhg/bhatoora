<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Admin_Controller {
  
   
    
    public function listCustomers() { 
        $this->load->model('Customer');
        $this->data['pageTitle'] = 'Manage Customers';
        $this->data['arrUserList'] = $this->Customer->listCustomers();
        $this->content = 'admin/customer/list_customers';
        $this->layout();
    }
    
    public function changeStatus() {
        $intUserId  = $this->uri->segment(4);
        $status     = $this->uri->segment(5);
        
        if(empty($intUserId) || empty($status)) {
            throw new exception('There has been an error');
        }
//        
//        $objCustomer = new Customer();
        $this->load->model('Customer');
        $this->Customer->changeStatus($intUserId,$status);
//        
        $this->session->set_flashdata('success_message','Status has been changed successfully.');
        redirect('admin/customers/listcustomers');
    }
    
    
    
    
}