<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo isset($title) ? $title : $this->config->item('site_title'); ?></title>
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="header-section">
  <div class="header">
    <div class="logo">
      <h1><?php echo $this->config->item('site_title'); ?></h1>
      
    
           
    </div>
    <div class="menu">
      <ul>
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url(); ?>newsletter">Newsletter</a></li>
        <?php
        if(!$this->session->userdata('loggedin_email')) { ?>
        <li><a href="<?php echo base_url(); ?>login">Login</a></li>
        <li><a href="<?php echo base_url(); ?>signup">Sign up</a></li>
        <?php }else { ?>
            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
        <?php } ?>
      </ul>
        
      <?php
      if($this->session->userdata('loggedin_email')) { ?>
        <h3 style="color:white"> Hi, <?php echo $this->session->userdata('loggedin_fname') ;?> </h3>
      <?php }
      ?>
           
           
    </div>
  </div>
</div>