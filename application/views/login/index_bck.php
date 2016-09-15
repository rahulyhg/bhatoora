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
         
          
           <div class="row login-btn">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <button class="facebook" onclick="_login();" type="button"><i class="fa fa-facebook" aria-hidden="true"></i>
<span>Facebook</span></button>
</div>
               
<!--<a href="--><?php //echo base_url(); ?><!--twitter/auth">Login with twitter</a>-->
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">  <div class="google-pulse"><a href="<?php echo $google_plus_login_url; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i>
<span>Google+</span></a></div></div>
           </div>
 
          
          
        </div>
      </div>
              
    
    <!--------------------right-section------------>
  </div>
  <div class="clear"></div>
</div>
<!----------page-section----------------->






<script>
    // Load the SDK asynchronously
    (function(thisdocument, scriptelement, id) {
        var js, fjs = thisdocument.getElementsByTagName(scriptelement)[0];
        if (thisdocument.getElementById(id)) return;

        js = thisdocument.createElement(scriptelement); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function() {
        
        FB.init({
            appId      : '<?php echo $this->config->item('facebook_api_key'); ?>', //Your APP ID
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.6' // use version 2.1
        });

//        // These three cases are handled in the callback function.
 //       FB.getLoginStatus(function(response) {
  //          statusChangeCallback(response);
  //      });

    };

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            login_now();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
        }
    }

    function _login() {
        FB.login(function(response) {
            // handle the response
            if(response.status==='connected') {
                login_now();
            }
        }, {scope: 'public_profile,email'});
    }


    function fb_logout(){

        FB.logout(function(response) {
            alert('logged out successfully');
        });
        
    }

    function login_now(){
        FB.api('/me?fields=email,name', function(response) {

            /* $.post("<?php echo base_url(); ?>auth/login", {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',facebook_login: 'true', email: response.email, name: response.name, fb_id:response.id }, function(data){
            if(data == 'success'){
                    window.location.href="<?php echo base_url(); ?>user/profile";
                }
            }); */
       
            $.ajax({
                url      :  '<?php echo base_url(); ?>login/facebook_login',
                data     : {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                             email : response.email, name: response.name, fb_id : response.id  }, 
                method   : 'POST',
                dataType : 'json',
                success  : function(response) {
                    if(response.success) {
                        window.location = '<?php echo base_url(); ?>'
                    } else {
                        alert('Error');
                    }
                    
                },
                
            });
        });
    }

</script>

