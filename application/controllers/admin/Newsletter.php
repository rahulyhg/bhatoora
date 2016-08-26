<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -----------------------------------------------------
| PRODUCT NAME: 	Bhatoora
| -----------------------------------------------------
| AUTHOR:		Ravi Khare
| -----------------------------------------------------
| EMAIL:		ravi.khare@seven3rockers.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY Seven3Rockers
| -----------------------------------------------------
| MODULE:               Newsletter Model

*/
class Newsletter extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Newsletter_subscription');
    }
    
    
    public function listSubscribers() {
        $this->data['pageTitle'] = 'Newsletter Subscribers';
        $this->data['arrSubscribers'] = $this->Newsletter_subscription->getSubscribers();
        $this->content = 'admin/newsletter/list';
        $this->layout();
    }
    
    public function changeStatus() {
        $intId  = $this->uri->segment(4);
        $status     = $this->uri->segment(5);
        
        if(empty($intId) || empty($status)) {
            throw new exception('There has been an error');
        }
//        
//        $objCustomer = new Customer();
        $this->load->model('Newsletter_subscription');
        $this->Newsletter_subscription->changeStatus($intId,$status);
//        
        $this->session->set_flashdata('success_message','Status has been changed successfully.');
        redirect('admin/newsletter');
    }
    
    
}
