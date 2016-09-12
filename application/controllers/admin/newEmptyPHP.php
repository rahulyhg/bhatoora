<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends Admin_Controller {
    
   
    
    function __construct()
    {
        parent::__construct();
        $this->data['user']    = $this->ion_auth->user()->row();
        $this->load->model('Documents');
        $this->load->library('form_validation','session');
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
    }
   
    
    public function listDocument() {  
        $this->load->model('Documents'); 
        $this->data['pageTitle'] = 'Manage e-Books';
        $this->data['arrDocumentList'] = $this->Documents->listDocuments();
        $this->content = 'admin/document/list_documents';
        $this->layout();
    }
    
    
    public function add() {
        
        $this->data['pageTitle'] = 'Add e-book';
        
      
        /* Set rules */
        $this->form_validation->set_rules('title', 'Title','required|min_length[3]|max_length[250]');
        $this->load->helper('general');
                
        if($this->input->post()) { 
          

            $this->data['title']       = $title  =  $this->input->post('title');
            $publish_dt =  $this->input->post('published_date');


            
            $publish_dt = calenderToDb($publish_dt);

            $this->data['publish_dt'] = $publish_dt;
//            echo "<pre>";
//            print_r($_FILES);
//            exit;

            try {
               // $this->db->trans_start();
           
            $coverImageFileName = isset($_FILES) ? $_FILES['cover_image']['name'] : '';
            $ext = pathinfo($coverImageFileName, PATHINFO_EXTENSION);
            
           
            $fileTitle = cleanFileName($title);
            
            $coverImageFileName  = $fileTitle.".".$ext;
                
            $insert = array('title' => $title, 'published_dt' => $publish_dt);
            
            $intLastInsertId = $this->Documents->add($insert);
            
            if(empty($intLastInsertId)) {
                throw new Exception('There has been an error');
            }
            
            /* Upload Cover Image */
            $coverImageUploadPath = './uploads/documents/'.$intLastInsertId.'/coverimages/' ;
            
            if (!file_exists($coverImageUploadPath)) {
                mkdir($coverImageUploadPath, 0777, true);
            }
            
            $config['upload_path']   = $coverImageUploadPath; 
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
//            $config['max_size']      = 400; 
//            $config['max_width']     = 300; 
//            $config['max_height']    = 400;  
            $config['file_name']     = $coverImageFileName;
            
            $this->load->library('upload', $config);
            
            $errorFound = false;
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('cover_image')) {
               //$error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata('error_message',$this->upload->display_errors());
               $errorFound = true;
            } 
            /****************************************/
            
            
            
            /* Upload Book */
            
            $bookFileName = isset($_FILES) ? $_FILES['book']['name'] : '';
            $ext = pathinfo($bookFileName, PATHINFO_EXTENSION);
            
            $bookFileName  = $title.".".$ext;
            
            $bookUploadPath = './uploads/documents/'.$intLastInsertId.'/book/' ;
            
            if (!file_exists($bookUploadPath)) {
                mkdir($bookUploadPath, 0777, true);
            }
            
            
            $config1['upload_path']   = $bookUploadPath; 
            $config1['file_name']     = $bookFileName;
            $config1['allowed_types'] = '*'; 
            
            $this->load->library('upload', $config1);
            $this->upload->initialize($config1);
            if ( ! $this->upload->do_upload('book')) {
               //$error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata('error_message',$this->upload->display_errors());
               $errorFound = true;
            } 
            /****************************************/
            
            if(!$errorFound) {
                // $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                 $currentDate = date('Y-m-d H:i:s');

                 /* Update Docurment */
                 $update = array('cover_image' => $coverImageFileName, 'book_name' => $bookFileName, 'entry_dt' => $currentDate);
                 $this->Documents->update($update, $intLastInsertId);
                 
                 $this->session->set_flashdata('success_message','Record has been added successfully.');
                 redirect('admin/document/');
            } else {
                 //$this->db->trans_rollback();
            }
            
            if ($this->db->trans_status() === FALSE)
            {
                   // $this->db->trans_rollback();
            }
            else
            {
               // $this->db->trans_complete();
                //$this->db->trans_commit();
            }
            
            
            }   catch (Exception $ex) {
                //$this->db->trans_rollback();
            }
            
        }
        
        $this->content = 'admin/document/add_edit.php';
        $this->layout();
    }
    
    
    
    public function edit() {
        
        $this->data['intSelectedId'] = $intSelectedId    = $this->uri->segment(5);
        
        if(empty($intSelectedId)  || !is_numeric($intSelectedId)) {
            throw new Exception('Id not found.');
        }
        
        $this->data['pageTitle'] = 'Edit e-Book';
        $this->data['form_submit_url'] = 'admin/document/edit/id/' . $intSelectedId;
        $this->data['back_url'] = base_url() . 'admin/document/';
        
        $this->Documents->strCondition = " AND documents.id = " . $intSelectedId;
        $arrSelectedItemList = $this->Documents->listDocuments();
        
        if(count($arrSelectedItemList) != 1) {
            //throw new Exception( $this->lan);
        }
        
        $this->data['arrSelectedItemList'] = $arrSelectedItemList[0];

        if(!empty($arrSelectedItemList[0]['cover_image'])) {
           $this->data['coverImageUrl'] = base_url(). 'uploads/documents/'.$intSelectedId.'/coverimages/'.$arrSelectedItemList[0]['cover_image'];
        }
        

        $this->load->library('form_validation');
        
        if($this->input->post()) {
            
            try {
            
            $this->form_validation->set_rules('title','Title','required|min_length[3]');
            
            if( $this->form_validation->run() ) {
                
                $post = $this->input->post();
                
                $title          = $post['title'];

                $this->load->helper('general');

                $published_date = $post['published_date'];

                $published_date = calenderToDb($published_date);
                
                //                echo "<pre>";
//                print_r($_FILES);
//                exit;
                
                /* If file is not uploaded */
                if($_FILES['cover_image']['error'] == 4) {
                    
                    $bookFileName = $post['cover_image'];
                    
                     /* update database */
                    $currentDate = date('Y-m-d H:m:s');
                    $update = array('title' => $title,'published_dt'=>$published_date, 'modify_dt' => $currentDate);
                    $this->load->model('Documents');
                    $this->Documents->save($update,$intSelectedId);
                    $this->session->set_flashdata('success_message', 'e-Book updated Successfully');
                    redirect('admin/document/');
                    
                }
                else if($_FILES['cover_image']['error'] == 0 ){
                    
                    /* Upload Cover Image */
                    $coverImageUploadPath = './uploads/documents/'.$intSelectedId.'/coverimages/' ;

                    if (!file_exists($coverImageUploadPath)) {
                        mkdir($coverImageUploadPath, 0777, true);
                    }

                    $config['upload_path']   = $coverImageUploadPath; 
                    $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
        //            $config['max_size']      = 400; 
        //            $config['max_width']     = 300; 
        //            $config['max_height']    = 400;  
                    $config['file_name']     = $coverImageFileName;

                    $this->load->library('upload', $config);

                    $errorFound = false;
                    $this->upload->initialize($config);
                    if ( ! $this->upload->do_upload('cover_image')) {
                       //$error = array('error' => $this->upload->display_errors());
                       $this->session->set_flashdata('error_message',$this->upload->display_errors());
                       $errorFound = true;
                    } 

                    // $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                    $currentDate = date('Y-m-d H:i:s');

                    /* Update Docurment */
                    $update = array('cover_image' => $coverImageFileName, 'modify_dt' => $currentDate);
                    $this->Documents->save($update, $intSelectedId);
                 
                    $this->session->set_flashdata('success_message','Record has been added successfully.');
                    redirect('admin/document');
                    /****************************************/
            } else {			
                    $this->session->set_flashdata('error_message', 'Cover Image required.');
                   // redirect('admin/document/edit/id/' . $intSelectedId);
                   // exit;
            }
                     
            }
        }catch(Exception $e) {
            die($e->getMessage());
        }
    }
        
    $this->content = 'admin/document/add_edit';
    $this->layout();
    }
    
    
   
    
    public function changeStatus() {
        $intId = $this->uri->segment(4);
        $status        = $this->uri->segment(5);
        
        if(empty($intId) || empty($status)) {
            throw new exception('There has been an error');
        }
        
        $this->load->model('documents');
        $this->documents->changeStatus($intId,$status);
        
        $this->session->set_flashdata('success_message','Status has been changed successfully.');
        redirect('admin/document');
    }
    
    
    
    
    
}
  