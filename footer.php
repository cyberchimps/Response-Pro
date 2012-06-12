<?php 

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Footer template used by the CyberChimps Response Core Framework
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
	global $options, $themeslug // call globals
?>
	
<?php if ($options->get($themeslug.'_disable_footer') != "0"):?>	

</div><!--end container wrap-->

<div class="footer">
	<div id="main_wrap">
   		<div id="footer" class="container-fluid">
     		<div id="footer_container" class="row-fluid">
    			<div id="footer_wrap" class="span12">	
					<!--Begin response_footer hook-->
						<?php response_footer(); ?>
					<!--End response_footer hook-->
				</div>
	<?php endif;?>
	
			</div><!--end footer_wrap-->
	</div><!--end footer-->
</div> 

<?php if ($options->get($themeslug.'_disable_afterfooter') != "0"):?>

	<div id="afterfooter" class="container-fluid">
		<div class="row-fluid" id="afterfooterwrap">	
			
		<!--Begin response_secondary_footer hook-->
			<?php response_secondary_footer(); ?>
		<!--End response_secondary_footer hook-->
				
		</div> <!--end afterfooter-->	
	</div> 
</div>	
	
	<?php endif;?>
	
	<?php wp_footer(); ?>	
</div>  <!--End of footer-->
</body>

</html>