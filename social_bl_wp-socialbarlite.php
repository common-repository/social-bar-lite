<?php
/*
Plugin Name: Social Bar Lite
Description: A floating bar plugin that allows your visitors connect them to your Twitter social network in a fast, secure and instant way. Increase the number of followers of your Twitter account in a 200%, change its background color, text color, enable it or disable it with just one click.
Version: 1.0.2
Author: Infranetworking
Author URI: https://infranetworking.com/
License: GPLv2 or later
*/

define("SOCIAL_BL_ROOT_DIR", plugin_dir_path( __FILE__ ));
define("SOCIAL_BL_STATIC_URL",plugins_url( 'statics/' , __FILE__ ));
define("SOCIAL_BL_ROOT_VIEWS", SOCIAL_BL_ROOT_DIR.'views/');
define("SOCIAL_BL_DEBUG", false);
define("SOCIAL_BL_PLUGIN_NAME", "SocialBarLite");
define("SOCIAL_BL_PLUGIN_NAME_VAR", "socialbarlite");
define("SOCIAL_BL_FORM_URL","pro_plugin_settings");
/*Directories that contain classes*/
$classesDir = array (
    SOCIAL_BL_ROOT_DIR.'libs/',
    SOCIAL_BL_ROOT_DIR.'models/',
    SOCIAL_BL_ROOT_DIR.'controllers/',
);
function social_bl_autoload($className) {
	//print_r($className);
    global $classesDir;
    foreach ($classesDir as $directory) {
    	foreach ( glob($directory."*.php") as $file )
    	{
		if(is_file($file)&&!class_exists($file))
    		include_once $file;


   	}

    }
}


/* -------- Pr ---------- */

function social_bl_pr($array){

    echo '<pre>';
    print_r($array);
    echo  '</pre>';

}


function social_bl_pro_plugin_activation() {
}


function social_bl_pro_plugin_deactivation() {
}

/* ------ Load Controller------ */
function social_bl_loadController($option){
	$optionexplode = explode(".", $option);
	$controller_name= $optionexplode[0].'Controller';
	$controller_action = $optionexplode[1];

	$controller = new $controller_name;
	$controller->$controller_action();

}


function social_bl_pro_plugin_display_settings() {

//	pr($_REQUEST);

	if ( current_user_can( 'administrator' ) ) {

		if(isset($_REQUEST["option"])){
			$option = $_REQUEST["option"];
		}else{
			$option = 'social_bl_masterPlugin.social_bl_init';
		}
    //echo $option;
		social_bl_loadController($option);
	}
}

function social_bl_add_ccs(){
    $option='social_bl_masterPlugin.social_bl_showBarCss';
    social_bl_loadController($option);
}

function social_bl_add_ccs_modify(){
    $option='social_bl_masterPlugin.social_bl_showBarCssModify';
    social_bl_loadController($option);
}

function social_bl_add_js(){
    $option='social_bl_masterPlugin.social_bl_showBarJs';
     social_bl_loadController($option);
}

function social_bl_showBar() {

         $option='social_bl_masterPlugin.social_bl_showBar';
         social_bl_loadController($option);
}


function social_bl_pro_plugin_settings() {
    add_menu_page(SOCIAL_BL_PLUGIN_NAME.' Settings', SOCIAL_BL_PLUGIN_NAME, 'manage_options',  SOCIAL_BL_FORM_URL, 'social_bl_pro_plugin_display_settings');
    //add_submenu_page( 'pro_plugin_settings', 'About Us', 'About Us', 'manage_options', 'pro_plugin_aboutus', 'pro_plugin_display_settings');
}

spl_autoload_register('social_bl_autoload');
register_activation_hook(__FILE__, 'social_bl_pro_plugin_activation');
register_deactivation_hook(__FILE__, 'social_bl_pro_plugin_deactivation');
add_action('admin_menu', 'social_bl_pro_plugin_settings');
add_filter('wp_footer', 'social_bl_showBar');
add_action( 'wp_print_styles', 'social_bl_add_ccs' );
add_action( 'wp_enqueue_scripts', 'social_bl_add_js' );
?>
