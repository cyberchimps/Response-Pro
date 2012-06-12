<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Product element actions used by Response Pro
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
* @package Response Pro
* @since 1.0
*/

add_action( 'response_product_element', 'response_product_element_content' );

function response_product_element_content(){
	global $options, $themeslug, $post;
	
	if (is_page()) {
		$title = get_post_meta($post->ID, $themeslug.'_product_title' , true);
		$text  = get_post_meta($post->ID, $themeslug.'_product_text' , true);
		$type  = get_post_meta($post->ID, $themeslug.'_product_type' , true);
		$image = get_post_meta($post->ID, $themeslug.'_product_image' , true);
		$video = get_post_meta($post->ID, $themeslug.'_product_video' , true);	
		$align = get_post_meta($post->ID, $themeslug.'_product_text_align' , true);
		$link_enable  = get_post_meta($post->ID, $themeslug.'_product_link_toggle' , true);
		$link  = get_post_meta($post->ID, $themeslug.'_product_link_url' , true);
		$link_text  = get_post_meta($post->ID, $themeslug.'_product_link_text' , true);
		
	} else {
		$text  = $options->get($themeslug.'_blog_product_text');
		$title = $options->get($themeslug.'_blog_product_title');
		$type = $options->get($themeslug.'_blog_product_type');
		$imgsource = $options->get($themeslug.'_blog_product_image');
		$image = $imgsource['url'];
		$video = $options->get($themeslug.'_blog_product_video');
		$align = $options->get($themeslug.'_blog_product_text_align');
		$link_enable = $options->get($themeslug.'_blog_proudct_link_toggle');
		$link = $options->get($themeslug.'_blog_product_link_url');
		$link_text = $options->get($themeslug.'_blog_product_link_text');
	}
	
	if ($link_enable == "on" || $link_enable == "1" || $link_enable == '') {
		$button = "<a href='$link' class='nice medium radius white button'>$link_text</a>";
	} else {
		$button = '';
	}
	
	if ($type == "0" || $type == "key1") {
		$media = "<img src='$image'>";
	} else {
		$media ="<div class='flex-video'>$video</div>";
	}
	
	if ($align == "0" || $align == "key1"){
		echo '<style type="text/css">';
		echo "#product_media.six.columns img {float: right;} ";
		echo '</style>';
	}
	
	if ($align == "0" || $align =="key1") {
		$output = "
					<div id='product_text' class='six columns'>
						<div class='product_text_title'>$title</div> <br /> <span class='product_text_text'>$text </span><br /><br />
							$button
					</div>
					<div id='product_media' class='six columns'>
						$media
					</div>
				    "; 
	}
	if ($align == "1" || $align =="key2"){
		$output =   "
					<div id='product_media' class='six columns'>
						$media
					</div>
					<div id='product_text' class='six columns'>
						<span class='product_text_title'>$title</span> <br /> <span class='product_text_text'>$text </span><br /><br />
							$button
					</div>
				    "; 
	}
?>

<div id="productbg">
	<div class="container">
		<div id="product" class="row">
			<?php echo $output; ?>
		</div>
	</div>
</div>

<?php } ?>