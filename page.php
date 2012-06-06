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
* @since 1.0.5
*/
	global $options, $post, $themeslug;
	$page_section_order = get_post_meta($post->ID, $themeslug.'_page_section_order' , true);
	
	if(!$page_section_order) {
		$page_section_order = 'page_section,breadcrumbs';
	}
	
	get_header(); 
?>
<div id="main_wrap">
<div class="container-fluid">
	<div class="row-fluid"> 
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
</div>
<?php get_footer(); ?>