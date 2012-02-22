<?php
/**
* Initializes the CyberChimps Synapse Core Framework Pro Extension 
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
function synapse_box_section() {
	do_action ('synapse_box_section');
}

/** 
* Callout Section
*/
function synapse_callout_section() {
	do_action ('synapse_callout_section');
}

/** 
* Carousel Section
*/
function synapse_index_carousel_section() {
	do_action ('synapse_index_carousel_section');
}

function synapse_carousel_section() {
	do_action ('synapse_carousel_section');
}

/** 
* Entry 
*/
function synapse_pro_before_entry() {
	do_action('synapse_pro_before_entry');
}

function synapse_pro_entry() {
	do_action('synapse_pro_entry');
}

/** 
* Slider
*/
function synapse_blog_slider() {
	do_action ('synapse_blog_slider');
}
function synapse_blog_content_slider() {
	do_action ('synapse_blog_content_slider');
}
function synapse_page_slider() {
	do_action ('synapse_page_slider');
}
function synapse_page_content_slider() {
	do_action ('synapse_page_content_slider');
}

function synapse_blog_nivoslider() {
	do_action ('synapse_blog_nivoslider');
}

function synapse_page_nivoslider() {
	do_action ('synapse_page_nivoslider');
}


/**
* End
*/
		    
?>