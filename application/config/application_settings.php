<?php
/* Created by Ravi */

$config['site_title']     = 'Bhatoora';


$config['max_category_allowed']     = 8;

$config['ui_footer_primary_links']  = array( array('title' => 'Terms' ,  'url'  => '#'), 
                                             array('title' => 'Privacy', 'url' => '#'), 
                                             array('title' => 'Advertise with us', 'url' => '#'), 
                                             array('title' => 'Careers', 'url' => '#'),
                                             array('title' => 'Help', 'url' => '#'),
                                             array('title' => 'Feedback', 'url' => '#'),
                                            );

$config['admin_profile_image'] = 'dist/img/user2-160x160.jpg';

$config['categories'] = array( 
                                array('id' => '1', 'category_name' => 'News', 
                                                'subcategories' => array(
                                                    array('id' => '8',  'category_name' => 'Breaking News'),
                                                    array('id' => '9',  'category_name' => 'National'),
                                                    array('id' => '10', 'category_name' => 'Regional'),
                                                    array('id' => '11', 'category_name' => 'World')
                                                ),
                                    ),
    
    
                                array('id' => '2', 'category_name' => 'Lifestyle', 
                                                'subcategories' => array( 
                                                    array('id' => '12', 'category_name' => 'Diet'),
                                                    array('id' => '13', 'category_name' => 'Health & Wellness'),
                                                    array('id' => '14', 'category_name' => 'Fashion'),
                                                    array('id' => '15', 'category_name' => 'Beauty')
                                                ),
                                    ),
    
                                array('id' => '3', 'category_name' => 'Entertainment', 
                                                'subcategories' => array(
                                                    array('id' => '16', 'category_name' => 'New Release'),
                                                    array('id' => '17', 'category_name' => 'Movie Review'),
                                                    array('id' => '18', 'category_name' => 'What\'s Hot?'),
                                                    array('id' => '19', 'category_name' => 'Poll of the day')
                                                ),
                                    ),
                                  
                                array('id' => '4', 'category_name' => 'Horoscope', 
                                                'subcategories' => array(
                                                    array('id' => '20', 'category_name' => 'Daily horoscope'),
                                                    array('id' => '21', 'category_name' => 'Tarot'),
                                                    array('id' => '22', 'category_name' => 'Vastu'),
                                                    array('id' => '23', 'category_name' => 'Horoscope calculator')
                                                )
                                    ),
                            );



$config['facebook_api_key'] = '181863905567505';

