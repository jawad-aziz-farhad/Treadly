<?php
/**
 * Plugin Name: Review Form
 * Description: Upload large files using the JavaScript FileReader API
 * Author: Jawad Aziz Farhad
 * Version: 1.0
 * Author URI: http://deliciousbrains.com
 */
class DBI_File_Uploader {
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_wp_scripts' ) );
		add_action( 'wp_ajax_upload_file', array( $this, 'ajax_upload_file' ) );
		add_action( 'wp_ajax_nopriv_upload_file',  array( $this, 'ajax_upload_file' ));
		

		add_action( 'wp_ajax_submitReviewForm',  array( $this,'submitReviewForm' ));
		add_action( 'wp_ajax_nopriv_submitReviewForm',  array( $this,'submitReviewForm' ));

		add_shortcode( 'new_review_form', array( $this, 'render_shortCode' ) );
		
	}

	public function render_shortCode() {
		include('templates/new-form.php');
	}

	public function enqueue_wp_scripts() {

		wp_enqueue_style('jquery-steps-css',  plugins_url( '/css/jquery.steps.css', __FILE__ ), array(), 1.0);
		wp_enqueue_style('percentage-loader',  plugins_url( '/css/percentage-loader.css', __FILE__ ), array(), 1.0);
        wp_enqueue_style('loader-css',  plugins_url( '/css/loader.css', __FILE__ ), array(), 1.0);
        wp_enqueue_style('rating-css',  plugins_url( '/css/rating.css', __FILE__ ), array(), 1.0);
        
        wp_enqueue_script( 'jquery', '/js/jquery-3.3.1.min.js', array(), 1.0, false );      
		wp_enqueue_script( 'jquery-validate', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js', array('jquery'), 1.0, false );
		wp_enqueue_script( 'jquery-steps', plugins_url( '/js/jquery.steps.js', __FILE__ ), array('jquery'), 1.0, false);          
        wp_enqueue_script( 'main', plugins_url( '/js/main.js', __FILE__ ), array('jquery'), 1.0, false);
        
        global $wp_query;
        wp_localize_script( 'main', 'reviewForm', 
                        array( 'review_url' => admin_url( 'admin-ajax.php' ) ,
							  'query_vars' => json_encode($wp_query -> $query),
							  'upload_file_nonce' => wp_create_nonce( 'dbi-file-upload' )) 
                      );
                       
	}

	
	public function ajax_upload_file() {
		check_ajax_referer( 'dbi-file-upload', 'nonce' );
		$wp_upload_dir = wp_upload_dir();
		$file_path     = trailingslashit( $wp_upload_dir['path'] ) . $_POST['file'];
		$file_data     = $this->decode_chunk( $_POST['file_data'] );
		if ( false === $file_data ) {
			wp_send_json_error();
		}
		file_put_contents( $file_path, $file_data, FILE_APPEND );
		
		wp_send_json_success(array('path'=>$file_path, 'success'=>true));
	}
	
	public function decode_chunk( $data ) {
		$data = explode( ';base64,', $data );
		if ( ! is_array( $data ) || ! isset( $data[1] ) ) {
			return false;
		}
		$data = base64_decode( $data[1] );
		if ( ! $data ) {
			return false;
		}
		return $data;
	}
	

	public function submitReviewForm () {

		check_ajax_referer( 'dbi-file-upload', 'nonce' );
		
		$post = $this->createPost();
		
		if($post['success'] === false)
			$this->handleError($post);
        else{

            $fields = acf_get_fields_by_id($post->post_id);
            
            $allFields = array();

            foreach ($fields as $field) {
                $value = $_POST[$field['name']];
                if(isset( $value )) {
                    if($field['key'] === 'category' || $field['key'] === 'country')
                        $value = array($value);
                    update_field($field['key'], $value , $post['post_id']);                      
                }            
                $fieldData = array( $field['key'] => $value , 'name' => $field['name']);
                array_push($allFields , $fieldData);
			}
			
			$files = ['bike', 'gears', 'tyres' , 'handlebar' , 'suspension' , 'review_video'];        
        	foreach($files as $file) {   
				if(isset( $_POST[$file] )) {                     
					$attachid = $this->insertAttachment($post['post_id'], $_POST[$file]);
					$key = ( $file === 'review_video' ) ? $file : ($file . '_image');
					update_field($key, $attachid, $post['post_id']);
				}
        	}			
        	$mailResponse = $this->sendEmail();
            echo json_encode(['post' => $post , 'all' => $allFields, 'mail_response' => $mailResponse]);
            wp_die();
        }       
    }

    function handleError($error){
        echo json_encode($error);
        wp_die();
    }
    
    function sendEmail(){
        $to      = $_POST['email'];
		$subject = 'Hi! ' . $_POST['name'] . ' ,';
		$body    =  'Your review has been submitted to the Real Bike Review successfully. After being reviewed it will be published and you will be notified by email. Thank you for taking the time to share your thoughts about this bike. With your help we can get every person on the right bike';

		$headers = array('Reply-To: TRBR <chris.gibbs1977@gmail.com>');
		$headers = array('Content-Type: text/html; charset=UTF-8','From: TRBR <chris.gibbs1977@gmail.com>');
		if(wp_mail( $to, $subject, $body , $headers ))
			return 'Mail sent successfullly.';
		else
			return 'something went wrong.';
    }

    function createPost() {

		$data = $_POST;

		// Set the post ID to -1. This sets to no action at moment
        $post_id = -1;     
        // Set the Author, Slug, title and content of the new post
        $author_id = get_current_user_id();
        $slug = $this->makeSlug($data['brand'] . ' ' . $data['model']);
        $title = ' Review at ' . current_time( 'mysql' )  ;
		$content = '';

        // Cheks if doen't exists a post with slug "wordpress-post-created-with-code".
        $response = array();
        if( !$this->post_exists_by_slug( $slug ) ) {
            $post = array(
                'comment_status'    =>   'open',
                'ping_status'       =>   'open',
                'post_author'       =>   $author_id,
                'post_name'         =>   $slug,
                'post_title'        =>   $title,
                'post_content'      =>   $content,
                'post_status'       =>   'draft',
                'post_type'         =>   'post'
            );            
            // Set the post ID
			$post_id = wp_insert_post( $post );
			
			if(!is_wp_error($post_id)){
                //the post is valid
                $response = ['post_id' => $post_id , 'success' => true];
                }else{
                    //there was an error in the post insertion, 
                    $response = ['message' => $post_id -> get_error_message() , 'success' => false];
                }
        } else {     
            // Set pos_id to -2 becouse there is a post with this slug.
            $post_id = -2;
            $response = ['post_id' => $post_id , 'success' => false, 'slug' => 'Slug already exist.'];         
        } // end if     
        
        return $response;
    } 

    function makeSlug($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string . current_time( 'timestamp', 1 );
    }    

    function post_exists_by_slug( $post_slug ) {
        $args_posts = array(
            'post_type'      => 'post',
            'post_status'    => 'any',
            'name'           => $post_slug,
            'posts_per_page' => 1,
        );
        $loop_posts = new WP_Query( $args_posts );
        if ( ! $loop_posts->have_posts() ) {
            return false;
        } else {
            $loop_posts->the_post();
            return $loop_posts->post->ID;
        }
	}

	public function testUpdateField() {

		check_ajax_referer( 'dbi-file-upload', 'nonce' );

		$files = ['bike', 'gears', 'tyres' , 'handlebar' , 'suspension' ];        
		foreach($files as $file) {   
			$attachid = $this->__insertAttachment( 'birds.jpg');
			$key = ( $file === 'review_video' ) ? $file : ($file . '_image');
			update_field($key, $attachid, 267);
			
		}		
		$filename = wp_upload_dir()['url'] . '/' . basename('birds.jpg');	
		echo json_encode(['success' => true, 'filename' => $filename]);
		wp_die();
	}

	public function insertAttachment($postid, $filename) {        
        $filetype = wp_check_filetype( basename( $filename ), null );

        // Get the path to the upload directory.
        $wp_upload_dir = wp_upload_dir();

		// $filename should be the path to a file in the upload directory.
		$filename = $wp_upload_dir['url'] . '/' . basename( $filename );
		
		// Check the type of file. We'll use this as the 'post_mime_type'.
		$filetype = wp_check_filetype( basename( $filename ), null );

		// Get the path to the upload directory.
		$wp_upload_dir = wp_upload_dir();

		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		// Insert the attachment.
		$attach_id = wp_insert_attachment( $attachment, $filename, $postid );

		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// Generate the metadata for the attachment, and update the database record.
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;
    }

}
new DBI_File_Uploader();