<?php
/**
* Functions related to the Response Theme Options.
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 1.0
*/

/* Standard Web Layout*/

function standard_web_layout() {
	global $options, $themeslug;
	
	if ($options->get($themeslug.'_standard_web_layout') == '1' ) {
		echo '<style type="text/css">';
		echo ".row {max-width: 1020px;}";
		echo "#sidebar.four.columns {margin-left: 1.9%; width: 32.2%;}";
		echo "#sidebar_left.four.columns {margin-right: 1.9%; width: 32.2%;}";
		echo "#content.eight.columns {width: 65.9%; margin-left: 0%;}";
		echo ".ifeature-tabbed-header li a {padding-right: 13px;";
		echo '</style>';
	}

}
add_action( 'wp_head', 'standard_web_layout' );

/* Widget Title Background*/

function custom_row_width() {
	global $options, $themeslug;
	$maxwidth = $options->get($themeslug.'_row_max_width');
	
	if ($maxwidth != '0' OR $maxwidth =='1020px' ) {
		echo '<style type="text/css">';
		echo ".row {max-width: $maxwidth;}";
		echo '</style>';
	}	
}
add_action( 'wp_head', 'custom_row_width' );

/* Widget Title Background*/

function custom_text_color() {
	global $options, $themeslug;
	$color = $options->get($themeslug.'_text_color');
	
	if ($options->get($themeslug.'_text_color') != '' ) {
		echo '<style type="text/css">';
		echo "body {color: $color;}";
		echo '</style>';
	}

}
add_action( 'wp_head', 'custom_text_color' );

/* Adjust postbar width for full width and 2 sidebar configs*/

function postbar_option() {
	global $options, $themeslug;
	
	if ($options->get($themeslug.'_blog_sidebar') == 'two-right' OR $options->get($themeslug.'_blog_sidebar') == 'right-left') {
		echo '<style type="text/css">';
		echo ".postbar {width: 95.4%;}";
		echo '</style>';
	}
	
	if ($options->get($themeslug.'_blog_sidebar') == 'none') {
		echo '<style type="text/css">';
		echo ".postbar {width: 97.8%;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'postbar_option');


/* Featured Image Alignment */

function featured_image_alignment() {

	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_align') == "key3" ) {
	
		echo '<style type="text/css">';
		echo ".featured-image {float: right;}";
		echo '</style>';
			
	}
	elseif ($options->get($themeslug.'_featured_image_align') == "key2" ) {

		echo '<style type="text/css">';
		echo ".featured-image {text-align: center;}";
		echo '</style>';
		
	}
	else {
		
		echo '<style type="text/css">';
		echo ".featured-image {float: left;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'featured_image_alignment');

/* Post Meta Data width */

function post_meta_data_width() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_blog_sidebar') == "two-right" OR $options->get($themeslug.'_blog_sidebar') == "right-left") {

		echo '<style type="text/css">';
		echo ".postmetadata {width: 480px;}";
		echo '</style>';
		
	}
	
}
add_action( 'wp_head', 'post_meta_data_width');

/* Site Title Color */

function add_sitetitle_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_sitetitle_color') == "") {
		$sitetitle = '#717171';
	}
	
	else {
		$sitetitle = $options->get($themeslug.'_sitetitle_color'); 
	}		
	
		echo '<style type="text/css">';
		echo ".sitename a {color: $sitetitle;}";
		echo '</style>';
		
}
add_action( 'wp_head', 'add_sitetitle_color');

/* Link Color */

function add_link_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_link_color') != '') {
		$link = $options->get($themeslug.'_link_color'); 
	

		echo '<style type="text/css">';
		echo "a {color: $link;}";
		echo ".meta a {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_color');

/* Link Hover Color */

function add_link_hover_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_link_hover_color') != '') {
		$link = $options->get($themeslug.'_link_hover_color'); 
	

		echo '<style type="text/css">';
		echo "a:hover {color: $link;}";
		echo ".meta a:hover {color: $link;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_link_hover_color');

/* Tagline Color */

function add_tagline_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_tagline_color') != '') {
		$color = $options->get($themeslug.'_tagline_color'); 

		echo '<style type="text/css">';
		echo ".description {color: $color;}";
		echo '</style>';

	}	
}
add_action( 'wp_head', 'add_tagline_color');

/* Post Title Color */

function add_posttitle_color() {

	global $themename, $themeslug, $options;

	if ($options->get($themeslug.'_posttitle_color') != '') {
		$posttitle = $options->get($themeslug.'_posttitle_color'); 
			
		echo '<style type="text/css">';
		echo ".posts_title a {color: $posttitle;}";
		echo '</style>';
	}
}
add_action( 'wp_head', 'add_posttitle_color');

/* Menu Font */
 
function add_menu_font() {
		
	global $themename, $themeslug, $options;	
		
	if ($options->get($themeslug.'_menu_font') == "") {
		$font = 'Arial';
	}		
		
	elseif ($options->get($themeslug.'_menu_font') == 'custom' && $options->get($themeslug.'_custom_menu_font') != "") {
		$font = $options->get($themeslug.'_custom_menu_font');	
	}
	
	else {
		$font = $options->get($themeslug.'_menu_font'); 
	}
	
		$fontstrip =  ereg_replace("[^A-Za-z0-9]", " ", $font );
	
		echo "<link href='http://fonts.googleapis.com/css?family=$font' rel='stylesheet' type='text/css' />";
		echo '<style type="text/css">';
		echo "#nav ul li a {font-family: $fontstrip;}";
		echo '</style>';
}
add_action( 'wp_head', 'add_menu_font'); 

/* Custom CSS */

function custom_css() {

	global $themename, $themeslug, $options;
	
	$custom =$options->get($themeslug.'_css_options');
	echo '<style type="text/css">' . "\n";
	echo  $custom  . "\n";
	echo '</style>' . "\n";
}

function custom_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}
		
add_action ( 'wp_head', 'custom_css' );

?>