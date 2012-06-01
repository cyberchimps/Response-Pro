<?php
/**
* Template Name: Reize
*
* Testing wp_resize outside of the slider
*/

global $options, $themeslug, $post, $sidebar, $content_grid, $root; // call globals	


get_header();  //Display Header
?>

<div id="main_wrap">
	<div class="container-fluid">
		<div class="row-fluid">
			
			<img src="<?php echo $root;?>/library/images/fish.jpg">
			
		<br /><br />

		</div>
	</div><!--end container-->
</div>	<!--end main_wrap-->
<?php get_footer(); //Dsiplay footer  ?>  