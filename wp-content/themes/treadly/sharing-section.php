<div class="sharing-section">
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-md-6">
                <div class="section-img text-center">
                    <div class="owl-carousel owl-theme">
                        <div class="item"><img src="<?php echo site_url() . '/wp-content/themes/treadly/images/01.jpg'?>" class="img-fluid" alt=""></div>
                        <div class="item"><img src="<?php echo site_url() . '/wp-content/themes/treadly/images/02.jpg'?>" class="img-fluid" alt=""></div>
                        <div class="item"><img src="<?php echo site_url() . '/wp-content/themes/treadly/images/03.jpg'?>" class="img-fluid" alt=""></div>
                    </div>                                        
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-content">
                <div class="circle-bg"></div>
                    <h3>Got a friend you know would love this?</h3>
                    <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <?php
                        echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,linkedin,pinterest,email' twitter_username='' facebook_text='facebook' twitter_text='twitter' linkedin_text='linkedin' pinterest_text='pinterest' xing_text='Share on Xing' reddit_text='Share on Reddit' email_text='Email' icon_order='f,t,l,p,x,r,e' show_icons='0' before_button_text='' text_position='' social_image='']");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    