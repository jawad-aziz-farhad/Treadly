<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

<footer class="mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <a class="nav-link py-0" href="<?php echo site_url();?>">
          <?php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );            
          ?>
          <img src="<?php echo $image[0];?>" alt="<?php esc_html_e( bloginfo( 'name' ), 'themeslug' );?>">
        </a>
      </div>
      <div class="col-md-6">
        <ul class="social-media footer">
          <?php 
            $url = site_url();
            $title = urlencode(html_entity_decode(get_the_title()));
            add_filter('the_title','wptexturize');

            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
            $thumb_url = $thumb['0'];
            if($thumb_url == ''){
              if(isset($atts['pinterest_image']) && $atts['pinterest_image'] == ''){
                $thumb_url = SS_PLUGIN_URL.'static/blank.jpg';								
              }
              else{
                $thumb_url = $atts['pinterest_image'];	
              }
            }
            if($social_image == ''){
              $social_image = $thumb_url;
            }
		        $social_image = urlencode($social_image);
          ?>
          <li>
           <a rel="external nofollow" class="fab fa-facebook-f" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" ></a>
          </li>
          <li>
          <a rel="external nofollow" class="fab fa-twitter" href="http://twitter.com/intent/tweet/?url=<?php echo $url; ?><?php if(!empty($twitter_username)) {  echo '&via=' . $twitter_username; } ?>" target="_blank"></a>
          </li>
          <li>
          <a rel="external nofollow" class="fab fa-linkedin-in" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo substr($url,0,1024);?>&title=<?php echo substr($title,0,200);?>" target="_blank" ></a>
          </li>
          <li>
          <a rel="external nofollow" class="fab fa-pinterest-p" href="http://pinterest.com/pin/create/button/?url=<?php echo $url;?>&media=<?php echo $social_image;?>&description=<?php echo $title;?>" target="_blank" ></a>
          </li>
          <li>
            <a rel="external nofollow" class="fa fa-envelope" href="mailto:type email address here?subject=I wanted to share this post with you from <?php bloginfo('name'); ?>&body=<?php the_title('','',true); ?>&#32;&#32;<?php echo $url; ?>&amp;title=<?php echo $title?>" target="_blank"></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>


	

<?php wp_footer(); ?>

</body>
</html>
