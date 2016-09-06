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
| MODULE:               Thought

*/

class Thoughts extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Thought');
        $this->load->library('form_validation','session');
        $this->lang->load('messages_lang');
    }
    
    public function listThoughts() {
        $this->data['pageTitle']   = 'Manage Thoughts';
        $this->data['arrListData'] = $this->Thought->listThoughts();
        $this->content = 'admin/thoughts/list';
        $this->layout();
    }
    
    public function add() {
        
        $this->data['page_title'] = 'Add Thought';
        $this->data['form_submit_url'] = 'admin/thoughts/add';
        
        $this->load->library('form_validation');
        
        
        
        if($this->input->post()) {
            
            $this->form_validation->set_rules('thought','Thought','required|min_length[5]');
            
            if( $this->form_validation->run() ) {
                $post = $this->input->post();
                $post['entry_dt'] =  date('Y-m-d H:i:s');
                $intLastInsertId = $this->Thought->save($post);
                if(!empty($intLastInsertId)) {
                    redirect('admin/thoughts');
                }
            }
        }
        
        $this->content = 'admin/thoughts/add_edit';
        $this->layout();
    }
    
    
    
    public function edit() {
        
        $this->data['page_title'] = 'Edit Thought';
        
        $this->data['intSelectedId'] = $intSelectedId    = $this->uri->segment(5);
        
        if(empty($intSelectedId)  || !is_numeric($intSelectedId)) {
            throw new Exception('Id not found.');
        }
        
        $this->Thought->strCondition = " AND thoughts.id = " . $intSelectedId;
        $arrSelectedItemList = $this->Thought->listThoughts();
        
//        echo "<pre>";
//        print_r($arrSelectedItemList);
//        exit;
        
        if(count($arrSelectedItemList) !=1 ) {
            throw new Exception('There has been an error');
        }
        
        $this->data['arrSelectedItemList'] = $arrSelectedItemList[0];
        
        if($this->input->post()) {
            
            $this->form_validation->set_rules('thought','Thought','required|min_length[5]');
            
            if ($this->form_validation->run())
            {
               
                $post = $this->input->post();
                $post['modify_dt'] =  date('Y-m-d H:i:s');
                
                $this->Thought->save($post, $intSelectedId);
                $this->session->set_flashdata('success_message', 'Information has been updated successfully.');
                redirect('/admin/thoughts/edit/id/' . $intSelectedId);
            }
        }
        
        $this->content = 'admin/thoughts/add_edit';
        $this->layout();
        
    }
    
    
    
    public function changeStatus() {
        $intId    = $this->uri->segment(4);
        $status   = $this->uri->segment(5);
        
        if(empty($intId) || empty($status)) {
            throw new exception('There has been an error');
        }
        
        
        $this->Thought->changeStatus($intId,$status);
        
       // $this->session->set_flashdata('success_message','Status has been changed successfully.');
        redirect('admin/thoughts');
    }
    
    
    
    
}