<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Recent Posts Element used by the CyberChimps Response Core Framework
*
* Authors: Benjamin Mueller, Tyler Cunningham
* Copyright: � 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 2.0
*/

add_action( 'response_recent_posts_element', 'response_recent_posts_element_content' );

function response_recent_posts_element_content() {
	global $options, $themeslug, $wp_query, $custom_excerpt, $post;
	$custom_excerpt = 'recent';
	
	if (is_page()){
		$title = get_post_meta($post->ID, $themeslug.'_recent_posts_title' , true);;
		$toggle = get_post_meta($post->ID, $themeslug.'_recent_posts_title_toggle' , true);;
		$recent_posts_image = get_post_meta($post->ID, $themeslug.'_recent_posts_images_toggle' , true);;
		$category = get_post_meta($post->ID, $themeslug.'_recent_posts_category' , true);

	} else {
		$title = $options->get($themeslug.'_recent_posts_title');
		$toggle = $options->get($themeslug.'_recent_posts_title_toggle');
		$recent_posts_image = $options->get($themeslug.'_recent_posts_images_toggle');
		$category = $options->get($themeslug.'_recent_posts_category'); 
	}
	
	if ($category != 'all') {
		$blogcategory = $category;
	}
	else {
		$blogcategory = "";
	}
	
	$args = array( 'numberposts' => 4, 'post__not_in' => get_option( 'sticky_posts' ), 'category_name' => $blogcategory );
	$recent_posts = get_posts( $args );
	
?>
<div class="container">
<div id="recent_posts" class="row-fluid">
	<?php if ($toggle == '1' OR $toggle == 'on'): ?>
		<h4 class="recent_posts_element_title"><?php echo $title; ?></h4>
	<?php endif; ?>
	<div id="recent_posts_wrap">
	
	<?php if ( $recent_posts ) :
		foreach($recent_posts as $post) : setup_postdata($post); ?>
			<div id="recent-posts-container" class="three columns">
			
				<h5 class="recent_posts_post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
				<h6 class="recent_posts_byline"><?php the_time( 'd/m/y');?> - <?php the_category(', ') ?> - <?php comments_popup_link( __('No Comments', 'response' ), __('1 Comment', 'response' ), __('% Comments' , 'response' )); //need a filer here ?></h6>
				<?php
					if ( has_post_thumbnail() && $recent_posts_image == '1' OR has_post_thumbnail() && $recent_posts_image == 'on' ) {
	 		 			echo '<div class="recent-posts-image">';
	 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
	 		 			the_post_thumbnail();
	  					echo '</a>';
	  					echo '</div>';
					}
				?>
				
				<?php the_excerpt(); ?>	
			</div>
		<?php endforeach; wp_reset_postdata(); ?>
		
	<?php else : ?>
		
		<h2>Not Found</h2>
		
	<?php endif; ?>
	
	</div>
</div>
</div>
<?php } ?>