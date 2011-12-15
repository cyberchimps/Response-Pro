<?php 

/*
	Header
	Authors: Tyler Cunningham, Trent Lapinski
	Creates the theme header. 
	Copyright (C) 2011 CyberChimps
	Version 2.0
*/

/* Call globals. */	

	global $themename, $themeslug, $options;
	
	ifeature_header_content_init();

/* End globals. */
	
?>
<!-- Begin @Core head_tag hook content-->
	<?php chimps_head_tag(); ?>
<!-- End @Core head_tag hook content-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> <!-- wp_enqueue_script( 'comment-reply' );-->
<?php wp_head(); ?> <!-- wp_head();-->
	
</head> <!-- closing head tag-->

<!-- Begin @Core after_head_tag hook content-->
	<?php chimps_after_head_tag(); ?>
<!-- End @Core after_head_tag hook content-->
	
<!-- Begin @Core before_header hook  content-->
	<?php chimps_before_header(); ?> 
<!-- End @Core before_header hook content -->
			
	<header id="head">
		
	<?php if ($options->get($themeslug.'_disable_header') != "0"):?>
	

	<div class="container">
		<div class="row">
		
			<div class="fourcol">
				
				<!-- Begin @Core header sitename hook -->
					<?php chimps_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="eightcol last">
				
		<!-- Begin @Core navigation contact area hook -->
			<?php chimps_navigation(); ?> 
		<!-- End @Core navigation contact area hook -->
				
			</div>	
		</div><!--end row-->
	</div><!--end container-->
		
	<?php endif;?>

	</header>
		
<script type="text/javascript">jQuery(document).ready(function($) {$("ul").parent("li").addClass("parent"); });</script>		

<div class="container" style="margin-top: 25px;"><div class="row"><!--main wrap-->	
<!-- Begin @Core after_header hook -->
	<?php chimps_after_header(); ?> 
<!-- End @Core after_header hook -->