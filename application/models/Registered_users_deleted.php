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
class Registered_users extends CI_Model {
    
    public function getUserDetailByEmail($email) {
        $sql = " SELECT * FROM users WHERE email = '" . $email."'" ;
        return $this->db->query($sql)->result_array();
    }
    
   
}