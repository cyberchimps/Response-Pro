<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Magazine Element used by the CyberChimps Response Core Framework Pro Extension
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
* @since 2.0
*/

add_action( 'response_magazine_element', 'response_magazine_element_content' );


function response_magazine_element_content() {
global $options, $themeslug, $post, $sidebar, $content_grid; // call globals	

 $featured_images = $options->get($themeslug.'_show_featured_images');
get_header();  //Display Header

$box_no = 3;
?>
	
		<!-- Script for featured post slider-->
		<script type="text/javascript">   
			function mycarousel_initCallback(carousel)
			{
				// Disable autoscrolling if the user clicks the prev or next button.
				carousel.buttonNext.bind('click', function() {
					carousel.startAuto(0);
				});

				carousel.buttonPrev.bind('click', function() {
					carousel.startAuto(0);
				});

				// Pause autoscrolling if the user moves with the cursor over the clip.
				carousel.clip.hover(function() {
					carousel.stopAuto();
				}, function() {
					carousel.startAuto();
				});
			};

			/*	Initiating jcarousel while page is ready	*/
			jQuery(document).ready(function() {
				jQuery('#mycarousel').jcarousel({
					vertical: true,
					auto: 2,
					wrap: 'last',
					initCallback: mycarousel_initCallback
				});
			});
		</script>

		<!-- Start of first row (Headline post and featured post scroller)-->
		<div class="row-fluid homefeature">
		
			<!-- Start of Headline post-->
			<div class="span8 headline_post" id="content-row">
				<div id="headline">        
					<?php
                    /* To keep the post ids for those are already displayed */
                    $exclude_posts = array();
                    
					$the_query = new WP_Query(array('showposts' => 1, 'orderby' => 'post_date', 'order' => 'desc', 'post__not_in' => get_option( 'sticky_posts' ) )); 					
					if ($the_query -> have_posts()) : while ($the_query -> have_posts()) : $the_query -> the_post();
                    $exclude_posts[] = get_the_ID();
					?>
						<!-- Headline Section -->
						
							<h2 class="headline-label"><a href="<?php the_permalink() ?>">Headline &raquo</a></h2>
						
						<div class="clearfloat">
							<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink() ?>" class="headline-link headline-left">
								<?php the_post_thumbnail('headline-thumb',array('class'	=> 'headline-thumb')); ?>
							</a>
							<?php } ?>
							<div>
								<h1 class="title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
							</div>
							<div class="meta">
								<span><?php echo get_the_time('F j, Y - g:i a '); ?></span> | 
								<span><?php comments_popup_link('No Comment', '1 Comment', '% Comments');?> &nbsp;|&nbsp;<?php echo getPostViews(get_the_ID()); ?></span>
							</div><!--/.meta-->
							<?php 
							add_filter('excerpt_more', 'response_excerpt_more'); 
							the_excerpt();
							remove_filter('excerpt_more', 'response_excerpt_more'); 
							?>
						</div><!--/.clearfloat-->
						<?php 
						endwhile;
					endif 
					?>
				</div>
			</div> <!-- End of Headline post-->

			<!-- Start of Featured post scroller-->
			<div class="span4 newsscroll">
				<div id="featured">
					<ul id="mycarousel" class="jcarousel jcarousel-skin-response">
						<?php 
						$featured_query = new WP_Query('category_name=featured-post &orderby=post_date&order=desc');  
						if ($featured_query -> have_posts()) : 
							while ($featured_query -> have_posts()) : $featured_query -> the_post();
                            $exclude_posts[] = get_the_ID();
						?>
						<li>
							<div class="clearfloat featured">
								<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink() ?>" class="featured-link featured-left">
									<?php the_post_thumbnail('featured-thumb',array('class'	=> 'featured-thumb')); ?>
								</a>
								<?php } ?>                        
								<h5 class="featured-info">
									<a class="featured-post-title" rel="bookmark" href="<?php the_permalink() ?>">
										<?php the_title(); ?>
									</a>
								</h5>
								<div class="featured-meta">
									<span class="date-n-time"><?php echo get_the_time('F j, Y - g:i a '); ?></span>
									<span class="comments-n-views"><?php comments_popup_link('No Comment', '1 Comment', '% Comments');?> | <?php echo getPostViews(get_the_ID()); ?></span>
								</div>
							</div> 
						</li>
						<?php endwhile;
						endif ?>
					</ul>
				</div>
			</div>   <!-- End of Headline post-->
		</div>	<!-- End of first row (Headline post and featured post scroller)-->

		<!--Begin response_sidebar_init-->
			<?php response_sidebar_init(); ?>
		<!--End response_sidebar_init-->
		
		<div class="row-fluid">
			<!--Begin response_before_content_sidebar hook-->
				<?php response_before_content_sidebar(); ?>
			<!--End response_before_content_sidebar hook-->
			
			<?php
			global $wp_query;
                    $page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $wp_query = new WP_Query(
                                        array(
                                            'paged'         => $page_number,
                                            'post_type'     => 'post',
                                            'orderby'       => 'post_date',
                                            'order'         => 'desc',
                                            'posts_per_page'=> 9,
                                            'post__not_in'  => $exclude_posts
                                        )
                                    );
			?>
			
			<div id="content" class="<?php if($box_no == 2) echo $content_grid; else if($box_no == 3) echo "span12" ?>">
				<div class="row-fluid">
					
					<?php
						$counter_post = 0; 
						$counter_box = 0;
						
					if (have_posts()) : while (have_posts()) : the_post();  
					
						if( $counter_post < 2*$box_no )
						{ ?>
							<div class="post_container box_post <?php if($box_no == 2) echo "span6" ; else if($box_no == 3) echo "span4" ?> ">            
								<div <?php post_class() ?> id="post-<?php the_ID(); ?>">                
									<?php                
									if (get_post_format() == '') {
										$format = "default";
									}
									else {
										$format = get_post_format();
									} ?>
								
									<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
									
									<!--begin response_post_byline hook-->
										<?php response_post_byline(); ?>
									<!--end response_post_byline hook-->
										
									<?php
									if ( has_post_thumbnail() ) {
										echo '<div class="featured-image">';
										echo '<a href="' . get_permalink($post->ID) . '" >';
											the_post_thumbnail();
										echo '</a>';
										echo '</div>';
									}
									?>	
									
									<div class="entry" <?php if ( has_post_thumbnail() ) { echo 'style="min-height: 115px;" '; }?>>
										<?php the_excerpt();    ?>
									</div><!--end entry-->  
								
									<!--Begin response_link_pages hook-->
										<?php response_link_pages(); ?>
									<!--End response_link_pages hook-->
								
									<!--Begin response_post_edit_link hook-->
										<?php response_edit_link(); ?>
									<!--End response_post_edit_link hook-->		
												
									<!--Begin response_post_bar hook-->
										<?php response_post_bar(); ?>
									<!--End response_post_bar hook-->
									
									<!-- ************Links to share in social networks***********-->	
									<!-- Share in Facebook -->
															
								</div><!--end post_class-->
							</div><!--end post container-->
							<?php 
							$counter_box++;
							$counter_post++;
							if($box_no == $counter_box) {
								echo '</div><div class="row-fluid">';
								$counter_box = 0;
							}
							
							if( $counter_post == 6 && $box_no == 3 )
							{ ?>
								</div> </div> </div>	<!-- Ending "row-fluid" and "content" div -->
								
								<!-- Starting "content" and "row-fluid" div -->
								<div class="row-fluid">	
									<div id="content" class="<?php echo $content_grid ?>">
										<div class="row-fluid">	
							<?php
							}
						}
						else
						{ ?>
							<div class="post_container wide_post">
								<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
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
									<div class="entry" <?php if ( has_post_thumbnail() && $featured_images == '1' ) { echo 'style="min-height: 115px;" '; }?>>
										<?php 
											the_excerpt();
										 ?>
									</div><!--end entry-->    
								
									<!--Begin response_link_pages hook-->
										<?php response_link_pages(); ?>
									<!--End response_link_pages hook-->
								
									<!--Begin response_post_edit_link hook-->
										<?php response_edit_link(); ?>
									<!--End response_post_edit_link hook-->		
												
									<!--Begin response_post_tags hook-->
										<?php response_post_tags(); ?>
									<!--End response_post_tags hook-->
												
									<!--Begin response_post_bar hook-->
										<?php response_post_bar(); ?>
									<!--End response_post_bar hook-->
								
									<!-- ************Links to share in social networks***********-->	
									<!-- Share in Facebook -->	
									</div><!--end post_class-->
							</div><!--end post container-->
						<?php }	?>
						
						<?php endwhile;
						else : ?>
							<h2>Not Found</h2>
					<?php endif; ?>
					
				</div><!--end content-->
                
				<!--Begin @response pagination hook-->
					<?php response_pagination(); ?>
				<!--End @response pagination loop hook-->
			</div>

			<!--Begin response_after_content_sidebar hook-->
				<?php response_after_content_sidebar(); ?>
			<!--End response_after_content_sidebar hook-->

		</div>
<?php	
}
?>