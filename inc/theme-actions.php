<?php
/**
* Custom actions used by the iFeature Pro WordPress Theme
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
* @package iFeature Pro
* @since 3.0
*/


/**
* Header content standard
*
* @since 1.0
*/





/**
* Header content extra
*
* @since 3.0
*/
function ifeature_header_extra_content() {
global $options, $themeslug;?>
	
	<div class="container">
		<div class="row">
		
		<div class="sixcol">
				
			<!-- Begin @Core header sitename hook -->
				<?php chimps_header_sitename(); ?> 
			<!-- End @Core header sitename hook -->
				
		</div>	
			
				<div id="header_contact" class="sixcol last">
				&nbsp;
			<?php if ($options->get($themeslug.'_enable_header_contact') == '1'	): ?>

		<!-- Begin @Core header contact area hook -->
			<?php chimps_header_contact_area(); ?>
		<!-- End @Core header contact area hook -->
					<?php endif ; ?>
		</div>	
		
		</div><!--end row-->	
	</div><!--end container-->
		
	<div class="container" id="head2">
		<div class="row">
				
		<div class="sixcol">
		&nbsp;
			<?php if ($options->get($themeslug.'_show_description') == '1'	): ?>
			<!-- Begin @Core header description hook -->
				<?php chimps_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			<?php endif; ?>
		</div>
			
		<div class="sixcol last">
			
			<!-- Begin @Core header social icon hook -->
				<?php chimps_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
				
		</div>
			
		</div><!--end row-->	
	</div><!--end container-->

<?php
}

/**
* Define header contact based on theme options
*
* @since 3.0
*/
function ifeature_header_content_init() {
	global $options, $themeslug;
	
	if ($options->get($themeslug.'_enable_header_contact') != '1' && $options->get($themeslug.'_show_description') != '1') {
	
			add_action( 'ifeature_header_content', 'ifeature_header_standard_content');
	}
	
	if ($options->get($themeslug.'_enable_header_contact') == '1' OR $options->get($themeslug.'_show_description') == '1') {
	
			add_action( 'ifeature_header_content', 'ifeature_header_extra_content');
	}
}

