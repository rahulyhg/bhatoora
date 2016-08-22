
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">
  
    
  <!-- Bootstrap 3.3.6 -->
<!--  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
   Font Awesome 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
   Ionicons 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   Theme style 
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
   iCheck 
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <a href="../../index2.html"><b>Bhatoora</b> <br> Admin Panel</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <div id="infoMessage"><?php echo $message;?></div>
    <?php echo form_open("auth/login");?>
      <div class="form-group has-feedback">
<!--        <input type="email" class="form-control" placeholder="Email">-->
        <?php $data = array(
        'type'          => 'email',    
        'name'          => 'identity',
        'id'            => 'identity',
        'maxlength'     => '75',
        'placeholder'   => 'Email',    
        'class'         => 'form-control'
        );

        echo form_input($data);
        ?>
      
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
    
      <div class="form-group has-feedback">
<!--        <input type="password" class="form-control" placeholder="Password">-->
        
         <?php $data = array(
        'type'          => 'password',    
        'name'          => 'password',
        'id'            => 'password',
        'maxlength'     => '75',
        'placeholder'   => 'Password',    
        'class'         => 'form-control'
        );

        echo form_input($data);
        ?>
        
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
<!--              <input type="checkbox"> Remember Me-->
              <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
<!--          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
          <?php echo form_submit('submit', 'Sign In', 'class="btn btn-primary btn-block btn-flat"');?>
        </div>
        <!-- /.col -->
      </div>
   

   
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
