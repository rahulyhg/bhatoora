<footer>
    <div class="row top-footer">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <?php
                           
                            $this->config->load('application_settings');
                            $arrFooterLinks = $this->config->item('ui_footer_primary_links');
                            
//                            echo "<pre>" ;
//                            print_r($arrFooterLinks);
//                            exit;
//                            
                            if(count($arrFooterLinks)) {?>
                            <ul>
                                <?php
                                foreach($arrFooterLinks as $link) { ?>
                                    <li style="display: inline; margin-left: 15px;"><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></li> | 
                                <?php
                                }
                                ?>
                            </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>    