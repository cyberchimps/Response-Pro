<?php
/**
* Index template used by the CyberChimps Response Core Framework
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

	global $options, $themeslug, $post; // call globals
	
	$reorder = $options->get($themeslug.'_blog_section_order');
	$slidersize = $options->get($themeslug.'_slider_size');
	$nivoslidersize = $options->get($themeslug.'_nivo_slider_size');
			
/* Set slider hook based on page option */

	if (preg_match("/response_blog_slider/", $reorder ) && $slidersize != "key2" ) {
		remove_action ( 'response_blog_slider', 'response_slider_content' );
		add_action ( 'response_blog_content_slider', 'response_slider_content');
	}
	
	if (preg_match("/response_blog_nivoslider/", $reorder ) && $nivoslidersize == "key1" ) {
		remove_action ( 'response_blog_nivoslider', 'response_nivoslider_content' );
		add_action ( 'response_blog_content_slider', 'response_nivoslider_content');
	}
	
/* End set slider hook*/

?>

<?php get_header(); ?>

<div class="container">
		<?php
			foreach(explode(",", $options->get($themeslug.'_blog_section_order')) as $fn) {
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>
</div><!--end container-->
<?php get_footer(); ?>