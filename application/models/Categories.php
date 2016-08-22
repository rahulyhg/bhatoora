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
| MODULE:               Category Model
| -----------------------------------------------------
| This is Category model file.
| -----------------------------------------------------
*/
class Categories extends CI_Model {
    
    public $strCondition = '';
    
    public function listCategories($intCategoryId = '', $intParentCategoryId = '') {
        
        $sql =" SELECT cat.id, cat.category_name, cat_parent.category_name as parent_category_name, "
                . " cat.parent_category as parent_category_id, cat.status, "
                . "   cat.description FROM category cat left join category cat_parent"
                . "   on cat.parent_category = cat_parent.id WHERE 1 ";
        
        
        if(!empty($this->strCondition)) {
            $sql .= $this->strCondition;
        }
        
        $sql .= "  order by category_name " ;
        
        //echo $sql;
        
        return $this->db->query($sql)->result_array();
        
    }
    
    public function addCategory($data) {
        $this->db->insert('category', $data);
        return $this->db->insert_id();
    }  
    
    
    public function updateCategory($intId, $data) {
        $this->db->where("id", $intId); 
        return $this->db->update('category', $data);
    }   
    
    public function addSubCategory($intParentCategory) {
        
    }
    
    public function editCategory($intCategoryId) {
        
    }
    
    public function deleteCategory() {
        
    }
    
    public function changeStatus($intCategoryId, $status) {
        $this->db->where('id',$intCategoryId);
        $this->db->update('category', array('status' => $status));
    } 
    
}