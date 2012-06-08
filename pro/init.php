<?php
/**
* Initializes the CyberChimps Response Core Framework Pro Extension
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

require_once ( get_template_directory() . '/pro/hooks.php' );
require_once ( get_template_directory() . '/pro/functions.php' );
require_once ( get_template_directory() . '/pro/library/wp-resize.php' );

// Load element files
require_once ( get_template_directory() . '/pro/elements/slider.php' );
require_once ( get_template_directory() . '/pro/elements/portfolio.php' );

?>