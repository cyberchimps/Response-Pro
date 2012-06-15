<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Footer actions used by the CyberChimps Response Core Framework
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
* @package Response
* @since 1.0
*/

/**
* Response footer actions
*/
add_action ( 'response_footer_element', 'response_footer_element_content' );

add_action ( 'response_afterfooter_element', 'response_afterfooter_element_content' );



/**
* Set the footer widgetized area.
*
* @since 1.0
*/
function response_footer_element_content() { 
?>
</div><!--end container wrap-->

<div class="footer">
	<div id="main_wrap">
   		<div id="footer" class="container-fluid">
     		<div id="footer_container" class="row-fluid">
    			<div id="footer_wrap" class="span12">	
	    			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) { ?>
	    			<div class="row-fluid">
		    			<div class="span3 footer-widgets">
			    			<h3 class="footer-widget-title"><?php printf( __( 'Footer Widgets', 'response' )); ?></h3>
			    			<ul>
				    			<li>To customize this widget area login to your admin account, go to Appearance, then Widgets and drag new widgets into Footer Widgets</li>
				    		</ul>
				    	</div>

				    	<div class="span3 footer-widgets">
					    	<h3 class="footer-widget-title"><?php printf( __( 'Recent Posts', 'response' )); ?></h3>
					    	<ul>
						    	<?php wp_get_archives('type=postbypost&limit=4'); ?>
						    </ul>
						</div>
		
						<div class="span3 footer-widgets">
							<h3 class="footer-widget-title"><?php printf( __( 'Archives', 'response' )); ?></h3>
							<ul>
								<?php wp_get_archives('type=monthly&limit=16'); ?>
							</ul>
						</div>

						<div class="span3 footer-widgets">
							<h3 class="footer-widget-title"><?php printf( __( 'WordPress', 'response' )); ?></h3>
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<li><a href="<?php echo esc_url( __('http://wordpress.org/', 'response' )); ?>" target="_blank" title="<?php esc_attr_e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'response'); ?>"> <?php printf( __('WordPress', 'response' )); ?></a></li>
								<?php wp_meta(); ?>
							</ul>
						</div>
					</div><!--end row-fluid-->
			</div>
		</div><!--end footer_wrap-->
	</div><!--end footer-->
</div> 
<?php 
					}
?>
	<div class='clear'></div> 
<?php
}

/**
* Adds the afterfooter copyright area. 
*
* @since 1.0
*/
function response_afterfooter_content_element() {
	global $options, $themeslug; //call globals
		
	if ($options->get($themeslug.'_footer_text') == "") {
		$copyright =  get_bloginfo('name');
	}
	else {
		$copyright = $options->get($themeslug.'_footer_text');
	}
?>
<div id="afterfooter" class="container-fluid">
	<div class="row-fluid" id="afterfooterwrap">		
	
		<div id='afterfootercopyright' class='span6'>
			<?php echo "&copy; $copyright"; ?>
			</div>
	
		<div id="credit" class="span6">
			<a href="http://cyberchimps.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/achimps.png" alt="credit" /></a>
		</div> 
	
	</div>
</div>	
<?php 
}

/**
* End
*/

?>