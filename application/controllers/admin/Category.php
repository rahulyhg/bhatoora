<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller
{
 
    function __construct()
    {
        parent::__construct();
        $this->data['user']    = $this->ion_auth->user()->row();
        $this->load->model('Categories');
        $this->load->library('form_validation','session');
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
    }
    
    function index() {
        $arrCategoryList = $this->Categories->listCategories();
        $this->data['arrCategoryList'] = $arrCategoryList;
        $this->content = 'admin/category/list';
        //$this->load->view('admin/templates/admin_template',$this->data);
        $this->layout();
    }
    
    
    public function add() {
        
        $this->data['page_title'] = 'Add Category';
        
        
        $arrCategoryList = $this->Categories->listCategories();
        
        $response = array();
        if(count($arrCategoryList) > 0 ) {
            foreach($arrCategoryList as $category) {
                $response[$category['id']] = $category['category_name'];
            }
        }
         $this->data['arrCategoryList'] = $response;
         
         
         
       
        /* Set rules */
        $this->form_validation->set_rules('category_name', 'Category Name','required|min_length[3]|max_length[75]');
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        
        $this->data['category_name']   =  '';
        $this->data['parent_category'] =  '0';
                
        if($this->input->post()) {
            
            $this->data['category_name']  = $category_name  =  $this->input->post('category_name');
            $this->data['parent_category'] = $parent_category =  $this->input->post('parent_category');
            
            if ($this->form_validation->run() == FALSE)
            {
                $this->data['content'] = 'admin/category/add_edit';
                $this->load->view('admin/templates/admin_template',$this->data);
            }
            else
            {
                /* Insert data in database */
                $insert = array('category_name' => $this->input->post('category_name'), 
                                'parent_category' => $this->input->post('parent_catgory')
                                );
                
                $intLastInsertId = $this->Categories->addCategory($insert);
                
                if(empty($intLastInsertId)) {
                    $this->session->set_flashdata('error_message', 'There has been an error, Please try again later.');
                    $this->data['content'] = 'admin/category/add_edit';
                    $this->load->view('admin/templates/admin_template',$this->data);
                } else {
                    redirect('/admin/category/');
                }
            }
            
            
        } else {
            $this->data['content'] = 'admin/category/add_edit';
            $this->load->view('admin/templates/admin_template',$this->data);
        }
    }
    
    public function edit() {
        
        $this->data['page_title'] = 'Edit Category';
        
        $this->data['intSelectedCategoryId'] = $intSelectedCategoryId    = $this->uri->segment(5);
        
        if(empty($intSelectedCategoryId)  || !is_numeric($intSelectedCategoryId)) {
            throw new Exception('Category Id not found.');
        }
        
        $objCategory = new Categories();
        $objCategory->strCondition = " AND cat.id = " . $intSelectedCategoryId;
        $arrSelectedCategoryList = $objCategory->listCategories();
        
//        echo "<pre>";
//        print_r($arrSelectedCategoryList);
//        exit;
        
        if(empty($arrSelectedCategoryList)) {
            throw new Exception('There has been an error');
        }
        
        $this->data['arrSelectedCategoryList'] = $arrSelectedCategoryList[0];
        
        
        $objCategory = new Categories();
        $objCategory->strCondition = " AND cat.id <> " . $intSelectedCategoryId;
        $arrCategoryList = $objCategory->listCategories();
        
        $response = array();
        if(count($arrCategoryList) > 0 ) {
            foreach($arrCategoryList as $category) {
                $response[$category['id']] = $category['category_name'];
            }
        }
        
        $this->data['arrCategoryList'] = $response;
         
        /* Set rules */
        $this->form_validation->set_rules('category_name', 'Category Name','required|min_length[3]|max_length[75]');
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        
        $this->data['category_name']   =  $arrSelectedCategoryList[0]['category_name'];
        $this->data['parent_category'] =  $arrSelectedCategoryList[0]['parent_category_id'];
                
        if($this->input->post()) {
            
            $this->data['category_name']   = $category_name  =  $this->input->post('category_name');
            $this->data['parent_category'] = $parent_category =  $this->input->post('parent_category');
            
            if ($this->form_validation->run() == FALSE)
            {
                $this->data['content'] = 'admin/category/add_edit';
                $this->load->view('admin/templates/admin_template',$this->data);
            }
            else
            {
                /* Insert data in database */
                $update = array('category_name' => $this->input->post('category_name'), 
                                'parent_category' => $this->input->post('parent_catgory')
                                );
                
                $response = $this->Categories->updateCategory($intSelectedCategoryId, $update);
                
                if(!($response)) {
                    $this->session->set_flashdata('error_message', 'There has been an error, Please try again later.');
                    $this->data['content'] = 'admin/category/add_edit';
                    $this->load->view('admin/templates/admin_template',$this->data);
                } else {
                    $this->session->set_flashdata('success_message', 'Information has been updated successfully.');
                    redirect('/admin/category/edit/id/' . $intSelectedCategoryId);
                }
            }
            
            
        } else {
            $this->data['content'] = 'admin/category/add_edit';
            $this->load->view('admin/templates/admin_template',$this->data);
        }
    }
    
    public function changeStatus() {
        $intCategoryId = $this->uri->segment(4);
        $status        = $this->uri->segment(5);
        
        if(empty($intCategoryId) || empty($status)) {
            throw new exception('There has been an error');
        }
        
        $objCategory = new Categories();
        $objCategory->changeStatus($intCategoryId,$status);
        
        $this->session->set_flashdata('success_message','Status has been changed successfully.');
        redirect('admin/category');
    }
    
    
    public function add_edit() {
        
        
        
        $intCategoryId = $this->uri->segment(5);
        
        if(empty($intCategoryId)) {
            throw new Exception('Category id not found.');
        }
        
        $this->data['arrCategoryToEditList'] =  $this->Categories->listCategories($intCategoryId);
        
       
        
       
    }
    
}
