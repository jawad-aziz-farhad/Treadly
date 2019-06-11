<?php


/*
|----------------------
| ENQUEUING SCRIPTS
|----------------------
*/
function treadly_scripts(){
    wp_enqueue_script( 'jquery',      'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '20120206', true );
    wp_enqueue_script( 'bootstrap',   get_template_directory_uri() . '/js/bootstrap.min_2.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'modernizr',    get_template_directory_uri() . '/js/modernizr-custom.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'classie',      get_template_directory_uri() . '/js/classie.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'main',         get_template_directory_uri() . '/js/main.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'ajax-func',    get_template_directory_uri() . '/js/ajax-func.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'custom-js',    get_template_directory_uri() . '/js/main_new.js', array('jquery'), '20160816', true);
    global $wp_query;
    wp_localize_script( 'ajax-func', 'ajaxFunc', 
                        array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ,
                               'query_vars' => json_encode($wp_query -> $query)) 
                       );
}
/*
|----------------------
| ENQUEUING STYLES
|----------------------
*/
function treadly_styles(){
    wp_enqueue_style( 'google-apis' , 'https://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700', array(), 1.0 );
    wp_enqueue_style('font-awesome-all',  'https://use.fontawesome.com/releases/v5.8.2/css/all.css',  array() , 1.0);
    wp_enqueue_style('font-awesome'   , get_stylesheet_directory_uri() . '/css/font_awesome.min.css', array(), 1.0);
    wp_enqueue_style( 'component-css', get_stylesheet_directory_uri() . '/css/component.css',     array(), 1.0 );
    wp_enqueue_style( 'owl-carousel' , get_stylesheet_directory_uri() . '/css/owl.carousel.css',  array(), 1.0 );
    wp_enqueue_style( 'bootstrap-min', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 1.0 );
    //wp_enqueue_style( 'styles-css'   , get_stylesheet_directory_uri() . '/css/styles.css',        array(), 1.0 );
    wp_enqueue_style( 'new-styles'   , get_stylesheet_directory_uri() . '/css/new_styles.css',    array(), 1.0 );
}

add_action('wp_enqueue_scripts', 'treadly_scripts');
add_action('wp_enqueue_scripts', 'treadly_styles');

add_action( 'wp_ajax_allPosts', 'allPosts' );
add_action( 'wp_ajax_nopriv_allPosts', 'allPosts' );

add_action( 'wp_ajax_fetchProducts', 'fetchProducts' );
add_action( 'wp_ajax_nopriv_fetchProducts', 'fetchProducts' );


add_action( 'wp_ajax_updateCustomeField', 'updateCustomeField' );
add_action( 'wp_ajax_nopriv_updateCustomeField', 'updateCustomeField' );

/* START OF AJAX REQUEST */
function allPosts() {
    
    $args = array('type' => 'post');

    $the_query = new WP_Query($args);    

    $products = array();
    $response = array();

    if ($the_query->have_posts()) {
        
        while( $the_query -> have_posts() ) {
            
            $the_query -> the_post();            
            $title         =  get_the_title();
            $featured_imge = get_the_post_thumbnail_url(get_the_ID(),'full'); 
            $custom_fields = get_field_objects(); 
            $price         = get_field( "price_details");
            $products[]    =  array('id' => get_the_ID() , 'title' => get_the_title() , 'price' => $price , 'custom_fields' => $custom_fields , 'image' => $featured_imge);
        }       
        
        $response['success']    = true;
        $response['products']   = $products;
        echo json_encode($response);
        exit();
    }
  else  {
        $response['success']  = false;
        $response['products'] = [];
        echo json_encode($response);
        exit();
    }
  wp_reset_postdata(); 
  die();
}
/*
|--------------------------
|   Fetching Products
|--------------------------
*/
function make_Query($key) {
    if(empty($_POST[$key]))
        return [];
    $_key = ($key == 'price') ? $key .'_details' : $key .'_feature';
    //$compare = ($key == 'price') ? 'BETWEEN' : 'LIKE';
    $values = array();
    $index = 0;
    foreach($_POST[$key] as $val){
        $compare = ($key == 'price') ? ($index == 0 ? '>=' : '<='): 'LIKE';        
        array_push($values,  array( 'key' => $_key ,'value' => $val , 'compare'=> $compare , 'type' => ($key == 'price') ? 'NUMERIC' : ''));
        $index++;
    }
    return array('relation' => 'OR', $values);
}


function getQuery() {

    $use     =  make_Query('use')  ;
    $level   =  make_Query('level')  ;
    $surface =  make_Query('surface');
    $price   =  make_Query('price') ;
    $gender  =  make_Query('gender');   
    
    $args =  '';    
    
    if(empty($_POST['use']) && empty($_POST['level']) && empty($_POST['surface']) && empty($_POST['gender']) && empty($_POST['price'])){
       $args = []; 
    } 
    if(!empty($_POST['use']) && empty($_POST['level']) && empty($_POST['surface']) && empty($_POST['gender']) && empty($_POST['price'])){
        $args =  array(
            'numberposts'	=> -1,
            'post_status'        => 'publish',
            'post_type'		=> 'post',
            'meta_query'    => $use
        );       
    }    
    else if(empty($_POST['use']) && !empty($_POST['level']) && empty($_POST['surface']) && empty($_POST['gender']) && empty($_POST['price'])){
        $args =  array(
                'numberposts'	=> -1,
                'post_status'        => 'publish',
                'post_type'		=> 'post',
                'meta_query'    => $level
            );  
    }    
    else if(empty($_POST['use']) && empty($_POST['level']) && !empty($_POST['surface']) && empty($_POST['gender']) && empty($_POST['price'])){
        $args =  array('numberposts'	=> -1,
                        'post_status'        => 'publish',
                        'post_type'		=> 'post',
                        'meta_query'    => $surface
                    );    
    }    
    else if(empty($_POST['use']) && empty($_POST['level']) && empty($_POST['surface']) && !empty($_POST['gender']) && empty($_POST['price'])){
        $args =  array('numberposts'	=> -1,
                        'post_status'        => 'publish',
                        'post_type'		=> 'post',
                        'meta_query'    => $gender
                    );    
    }    
    else if(empty($_POST['use']) && empty($_POST['level']) && empty($_POST['surface']) && empty($_POST['gender']) && !empty($_POST['price'])){
        $args =  array('numberposts'	=> -1,
                        'post_status'        => 'publish',
                        'post_type'		=> 'post',
                        'meta_query'    => $price
                    );         
    }
    else {
        $args = array('numberposts'	=> -1,
                      'post_status'      => 'publish',
                      'post_type'	=> 'post',
                      'meta_query'	=> array(
                      'relation'	=> 'AND',
                       $level, $use ,  $surface, $gender ,$price));   
    }    
    return $args;
}

function fetchProducts(){

    $args = getQuery();
    if(empty($args)){
        allPosts();
        return;
    }

    $the_query = new WP_Query($args);    

    $products = array();
    $response = array();

    if ($the_query->have_posts()) {
        
        while( $the_query -> have_posts() ) {
            
            $the_query -> the_post();            
            $title         =  get_the_title();
            $featured_imge = get_the_post_thumbnail_url(get_the_ID(),'full'); 
            $custom_fields = get_field_objects(); 
            $price         = get_field( "price_details");
            $products[]    =  array('id' => get_the_ID() , 'title' => get_the_title() , 'price' => $price , 'custom_fields' => $custom_fields , 'image' => $featured_imge);
        }      
        
        $response['success']    = true;
        $response['products']   = $products;
        echo json_encode($response);
        exit();
    }
  else  {
        $response['query']    = $args;
        $response['success']  = false;
        $response['products'] = [];
        echo json_encode($response);
        exit();
    }
  wp_reset_postdata(); 
  die();
}

/*
======================================
    SPLITTING DESCRIPTION STRING 
    AND PUTTING EVERY SPLITTED 
    PART IN ARRAY
======================================
*/
function split_content($description) {
    global $more;
    $more = true;
	$content = preg_split('/<!--more(.*?)?-->/', $description);
	for($c = 0, $csize = count($content); $c < $csize; $c++) {
		$content[$c] = apply_filters('the_content', $content[$c]);
	}
	return $content;
}

/*
    ======================================
        GETTING POST CREATION TIME 
        AND CALCULATING THE DIFFERENCE
        WITH CURRENT DATE AND TIME
    ======================================
*/
function getPostCreationTime(){
    $product_created_date = get_the_date();
    $date1 = date_create($product_created_date);
    $date2 = date_create(date("Y-m-d"));
    $diff  = date_diff($date1,$date2);
    $difference = $diff->format("%R%a");
    $difference = intval($difference);    
    return $difference;
}

/*
    ======================================
        GETTING POST IMAGE
    ======================================
*/
function getProductImage(){
    $product_id = get_the_ID();                        
    $product   = new WC_product($product_id);
    $attachment_ids = $product -> get_gallery_image_ids();
    foreach($attachment_ids as $attachment_id){
        $image_url = '';
        $image_url = wp_get_attachment_url( ($attachment_id) );
    }    
    return $image_url;
}
/* END OF AJAX REQUEST */
/*
|------------------------------------
|  ADDING THEME SUPPORT FEATURES
|------------------------------------
*/
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'post-formats', array('aside', 'image', 'video'));

