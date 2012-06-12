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
* @since 2.0
*/

add_action( 'response_product_element', 'response_product_element_content' );

function response_product_element_content(){
	global $options, $themeslug, $root, $post;
	
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
	}
	else {
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
	
	
	
	if ($link_enable == "on" or $link_enable == "1" OR $link_enable == '') {
		$button = "<a href='$link' class='nice medium radius white button'>$link_text</a>";
	}
	else {
		$button = '';
	}
	
	if ($type == "0" OR $type == "key1") {
		$media = "<img src='$image'>";
	}
	else {
		$media ="<div class='flex-video'>$video</div>";
	}
	
	if ($align == "0" or $align == "key1"){
		echo '<style type="text/css">';
		echo "#product_media.span6 {float: right;} ";
		echo '</style>';
	}
	
	if ($align == "0" OR $align =="key1") {
		$output =   "
					<div id='product_text' class='span6'>
						<div class='product_text_title'>$title</div> <br /> <span class='product_text_text'>$text </span><br /><br />
							$button
					</div>
					<div id='product_media' class='span6'>
						$media
					</div>
				    "; 
	}
	if ($align == "1" OR $align =="key2"){
		$output =   "
					<div id='product_media' class='span6'>
						$media
					</div>
					<div id='product_text' class='span6'>
						<span class='product_text_title'>$title</span> <br /> <span class='product_text_text'>$text </span><br /><br />
							$button

					</div>
				    "; 
	}
?>

<div id="productbg">
	<div class="container-fluid">
		<div id="product" class="row-fluid">
			<?php echo $output; ?>
		</div>
	</div>
</div>

<?php
}

/**
* End
*/

?>