<?php
/**
* Custom actions used by the response Pro WordPress Theme
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimpscom/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response Pro
* @since 3.0
*/

/**
* response Actions
*/

add_action( 'response_header_content', 'response_header_standard_content');


add_action( 'response_sitename_contact', 'response_sitename_contact_content');
add_action( 'response_description_icons', 'response_description_icons_content');
add_action( 'response_logo_menu', 'response_logo_menu_content');
add_action( 'response_logo_description', 'response_logo_description_content');
add_action( 'response_banner', 'response_banner_content');
add_action( 'response_icons', 'response_icons_content');


/**
* Sitename/Contact
*
* @since 3.0
*/
function response_sitename_contact_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="five columns">
			
			<!-- Begin @Core header contact area hook -->
			<?php response_header_contact_area(); ?>
		<!-- End @Core header contact area hook -->
						
			</div>	
		</div><!--end row-->
	</div>
	
<?php
}

/**
* Full-Width Logo
*
* @since 3.0
*/
function response_banner_content() {
global $themeslug, $options, $root; //Call global variables
$banner = $options->get($themeslug.'_banner'); //Calls the logo URL from the theme options
$default = "$root/images/pro/banner.jpg";

?>
	<div class="container">
		<div class="row">
		
			<div class="twelve columns">
			<div id="banner">
			
			<?php if ($banner != ""):?>
				<a href="<?php echo home_url(); ?>/"><img src="<?php echo stripslashes($banner['url']); ?>" alt="logo"></a>		
			<?php endif; ?>
			
			<?php if ($banner == ""):?>
				<a href="<?php echo home_url(); ?>/"><img src="<?php echo $default; ?>" alt="logo"></a>		
			<?php endif; ?>
			
			</div>		
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* Full-Width Icons
*
* @since 3.0
*/
function response_icons_content() {
global $themeslug, $options, $root; //Call global variables
$banner = $options->get($themeslug.'_banner'); //Calls the logo URL from the theme options
$default = "$root/images/pro/banner.jpg";

?>
	<div class="container">
		<div class="row">
		
			<div class="twelve columns">
			
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	

			
			</div>	
		</div><!--end row-->
	</div>	

<?php
}


/**
* Logo/Description
*
* @since 3.0
*/
function response_logo_description_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
			<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
			<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div class="five columns" style="text-align: right;">
			
			<!-- Begin @Core header description hook -->
				<?php response_header_site_description(); ?> 
			<!-- End @Core header description hook -->
						
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* Description/Icons
*
* @since 3.0
*/
function response_description_icons_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="five columns">
				
			<!-- Begin @Core header description hook -->
				<?php response_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			
				
			</div>	
			
			<div class="seven columns">
			
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
						
			</div>	
		</div><!--end row-->
	</div>	

<?php
}

/**
* Description/Icons
*
* @since 3.0
*/
function response_logo_menu_content() {
?>
	
	<div class="container">
		<div class="row">	
			
			<div class="five columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
			</div>	
			
			<div class="seven columns">
			<div id="halfnav">
			<?php wp_nav_menu( array(
		    'theme_location' => 'sub-menu' // Setting up the location for the main-menu, Main Navigation.
			    )
			);
	    	?>
			</div>					
			</div>	
		
		</div><!--end row-->
	</div>
<?php
}

/**
* Header content standard
*
* @since 3.0
*/
function response_header_standard_content() {
?>
	<div class="container">
		<div class="row">
		
			<div class="seven columns">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
				
			</div>	
			
			<div id ="register" class="five columns">
				
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
				
			</div>	
		</div><!--end row-->
	</div>

<?php
}

?>