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
    
    
    
}