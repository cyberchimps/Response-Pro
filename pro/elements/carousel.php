<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Carousel section actions used by the CyberChimps Response Core Framework Pro Extension
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
* @package Pro
* @since 1.0
*/

add_action( 'response_carousel_element', 'response_carousel_element_content' );

function response_carousel_element_content() {
	global $themeslug, $post, $options;
	
	/* Define variables. */
	$default = get_template_directory_uri() . '/library/images/pro/carousel.jpg';
	
	if (is_page()) {
		$customcategory = get_post_meta($post->ID, $themeslug.'_carousel_category' , true);
		$speed = get_post_meta($post->ID, $themeslug.'_carousel_speed' , true);
		$autoplay = get_post_meta($post->ID, $themeslug.'_carousel_autoplay' , true);
		$autoplay_speed = get_post_meta($post->ID, $themeslug.'_carousel_autoplay_speed' , true);
		
	} else {
		$customcategory = $options->get($themeslug.'_carousel_category');
		$speed = $options->get($themeslug.'_carousel_speed');
		$autoplay = $options->get($themeslug.'_carousel_autoplay');
		$autoplay_speed = $options->get($themeslug.'_carousel_autoplay_speed');
	}
	
	if ($autoplay == 1) {
		$play = 'true';
	}
	else {
		$play = 'false';
	}
	/* End define variables. */	 
?>

<div class="row-fluid">
	<div id="carousel" class="es-carousel-wrapper">
		<div class="es-carousel">
			<?php
			$args = array ('post_type' => $themeslug.'_carousel_images', 'showposts' => 50, true, 'carousel_categories' => $customcategory );
			$carousel_posts = get_posts( $args );
			
			if ( $carousel_posts ) : ?>
				<ul>
					<?php foreach($carousel_posts as $post) : setup_postdata($post);
						/* Post-specific variables */
				    	$title = (get_the_title() != "Untitled") ? get_the_title() : '';
						$image = (get_post_meta($post->ID, $themeslug.'_carousel_image' , true)) ? get_post_meta($post->ID, $themeslug.'_carousel_image' , true) : $default;
						$link = get_post_meta($post->ID, $themeslug.'_carousel_url' , true);
						$lightbox = get_post_meta($post->ID, $themeslug.'_carousel_image_lightbox' , true);
						?>
						<?php if ($lightbox == '1' OR $lightbox == ''): ?>
						<li>
							<a href="<?php echo $image; ?>" rel="lightbox-carousel" title="<?php echo $title; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/></a>
							<div class="carousel_caption"><?php echo $title; ?></div>
						</li>
						<?php endif; ?>
						<?php if ($lightbox == '0'): ?>
						<li>
							<a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/></a>
							<div class="carousel_caption"><?php echo $title; ?></div>
						</li>
						<?php endif; ?>
					<?php endforeach; wp_reset_postdata(); ?>
				</ul>
			<?php else : ?>
				<ul>
					<?php	
						$i = 1;
						while ($i<9) : 
					?>	
						<li>
							<a href='#' class='image-container'><img src='<?php echo $default; ?>' alt='Post <?php echo $i; ?>'/></a>
							<div class='carousel_caption'>Title <?php echo $i; ?></div>
						</li><?php
					$i++;
					endwhile;?>
    			</ul>
			<?php endif; ?>
			
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
					$('#carousel').elastislide({
						autoplay	: <?php echo $play; ?>,
						imageW 		: 145,
						speed 		: <?php echo $speed; ?>,
						autoplay_speed : <?php echo $autoplay_speed; ?>,
						margin		: 9,
						minItems 	: 5
					});
				});
			</script>
		</div>
	</div>
</div>
<?php } ?>