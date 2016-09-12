<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo isset($title) ? $title : $this->config->item('site_title'); ?></title>
<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
	<link href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/media.css" rel="stylesheet" />
        
        
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <link href="css/ie8.css" rel="stylesheet" />
    <![endif]-->
</head>
<body>
	<div class="wrapper">
		<header class="row">
			<div class="content">
				<div class="dlg-3 dmd-3 logo">
					<a href=""><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="<?php echo $this->config->item('site_title'); ?>" /></a>
				</div>
				<div class="dlg-9 dmd-9 hdr_rt">
					<div class="row">
						<div id="reg">
							<a href="" class="reg_icon"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
							<a href="" class="reg_btn">Register Here</a>
						</div>
                                            
						<div id="login">
							<div class="row">
                                                            <div id="login-error-container"></div>
								<div class="login_btn">
                                                                    <a href="javascript:void(0)" onclick="userLogin();"><i class="fa fa-lock" aria-hidden="true"></i>LOGIN</a></div>
								<div class="login_field">
									<input type="password" id="header_password" />
									<label for="usr_pswrd">Password</label>
									<span><i class="fa fa-key" aria-hidden="true"></i></span>
								</div>
                                                            
								<div class="login_field">
									<input type="text" id="header_username" />
									<label for="usr_name">User Name</label>
									<span><i class="fa fa-user" aria-hidden="true"></i></span>
								</div>
							</div>
							<p><a href="">Forgot Password ?</a></p>
						</div>
					</div>
				</div>
			</div>
		</header>
		<nav class="row">
			<div class="content">
				<ul class="nav">
					<li class="nav_home"><a href=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                        
                                        <?php 
                                        $CI =& get_instance();
                                        
                                        $CI->load->model('Categories');
                                        $CI->Categories->strCondition = " AND cat.parent_category = 0 ";
                                        $CI->Categories->orderByField = " cat.display_order ";
                                        $CI->Categories->orderBy      = " ASC ";
                                        $arrCategories = $CI->Categories->listCategories();
//                                        
//                                        echo "<pre>";
//                                        print_r($arrCategories);
//                                        exit;
//                                        
                                        if(count($arrCategories) > 0) {
                                            while( list($key, $val) = each($arrCategories) ) { ?>
                                        
                                                    <li class="has_sub">
                                                        <a href="javascript:void(0);"><?php echo $val['category_name']; ?></a>
                                                        <?php 
                                                        $CI->load->model('Categories');
                                                        $CI->Categories->strCondition = " AND cat.parent_category = " . $val['id']." "
                                                                . "  AND cat.parent_category <> 0 ";
                                                       
                                                        $arrSubCategories = $CI->Categories->listCategories();
                                                        
                                                        if(count($arrSubCategories) > 0 ) { ?>
                                                        
                                                        <ul class="sub">
                                                               <?php 
                                                                foreach($arrSubCategories as $subCategory) { ?>
                                                                    <li><a href=""><?php echo $subCategory['category_name']; ?></a></li>
                                                                <?php }
                                                               ?>

                                                        </ul>
                                                        
                                                        <?php } ?>
                                                    </li>
                                        
                                                
                                            <?php }
                                        }
                                        ?>
                                        
                                     
				</ul>
				<div id="srch">
					<input type="text" id="main_srch" />
					<label for="main_srch">Search Keywords</label>
					<a><i class="fa fa-search" aria-hidden="true"></i></a>
				</div>
			</div>
		</nav> <div class="clear"></div>
                <!-- header ends -->
                
                
      <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>          
             
		