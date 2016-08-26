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
    
    public function getSubscribers() {
        $this->db->select('*');
        $this->db->from('newsletter_subscription');
        return $this->db->get()->result_array();
    }
    
    public function changeStatus($intId, $status) {
        $this->db->where('id',$intId);
        
        if($status == 'N') {
            $update = array('active' => 'N', 'unsubscription_date' => date("Y-m-d :h-m-s"));
        } else {
            $update = array('active' => 'Y', 'subscription_date' => date("Y-m-d :h-m-s"));
        }
        
        $this->db->update('newsletter_subscription', $update);
    } 
    
    
    
    
}

?>
