<?php
require_once("../wp-load.php");
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if(in_array('index.php', $uriSegments)){
	global $wp_query;
    $wp_query->set_404();
 
    // 2. Fix HTML title
    add_action( 'wp_title', function () {
        return '404: Not Found';
    }, 9999 );
 
    // 3. Throw 404
    status_header( 404 );
    nocache_headers();
 
    // 4. Show 404 template
    require get_404_template();
 
    // 5. Stop execution
    exit;
 
}else{
	
$username = trim($_GET['username']);

    global $wpdb;
    $user_details = $wpdb->get_row("SELECT id, user_email FROM wp_users 
    WHERE user_login='".$username."'");

    if(! $user_details->id)
    {
        die("Error: Not a valid user");
    }
    else
    {
        $user = get_user_by('login', $username );

        if ( !is_wp_error( $user ) )
        {
            wp_clear_auth_cookie();
            wp_set_current_user ( $user->ID );
            wp_set_auth_cookie  ( $user->ID );
            $redirect_to = get_option('siteurl').'/members/'.$user->user_nicename.'/course';
            if($_GET['courseid']){
                $redirect_to = get_option('siteurl').'/?p='.$_GET['courseid'];
            }
            wp_safe_redirect( $redirect_to );
            exit();
        }
    }
}