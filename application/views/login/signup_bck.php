<div class="page-section">
  <div class="page">
   
  
      <div class="panel">
        <div class="title">
          <h1><?php echo $pageTitle; ?></h1>
        </div>
        <div class="content">
          <h3><?php echo $this->session->flashdata('error_message'); ?></h3>
          <h3><?php echo $this->session->flashdata('success_message'); ?></h3>
          
          <?php echo form_open('login/signup'); ?>
            <div class="contact-form mar-top30">
                
              <label> <span>Email Id</span>
              <?php echo form_error('username','<div class="error">', '</div>');
                $data = array('name'=>'username', 'id' => 'username' , 'maxlength' => 30, 'value' => $username, 'class' => 'input_text');
                echo form_input($data);
              ?>
                  
              </label>
                
               <label> <span>Password</span>
              <?php    
                echo form_error('password','<div class="error">', '</div>');
                $data = array('name'=>'password', 'id' => 'password' , 'type' =>'password', 'maxlength' => 30, 'value' => $password,'class' => 'input_text');
                echo form_input($data);
                ?>
              </label>
                
                
              <label><span>Name</span>
              <?php echo form_error('fname','<div class="error">', '</div>');
                $data = array('name'=>'fname', 'id' => 'fname' , 'maxlength' => 30, 'value' => $fname, 'class' => 'input_text');
                echo form_input($data,'class="input_text');
              ?>
              </label>
                
            
                
              <label> <span>Address</span>
              <?php    
                echo form_error('address','<div class="error">', '</div>');
                $data = array('name'=>'address', 'id' => 'address' , 'type' =>'text', 'maxlength' => 30, 'value' => $address,'class' => 'input_text');
                echo form_input($data);
                ?>
              </label>
                
               <label> <span>Contact Number</span>
              <?php    
                echo form_error('contactno','<div class="error">', '</div>');
                $data = array('name'=>'contactno', 'id' => 'contactno' , 'type' =>'text', 'maxlength' => 30, 'value' => $contactno,'class' => 'input_text');
                echo form_input($data);
                ?>
              </label>
                
               <?php 
                $this->load->helper('captcha');
                $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
                $vals = array(
                    'word' => $random_number,
                    'img_path' => './assets/images/captcha/',
                    'img_url' => 'http://localhost/bhatoora/assets/images/captcha/',
                    'img_width' => 140,
                    'img_height' => 32,
                    'expiration' => 7200
                );
                
               
        
        
        
            

                        $cap = create_captcha($vals);
                        
//                        echo "<pre>";
//                        print_r($cap);
//                        exit;
//                        
                        echo $cap['image'];
                    ?>


                  
              <?php  
               $data = array('name'=>'btnSignup', 'id' => 'btnSignup' , 'value' => 'Register', 'class' => 'button');
               echo form_submit($data); 
               ?>
           
            </div>
          </form>
          
        </div>
      </div>
    
    <!--------------------right-section------------>
  </div>
  <div class="clear"></div>
</div>
<!----------page-section----------------->
