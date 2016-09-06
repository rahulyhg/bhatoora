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
| MODULE:               Thoughts Model
| -----------------------------------------------------
*/
class Thought extends CI_Model {
    
    public $strCondition = NULL ;
    
    public function listThoughts() {
        $sql = " SELECT * FROM thoughts WHERE 1 " ;
        
        if(!empty($this->strCondition)) {
            $sql .= $this->strCondition;
        }
        
        return $this->db->query($sql)->result_array();
    }
    
    public function save($data, $id = '') {
        if(empty($id)) {
            $this->db->insert('thoughts', $data);
            return $this->db->insert_id('thoughts');
        }else {
            $this->db->where('id',$id);
            $this->db->update('thoughts', $data);
            return $id;
        }
    }
    
    public function changeStatus($intId, $status) {
        $this->db->where('id',$intId);
        $this->db->update('thoughts', array('status' => $status));
    } 
    
    
    
}

?>