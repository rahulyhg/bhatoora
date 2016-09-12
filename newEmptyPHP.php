<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
//        if(!$this->session->userdata('loggedin_email')) {
//            redirect('/login');
//        }
        
    }
    
    public function listBooks() {
        
        $this->data['pageTitle'] = "e-Books";
        
        $this->load->Model('Documents');
        $this->data['Documents'] = $this->Documents->listDocuments();
        
//        echo "<pre>";
//        print_r($this->data['Documents']);
//        exit;
        
        $this->content = 'books/list'; 
        $this->layout();
    }

   public function listBooksApp() {
        
        $this->load->Model('Documents');
        $result = $this->Documents->listDocuments();
        
        $response = array();
        if(count($result) > 0 ) {
            $intCounter = 0;
            foreach($result as $row) {
                $response[$intCounter]['url'] = base_url() .'uploads/documents/'.$row['id'].'/coverimages/'.$row['cover_image'];
                $response[$intCounter]['title'] = base_url() .'uploads/documents/'.$row['id'].'/coverimages/'.$row['cover_image'];
                $response[$intCounter]['title'] = base_url() .'uploads/documents/'.$row['id'].'/coverimages/'.$row['cover_image'];
            }
        }
        echo json_encode( array('result' => $response) );exit;
    }
    
    
    
}

