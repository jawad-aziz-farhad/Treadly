<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

  <header>
    <div class="sub-header">
      <div class="cotainer">
        <div class="row">
          <div class="col-md-12 text center">
          </div>
        </div>
      </div>
    </div>

    <?php
      $custom_logo_id = get_theme_mod( 'custom_logo' );
      $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );            
    ?>

    <div class="container">
    	<div class="row">
            
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-expand-md navbar-light bg-light" style="background-color: #ff0;">
            <a class="navbar-brand p-0" href="#">
              <img src="<?php echo $image[0];?>" alt="<?php esc_html_e( bloginfo( 'name' ), 'themeslug' );?>">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item <?php if(is_home()):?> active <?php endif;?>">
                  <a class="nav-link" href="<?php echo home_url();?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if($pagename == 'about'):?> active <?php endif;?>">
                  <a class="nav-link" href="<?php echo site_url();?>/about">About</a>
                </li>
                <li class="nav-item logo-menu">
                  <a class="nav-link py-0" href="<?php echo site_url();?>">
                  <img src="<?php echo $image[0];?>" alt="<?php esc_html_e( bloginfo( 'name' ), 'themeslug' );?>">
                  </a>
                </li>
                

                <?php if(is_user_logged_in()):?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileMenuItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo um_user('display_name');?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileMenuItem">
                    <a class="dropdown-item" href="<?php echo site_url();?>/user">Profile</a>
                    <a class="dropdown-item" href="<?php echo site_url();?>/logout">Logout</a>
                    </div>
                </li>

                <?php else:?>
                  <li class="nav-item <?php if($pagename == 'register'):?> active <?php endif;?>">
                    <a class="nav-link" href="<?php echo site_url();?>/register">subscribe</a>
                  </li>
                  <li class="nav-item <?php if($pagename == 'login'):?> active <?php endif;?>">
                    <a class="nav-link" href="<?php echo site_url();?>/login">Login</a>
                  </li>
                <?php endif;?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
    <!-- SHOWING BANNER ONLY ON HOMER PAGE -->
    <?php if(is_home()):?>
    <div class="slider-banner">
        <video autoplay muted loop id="myVideo">
          <source src="<?php echo site_url() . '/wp-content/themes/treadly/images/video.mp4';?>" type="video/mp4" />
          Your browser does not support HTML5 video.
        </video>
    	<div class="slider-table">
        	<div class="slider-cell">
            <div class="slider-content">
              <div class="container">
                  <div class="row">
                    <div class="col-md-9">
                      <h1>Looking for a new bike?</span></h1>
                      <h3>From thousands of bikes let's find you the perfect one.</h3>
                      <a href="#searchBox" class="scroll-anchor btn btn-outline-danger rounded-pill mb-2 px-4">Take a ride</a> &nbsp;
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <?php get_template_part('sharing_section');?>
    
    <?php endif;?>
<body>



