<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

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
* @since 1.0.5
*/
	global $options, $themeslug; // call globals	
?>

<?php get_header(); ?>

		<?php
			foreach(explode(",", $options->get($themeslug.'_blog_section_order')) as $fn) {
				if(function_exists($fn)) {
					call_user_func_array($fn, array());
				}
			}
		?>
		
</div> <!-- End of row -->
</div> <!-- End of container -->

<?php get_footer(); ?>