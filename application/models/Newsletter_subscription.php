<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter_subscription extends CI_Model {
    
    public function isNewsletterSubscribed($email) { 
        
        $sql = " SELECT email FROM newsletter_subscription WHERE email = '" . $email ."' ";
        
        $result = $this->db->query($sql)->result_array();
        
        if(count($result) > 0 ) {
            return true;
        }
        
        return false;
    }
   
    public function addSubscription($data) {
        $this->db->insert('newsletter_subscription', $data);
        return $this->db->insert_id();
    }
    
    
    
}

?>
