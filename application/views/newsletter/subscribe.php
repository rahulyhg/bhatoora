<div class="page-section">
  <div class="page">
   
  
      <div class="panel">
        <div class="title">
            <h1><?php echo $pageTitle; ?></h1>
        </div>
        <div class="content">
          <h3><?php echo $this->session->flashdata('error_message'); ?></h3>
          <h3><?php echo $this->session->flashdata('success_message'); ?></h3>
          
          <?php echo form_open('newsletter/subscribe'); ?>
            <div class="contact-form mar-top30">
                
                <label> <span>Name</span>
                <?php    
                  echo form_error('name','<div class="error">', '</div>');
                  $data = array('name'=>'name', 'id' => 'name' , 'type' =>'text', 'maxlength' => 75, 'value' => $name,'class' => 'input_text');
                  echo form_input($data);
                  ?>
                </label>
                
                
                <label> <span>Email Id</span>
                <?php echo form_error('email','<div class="error">', '</div>');
                  $data = array('name'=>'email', 'id' => 'email' , 'maxlength' => 75, 'value' => $email, 'class' => 'input_text');
                  echo form_input($data);
                ?>
                </label>
                
            
                  
                <?php  
                 $data = array('name'=>'btnSubscribe', 'id' => 'btnSubscribe' , 'value' => 'Subscribe', 'class' => 'button');
                 echo form_submit($data); 
                ?>
           
            </div>
        
          
        </div>
      </div>
    
    <!--------------------right-section------------>
  </div>
  <div class="clear"></div>
</div>
<!----------page-section----------------->
