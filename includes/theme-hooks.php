<?php
/**
* Custom hooks used by the response Pro WordPress Theme
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
* @package response Pro
* @since 3.0
*/


/**
* Hook for header content area
*
* @since 3.0
*/
function response_header_content() {
	do_action('response_header_content');
}


function response_sitename_contact() {
	do_action('response_sitename_contact');
}

function response_description_icons() {
	do_action('response_description_icons');
}

function response_logo_menu() {
	do_action('response_logo_menu');
}

function response_logo_description() {
	do_action('response_logo_description');
}

function response_banner() {
	do_action('response_banner');
}

function response_icons() {
	do_action('response_icons');
}

