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
| MODULE:               User Model
| -----------------------------------------------------
| This is Category model file.
| -----------------------------------------------------
*/
class Customer extends CI_Model {
    
    public function getCustomerDetailByEmail($email) {
        $sql = " SELECT * FROM customers WHERE email = '" . $email."' LIMIT 0,1" ;
        return $this->db->query($sql)->result_array();
    }
    
    public function register($data) {
        $this->db->insert('customers',$data);
        return $this->db->insert_id('customers');
    }
    
    public function isEmailExists($email) {
        
        $result = $this->getCustomerDetailByEmail($email);
        
        if(count($result) > 0) {
            return true;
        }
        
        return false;
        
    }
    
    public function listCustomers() {
       $sql = " SELECT * FROM customers " ;
       return $this->db->query($sql)->result_array();
    }
    
    public function changeStatus($intUserId, $status) {
        $this->db->where('id',$intUserId);
        $this->db->update('customers', array('status' => $status));
    } 
    
    
    public function createLoginSession($email) {
        
        $result = $this->getCustomerDetailByEmail($email);
        
        $sess_array = array();
        if(count($result) > 0 ) {
            $sess_array = array('loggedin_user_id' => $result[0]['id'], 
                                    'loggedin_user_name' => $result[0]['fname']);
        }
        
        $this->session->set_userdata('logged_in', $sess_array);
        
    }
    
    
}