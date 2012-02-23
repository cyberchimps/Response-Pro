<?php 
/**
* Page template used by the CyberChimps Response Core Framework
*
* Authors: Tyler Cunningham, Trent Lapinski
* Copyright: © 2012
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

/* Header call. */

	get_header(); 
	
/* End header. */	

/* Define global variables. */
	global $options, $post, $themeslug;
	$size = get_post_meta($post->ID, 'page_slider_size' , true);
	$nivosize = get_post_meta($post->ID, 'page_nivoslider_size' , true);
	$page_section_order = get_post_meta($post->ID, 'page_section_order' , true);
	if(!$page_section_order) {
		$page_section_order = 'page_section';
	}
	
/* End define global variables. */

/* Set slider hook based on page option */

if (preg_match("/page_slider/", $page_section_order ) && $size == "1" ) {
	remove_action ('response_page_slider', 'response_slider_content' );
	add_action ('response_page_content_slider', 'response_slider_content' );
}

if (preg_match("/page_nivoslider/", $page_section_order ) && $nivosize == "1" ) {
	remove_action ('response_page_nivoslider', 'response_nivoslider_content' );
	add_action ('response_page_content_slider', 'response_nivoslider_content' );
}

/* End set slider hook*/
?>

<div class="container">
	<div class="row">
		<?php if (function_exists('response_breadcrumbs')) { response_breadcrumbs(); }?>
	</div>
	<div class="row"> 
		<?php
			foreach(explode(",", $page_section_order) as $key) {
				$fn = 'response_' . $key;
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>	
	</div><!--end row-->
</div><!--end container-->
<?php get_footer(); ?>