<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Feature Slider Element used by the CyberChimps Response Core Framework Pro Extension
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

/**
* Pro slider actions
*/

add_action ('response_blog_slider', 'response_slider_content' );
add_action ('response_page_slider', 'response_slider_content' );


/**
* Slider markup.
*/
function response_slider_content() {
	global $themename, $themeslug, $options, $wp_query, $post;

    $tmp_query = $wp_query; 
	$root = get_template_directory_uri(); 
	
	if (is_page()) {
		$type = get_post_meta($post->ID, $themeslug.'_page_slider_type' , true);
		$category = get_post_meta($post->ID, $themeslug.'_slider_blog_category' , true);
		$customcategory = get_post_meta($post->ID, $themeslug.'_slider_category' , true);
		$postnumber  = get_post_meta($post->ID, $themeslug.'_slider_blog_posts_number' , true);
		$sliderheight = get_post_meta($post->ID, $themeslug.'_slider_height' , true);
		$sliderdelay = get_post_meta($post->ID, $themeslug.'_slider_delay' , true);
		$slideranimation = get_post_meta($post->ID, $themeslug.'_page_slider_animation' , true);
		$captionstyle = get_post_meta($post->ID, $themeslug.'_page_slider_caption_style' , true);
		$navigationstyle = get_post_meta($post->ID, $themeslug.'_page_slider_navigation_style' , true);
		$arrows = get_post_meta($post->ID, $themeslug.'_slider_arrows' , true);
		$wordenable = get_post_meta($post->ID, $themeslug.'_wp_resize' , true);	
	}
	else {
		$type = $options->get($themeslug.'_slider_type'); 
		$category = $options->get($themeslug.'_slider_category'); 
		$customcategory = $options->get($themeslug.'_customslider_category');
		$captionstyle = $options->get($themeslug.'_caption_style');
		$sliderheight = $options->get($themeslug.'_slider_height');
		$arrows = $options->get($themeslug.'_hide_slider_arrows');
		$wordenable = $options->get($themeslug.'_enable_wordthumb');
		$slideranimation = $options->get($themeslug.'_slider_animation');
		$postnumber = $options->get($themeslug.'_slider_posts_number');
		$sliderdelay = $options->get($themeslug.'_slider_delay');
		$navigationstyle = $options->get($themeslug.'_slider_nav');
	}

	$closerow = '</div>';
	$csWidth = '1020';
	$imgwidth = '1020';
	$defaultimage = "$root/library/images/pro/responseproslider.jpg";

?>	

<div class="row-fluid">

<?php

/**
* Get the animaiton options.
*/
	if ($slideranimation == 'key2') {
		$animation = 'fade';
	}
	elseif ($slideranimation == 'key3') {
		$animation = 'horizontal-slide' ;
	}
	elseif ($slideranimation == 'key4') {
		$animation = 'vertical-slide' ;
	}
	else {
		$animation = 'horizontal-push';
	}

/**
* Enable/Disable nav arrows based on option.
*/
	if ($arrows == '0') { ?>
		<style type="text/css">
		div.slider-nav {display: none;}
		</style> <?php
	}

/**
* Define slider height.
*/  
	if ($sliderheight == '') {
	    $height = '340';
	}    
	else {
		$height = $sliderheight;
	}

/**
* Define caption style.
*/
	if ($captionstyle == 'key2') { ?>
		<style type="text/css">
		.orbit-caption {height: <?php echo $height ?>px; width: 30% !important;}
		</style> <?php
	}
	elseif ($captionstyle == 'key3') { ?>
		<style type="text/css">
		.orbit-caption {position: relative !important; float: left; height: <?php echo $height ?>px; width: 30% !important; top: -375px;}
		</style><?php
	}    
	elseif ($captionstyle == '0') { ?>
		<style type="text/css">
		.orbit-caption {display: none !important;}
		</style><?php
	}    
	
/**
* Define whether slider pulls from blog posts or custom slides.
*/
	if ($type == 'custom' OR $type == '0' OR $type= "") {
		$usecustomslides = 'custom';
	}	
	else {
		$usecustomslides = 'posts';
	}

/**
* Get post category.
*/
	if ($category != 'all') {
		$blogcategory = $category;
	}
	else {
		$blogcategory = "";
	}
	
/**
* Query posts.
*/
	if ( $type == 'custom' OR $type == '0') {
    	query_posts( array ('post_type' => $themeslug.'_custom_slides', 'showposts' => 20,  'slide_categories' => $customcategory  ) );
    }
    else {
    	query_posts('category_name='.$blogcategory.'&showposts=50');
	}
    	
/**
* Start the counter.
*/
	if (have_posts()) :
	    $out = "<div id='orbitDemo'>"; 
	    $i = 0;
	if ($usecustomslides == 'posts' AND $postnumber == '' OR $type != '0' AND $postnumber == '') {
	    $no = '5';    	
	}   	
	elseif ($usecustomslides == 'custom' OR $type == '0') {
	    $no = '20';
	}
	else {
		$no = $postnumber;
	}
	
/**
* Create the slides.
*/
	while (have_posts() && $i<$no) : 

		the_post(); 
		
			$title			 = get_the_title();
			$permalink 		 = get_permalink(); 
	    	$customimage	 = get_post_meta($post->ID, $themeslug.'_slider_image' , true);  
	    	$customtext 	 = get_post_meta($post->ID, $themeslug.'_slider_caption' , true); 
	   	    $customlink 	 = get_post_meta($post->ID, $themeslug.'_slider_url' , true); 
	   		$blogtext 		 = get_post_meta($post->ID, $themeslug.'_slider_text' , true); 
	   		$hidetitlebar    = get_post_meta($post->ID, $themeslug.'_slider_hidetitle' , true); 	   		
	   		$customthumb 	 = get_post_meta($post->ID, $themeslug.'_slider_custom_thumb' , true); 
	   		$thumbtext       = get_post_meta($post->ID, $themeslug.'_slider_thumb_text' , true); 

			if ($hidetitlebar == 'on' AND $captionstyle != 'key4') {
	   			$caption = "data-caption='#htmlCaption$i'";
	   		}
	   		else {
	   			$caption = '';
	   		}

	    	if ( $type == 'custom' OR $type == '0') {
	    		$link = get_post_meta($post->ID, 'slider_url' , true);
	    	}
	    	else {
	    		$link = get_permalink();
	    	}

	 	    if ($type == 'custom' OR $type == '0') {
	    		$text = $customtext;
	    	}
	    	else {
	    		$text = $blogtext;
	    	}
	    	
	    	if ($customimage != '' && $customthumb == '' && $wordenable == '1' OR $customimage != '' && $customthumb == '' && $wordenable == 'on'){ // Custom image, no custom thumb, WordThumb enabled. 
	    		$resized            = wp_resize( '', $customimage, 1020, 330, true );
	    		$image = "<img src='$resized[url]' width='$resized[width]'  alt='Slider' />";
	    		$thumbnail = "$root/pro/library/wt/wordthumb.php?src=$customimage&a=c&h=30&w=50";
	    	}
	    	elseif ($customimage != '' && $customthumb != '' && $wordenable == '1' OR $customimage != '' && $customthumb != '' && $wordenable == 'on'){ // No Custom image, custom thumb, WordThumb enabled. 
	    		$resized            = wp_resize( '', $customimage, 1020, 330, true );
	    		$image = "<img src='$resized[url]' width='$resized[width]' alt='Slider' />";
	    		$thumbnail = "$root/pro/library/wt/wordthumb.php?src=$customthumb&a=c&h=30&w=50";
	    	}
	    	elseif ($customimage != '' && $customthumb != '' && $wordenable != '1' OR $customimage != '' && $customthumb != '' && $wordenable != 'on'){ // Custom image, custom thumb, WordThumb disabled. 
	    		$image = "<img src='$customimage' alt='Slider' />";
	    		$thumbnail = $customthumb;
	    	}
	 	    elseif ($customimage != '' && $customthumb == '' && $wordenable != '1' OR $customimage != '' && $customthumb == '' && $wordenable != 'on'){ // Custom image, no custom thumb, WordThumb disabled. 
	    		$image = "<img src='$customimage' alt='Slider' />";
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	elseif ($customimage != '' && $customthumb == '' && $wordenable == '1' OR $customimage != '' && $customthumb == '' && $wordenable == 'on'){ // Custom image, no custom thumb, WordThumb enabled. 
	    		$resized            = wp_resize( '', $customimage, 1020, 330, true );
	    		$image = "<img src='$resized[url]' width='$resized[width]' alt='Slider' />";
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}  	
	    	elseif ($customimage == '' && $wordenable != '1' OR $customimage == '' && $wordenable != 'on'){ // No custom image, no custom thumb, full-width slider, WordThumb enabled. 

	    		$image = "<img src='$defaultimage'>";
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	
	    	elseif ($customimage == '' && $wordenable == '1' OR $customimage == '' && $wordenable == 'on'){ // No custom image, no custom thumb, full-width slider, WordThumb enabled. 

	    		$image = "<img src='$defaultimage'>";
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	
	    $out .= "
	    	<a href='$link' $caption data-thumb='$thumbnail' bullet-text='$thumbtext'>
	    				$image
	    						<span class='orbit-caption' id='htmlCaption$i'><span class='caption_title'>$title</span> <br /> <span class='caption_text'>$text</span></span>
	    				</a>
	  	    	";

	    	/* End slide markup */
	      	$i++;
	      	endwhile;
	      	
	      	$out .= "</div>";
	      	
	      	else:
	      
	      	$out .= "	<br /><br /><br /><br />
	    				<font size='6'>Oops! You have not created a Custom Slide.</font> <br /><br />

To learn how to create a custom slide please <a href='http://cyberchimps.com/question/using-the-response-slider/' target='_blank'><font color='blue'>read the documentation</font></a>.<br /><br />

To create a Custom Slide please go to the Custom Slides tab in WP-Admin. Once you have created your first Custom Slide it will display here instead of this warning.<br /><br />
		
	    			";
	endif; 	    
	$wp_query = $tmp_query;    

/* End slide creation */	

/* Define slider delay variable */ 
    
	if ($sliderdelay == "") {
	    $delay = '3500';
	}    

	else {
		$delay = $sliderdelay;
	}

/* End slider delay variable */ 	

/* Define slider navigation variable */ 
  	
	if ($navigationstyle == 'key1' OR $navigationstyle == 'key2' OR $navigationstyle == 'key3' OR $navigationstyle == '') {
	    $dots = 'true';
	}
	else {
		$dots = 'false';
	}
	if ($navigationstyle == 'key2') {
	    $imagethumbs = 'true'; ?>
	    
	    <style type="text/css">
		.orbit-bullets {bottom: -50px !important;}
		</style> <?php
	}
	else {
		$imagethumbs = 'false';
	}
	
	if ($navigationstyle == 'key3') {
		$textthumbs = 'true';
	}
	else {
		$textthumbs = 'false';
	}

/* End slider navigation variable */ 

	?>
	
<!-- Apply slider CSS based on user settings -->

	<style type="text/css" media="screen">
		#orbitDemo { max-height: <?php echo $height ?>px !important; }
		#slider { width: <?php echo $csWidth ?>px; height: <?php echo $height ?>px; margin: auto; }
	</style>

<!-- End style -->

<?php if ($navigationstyle == 'key4') :?>
	<style type="text/css" media="screen">
		.slider_nav {display: none;}
		#orbitDemo {margin-bottom: 0px;}
	</style>
<?php endif;?>

	<?php
	
/* End slider navigation style */ 
	
	wp_reset_query(); /* Reset post query */ 

/* Begin Orbit javascript */ 
    
    $out .= <<<OUT
<script type="text/javascript">
    jQuery(document).ready(function ($) {
    $(window).load(function() {
    $('#orbitDemo').orbit({
         animation: '$animation',
         advanceSpeed: $delay,
         captionAnimation: 'slideOpen',		// fade, slideOpen, none
         captionAnimationSpeed: 800,  
         bullets: $dots,
         bulletThumbs: $imagethumbs,
         bulletTexts: $textthumbs
     });
     });
     });
</script>
OUT;

/* End Orbit javascript */ 

echo $out; ?> <div class="slider_nav"></div>

<?php echo $closerow; 

}

/**
* End
*/

?>