add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only
add_theme_support( 'post-thumbnails', array( 'page' ) );          // Pages only
add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) );

function initTheme(){
    add_theme_support( 'menus' ); 
    register_nav_menu( 'primary', 'Primary Header Navigation');
    register_nav_menu( 'secondary', 'Footer Navigation Menu');
}
add_action('init', 'initTheme'); 

/*
|------------------------------------
|  ADDING THEME SUPPORT FEATURES
|------------------------------------
*/
function custom_func_setup(){
    $logoData = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' )
    );    
    add_theme_support('custom-logo', $logoData);
    $headerData = array(
        'width' => 1460,
        'flex-width'    => true,
        'height'=> 60,
        'flex-height'    => true,
        'default-image' => get_template_directory_uri() . '/images/cycle-bg-1.jpg'
    );    
    add_theme_support('custom-header',$headerData);
    
    $headerImages = array(
    'image1' => array(
        'url' =>  get_template_directory_uri() . '/images/cycle-bg-1.jpg',
        'thumbnail_url' => get_template_directory_uri() . '/images/cycle-bg-1.jpg',
        'description' => '1st suggestion'
    ),
    'image2' => array(
        'url' =>  get_template_directory_uri() . '/images/cycle-bg-2.jpg',
        'thumbnail_url' => get_template_directory_uri() . '/images/cycle-bg-2.jpg',
        'description' => '2nd suggestion'
    )
    );    
	register_default_headers($headerImages);
	
    $backgroundData = array(
        'default-color'          => '',
        'default-image'          => get_template_directory_uri() . '/images/cycle-bg-1.jpg',
        'default-repeat'         => 'no-repeat',
        'default-position-x'     => 'left',
        'default-position-y'     => 'top',
        'default-size'           => 'cover',
        'default-attachment'     => 'scroll',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
	
	add_theme_support( 'custom-background', $backgroundData );
	
	
}
add_action( 'after_setup_theme', 'custom_func_setup' );

?>