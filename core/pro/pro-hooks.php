<?php
/**
* Initializes the CyberChimps Core Framework Pro Extension 
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
* Box Section
*/
function chimps_box_section() {
	do_action ('chimps_box_section');
}

/** 
* Callout Section
*/
function chimps_callout_section() {
	do_action ('chimps_callout_section');
}

/** 
* Carousel Section
*/
function chimps_index_carousel_section() {
	do_action ('chimps_index_carousel_section');
}

function chimps_carousel_section() {
	do_action ('chimps_carousel_section');
}

/** 
* Slider
*/
function chimps_blog_slider() {
	do_action ('chimps_blog_slider');
}
function chimps_page_slider() {
	do_action ('chimps_page_slider');
}
function chimps_page_content_slider() {
	do_action ('chimps_page_content_slider');
}

/** 
* Twitterbar Section
*/
function chimps_twitterbar_section() {
	do_action ('chimps_twitterbar_section');
}

/**
* End
*/
		    
?>