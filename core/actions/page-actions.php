<?php

add_action('chimps_page_section', 'chimps_page_section_content' );


function chimps_page_section_content() { 
	global $options, $themeslug, $post;
	
	
	$enable = get_post_meta($post->ID, 'page_enable_slider' , true);
	$size = get_post_meta($post->ID, 'page_slider_size' , true);
	$hidetitle = get_post_meta($post->ID, 'hide_page_title' , true);
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);
	$callout = get_post_meta($post->ID, 'enable_callout_section' , true);
	$twitterbar = get_post_meta($post->ID, 'enable_twitter_bar' , true);
	$enableboxes = get_post_meta($post->ID, 'enable_box_section' , true);
	$pagecontent = get_post_meta($post->ID, 'hide_page_content' , true);
	$test = get_post_meta($post->ID, 'page_section_order' , true);
	
	if ($sidebar == "1" OR $sidebar == "2" ) {
		$content_grid = 'sixcol';
	}
	
	elseif ($sidebar == "3") {
		$content_grid = 'twelvecol';
	}
	
	else {
		$content_grid = 'eightcol';
	}



?>

	<?php if ($sidebar == "2"): ?>
		<div id="sidebar" class="threecol">
			<?php get_sidebar('left'); ?>
		</div>
	<?php endif;?>
	
	
<?php if (function_exists('chimps_breadcrumbs')) chimps_breadcrumbs(); ?>
		
		<div id="content" class="eightcol">
		
		<?php chimps_page_content_slider(); ?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="page_container">
			
				<div class="post" id="post-<?php the_ID(); ?>">
				<?php if ($hidetitle == ""): ?>
				

					<h2 class="page-titles"><?php the_title(); ?></h2>
						<?php endif;?>

					<div class="entry">

						<?php the_content(); ?>
						
					</div><!--end entry-->
					
					<div style=clear:both;></div>
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>


				<?php edit_post_link('Edit', '<p>', '</p>'); ?>

				</div><!--end post-->
		
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
			</div><!--end post_container-->
				
		
		
	</div><!--end content_left-->
	
	<?php if ($sidebar == "0" OR $sidebar == ""): ?>
		<div id="sidebar" class="fourcol last">
			<?php get_sidebar(); ?>
		</div>
	<?php endif;?>
	
	<?php if ($sidebar == "1"): ?>
		<div id="sidebar" class="threecol last">
			<?php get_sidebar('left'); ?>
		</div>
	<?php endif;?>
	
	<?php if ($sidebar == "1" OR $sidebar == "2"): ?>
		<div id="sidebar" class="threecol last">
			<?php get_sidebar('right'); ?>
		</div>
	<?php endif;?>

<?php
}


?>