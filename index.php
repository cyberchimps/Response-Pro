<?php

 /*
	Index
	
	Creates the iFeature default index page.
	
	Copyright (C) 2011 CyberChimps
*/

	global $options, $themeslug, $post; // call globals
	
	$blogsidebar = $options->get($themeslug.'_blog_sidebar');
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);
	
	if ($sidebar == "1" OR $sidebar == "2" OR $blogsidebar == 'two-right' OR $blogsidebar == 'right-left' ) {
		$content_grid = 'grid_6';
	}
	
	elseif ($sidebar == "3" OR $blogsidebar == 'none' ) {
		$content_grid = 'grid_12';
	}
	
	else {
		$content_grid = 'grid_8';
	}

?>

<?php get_header(); ?>

<div class="container_12">


		<?php chimps_index_carousel_section() ?>	


	<!--Begin @Core index entry hook-->
		<?php chimps_index_before_entry(); ?>
	<!--End @Core index entry hook-->

		<div id="content" class="<?php echo $content_grid; ?>">
		
		<!--Begin @Core index entry hook-->
	<?php chimps_index_entry(); ?>
	<!--End @Core index entry hook-->


			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post_container">
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
				<!--Begin @Core index loop hook-->
					<?php chimps_index_loop(); ?>
				<!--End @Core index loop hook-->	
			
				<!--Begin @Core link pages hook-->
					<?php chimps_link_pages(); ?>
				<!--End @Core link pages hook-->
			
				<!--Begin @Core post edit link hook-->
					<?php chimps_edit_link(); ?>
				<!--End @Core post edit link hook-->
			
				<!--Begin @Core FB like hook-->
					<?php chimps_fb_like_plus_one(); ?>
				<!--End @Core FB like hook-->
			
				<!--Begin @Core post tags hook-->
					<?php chimps_post_tags(); ?>
				<!--End @Core post tags hook-->
			
				<!--Begin @Core post bar hook-->
					<?php chimps_post_bar(); ?>
				<!--End @Core post bar hook-->
			
				</div><!--end post_class-->	
		</div><!--end post container--> 
	
			<?php endwhile; ?>
		
			<?php else : ?>

				<h2>Not Found</h2>

			<?php endif; ?>
			
				<!--Begin @Core pagination hook-->
			<?php chimps_pagination(); ?>
			<!--End @Core pagination loop hook-->
		
		</div><!--end content-->

	<!--Begin @Core index after entry hook-->
	<?php chimps_index_after_entry(); ?>
	<!--End @Core index after entry hook-->

	

</div><!--end container_12-->

<div class='clear'>&nbsp;</div>

<?php get_footer(); ?>