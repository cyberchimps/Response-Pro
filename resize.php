<?php
/**
* Template Name: Reize
*
* Testing wp_resize outside of the slider
*/

	global $options, $themeslug, $post, $sidebar, $content_grid, $root; // call globals	

	$source = "http://farm3.static.flickr.com/2156/2364129390_4fe946df4a.jpg";
	$image = wp_resize( '', $source , 1000, 1000, true );

get_header();  //Display Header

var_dump($image['url']);
var_dump($image['height']);
var_dump($image['width']);

?>

<div id="main_wrap">
	<div class="container-fluid">
		<div class="row-fluid">
			
			<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" />
			
		<br /><br />

		</div>
	</div><!--end container-->
</div>	<!--end main_wrap-->
<?php get_footer(); //Dsiplay footer  ?>  