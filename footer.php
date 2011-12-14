<?php

/*
	
	Footer
	Establishes the widgetized footer and static post-footer section of iFeature. 
	Copyright (C) 2011 CyberChimps
	Version 2.0
	
*/

global $options, $themeslug;

?>
	
<?php if ($options->get($themeslug.'_disable_footer') != "0"):?>	
</div><!--end container main row-->
</div><!--end container main wrap-->

<div id="footer">
     <div class="container">
     	<div class="row">
    	
	<!-- Begin @Core footer hook content-->
		<?php chimps_footer(); ?>
	<!-- End @Core footer hook content-->
	
	<?php endif;?>
		</div>	   
	</div><!--end footer_wrap-->
</div><!--end footer-->

<?php if ($options->get($themeslug.'_disable_afterfooter') != "0"):?>
	
	<div id="afterfooter">
			<div class="container">
    		 	<div class="row">
		<!-- Begin @Core afterfooter hook content-->
			<?php chimps_afterfooter(); ?>
		<!-- End @Core afterfooter hook content-->
			</div></div>
	</div> <!--end afterfooter-->	
	
	<?php endif;?>
	
	<?php wp_footer(); ?>	
</body>

</html>
