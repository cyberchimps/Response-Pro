<?php
/**
* Slider section actions used by the CyberChimps Synapse Core Framework Pro Extension
*
* Author: Tyler Cunningham
* Copyright: © 2011
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
* Extend slider actions
*/

add_action ('synapse_blog_slider', 'synapse_slider_content' );
add_action ('synapse_page_slider', 'synapse_slider_content' );

add_action ('synapse_blog_nivoslider', 'synapse_nivoslider_content' );
add_action ('synapse_page_nivoslider', 'synapse_nivoslider_content' );

/**
* Nivoslider
*/
function synapse_nivoslider_content() {

/* Call globals. */	

	global $themename, $themeslug, $options, $wp_query, $post;

/* End globals. */

/* Define variables. */	

    $tmp_query = $wp_query; 
	$root = get_template_directory_uri(); 
	
	if (is_page()) {
		$size = get_post_meta($post->ID, 'page_nivoslider_size' , true);
		$size2 = get_post_meta($post->ID, 'page_sidebar' , true);
		$type = get_post_meta($post->ID, 'page_nivoslider_type' , true);
		$category = get_post_meta($post->ID, 'nivoslider_blog_category' , true);
		$customcategory = get_post_meta($post->ID, 'nivoslider_category' , true);
		$postnumber  = get_post_meta($post->ID, 'nivoslider_blog_posts_number' , true);
		$sliderheight = get_post_meta($post->ID, 'nivoslider_height' , true);
		$sliderdelay = get_post_meta($post->ID, 'nivoslider_delay' , true);
		$slideranimation = get_post_meta($post->ID, 'page_nivoslider_animation' , true);
		$captionstyle = get_post_meta($post->ID, 'page_nivoslider_caption_style' , true);
		$navigationstyle = get_post_meta($post->ID, 'page_nivoslider_navigation_style' , true);
		$hidenav = get_post_meta($post->ID, 'nivo_hide_arrows' , true);
		$wordenable = get_post_meta($post->ID, 'nivo_enable_wordthumb' , true);	
		$navautohide = get_post_meta($post->ID, 'nivo_nav_autohide' , true);	
	}
	
	else {
		$size = $options->get($themeslug.'_nivo_slider_size');
		$size2 = $options->get($themeslug.'_blog_sidebar');
		$type = $options->get($themeslug.'_nivo_slider_type'); 
		$category = $options->get($themeslug.'_nivo_slider_category'); 
		$customcategory = $options->get($themeslug.'_nivo_customslider_category');
		$captionstyle = $options->get($themeslug.'_nivo_caption_style');
		$sliderheight = $options->get($themeslug.'_nivo_slider_height');
		$hidenav = $options->get($themeslug.'_nivo_hide_slider_arrows');
		$wordenable = $options->get($themeslug.'_nivo_enable_wordthumb');
		$slideranimation = $options->get($themeslug.'_nivo_slider_animation');
		$postnumber = $options->get($themeslug.'_nivo_slider_posts_number');
		$sliderdelay = $options->get($themeslug.'_nivo_slider_delay');
		$navigationstyle = $options->get($themeslug.'_nivo_slider_nav');
		$navautohide = $options->get($themeslug.'_nivo_disable_nav_autohide');
	}
		
echo "<div id='slider-wrapper'>";

/* End row riv variables. */	
	
/* End define variables. */	

/* Define animation styles. */	

	/* Define animation styles. */	

	if ($slideranimation == 'sliceDown' OR $slideranimation == '1') {
		$animation = 'sliceDown';
	}
	
	elseif ($slideranimation == 'sliceDownLeft' OR $slideranimation == '2') {
		$animation = 'sliceDownLeft' ;
	}

	elseif ($slideranimation == 'sliceUp' OR $slideranimation == '3') {
		$animation = 'sliceUp' ;
	}

	elseif ($slideranimation == 'sliceUpLeft' OR $slideranimation == '4') {
		$animation = 'sliceUpLeft' ;
	}

	elseif ($slideranimation == 'sliceUpDown' OR $slideranimation == '5') {
		$animation = 'sliceUpDown' ;
	}

	elseif ($slideranimation == 'sliceUpDownLeft' OR $slideranimation == '6') {
		$animation = 'sliceUpDownLeft' ;
	}

	elseif ($slideranimation == 'fold' OR $slideranimation == '7') {
		$animation = 'fold' ;
	}

	elseif ($slideranimation == 'fade' OR $slideranimation == '8') {
		$animation = 'fade' ;
	}

	elseif ($slideranimation == 'slideInRight' OR $slideranimation == '9') {
		$animation = 'slideInRight' ;
	}

	elseif ($slideranimation == 'slideInLeft' OR $slideranimation == '10') {
		$animation = 'slideInLeft' ;
	}

	elseif ($slideranimation == 'boxRandom' OR $slideranimation == '11') {
		$animation = 'boxRandom' ;
	}

	elseif ($slideranimation == 'boxRain' OR $slideranimation == '12') {
		$animation = 'boxRain' ;
	}

	elseif ($slideranimation == 'boxRainReverse' OR $slideranimation == '13') {
		$animation = 'boxRainReverse' ;
	}

	elseif ($slideranimation == 'boxRainGrow' OR $slideranimation == '14') {
		$animation = 'boxRainGrow' ;
	}
	
	elseif ($slideranimation == 'boxRainGrowReverse' OR $slideranimation == '15') {
		$animation = 'boxRainGrowReverse' ;
	}
	
	else {
		$animation = 'random';
	}
	
/* End animation styles. */		

/* Slider navigation options */

	if ($hidenav == '1' OR $hidenav == 'on') {
		$hidenavigation = 'true';
	}
	else {
		$hidenavigation = 'false';
	}
	if ($navautohide == '1' or $navautohide == 'on') {
		$autohide = 'true';
	}
	else {
		$autohide = 'false';
	}

/* End navigation options */

/* Define blog category */

	if ($category != 'all') {
		$blogcategory = $category;
	}
	else {
		$blogcategory = "";
	}
	
/* End blog category */

/* Define slider height */      

	if ($sliderheight == '') {
	    $height = '330';
	}    
	else {
		$height = $sliderheight;
	}

/* End slider height */ 

/* Define slider caption style */      

	if ($captionstyle == 'key3' OR $captionstyle == '2') { ?>
		<style type="text/css">
		.nivo-caption {height: <?php echo $height ?>px; width: 30%;}
		</style> <?php
	}
	elseif ($captionstyle == 'key2' OR $captionstyle == '3') { ?>
		<style type="text/css">
		.nivo-caption {position: relative; float: right; height: <?php echo $height ?>px; width: 30%;}
		</style> <?php
	}    
	elseif ($captionstyle == 'key4' OR $captionstyle == '0') { ?>
		<style type="text/css">
		.nivo-caption {display: none !important;}
		</style> <?php
	}    

/* End slider caption */ 

	if ($size == "key2" OR $size == '0') {
		$wordthumb = "h=$height&w=980";
	}
	elseif ($size2 == "two-right" OR $size2 == "right-left" OR $size2 == "1" OR $size2 == "2") {
		$wordthumb = "h=$height&w=480";
	}
	else {
		$wordthumb = "h=$height&w=640";
	}

/* End define wordthumb. */

/* Define slider width variable */ 

	if ($size == 'key2' OR $size == '0' ) {
	  	$csWidth = '980';
	  	$imgwidth = '980';
	  	$defaultimage = "$root/images/pro/slider-980.jpg";
	}		
	elseif ($size2 == 'right-left' && $size != 'key2' OR $size2 == 'two-right' && $size != 'key2' OR $size2 == '1' && $size != '0' OR $size2 == '2' && $size != '0') {
		$csWidth = '470';
		$imgwidth = '470';
		$defaultimage = "$root/images/pro/slider-470.jpg";
	}  	
	else {
		$csWidth = '640';
		$imgwidth = '640';
		$defaultimage = "$root/images/pro/slider-640.jpg";
	}

/* End slider width variable */ 

/* Query posts based on theme/meta options */

	if ($type == 'custom' OR $type == '0' OR $type= "") {
		$usecustomslides = 'custom';
	}	
	else {
		$usecustomslides = 'posts';
	}

/* Query posts based on theme/meta options */

	if ( $type == 'custom' OR $type == '0') {
    	query_posts( array ('post_type' => $themeslug.'_custom_slides', 'showposts' => 20,  'slide_categories' => $customcategory  ) );
    }
    else {
    	query_posts('category_name='.$blogcategory.'&showposts=50');
	}

/* End query posts based on theme/meta options */
    	
/* Establish post counter */  
  	
	if (have_posts()) :
	    $out = "<div id='slider' class='nivoSlider'>"; 
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
	
/* End post counter */	    	

/* Initialize slide creation */	

	while (have_posts() && $i<$no) : 

		the_post(); 

	    	/* Post-specific variables */	

	    	$customimage 		= get_post_meta($post->ID, 'slider_image' , true);  /* Gets slide custom image from page/post meta option */
	    	$customtext 		=  $post->post_content; /* Gets slide caption from custom slide meta option */
	    	$customlink 		= get_post_meta($post->ID, 'slider_url' , true); /* Gets link from custom slide meta option */
	    	$permalink 			= get_permalink(); /* Gets post URL for blog post slides */
	   		$blogtext 			= get_post_meta($post->ID, 'slider_text' , true); /* Gets slide caption from post meta option */  		
	   		$title				= get_the_title() ; /* Gets slide title from post/custom slide title */
	   		$hidetitlebar       = get_post_meta($post->ID, 'slider_hidetitle' , true); /* Gets page/post meta option for disabling slide title bar */
	   		$customsized        = "$root/core/pro/library/wt/wordthumb.php?src=$customimage&a=c&$wordthumb"; /* Gets custom image from page/post meta option, applies wordthumb code  */
	   		$customthumb 		= get_post_meta($post->ID, 'slider_custom_thumb' , true); /* Gets custom thumbnail from page/post meta option */

			/* End variables */	

			/* Controls slide title based on page meta setting */	

			if ($hidetitlebar == 'on' AND $captionstyle != '0') {
	   			$titlevar = "#caption$i";
	   		}
	   		else{
	   			$titlevar = '';
	   		}

	    	/* End slide title */

	    	/* Controls slide link */

	    	if ( $type == 'custom' OR $type == '0') {
	    		$link = get_post_meta($post->ID, 'slider_url' , true);
	    	}
	    	else {
	    		$link = get_permalink();
	    	}

	    	/* End slide link */
	    	
	    	/* Establish slider text */
	    	
	    	if ($type == 'custom' OR $type == '0') {
	    		$text = $customtext;
	    	}
	    	else {
	    		$text = $blogtext;
	    	}
	    	
	    	/* End slider text */	

	    	/* Controls slide image and thumbnails */

	    	if ($customimage != '' && $customthumb == '' && $wordenable == '1' OR $customimage != '' && $customthumb == '' && $wordenable == 'on'){ // Custom image, no custom thumb, WordThumb enabled. 
	    		$image = $customsized;
	    		$thumbnail = "$root/core/pro/library/wt/wordthumb.php?src=$customimage&a=c&h=30&w=50";
	    	}
	    	elseif ($customimage != '' && $customthumb != '' && $wordenable == '1' OR $customimage != '' && $customthumb != '' && $wordenable == 'on'){ // No Custom image, custom thumb, WordThumb enabled. 
	    		$image = $customsized;
	    		$thumbnail = "$root/core/pro/library/wt/wordthumb.php?src=$customthumb&a=c&h=30&w=50";
	    	}
	    	elseif ($customimage != '' && $customthumb != '' && $wordenable != '1' OR $customimage != '' && $customthumb != '' && $wordenable != 'on'){ // Custom image, custom thumb, WordThumb disabled. 
	    		$image = $customimage;
	    		$thumbnail = $customthumb;
	    	}
	 	    elseif ($customimage != '' && $customthumb == '' && $wordenable != '1' OR $customimage != '' && $customthumb == '' && $wordenable != 'on'){ // Custom image, no custom thumb, WordThumb disabled. 
	    		$image = $customimage;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	elseif ($customimage != '' && $customthumb == '' && $wordenable == '1' OR $customimage != '' && $customthumb == '' && $wordenable == 'on'){ // Custom image, no custom thumb, WordThumb enabled. 
	    		$image = $customsized;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}  	
	    	elseif ($customimage == '' && $wordenable != '1' OR $customimage == '' && $wordenable != 'on'){ // No custom image, no custom thumb, full-width slider, WordThumb enabled. 

	    		$image = $defaultimage;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	
	    	elseif ($customimage == '' && $wordenable == '1' OR $customimage == '' && $wordenable == 'on'){ // No custom image, no custom thumb, full-width slider, WordThumb enabled. 

	    		$image = $defaultimage;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}

		    /* End image/thumb */	

	     	/* Markup for slides */

	    $out .= "<a href='$link'>	
	    				<img src='$image' height='$height' width='$csWidth' title='$titlevar' rel='$thumbnail' alt='Slider' class='nivoimg' />
	    					<span id='caption$i' class='nivo-html-caption'>
                				<span class='caption_title'>$title</span> <br /> <span class='caption_text'>$text</span>                			
                			</span>
	    				</a>
	    			";
	    	/* End slide markup */
	      	$i++;
	      	endwhile;
	      	
	      	$out .= "</div>";
	      	
	      	else:
	      
	      	$out .= "	<br /><br /><br /><br />
	    				<font size='6'>Oops! You have not created a Custom Slide.</font> <br /><br />

To learn how to create a custom slide please <a href='http://cyberchimps.com/question/using-the-ifeature-slider/' target='_blank'><font color='blue'>read the documentation</font></a>.<br /><br />

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

/* Define slider navigation style */ 		
	
	if ($navigationstyle == 'key1' OR $navigationstyle == '' OR $navigationstyle == '0') {
		
		echo '<style type="text/css">';
		echo ".nivo-controlNav a {background: url($root/images/slider/bullets.png) no-repeat; display:block; width:22px; height:22px; 	text-indent:-9999px; border:0; margin-right:3px; float:left;}";
		echo ".nivo-controlNav a.active {background-position:0 -22px;} ";
		echo '</style>';	
	}
	if ($navigationstyle == 'key3' OR $navigationstyle == '2') {
		
		echo '<style type="text/css">';
		echo ".nivo-controlNav {display: none;}";
		echo ".nivoslider_nav {display: none;}";
		echo '#slider-wrapper {margin-bottom: 20px !important;}';
		echo '</style>';

	}
	?>
	
<!-- Apply slider CSS based on user settings -->

	<style type="text/css" media="screen">
		#slider-wrapper { width: <?php echo $csWidth ?>px; height: <?php echo $height ?>px !important; margin: auto;}
		#slider { width: <?php echo $csWidth ?>px; height: <?php echo $height ?>px !important; margin: auto; margin-bottom:45px; }
	</style>

<!-- End style -->

<?php if ($navigationstyle == 'key3' OR $navigationstyle == '2') :?>
	<style type="text/css" media="screen">
		.slider_nav {display: none !important;}
		#orbitDemo {margin-bottom: 0px !important;}
	</style>
<?php endif;?>


	<?php
	
/* End slider navigation style */ 
	
	wp_reset_query(); /* Reset post query */ 

/* Begin NivoSlider javascript */ 
    
    $out .= <<<OUT
	<script type="text/javascript">
		
	jQuery(document).ready(function($) {
	$(window).load(function() {
    $('#slider').nivoSlider({
        effect:'$animation', // Specify sets like: 'fold,fade,sliceDown'
        slices:15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed:500, // Slide transition speed
        pauseTime:'$delay', // How long each slide will show
        startSlide:0, // Set starting Slide (0 index)
        directionNav:$hidenavigation, // Next  Prev navigation
        directionNavHide:$autohide, // Only show on hover
        controlNavThumbs:true, // Use thumbnails for Control Nav
        controlNavThumbsFromRel:true, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav:true, // Use left  right arrows
        pauseOnHover:true, // Stop animation while hovering
        manualAdvance:false, // Force manual transitions
        captionOpacity:0.7, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });
	$('#slider').each(function(){
    var \$this = $(this), \$control = $(".nivo-controlNav", this);
    \$control.css({left: (\$this.width() - \$control.width()) / 2}); 
});
});
});

</script>

OUT;

/* End NivoSlider javascript */ 

echo $out; ?> </div> <div class="nivoslider_nav" style="width: <?php echo $csWidth ?>px;"></div>

<?php 

}

/**
* Extend slider functions
*/
function synapse_slider_content() {

/* Call globals. */	

	global $themename, $themeslug, $options, $wp_query, $post;

/* End globals. */

/* Define variables. */	

    $tmp_query = $wp_query; 
	$root = get_template_directory_uri(); 
	
	if (is_page()) {
		$size = get_post_meta($post->ID, 'page_slider_size' , true);
		$size2 = get_post_meta($post->ID, 'page_sidebar' , true);
		$type = get_post_meta($post->ID, 'page_slider_type' , true);
		$category = get_post_meta($post->ID, 'slider_blog_category' , true);
		$customcategory = get_post_meta($post->ID, 'slider_category' , true);
		$postnumber  = get_post_meta($post->ID, 'slider_blog_posts_number' , true);
		$sliderheight = get_post_meta($post->ID, 'slider_height' , true);
		$sliderdelay = get_post_meta($post->ID, 'slider_delay' , true);
		$slideranimation = get_post_meta($post->ID, 'page_slider_animation' , true);
		$captionstyle = get_post_meta($post->ID, 'page_slider_caption_style' , true);
		$navigationstyle = get_post_meta($post->ID, 'page_slider_navigation_style' , true);
		$hidenav = get_post_meta($post->ID, 'hide_arrows' , true);
		$wordenable = get_post_meta($post->ID, 'enable_wordthumb' , true);	
	}
	
	else {
		$size = $options->get($themeslug.'_slider_size');
		$size2 = $options->get($themeslug.'_blog_sidebar');
		$type = $options->get($themeslug.'_slider_type'); 
		$category = $options->get($themeslug.'_slider_category'); 
		$customcategory = $options->get($themeslug.'_customslider_category');
		$captionstyle = $options->get($themeslug.'_caption_style');
		$sliderheight = $options->get($themeslug.'_slider_height');
		$hidenav = $options->get($themeslug.'_hide_slider_arrows');
		$wordenable = $options->get($themeslug.'_enable_wordthumb');
		$slideranimation = $options->get($themeslug.'_slider_animation');
		$postnumber = $options->get($themeslug.'_slider_posts_number');
		$sliderdelay = $options->get($themeslug.'_slider_delay');
		$navigationstyle = $options->get($themeslug.'_slider_nav');
	}

	
/* Row div variable. */	
if ($size == 'key2' OR $size == '0' ) {
	$openrow = '<div class="row">';
	$closerow = '</div>';
}

else {
	$openrow = '';
	$closerow = '';
}?>	

<?php echo $openrow; 
	
/* End row riv variables. */	
	
/* End define variables. */	

/* Define animation styles. */	

	if ($slideranimation == 'key2' OR $slideranimation == '1') {
		$animation = 'fade';
	}
	elseif ($slideranimation == 'key3' OR $slideranimation == '2') {
		$animation = 'horizontal-slide' ;
	}
	elseif ($slideranimation == 'key4' OR $slideranimation == '3') {
		$animation = 'vertical-slide' ;
	}
	else {
		$animation = 'horizontal-push';
	}

/* End animation styles. */		

/* Slider navigation options */

	if ($hidenav == '0' OR $hidenav == "off") { ?>
		<style type="text/css">
		div.slider-nav {display: none;}
		</style> <?php
	}
	
	
/* End navigation options */


/* Define blog category */

	if ($category != 'all') {
		$blogcategory = $category;
	}
	else {
		$blogcategory = "";
	}
	
/* End blog category */

/* Define slider height */      

	if ($sliderheight == '') {
	    $height = '330';
	}    

	else {
		$height = $sliderheight;
	}

/* End slider height */ 

/* Define slider caption style */      

	if ($captionstyle == 'key2' OR $captionstyle == '3') { ?>
		<style type="text/css">
		.orbit-caption {height: <?php echo $height ?>px; width: 30% !important;}
		</style> <?php
	}
	elseif ($captionstyle == 'key3' OR $captionstyle == '2') { ?>
		<style type="text/css">
		.orbit-caption {position: relative !important; float: left; height: <?php echo $height ?>px; width: 30% !important; top: -375px;}
		</style><?php
	}    
	elseif ($captionstyle == '0') { ?>
		<style type="text/css">
		.orbit-caption {display: none !important;}
		</style><?php
	}    

/* Define wordthumb default height and widths. */		

	if ($size == "key2" OR $size == '0') {
		$wordthumb = "h=$height&w=980";
	}
	elseif ($size2 == "two-right" OR $size2 == "right-left" OR $size2 == "1" OR $size2 == "2") {
		$wordthumb = "h=$height&w=480";
	}
	else {
		$wordthumb = "h=$height&w=640";
	}

/* End define wordthumb. */

/* Define slider width variable */ 

	if ($size == 'key2' OR $size == '0' ) {
	  	$csWidth = '980';
	  	$imgwidth = '980';
	  	$defaultimage = "$root/images/pro/slider-980.jpg";
	}		
	elseif ($size2 == 'right-left' && $size != 'key2' OR $size2 == 'two-right' && $size != 'key2' OR $size2 == '1' && $size != '0' OR $size2 == '2' && $size != '0') {
		$csWidth = '470';
		$imgwidth = '470';
		$defaultimage = "$root/images/pro/slider-470.jpg";
	}  	
	else {
		$csWidth = '640';
		$imgwidth = '640';
		$defaultimage = "$root/images/pro/slider-640.jpg";
	}

/* End slider width variable */ 

/* Query posts based on theme/meta options */

	if ($type == 'custom' OR $type == '0' OR $type= "") {
		$usecustomslides = 'custom';
	}	
	else {
		$usecustomslides = 'posts';
	}

/* Query posts based on theme/meta options */

	if ( $type == 'custom' OR $type == '0') {
    	query_posts( array ('post_type' => $themeslug.'_custom_slides', 'showposts' => 20,  'slide_categories' => $customcategory  ) );
    }
    else {
    	query_posts('category_name='.$blogcategory.'&showposts=50');
	}

/* End query posts based on theme/meta options */
    	
/* Establish post counter */  
  	
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
	
/* End post counter */	    	

/* Initialize slide creation */	

	while (have_posts() && $i<$no) : 

		the_post(); 

	    	/* Post-specific variables */	

	    	$customimage 		= get_post_meta($post->ID, 'slider_image' , true);  /* Gets slide custom image from page/post meta option */
	    	$customtext 		=  $post->post_content; /* Gets slide caption from custom slide meta option */
	    	$customlink 		= get_post_meta($post->ID, 'slider_url' , true); /* Gets link from custom slide meta option */
	    	$permalink 			= get_permalink(); /* Gets post URL for blog post slides */
	   		$blogtext 			= get_post_meta($post->ID, 'slider_text' , true); /* Gets slide caption from post meta option */  		
	   		$title				= get_the_title() ; /* Gets slide title from post/custom slide title */
	   		$hidetitlebar       = get_post_meta($post->ID, 'slider_hidetitle' , true); /* Gets page/post meta option for disabling slide title bar */
	   		$customsized        = "$root/core/pro/library/wt/wordthumb.php?src=$customimage&a=c&$wordthumb"; /* Gets custom image from page/post meta option, applies wordthumb code  */
	   		$customthumb 		= get_post_meta($post->ID, 'slider_custom_thumb' , true); /* Gets custom thumbnail from page/post meta option */

			/* End variables */	

			/* Controls slide title based on page meta setting */	

			if ($hidetitlebar == 'on' AND $captionstyle != 'key4') {
	   			$caption = "data-caption='#htmlCaption$i'";
	   		}
	   		else {
	   			$caption = '';
	   		}

	    	/* End slide title */

	    	/* Controls slide link */

	    	if ( $type == 'custom' OR $type == '0') {
	    		$link = get_post_meta($post->ID, 'slider_url' , true);
	    	}
	    	else {
	    		$link = get_permalink();
	    	}

	    	/* End slide link */
	    	
	    	/* Establish slider text */
	    	
	    	if ($type == 'custom' OR $type == '0') {
	    		$text = $customtext;
	    	}
	    	else {
	    		$text = $blogtext;
	    	}
	    	
	    	/* End slider text */	

	    	/* Controls slide image and thumbnails */

	    	if ($customimage != '' && $customthumb == '' && $wordenable == '1' OR $customimage != '' && $customthumb == '' && $wordenable == 'on'){ // Custom image, no custom thumb, WordThumb enabled. 
	    		$image = $customsized;
	    		$thumbnail = "$root/core/pro/library/wt/wordthumb.php?src=$customimage&a=c&h=30&w=50";
	    	}
	    	elseif ($customimage != '' && $customthumb != '' && $wordenable == '1' OR $customimage != '' && $customthumb != '' && $wordenable == 'on'){ // No Custom image, custom thumb, WordThumb enabled. 
	    		$image = $customsized;
	    		$thumbnail = "$root/core/pro/library/wt/wordthumb.php?src=$customthumb&a=c&h=30&w=50";
	    	}
	    	elseif ($customimage != '' && $customthumb != '' && $wordenable != '1' OR $customimage != '' && $customthumb != '' && $wordenable != 'on'){ // Custom image, custom thumb, WordThumb disabled. 
	    		$image = $customimage;
	    		$thumbnail = $customthumb;
	    	}
	 	    elseif ($customimage != '' && $customthumb == '' && $wordenable != '1' OR $customimage != '' && $customthumb == '' && $wordenable != 'on'){ // Custom image, no custom thumb, WordThumb disabled. 
	    		$image = $customimage;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	elseif ($customimage != '' && $customthumb == '' && $wordenable == '1' OR $customimage != '' && $customthumb == '' && $wordenable == 'on'){ // Custom image, no custom thumb, WordThumb enabled. 
	    		$image = $customsized;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}  	
	    	elseif ($customimage == '' && $wordenable != '1' OR $customimage == '' && $wordenable != 'on'){ // No custom image, no custom thumb, full-width slider, WordThumb enabled. 

	    		$image = $defaultimage;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}
	    	
	    	elseif ($customimage == '' && $wordenable == '1' OR $customimage == '' && $wordenable == 'on'){ // No custom image, no custom thumb, full-width slider, WordThumb enabled. 

	    		$image = $defaultimage;
	    		$thumbnail = "$root/images/pro/sliderthumb.jpg";
	    	}


		    /* End image/thumb */	

	     	/* Markup for slides */

	    	
	    $out .= "
	    	<a href='$link' $caption data-thumb='$thumbnail'>
	    				<img src='$image'  alt='Slider' />
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

To learn how to create a custom slide please <a href='http://cyberchimps.com/question/using-the-ifeature-slider/' target='_blank'><font color='blue'>read the documentation</font></a>.<br /><br />

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
  	
	if ($navigationstyle == 'key1' OR $navigationstyle == 'key2' OR $navigationstyle == '0'  OR $navigationstyle == '1' OR $navigationstyle == '') {
	    $dots = 'true';
	}
	else {
		$dots = 'false';
	}
	if ($navigationstyle == 'key2' OR $navigationstyle == '1') {
	    $thumbs = 'true'; ?>
	    
	    <style type="text/css">
		.orbit-bullets {bottom: -50px !important;}
		</style> <?php
	}
	else {
		$thumbs = 'false';
	}

/* End slider navigation variable */ 

	?>
	
<!-- Apply slider CSS based on user settings -->

	<style type="text/css" media="screen">
		#orbitDemo { max-height: <?php echo $height ?>px !important; }
		#slider { width: <?php echo $csWidth ?>px; height: <?php echo $height ?>px; margin: auto; }
	</style>

<!-- End style -->

<?php if ($navigationstyle == 'key3' OR $navigationstyle == '2') :?>
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
         bulletThumbs: $thumbs
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