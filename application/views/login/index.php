<div class="page-section">
  <div class="page">
   
  
      <div class="panel">
        <div class="title">
          <h1><?php echo $pageTitle; ?></h1>
        </div>
        <div class="content">
          <h2><?php echo $error_message; ?></h2>
          <?php echo form_open('login/login'); ?>
            <div class="contact-form mar-top30">
              <label> <span>User Name</span>
              <?php echo form_error('username');
                $data = array('name'=>'username', 'id' => 'username' , 'maxlength' => 30, 'value' => $username, 'class' => 'input_text');
                echo form_input($data,'class="input_text');
              ?>
                  
              </label>
                
              <label> <span>Password</span>
              <?php    
                echo form_error('password');
                $data = array('name'=>'password', 'id' => 'password' , 'type' =>'password', 'maxlength' => 30, 'value' => $password,'class' => 'input_text');
                echo form_input($data);
                ?>
              </label>
                
                
              <?php  
               $data = array('name'=>'btnLogin', 'id' => 'btnLogin' , 'value' => 'Login', 'class' => 'button');
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
