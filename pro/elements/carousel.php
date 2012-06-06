<?php
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
	$default = get_template_directory_uri() . '/images/pro/carousel.jpg';
	
	if (is_page()) {
		$customcategory = get_post_meta($post->ID, $themeslug.'_carousel_category' , true);
		$speed = get_post_meta($post->ID, $themeslug.'_carousel_speed' , true);
	} else {
		$customcategory = $options->get($themeslug.'_carousel_category');
		$speed = $options->get($themeslug.'_carousel_speed');
	}
	/* End define variables. */	 
?>

<div class="row-fluid">
	<div id="carousel" class="es-carousel-wrapper">
		<div class="es-carousel">
			<?php
			$args = array ('post_type' => $themeslug.'_featured_posts', 'showposts' => 50, true, 'carousel_categories' => $customcategory )
			$carousel_posts = get_posts( $args );
			
			if ( $carousel_posts ) : ?>
				<ul>
					<?php foreach($carousel_posts as $post) : setup_postdata($post);
						/* Post-specific variables */
				    	$title = (get_the_title() != "Untitled") ? get_the_title() : '';
						$image = (get_post_meta($post->ID, 'post_image' , true)) ? get_post_meta($post->ID, 'post_image' , true) : $default;
						$link = get_post_meta($post->ID, 'post_url' , true);
						?>
						<li>
							<a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/></a>
							<div class="carousel_caption"><?php echo $title; ?></div>
						</li>
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
						imageW 		: 145,
						speed 		: <?php echo $speed; ?>,
						margin		: 9,
						minItems 	: 5
					});
				});
			</script>
		</div>
	</div>
</div>
<?php } ?>