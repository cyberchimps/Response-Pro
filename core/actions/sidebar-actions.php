<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Sidebar actions used by the CyberChimps Response Core Framework
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

/**
* Response sidebar actions
*/
add_action( 'response_sidebar_init', 'response_sidebar_init_content' );
add_action( 'response_before_content_sidebar', 'response_before_content_sidebar_markup' );
add_action( 'response_after_content_sidebar', 'response_after_content_sidebar_markup' );


/**
* Set sidebar and grid variables.
*
* @since 1.0
*/
function response_sidebar_init_content() {

	global $options, $themeslug, $post, $sidebar, $content_grid;
	
	if (is_single()) {
	$sidebar = $options->get($themeslug.'_single_sidebar');
	}
	elseif (is_archive()) {
	$sidebar = $options->get($themeslug.'_archive_sidebar');
	}
	elseif (is_404()) {
	$sidebar = $options->get($themeslug.'_404_sidebar');
	}
	elseif (is_search()) {
	$sidebar = $options->get($themeslug.'_search_sidebar');
	}
	elseif (is_page()) {
	$sidebar = get_post_meta($post->ID, $themeslug.'_page_sidebar' , true);
	}
	else {
	$sidebar = $options->get($themeslug.'_blog_sidebar');
	}
	
	if ($sidebar == 'two-right' OR $sidebar == 'right-left' OR $sidebar == "2" OR $sidebar == "3") {
		$content_grid = 'span6';
	}
	elseif ($sidebar == 'none' OR $sidebar == "4") {
		$content_grid = 'span12';
	}
	else {
		$content_grid = 'span8';
	}
}

/**
* Before entry sidebar
*
* @since 1.0
*/
function response_before_content_sidebar_markup() { 
	global $options, $themeslug, $post, $sidebar; // call globals ?>
				
	<?php if ($sidebar == 'right-left' OR $sidebar == "2"): ?>
	<div id="sidebar-left" class="span3">
		<?php get_sidebar('left'); ?>
	</div>
	<?php endif; ?>
	
	<?php if ($sidebar == 'left' OR $sidebar == "1"): ?>
	<div id="sidebar_left" class="span3">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;
}

/**
* After entry sidebar
*
* @since 1.0
*/
function response_after_content_sidebar_markup() {
	global $options, $themeslug, $post, $sidebar; // call globals ?>
	
	<?php if ($sidebar == 'right' OR $sidebar == '0' OR $sidebar == '' ): ?>
	<div id="sidebar" class="span4">
		<?php get_sidebar(); ?>
	</div>
	<?php endif;?>
	
	<?php if ($sidebar == 'two-right' OR  $sidebar == '3' ): ?>
	<div id="sidebar-left" class="span3">
		<?php get_sidebar('left'); ?>
	</div>
	<?php endif;?> 
	
	<?php if ($sidebar == 'two-right' OR $sidebar == 'right-left' OR $sidebar == '2' OR $sidebar == '3'): ?>
	<div id="sidebar-right" class="span3">
		<?php get_sidebar('right'); ?>
	</div>
	<?php endif;?> <?php 
}

/**
* End
*/

?>