<?php
/**
* Box section actions used by the CyberChimps Synapse Core Framework Pro Extension
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
* @package Pro
* @since 1.0
*/

/**
* Synapse Box Section actions
*/
add_action( 'synapse_box_section', 'synapse_box_section_content' );

/**
* Sets up the Box Section wigetized area
*
* @since 1.0
*/
function synapse_box_section_content() { 
	global $post; //call globals
	
	$enableboxes = get_post_meta($post->ID, 'enable_box_section' , true);
	$root = get_template_directory_uri(); ?>
	
<div class="row">
	<div id="box_container" class="twelve columns"> <!--box container-->
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Left") ) : ?>
			<div class="box1">
				<h2 class="box-widget-title">Box Left</h2>
				<p>This is the box left widgetized area.</p>
			</div><!--end box1-->
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Middle") ) : ?>
			<div class="box2">
				<h2 class="box-widget-title">Box Middle</h2>
					<p>This is the box middle widgetized area.</p>
			</div><!--end box2-->
			<?php endif; ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Box Right") ) : ?>
			<div class="box3">
				<h2 class="box-widget-title">Box Right</h2>
				<p>This is the box right widgetized area.</p>
			</div><!--end box3-->
		<?php endif; ?>
</div>
	</div><!--end box_container--> <?php
	}


/**
* End
*/

?>