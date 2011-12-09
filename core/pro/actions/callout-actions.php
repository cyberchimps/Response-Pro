<?php
/**
* ___ actions used by the CyberChimps Core Framework 
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
* @package Core
* @since 1.0
*/

/**
* Pro callout actions
*/
add_action ( 'chimps_callout_section', 'chimps_callout_section_content' );

/**
* Retrieves the Callout Section options and sets up the HTML
*
* @since 1.0
*/
function chimps_callout_section_content() {

	global $options, $themeslug, $post; //call globals

/* Define variables. */	

	$root = get_template_directory_uri();  
	$callout = get_post_meta($post->ID, 'enable_callout_section' , true);
	$calloutbgcolor = get_post_meta($post->ID, 'callout_background_color' , true);
	$bcolor = get_post_meta($post->ID, 'custom_callout_button_color' , true);
	$tcolor = get_post_meta($post->ID, 'custom_callout_text_color' , true);
	$ticolor = get_post_meta($post->ID, 'custom_callout_title_color' , true);
	$title = get_post_meta($post->ID, 'callout_title' , true);
	$text = get_post_meta($post->ID, 'callout_text' , true);
	$btext = get_post_meta($post->ID, 'callout_button_text' , true);
	$link = get_post_meta($post->ID, 'callout_url' , true);
	$image = get_post_meta($post->ID, 'callout_image' , true);
	$hidebutton = get_post_meta($post->ID, 'disable_callout_button' , true);
	$customcalloutbgcolor = get_post_meta($post->ID, 'custom_callout_color' , true);
	
	if ($hidebutton != "on") {
		$grid = 'grid_9';
	}
	
	else {
		$grid = 'grid_12';
	}
	

/* End variable definition. */	

/* Echo custom button color. */

	if ($bcolor != "") {
	
		echo '<style type="text/css" media="screen">';
		echo ".calloutbutton {background: $bcolor ;}";
		echo '</style>';
	
	}
	

/* End custom button color. */

/* Echo custom text color. */

	if ($tcolor != "") {
	
		echo '<style type="text/css" media="screen">';
		echo ".callout_text {color: $tcolor ;}";
		echo '</style>';
	
	}
	
/* Echo custom title color. */

	if ($ticolor != "") {
	
		echo '<style type="text/css" media="screen">';
		echo ".callout_title {color: $ticolor ;}";
		echo '</style>';
	
	}
	

/* End custom text color. */

/* Echo background color CSS. */	

	if ($customcalloutbgcolor != ''){
	
		echo '<style type="text/css" media="screen">';
		echo "#calloutwrap {background: $customcalloutbgcolor ;}";
		echo '</style>';
	
	}
		
/* End CSS. */	

/* Define Callout title. */	

	if ($title == '') {
		$callouttitle = 'This is the Callout Section';
	}

	else {
		$callouttitle = $title;
	}
	
/* End define Callout title. */	

/* Define Callout text. */	

	if ($text == '') {
		$callouttext = 'iFeature Pro 3 gives you the tools to turn WordPress into a modern feature rich Content Management System (CMS)';
	}

	else {
		$callouttext = $text;
	}
	
/* End define Callout title. */	

/* Define Callout button text. */

	if ($btext == '') {
		$calloutbuttontext = 'Buy Now';
	}

	else {
		$calloutbuttontext = $btext;
	}

/* End define Callout button text. */	

/* Define Callout button image. */

	if ($image != '') {
		$calloutimage = $image;
	}

/* End define Callout button image. */

/* Define Callout button link. */

	if ($link == '') {
		$calloutlink = 'http://cyberchimps.com';
	}

	else {
		$calloutlink = $link;
	}

/* End define Callout button link. */	

?>

<div id="calloutwrap"><!--id="calloutwrap"-->

	<div id="callout_text" class="<?php echo $grid; ?>">
		<h2 class="callout_title"><?php echo $callouttitle ?></h2>
		<p><?php echo $callouttext  ?></p>
	</div>
		
<?php if ($image == '' && $hidebutton != 'on'): ?>
	<div id="calloutbutton" class="grid_2">
		<a href="<?php echo $calloutlink ?>"><?php echo $calloutbuttontext ;?></a>
	</div>
<?php endif;?>

<?php if ($image != ''): ?>
	<div id="calloutimg" class="grid_2">
		<a href="<?php echo $calloutlink ?>"><img src="<?php echo $image?>" alt="Callout" /></a>
	</div>
<?php endif;?>

</div><!--end calloutwrap--><?php

}



add_shortcode ('callout', 'chimps_callout_section_content' );

/**
* End
*/

?>