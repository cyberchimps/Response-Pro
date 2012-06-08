<?php
/**
* Portfolio Element used by Response Pro.
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

/**
* response Portfolio Section actions
*/
add_action( 'response_portfolio_element', 'response_portfolio_element_content' );

function response_portfolio_element_content() {	
	global $options, $post, $themeslug, $root;

	$image = get_post_meta($post->ID, 'portfolio_image' , true);

	if (is_page()){
		$category = get_post_meta($post->ID, $themeslug.'_portfolio_category' , true);
		$num = get_post_meta($post->ID, $themeslug.'_portfolio_row_number' , true);
		$title_enable = get_post_meta($post->ID, $themeslug.'_portfolio_title_toggle' , true);
		$title = get_post_meta($post->ID, $themeslug.'_portfolio_title' , true);;
	} else {
		$category = $options->get($themeslug.'_portfolio_category');
		$num = $options->get($themeslug.'_portfolio_number');
		$title_enable = $options->get($themeslug.'_portfolio_title_toggle');
		$title = $options->get($themeslug.'_portfolio_title');
	}

	if ($num == '1' || $num == 'key2') {
		$number = 'four';
		$numb = '3';
	} else if ($num == '2' || $num == 'key3') {
		$number = 'six';
		$numb = '2';
	} else {
		$number = 'three';
		$numb = '4';
	}

	$title = ($title != '') ? $title : 'Portfolio';	
	$title_output = ($title_enable == 'on' || $title_enable == '1') ? "<h1 class='portfolio_title'>$title</h1>" : '';
	?>

<div id="portfolio" class="container">
	<div class="row">
		
	<?php 
	$args = array( 'numberposts' => -1, 'post_type' => $themeslug.'_portfolio_images', 'portfolio_categories' => $category );
	$portfolio_posts = get_posts( $args );
	
	if ( !empty($portfolio_posts) ) : ?>
		<div id='gallery' class='twelve columns'>$title_output<ul>
		<?php

		$counter = 1;
		
		foreach( $portfolio_posts as $post ) : setup_postdata($post);
		
			$class = ( $counter % $numb == 1 ) ? 'first-row' : '';
			
			/* Post-specific variables */	
	    	$image = get_post_meta($post->ID, $themeslug.'_portfolio_image' , true);
	    	$title = get_the_title() ;	    	

	     	/* Markup for portfolio */
	     	?>
	    		<li id='portfolio_wrap' class='$number columns $class'>
	    			<a href='$image' rel="lightbox-portfolio" title='$title'><img src='$image'  alt='$title'/><div class='portfolio_caption'>$title</div></a>
	    		</li>
	    	<?php
	    	/* End slide markup */	
	    	
	    	$counter++;
	    endforeach; wp_reset_postdata(); ?>
	    
	    	</ul></div>
	    	
	    	<?php else: ?>
		
	    		<div id='gallery' class='span12'>
	    			<ul>
	    			
	    			<?php 
	    				$i = 1;
	    				while($i<4):
	    			?>
	      				<li id='portfolio_wrap' class='span3'>
	    					<a href='$root/images/pro/portfolio.jpg' rel="lightbox-portfolio" title='Image <?php echo $i; ?>'><img src='<?php echo $root; ?>/library/images/portfolio/default.jpg'  alt='Image <?php echo $i; ?>'/>
	    					<div class='portfolio_caption'>Image <?php echo $i; ?></div>
	    					</a>
	    				</li>
	    			<?php
	    				$i++;
	    				endwhile;
	    			?>	
	    			</ul>
	    		</div>
	    		
	<?php endif;?>

	</div>
</div>
<?php } ?>