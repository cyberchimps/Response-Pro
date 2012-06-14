<?php
/**
* Template Name: Magazine Layout
*
* Authors: Tyler Cunningham, Trent Lapinski
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 1.0.5
*/

global $options, $themeslug, $post, $sidebar, $content_grid; // call globals	

 $featured_images = $options->get($themeslug.'_show_featured_images');
get_header();  //Display Header
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
						
							<h2 class="headline-label"><a href="<?php the_permalink() ?>">Headline »</a></h2>
						
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

			<div id="content" class="<?php echo $content_grid; ?>">
				<div class="row-fluid">
					<?php   
					$counter = 0;
					$the_query = new WP_Query('showposts=4&orderby=post_date&order=desc&offset=1');  ?>    
					<?php if ($the_query -> have_posts()) : while ($the_query -> have_posts()) : $the_query -> the_post(); 
                            $exclude_posts[] = get_the_ID();
                    ?>
					
					<div class="post_container span6 box_post">            
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
							<div class="socialbar">
							<a class="share-fb social" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook" target="blank">Facebook</a>
							
							<!-- Twitt in Twitter -->
							<a class="share-twt social" href="http://twitter.com/home?status=Currently reading <?php the_permalink(); ?>" title="Share on Twitter" target="_blank">Twitter</a>
							
							<!-- Share in LikedIn -->
							<a class="share-ln social" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=&source=<?php bloginfo('name'); ?>" target="_new">LinkedIn</a>
							
							<!-- Share in Reddit -->
							<a class="share-rdt social" href="http://www.reddit.com/submit?url=<?php the_permalink();?>&title=<?php the_title(); ?>" target="blank">Reddit</a>
							</div>
						
						</div><!--end post_class-->
					</div><!--end post container-->
					
					<?php 
						$counter++; 
						if(2 == $counter) {
							echo '</div><div class="row-fluid">';
							$counter = 0;
						}
					?>
				
					<?php 
					endwhile; 
					wp_reset_query();      
					?>
					<?php else : ?>
						<h2>Not Found</h2>
					<?php endif; ?> 
                    
                
					<?php 
                    /* Modify the default loop to display certain posts with pagination 
                       Display these posts in wide box format 
                    */
                    global $wp_query;
                    $page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $wp_query = new WP_Query(
                                        array(
                                            'paged'         => $page_number,
                                            'post_type'     => 'post',
                                            'orderby'       => 'post_date',
                                            'order'         => 'desc',
                                            'posts_per_page'=> 5,
                                            'post__not_in'  => $exclude_posts
                                        )
                                    );
                    ?>    
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
				
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
								<div class="socialbar">
								<a class="share-fb social" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook" target="blank">Facebook</a>
							
								<!-- Twitt in Twitter -->
								<a class="share-twt social" href="http://twitter.com/home?status=Currently reading <?php the_permalink(); ?>" title="Share on Twitter" target="_blank">Twitter</a>
								
								<!-- Share in LikedIn -->
								<a class="share-ln social" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=&source=<?php bloginfo('name'); ?>" target="_new">LinkedIn</a>
								
								<!-- Share in Reddit -->
								<a class="share-rdt social" href="http://www.reddit.com/submit?url=<?php the_permalink();?>&title=<?php the_title(); ?>" target="blank">Reddit</a>
							</div>
							</div><!--end post_class-->
						</div><!--end post container-->
						
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

<div class="push"></div>
</div> <!-- End of row -->
</div> <!-- End of container -->
</div> <!-- End of wrapper -->
<?php get_footer(); //Dsiplay footer  ?>  