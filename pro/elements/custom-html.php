<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Custom HTML element actions used by the CyberChimps Response Core Framework Pro Extension
*
* Author: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Pro
* @since 1.0
*/

/**
* Response Box Section actions
*/
add_action( 'response_custom_html_element', 'response_custom_html_element_content' );

function response_custom_html_element_content() {
	global $options, $themeslug, $post;
	
	if (is_page()) {
		$custom = stripslashes(get_post_meta($post->ID, $themeslug.'_custom_html', true));
	} else {
		$custom = stripslashes($options->get($themeslug.'_blog_custom_html'));
	}
	?>
		
	<div class="container">
		<div class="row-fluid">
			<div class="span 12">
				<?php echo $custom; ?>
			</div>
		</div>
	</div>
<?php } ?>