<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

global $options, $themeslug, $post; //call globals
	
	if (is_single()) {
		 $post_formats = $options->get($themeslug.'_single_post_formats');
		 $featured_images = $options->get($themeslug.'_single_show_featured_images');
		 $excerpts = $options->get($themeslug.'_single_show_excerpts');
	}
	elseif (is_archive()) {
		 $post_formats = $options->get($themeslug.'_archive_post_formats');
		 $featured_images = $options->get($themeslug.'_archive_show_featured_images');
		 $excerpts = $options->get($themeslug.'_archive_show_excerpts');
	}
	else {
		 $post_formats = $options->get($themeslug.'_post_formats');
		 $featured_images = $options->get($themeslug.'_show_featured_images');
		 $excerpts = $options->get($themeslug.'_show_excerpts');
	}
	
	if (get_post_format() == '') {
		$format = "default";
	}
	else {
		$format = get_post_format();
	} ?>
		
		<?php ob_start(); ?>
			
			<?php if ($post_formats != '0') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format ;?>.png" alt="formats" />
			</div><!--end format-icon-->
			<?php endif; ?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--begin response_post_byline hook-->
						<?php response_post_byline(); ?>
					<!--end response_post_byline hook-->
				<?php
				if ( has_post_thumbnail() && $featured_images == '1') {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $featured_images == '1' && !is_single()  ) { echo 'style="min-height: 115px;" '; }?>>
					<?php 
						if ($excerpts == '1' && !is_single() ) {
						the_excerpt();
						}
						else {
							the_content(__('Read more...', 'response'));
						}
					 ?>
				</div><!--end entry-->
		<?php	
		
		$content = ob_get_clean();
		$content = apply_filters( 'response_post_formats_'.$format.'_content', $content );
	
		echo $content; 

?>