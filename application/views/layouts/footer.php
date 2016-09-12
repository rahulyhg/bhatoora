<footer class="row">
        <div class="content">
                <div class="f_top">
                        <ul class="f_social">
                                <li><a href="" class="ttr"></a></li>
                                <li><a href="" class="fb"></a></li>
                                <li><a href="" class="blg"></a></li>
                                <li><a href="" class="ggl"></a></li>
                                <li><a href="" class="youtb"></a></li>
                        </ul>		

                        <ul class="f_menu">
                            
                            <?php
                           
                            $this->config->load('application_settings');
                            $arrFooterLinks = $this->config->item('ui_footer_primary_links');
                            
//                            echo "<pre>" ;
//                            print_r($arrFooterLinks);
//                            exit;
//                            
                            if(count($arrFooterLinks)) {
                                $intCounter = 0; ?>
                            <ul>
                                <?php
                                foreach($arrFooterLinks as $link) { ?>
                                    <li><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></li>
                                    <?php if($intCounter < count($arrFooterLinks) - 1) { ?>
                                        <li><span>|</span></li>
                                    <?php } ?>
                                <?php
                                    $intCounter++;
                                }
                                ?>
                            </ul>
                            <?php
                            }
                            ?>
                        </ul>
                </div>
        </div>
<p class="copyrt">Copyright © <?php echo date('Y'); ?> <a href=""><?php echo $this->config->item('site_title'); ?></a> All Rights Reserved</p>
	</footer>
	</div>
	<script src="<?php echo base_url(); ?>assets/js/bhatoora.min.js"></script>
        
        <script type="text/javascript">
            
            function userLogin() {
                var email = $("#header_username").val();
                var password = $("#header_password").val();
                
                $.ajax({
   	
                    type:'POST',
                    url:'<?php echo base_url();?>login/login',
                    dataType : 'JSON',
                    data:'email='+email+'&password='+password+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
                    cache:false,
                    success: function(response) { 
                        if(response.success) {
                            window.location = '/';
                        }else {
                            $("#login-error-container").text(response.message);
                        }
                        //alert(response);
                    }
                });
            }
            
        </script>  
       
</body>
</html>