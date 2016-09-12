<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends Admin_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->data['user']    = $this->ion_auth->user()->row();
        $this->load->model('Banner');
        $this->load->library('form_validation');
        $this->lang->load('messages_lang','english');
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
    }
    
    public function index() {
        $this->data['pageTitle']   = 'Manage Banners';
        $this->data['arrListData'] = $this->Banner->listBanners();
        $this->content = 'admin/banners/list';
        $this->layout();
    }
    
    public function add() {
        
        $this->data['page_title'] = 'Add Banner';
        $this->data['form_submit_url'] = 'admin/banners/add';
        $this->data['back_url'] = base_url() . 'admin/banners/';

        $this->load->library('form_validation');
        
        if($this->input->post()) {
            
            try {
            
            $this->form_validation->set_rules('title','Title','required|min_length[3]');
            
            if( $this->form_validation->run() ) {
                $post = $this->input->post();
                
                $title = $post['title'];
                
                
               
//                echo "<pre>";
//                print_r($_FILES);
//                exit;
               
                if($_FILES['banner']['error'] == 0){
                    
                    $this->load->helper('General');
                    
                    $title = cleanFileName($title);
                    
                    $fileName = $_FILES['banner']['name'];
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    
                    $bannerFileName = $title .'.' .$ext;
                    
                    $uploadPath = UPLOAD_DIR . 'uploads/banners/';
                    
                   // echo $uploadPath;exit;
                    
                    if(!file_exists($uploadPath)) {
                        @mkdir($uploadPath);
                    }
                    
                    //upload and update the file
                    $config['file_name'] = $bannerFileName; // if we specify the extension here, uploaded image automatically convert and save with this filename.
                    $config['upload_path'] = $uploadPath; // Location to save the image
                    $config['allowed_types'] = 'gif|jpg|png|jpeg'; // allowed types
                    $config['overwrite'] = true; // it overwrites if we set this to true
                    $config['remove_spaces'] = true; // spaces will be converted to underscores if we set this to true
                    $config['max_size']   = '800';// in KB 
		
                    $this->load->library('upload', $config);
                    
		    $this->upload->initialize($config); //upload library i already mentioned in autoload.php, so here i initialize with config options.
			
                   
                    if ( ! $this->upload->do_upload('banner')) // image will be upload with this statement
                    {
                        $this->session->set_flashdata('error_message', $this->upload->display_errors('', '')); // i assigned errors fucntion to set_flashdata to display in view.
                        //redirect('admin/banners');
                    }
                    else
                    {		
                        /* Insert into database */
                        $currentDate = date('Y-m-d H:m:s');
                        $insert = array('banner_image' => $bannerFileName, 'title' => $title, 'entry_dt' => $currentDate);
                        $this->load->model('Banner');
                        $intLastInsertId = $this->Banner->save($insert);
                        
                        if(!empty($intLastInsertId)) {
                            $this->session->set_flashdata('success_message', 'Banner Uploaded Successfully');
                            redirect("admin/banners", "refresh");//redirect("admin/banner", "refresh");
                        } else {
                            $this->session->set_flashdata('error_message', $this->lang->line('technical_error_message'));
                            redirect("admin/banners/add", "refresh");//redirect("admin/banner", "refresh");
                        }
                        
                     
                        /*
                        $uploaded_file_full_details = $this->upload->data();	// // it will return full details of the uploaded file. so use this after $this->upload->do_upload('banneer');					

                        $config['image_library'] = 'gd2';						
                        $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;															
                        $config['maintain_ratio'] = false;
                        $config['create_thumb'] = false; // if we set this to true, a thumbnail will be create with the specified width and height.
                        //$config['thumb_marker'] = '_resizedimage'; // if we set create_thumb to true and then if we use this line,then thumbnail will be created with this thumbnail indicator like  for ex : if you upload welcome.jpg, thumbnail will be welcome__resizedimage.jpg
                        $config['width'] = 921; // image re-size  properties
                        $config['height'] = 153; // image re-size  properties 						
                        $config['master_dim'] = 'width';
                        $config['x_axis'] = '100';
                        $config['y_axis'] = '300';
                        
                        $this->load->library('image_lib');
                       	$this->image_lib->initialize($config);	

                        /*if ( ! $this->image_lib->crop()){		//  cropping the image with specified width and height and X,Y coordinate values in pixels
                                echo $this->image_lib->display_errors('', '');
                                exit;
                                $this->session->set_flashdata('error_message', $this->image_lib->display_errors('', ''));
                                redirect('admin/banners'); // redirect  page if the resize fails.

                        } else {
                                $this->session->set_flashdata('success_message', 'Banner Uploaded Successfully');
                                $this->image_lib->clear(); // it will clear all image processing values.
                                redirect("admin/banners", "refresh");//redirect("admin/banner", "refresh");
                        }
                        */
                    }
            } else {			
                    $this->session->set_flashdata('error_message', 'Image Field required.');
                    redirect("admin/banners");
            }
            
	
                
//            $post['entry_dt'] =  date('Y-m-d H:i:s');
//            $intLastInsertId = $this->Banner->save($post);
//            if(!empty($intLastInsertId)) {
//                redirect('admin/banners');
//            }
        }
        }catch(Exception $e) {
            die($e->getMessage());
        }
    }
        
    $this->content = 'admin/banners/add_edit';
    $this->layout();
    }
    
    
    
    
    public function edit() {
        
        $this->data['intSelectedId'] = $intSelectedId    = $this->uri->segment(5);
        
        if(empty($intSelectedId)  || !is_numeric($intSelectedId)) {
            throw new Exception('Id not found.');
        }
        
        $this->data['page_title'] = 'Edit Banner';
        $this->data['form_submit_url'] = 'admin/banners/edit/id/' . $intSelectedId;
        $this->data['back_url'] = base_url() . 'admin/banners/';
        
        $this->Banner->strCondition = " AND banners.id = " . $intSelectedId;
        $arrSelectedItemList = $this->Banner->listBanners();
        
        if(count($arrSelectedItemList) != 1) {
            throw new Exception( $this->lan);
        }
        
        $this->data['arrSelectedItemList'] = $arrSelectedItemList[0];

        $this->load->library('form_validation');
        
        if($this->input->post()) {
            
            try {
            
            $this->form_validation->set_rules('title','Title','required|min_length[3]');
            
            if( $this->form_validation->run() ) {
                
                $post = $this->input->post();
                
                $title          = $post['title'];
                
                
                //                echo "<pre>";
//                print_r($_FILES);
//                exit;
                
                /* If file is not uploaded */
                if($_FILES['banner']['error'] == 4) {
                    
                    $bannerFileName = $post['banner_image'];
                    
                     /* update database */
                    $currentDate = date('Y-m-d H:m:s');
                    $update = array('title' => $title, 'modify_dt' => $currentDate);
                    $this->load->model('Banner');
                    $this->Banner->save($update,$intSelectedId);
                    $this->session->set_flashdata('success_message', 'Banner updated Successfully');
                    redirect('admin/banners/');
                    
                }
                else if($_FILES['banner']['error'] == 0 ){
                    
                    $this->load->helper('General');
                    
                    $title = cleanFileName($title);
                    
                    $fileName = $_FILES['banner']['name'];
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    
                    $bannerFileName = $title .'.' .$ext;
                    
                    $uploadPath = UPLOAD_DIR . 'uploads/banners/';
                    
                   // echo $uploadPath;exit;
                    
                    if(!file_exists($uploadPath)) {
                        @mkdir($uploadPath);
                    }
                    
                    //upload and update the file
                    $config['file_name'] = $bannerFileName; // if we specify the extension here, uploaded image automatically convert and save with this filename.
                    $config['upload_path'] = $uploadPath; // Location to save the image
                    $config['allowed_types'] = 'gif|jpg|png|jpeg'; // allowed types
                    $config['overwrite'] = true; // it overwrites if we set this to true
                    $config['remove_spaces'] = true; // spaces will be converted to underscores if we set this to true
                    $config['max_size']   = '800';// in KB 
		
                    $this->load->library('upload', $config);
                    
		    $this->upload->initialize($config); //upload library i already mentioned in autoload.php, so here i initialize with config options.
			
                   
                    if ( ! $this->upload->do_upload('banner')) // image will be upload with this statement
                    {
                        $this->session->set_flashdata('error_message', $this->upload->display_errors('', '')); // i assigned errors fucntion to set_flashdata to display in view.
                       // redirect('admin/banners');
                      //  exit;
                    }
                    	
                    /* update database */
                    $currentDate = date('Y-m-d H:m:s');
                    $update = array('banner_image' => $bannerFileName, 'title' => $title, 'modify_dt' => $currentDate);
                    $this->load->model('Banner');
                    $this->Banner->save($update,$intSelectedId);
                    $this->session->set_flashdata('success_message', 'Banner updated Successfully');
                    redirect('admin/banners/');
            } else {			
                    $this->session->set_flashdata('error_message', 'Banner Image required.');
                   // redirect('admin/banners/edit/id/' . $intSelectedId);
                   // exit;
            }
                     
            }
        }catch(Exception $e) {
            die($e->getMessage());
        }
    }
        
    $this->content = 'admin/banners/add_edit';
    $this->layout();
    }
    
    
    public function changeStatus() {
        $intId    = $this->uri->segment(4);
        $status   = $this->uri->segment(5);
        
        if(empty($intId) || empty($status)) {
            throw new exception('There has been an error');
        }
        
        
        $this->Banner->changeStatus($intId,$status);
        
        $this->session->set_flashdata('success_message','Status has been changed successfully.');
        redirect('admin/banners');
    }
    
    
  
    
    
}