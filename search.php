<?php 

/*
	Search
	
	Establishes the iFeature search functionality. 
	
	Copyright (C) 2011 CyberChimps
*/

get_header(); 

?>

	<div id="content" class="eightcol">
	<!-- Begin @Core before_search hook -->
		<?php chimps_before_search(); ?>
	<!-- End @Core before_search hook -->
	
	<!-- Begin @Core search hook -->
		<?php chimps_search(); ?>
	<!-- End @Core search hook -->
	
	<!-- Begin @Core after_search hook -->
		<?php chimps_after_search(); ?>
	<!-- End @Core after_search hook -->
		
	</div>
	
	<div id="sidebar" class="fourcol last">
		<?php get_sidebar(); ?>
	</div>
	

<?php get_footer(); ?>
