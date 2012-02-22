<?php
/**
* Footer actions used by the CyberChimps Synapse Core Framework Pro Extension
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

remove_action ( 'synapse_secondary_footer', 'synapse_secondary_footer_credit' );
add_action ( 'synapse_secondary_footer', 'synapse_pro_secondary_footer_credit' );

/**
* Adds the CyberChimps Pro credit link.
*
* @since 1.0
*/
function synapse_pro_secondary_footer_credit() { 
	global $options, $themeslug; //call globals
	
	if ($options->get($themeslug.'_hide_link') == "1") {?>
		
		<div id="credit" class="four columns">
			<a href="http://cyberchimps.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/achimps.png" alt="credit" /></a>
		</div> 
	
	<?php }
}

/**
* End
*/

?>