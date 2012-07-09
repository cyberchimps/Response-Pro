<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Initializes the response Pro Theme Options
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
* @package response Pro
* @since 3.0
*/

require( get_template_directory() . '/core/classy-options/classy-options-framework/classy-options-framework.php');

add_action('init', 'chimps_init_options');

function chimps_init_options() {

global $options, $themeslug, $themename, $themenamefull;
$options = new ClassyOptions($themename, $themenamefull." Options");

$carouselterms2 = get_terms('carousel_categories', 'hide_empty=0');
	$customcarousel = array();                          
    	foreach($carouselterms2 as $carouselterm) {
        	$customcarousel[$carouselterm->slug] = $carouselterm->name;
        }
        
$portfolioterms2 = get_terms('portfolio_categories', 'hide_empty=0');
	$customportfolio = array();                                   
    	foreach($portfolioterms2 as $portfolioterm) {
        	$customportfolio[$portfolioterm->slug] = $portfolioterm->name;
        }

$customterms2 = get_terms('slide_categories', 'hide_empty=0');
	$customslider = array();                                    
    	foreach($customterms2 as $customterm) {
        	$customslider[$customterm->slug] = $customterm->name;
        }

$terms2 = get_terms('category', 'hide_empty=0');
	$blogoptions = array();                                  
	$blogoptions['all'] = "All";
    	foreach($terms2 as $term) {
        	$blogoptions[$term->slug] = $term->name;
        }

/*  Checking whether "the-events-calendar" plugin is installed or not */
$plugins = get_plugins() ;

if(isset($plugins["the-events-calendar/the-events-calendar.php"]))  /* plugin is installed */
{
	$install_link = "The plugin is allready installed";
}	
else
{		/* plugin is not installed. Display link to install plugin. */
	$install_link = "<a href='".  wp_nonce_url('themes.php?page=install-required-plugins&plugin=the-events-calendar&plugin_name=the-events-calendar&plugin_source=repo&tgmpa-install=install-plugin', 'tgmpa-install') ."'>Click here to install</a>";
}	

$options
	->section(__('Welcome', 'response-admin'))
		->info("<h1>Response Pro</h1>
		
<p><strong>A Responsive Starter WordPress Theme</strong></p>

<p>Response Pro includes a Responsive Design (which magically adjusts to mobile devices such as the iPhone and iPad), Responsive Slider, Drag & Drop Header Elements, Page and Blog Elements, simplified Theme Options, and is built with HTML5 and CSS3.</p>

<p>To get started simply work your way through the options below, add your content, and always remember to hit save after making any changes.</p>

<p>The Response Pro Slider options are under the Response Pro Page Options which are available below the Page content entry area in WP-Admin when you edit a page. This way you can configure each page individually. You will also find the Drag & Drop Page Elements editor within the response Pro Page Options as well.</p>

<p>If you are using the Response Pro Slider on a Page you can upload, and edit your slides from the Feature Slides menu available in the WP-Admin menu. Look for the CyberChimps logo.</p>

<p>We tried to make Response Pro as easy to use as possible, but if you still need help please read the <a href='http://cyberchimps.com/responsepro/docs/' target='_blank'>documentation</a>, and visit our <a href='http://cyberchimps.com/forum/pro/' target='_blank'>support forum</a>.</p>

<p>Thank you for using Response Pro.</p>
")
	->section(__('Design', 'response-admin'))
		->subsection(__('Typography', 'response-admin'))
			->font($themeslug."_font", __('Font setting', 'response-admin'),  array('options' => array("Arial" => "Arial (default)", "Courier New" => "Courier New", "Georgia" => "Georgia", "Helvetica" => "Helvetica", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Actor" => "Actor", "Coda" => "Coda", "Maven+Pro" => "Maven Pro", "Metrophobic" => "Metrophobic", "News+Cycle" => "News Cycle", "Nobile" => "Nobile", "Tenor+Sans" => "Tenor Sans", "Quicksand" => "Quicksand", "Ubuntu" => "Ubuntu", 'custom' => "Custom"), 'size' => '25', 'preview' => 'true'))
			 ->text($themeslug.'_custom_font', __('Enter a Custom Font', 'response-admin'))
			 ->textarea($themeslug.'_typekit', __('TypeKit Code', 'response-admin'))
		->subsection_end()
		->subsection(__('Layout', 'response-admin'))
			->text($themeslug.'_row_max_width', __('Row Max Width', 'response-admin'), array('default' => '1020px'))
		->subsection_end()
		->subsection(__('Custom Colors', 'response-admin'))
			->color($themeslug.'_text_color', __('Text Color', 'response-admin'))
			->color($themeslug.'_sitetitle_color', __('Site Title Color', 'response-admin'))
			->color($themeslug.'_tagline_color', __('Site Description Color', 'response-admin'))
			->color($themeslug.'_link_color', __('Link Color', 'response-admin'))
			->color($themeslug.'_link_hover_color', __('Link Hover Color', 'response-admin'))
			->color($themeslug.'_posttitle_color', __('Post Title Color', 'response-admin'))
		->subsection_end()
			->open_outersection()
				->checkbox($themeslug.'_responsive_video', __('Responsive Videos', 'response-admin'))
			->close_outersection()
			->open_outersection()
				->textarea($themeslug.'_css_options', __('Custom CSS', 'response-admin'))
			->close_outersection()
	->section(__('Header', 'response-admin'))
		->open_outersection()
			->section_order('header_section_order', __('Drag & Drop Header Elements', 'response-admin'), array('options' => array('response_logo_icons' => __('Logo + Icons', 'response-admin'), 'response_sitename_contact' => __('Logo + Contact', 'response-admin'), 'response_description_icons' => __('Description + Icons', 'response-admin'), 'response_logo_menu' => __('Logo + Menu', 'response-admin'), 'response_logo_Description' => __('Logo + Description', 'response-admin'), 'response_header_banner_element' => __('Banner', 'response-admin'), 'response_custom_header_element' => __('Custom', 'response-admin'), 'response_navigation' => __('Menu', 'response-admin'), 'response_logo_register' => __('Logo + Login', 'response-admin')), 'default' => 'response_logo_icons,response_navigation'))
			->textarea($themeslug.'_header_contact', __('Contact Information', 'response-admin'))
			->textarea($themeslug.'_custom_header_element', __('Custom HTML', 'response-admin'))
		->close_outersection()
			->subsection(__('Banner Options', 'response-admin'))
				->select($themeslug.'_header_banner_type', __('Header Banner Type', 'response-admin'), array( 'options' => array('key1' => __('CyberChimps Affilaite', 'response-admin'), 'key2' => __('Image/URL', 'response-admin'), 'key3' => __('Code Embed', 'response-admin'))))
				->images($themeslug.'_header_banner_affiliate_image', __('Affiliate Image', 'response-admin'), array( 'options' => array('key1' => 'http://placehold.it/100x100','key2' => 'http://placehold.it/100x100', 'key3' => 'http://placehold.it/100x100')))
				->text($themeslug.'_header_banner_affiliate_link', __('Affiliate Link', 'response-admin'), array('default' => home_url()))				
				->upload($themeslug.'_header_banner_image', __('Header Banner Image', 'response-admin') , array('default' => array('url' => 'http://placehold.it/150x150')))
				->text($themeslug.'_header_banner_image_url', __('Banner URL', 'response-admin'), array('default' => home_url()))
				->textarea($themeslug.'_header_banner_code_emebed', __('Code Embed', 'response-admin'))
			->subsection_end()		
			->subsection(__('Header Options', 'response-admin'))
				->checkbox($themeslug.'_custom_logo', __('Custom Logo', 'response-admin') , array('default' => true))
			->upload($themeslug.'_logo', __('Logo', 'response-admin'), array('default' => array('url' => TEMPLATE_URL . '/library/images/responseprologo.png')))
			->upload($themeslug.'_favicon', __('Custom Favicon', 'response-admin'))
			->upload($themeslug."_apple_touch", "Apple Touch Icon", array('default' => array('url' => TEMPLATE_URL . '/library/images/apple-icon.png')))
		->subsection_end()
		->subsection(__('Social', 'response-admin'))
			->images($themeslug.'_icon_style', __('Icon set', 'response-admin'), array( 'options' => array('legacy' => TEMPLATE_URL . '/library/images/social/thumbs/icons-classic.png', 'default' =>
TEMPLATE_URL . '/images/social/thumbs/icons-default.png' ), 'default' => 'default' ) )
			->text($themeslug.'_twitter', __('Twitter Icon URL', 'response-admin'), array('default' => 'http://twitter.com'))
			->checkbox($themeslug.'_hide_twitter_icon', __('Hide Twitter Icon', 'response-admin'), array('default' => true))
			->text($themeslug.'_facebook', __('Facebook Icon URL', 'response-admin'), array('default' => 'http://facebook.com'))
			->checkbox($themeslug.'_hide_facebook_icon', __('Hide Facebook Icon', 'response-admin') , array('default' => true))
			->text($themeslug.'_gplus', __('Google + Icon URL', 'response-admin'), array('default' => 'http://plus.google.com'))
			->checkbox($themeslug.'_hide_gplus_icon', __('Hide Google + Icon', 'response-admin') , array('default' => true))
			->text($themeslug.'_flickr', __('Flickr Icon URL', 'response-admin'), array('default' => 'http://flikr.com'))
			->checkbox($themeslug.'_hide_flickr', __('Hide Flickr Icon', 'response-admin'))
			->text($themeslug.'_linkedin', __('LinkedIn Icon URL', 'response-admin'), array('default' => 'http://linkedin.com'))
			->checkbox($themeslug.'_hide_linkedin', __('Hide LinkedIn Icon', 'response-admin'))
			->text($themeslug.'_youtube', __('YouTube Icon URL', 'response-admin'), array('default' => 'http://youtube.com'))
			->checkbox($themeslug.'_hide_youtube', __('Hide YouTube Icon', 'response-admin'))
			->text($themeslug.'_googlemaps', __('Google Maps Icon URL', 'response-admin'), array('default' => 'http://maps.google.com'))
			->checkbox($themeslug.'_hide_googlemaps', __('Hide Google maps Icon', 'response-admin'))
			->text($themeslug.'_email', __('Email Address', 'response-admin'))
			->checkbox($themeslug.'_hide_email', __('Hide Email Icon', 'response-admin'))
			->text($themeslug.'_rsslink', __('RSS Icon URL', 'response-admin'))
			->checkbox($themeslug.'_hide_rss_icon', __('Hide RSS Icon', 'response-admin') , array('default' => true))
		->subsection_end()
		->subsection(__('Tracking and Scripts', 'response-admin'))
			->textarea($themeslug.'_ga_code', __('Google Analytics Code', 'response-admin'))
			->textarea($themeslug.'_custom_header_scripts', __('Custom Header Scripts', 'response-admin'))
		->subsection_end()
	->section(__('Blog', 'response-admin'))
		->open_outersection()
			->section_order($themeslug.'_blog_section_order', __('Drag & Drop Blog Elements', 'response-admin'), array('options' => array('response_index' => __('Post Page', 'response-admin'),'response_magazine_element' => __('Magazine Layout', 'response-admin'), 'response_blog_slider' => __('Feature Slider', 'response-admin'),  'response_callout_element' => __('Callout', 'response-admin'), 'response_twitterbar_element' => __('Twitter Bar', 'response-admin'), 'response_portfolio_element' => __('Portfolio', 'response-admin'), 'response_carousel_element' => __('Carousel', 'response-admin'), 'response_box_element' => __('Boxes', 'response-admin')), 'default' => 'response_index'))
		->close_outersection()
		->subsection(__('Blog Options', 'response-admin'))
			->images($themeslug.'_blog_sidebar', __('Sidebar Options', 'response-admin'), array( 'options' => array('none' => TEMPLATE_URL . '/library/images/options/none.png','two-right' => TEMPLATE_URL . '/library/images/options/tworight.png', 'right-left' => TEMPLATE_URL . '/library/images/options/rightleft.png', 'left' => TEMPLATE_URL . '/library/images/options/left.png',  'right' => TEMPLATE_URL . '/library/images/options/right.png'), 'default' => 'right'))
			->checkbox($themeslug.'_post_formats', __('Post Format Icons', 'response-admin'),  array('default' => true))
			->checkbox($themeslug.'_show_excerpts', __('Post Excerpts', 'response-admin'))
			->text($themeslug.'_excerpt_link_text', __('Excerpt Link Text', 'response-admin'), array('default' => '(More)…'))
			->text($themeslug.'_excerpt_length', __('Excerpt Character Length', 'response-admin'), array('default' => '55'))
			->checkbox($themeslug.'_show_featured_images', __('Featured Images', 'response-admin'))
			->select($themeslug.'_featured_image_align', __('Featured Image Alignment', 'response-admin'), array( 'options' => array('key1' => 'Left', 'key2' => 'Center', 'key3' => 'Right')))
			->text($themeslug.'_featured_image_height', __('Featured Image Height', 'response-admin'), array('default' => '100'))
			->text($themeslug.'_featured_image_width', __('Featured Image Width', 'response-admin'), array('default' => '100'))	
			->multicheck($themeslug.'_hide_byline', __('Post Byline Elements', 'response-admin'), array( 'options' => array($themeslug.'_hide_author' => __('Author', 'response-admin') , $themeslug.'_hide_categories' => __('Categories', 'response-admin'), $themeslug.'_hide_date' => __('Date', 'response-admin'), $themeslug.'_hide_comments' => __('Comments', 'response-admin'),  $themeslug.'_hide_tags' => __('Tags', 'response-admin')), 'default' => array( $themeslug.'_hide_tags' => true, $themeslug.'_hide_author' => true, $themeslug.'_hide_date' => true, $themeslug.'_hide_comments' => true, $themeslug.'_hide_categories' => true ) ) )		
		->subsection_end()
		->subsection(__('Feature Slider', 'response-admin'))
			->select($themeslug.'_slider_type', __('Slider Type', 'response-admin'), array( 'options' => array('posts' => __('posts', 'response-admin'), 'custom' => __('custom', 'response-admin'))))
			->select($themeslug.'_slider_category', __('Post Category', 'response-admin'), array( 'options' => $blogoptions ))
			->select($themeslug.'_customslider_category', __('Custom Slide Category', 'response-admin'), array( 'options' => $customslider ))
			->text($themeslug.'_slider_posts_number', __('Number of Featured Blog Posts', 'response-admin'), array('default' => '5'))
			->text($themeslug.'_slider_height', __('Slider height', 'response-admin'), array('default' => '340'))
			->text($themeslug.'_slider_delay', __('Slider Delay', 'response-admin'), array('default' => '3500'))
			->select($themeslug.'_slider_animation', __('Sidebar Animation', 'response-admin'), array( 'options' => array('key1' => __('Horizontal-Push', 'response-admin'), 'key2' => __('Fade', 'response-admin'), 'key3' => __('Horizontal-Slide', 'response-admin'), 'key4' => __('Vertical-Slide', 'response-admin'))))
			->select($themeslug.'_caption_style', __('Caption Style', 'response-admin'), array( 'options' => array('key1' => __('Bottom', 'response-admin'), 'key2' => __('Right', 'response-admin'), 'key3' => __('Left', 'response-admin'), 'key4' => __('None', 'response-admin'))))	
			->select($themeslug.'_caption_animation', __('Caption Animation', 'response-admin'), array( 'options' => array('key1' => __('Fade', 'response-admin'), 'key2' => __('Slide Open', 'response-admin'), 'key3' => __('None', 'response-admin'))))
			->select($themeslug.'_slider_nav', __('Slider Navigation', 'response-admin'), array( 'options' => array('key1' => __('Dots', 'response-admin'), 'key2' => __('Image Thumbnails', 'response-admin'), 'key3' => __('Text Thumbnails', 'response-admin'), 'key4' => __('None', 'response-admin'))))
			->checkbox($themeslug.'_hide_slider_arrows', __('Slider Arrows', 'response-admin'), array('default' => true))
			->checkbox($themeslug.'_image_resize', __('Image Resizing', 'response-admin'))
		->subsection_end()
		->subsection(__('Callout Options', 'response-admin'))
			->textarea($themeslug.'_blog_callout_text', __('Enter your Callout text','response-admin'))
			->checkbox($themeslug.'_blog_custom_callout_options', __('Custom Callout Options', 'response-admin'))
			->color($themeslug.'_blog_callout_text_color', __('Custom Callout Text Color', 'response-admin'))
		->subsection_end()
		->subsection(__('Twitterbar Options', 'response-admin'))
			->text($themeslug.'_blog_twitter', __('Enter your Twitter handle', 'response-admin'))
			->checkbox($themeslug.'_blog_twitter_reply', __('Show @ Replies', 'response-admin'))
		->subsection_end()
		->subsection(__('Portfolio Options', 'response-admin'))
			->select($themeslug.'_portfolio_number', __('Images Per Row', 'response-admin'), array( 'options' => array('key1' => __('Four (default)', 'response-admin') , 'key2' => __('Three', 'response-admin'), 'key3' => __('Two', 'response-admin'))))
			->select($themeslug.'_portfolio_category', 'Portfolio Category', array( 'options' => $customportfolio ))
			->checkbox($themeslug.'_portfolio_title_toggle', __('Portfolio Title', 'response-admin'))
			->text($themeslug.'_portfolio_title', __('Title', 'response-admin'), array('default' => __('Portfolio', 'response-admin')))
		->subsection_end()
		->subsection(__('Carousel Options', 'response-admin'))
			->select($themeslug.'_carousel_category', __('Select the carousel category', 'response-admin'), array( 'options' => $customcarousel ))
			->text($themeslug.'_carousel_speed', __('Carousel Animation Speed (ms)', 'response-admin'), array('default' => '750'))
			->checkbox($themeslug.'_carousel_autoplay', __('Carousel Autoplay', 'response-admin'))
		->subsection_end()
	->section(__('Templates', 'response-admin'))
		->subsection(__('Single Post', 'response-admin'))
			->section_order($themeslug.'_single_section_order', __('Drag & Drop Elements', 'response-admin'), array('options' => array('response_index' => __('Post Page', 'response-admin'),'response_breadcrumbs' => __('Breadcrumbs', 'response-admin'), 'response_single_banner_element' => __('Banner', 'response-admin')), 'default' => 'response_index'))
			->images($themeslug.'_single_sidebar', __('Sidebar Options', 'response-admin'), array( 'options' => array('left' => TEMPLATE_URL . '/library/images/options/left.png', 'two-right' => TEMPLATE_URL . '/library/images/options/tworight.png', 'right-left' => TEMPLATE_URL . '/library/images/options/rightleft.png', 'none' => TEMPLATE_URL . '/library/images/options/none.png', 'right' => TEMPLATE_URL . '/library/images/options/right.png'), 'default' => 'right'))
			->subsection(__('Banner Options', 'response-admin'))
				->select($themeslug.'_single_banner_type', __('single Banner Type', 'response-admin'), array( 'options' => array('key1' => __('CyberChimps Affilaite', 'response-admin'), 'key2' => __('Image/URL', 'response-admin'), 'key3' => __('Code Embed', 'response-admin'))))
				->images($themeslug.'_single_banner_affiliate_image', __('Affiliate Image', 'response-admin'), array( 'options' => array('key1' => 'http://placehold.it/100x100','key2' => 'http://placehold.it/100x100', 'key3' => 'http://placehold.it/100x100')))
				->text($themeslug.'_single_banner_affiliate_link', __('Affiliate Link', 'response-admin'), array('default' => home_url()))				
				->upload($themeslug.'_single_banner_image', __('Single Banner Image', 'response-admin') , array('default' => array('url' => 'http://placehold.it/150x150')))
				->text($themeslug.'_single_banner_image_url', __('Banner URL', 'response-admin'), array('default' => home_url()))
				->textarea($themeslug.'_single_banner_code_emebed', __('Code Embed', 'response-admin'))
			->subsection_end()		
			->checkbox($themeslug.'_single_show_featured_images', __('Featured Images', 'response-admin'))
			->checkbox($themeslug.'_single_post_formats', __('Post Format Icons', 'response-admin'),  array('default' => true))
			->multicheck($themeslug.'_single_hide_byline', __('Post Byline Elements', 'response-admin'), array( 'options' => array($themeslug.'_hide_author' => __('Author', 'response-admin') , $themeslug.'_hide_categories' => __('Categories', 'response-admin'), $themeslug.'_hide_date' => __('Date', 'response-admin'), $themeslug.'_hide_comments' => __('Comments', 'response-admin'), $themeslug.'_hide_share' => __('Share', 'response-admin'), $themeslug.'_hide_tags' => __('Tags', 'response-admin')), 'default' => array( $themeslug.'_hide_tags' => true, $themeslug.'_hide_share' => true, $themeslug.'_hide_author' => true, $themeslug.'_hide_date' => true, $themeslug.'_hide_comments' => true, $themeslug.'_hide_categories' => true ) ) )
			->checkbox($themeslug.'_post_pagination', __('Post Pagination Links', 'response-admin'),  array('default' => true))
		->subsection_end()	
		->subsection(__('Archive', 'response-admin'))
			->section_order($themeslug.'_archive_section_order', __('Drag & Drop Elements', 'response-admin'), array('options' => array('response_index' => __('Post Page', 'response-admin'),'response_breadcrumbs' => __('Breadcrumbs', 'response-admin')), 'default' => 'response_index'))
			->images($themeslug.'_archive_sidebar', __('Sidebar Options', 'response-admin'), array( 'options' => array('left' => TEMPLATE_URL . '/library/images/options/left.png', 'two-right' => TEMPLATE_URL . '/library//images/options/tworight.png', 'right-left' => TEMPLATE_URL . '/library/images/options/rightleft.png', 'none' => TEMPLATE_URL . '/library/images/options/none.png', 'right' => TEMPLATE_URL . '/library/images/options/right.png'), 'default' => 'right'))
			->checkbox($themeslug.'_archive_show_excerpts', __('Post Excerpts', 'response-admin'), array('default' => true))
			->checkbox($themeslug.'_archive_show_featured_images', __('Featured Images', 'response-admin'))
			->checkbox($themeslug.'_archive_post_formats', __('Post Format Icons', 'response-admin'),  array('default' => true))
			->multicheck($themeslug.'_archive_hide_byline', __('Post Byline Elements', 'response-admin'), array( 'options' => array($themeslug.'_hide_author' => __('Author', 'response-admin') , $themeslug.'_hide_categories' => __('Categories', 'response-admin'), $themeslug.'_hide_date' => __('Date', 'response-admin'), $themeslug.'_hide_comments' => __('Comments', 'response-admin'), $themeslug.'_hide_share' => __('Share', 'response-admin'), $themeslug.'_hide_tags' => __('Tags', 'response-admin')), 'default' => array( $themeslug.'_hide_tags' => true, $themeslug.'_hide_share' => true, $themeslug.'_hide_author' => true, $themeslug.'_hide_date' => true, $themeslug.'_hide_comments' => true, $themeslug.'_hide_categories' => true ) ) )
			->subsection_end()
		->subsection(__('Search', 'response-admin'))
			->images($themeslug.'_search_sidebar', __('Sidebar Options', 'response-admin'), array( 'options' => array('left' => TEMPLATE_URL . '/library/images/options/left.png', 'two-right' => TEMPLATE_URL . '/library/images/options/tworight.png', 'right-left' => TEMPLATE_URL . '/library/images/options/rightleft.png', 'none' => TEMPLATE_URL . '/library/images/options/none.png', 'right' => TEMPLATE_URL . '/library/images/options/right.png'), 'default' => 'right'))
			->checkbox($themeslug.'_search_show_excerpts', 'Post Excerpts', array('default' => true))
		->subsection_end()
		->subsection(__('404', 'response-admin'))
			->images($themeslug.'_404_sidebar', __('Select the Sidebar Type', 'response-admin'), array( 'options' => array('left' => TEMPLATE_URL . '/library/images/options/left.png', 'two-right' => TEMPLATE_URL . '/library/images/options/tworight.png', 'right-left' => TEMPLATE_URL . '/library/images/options/rightleft.png', 'none' => TEMPLATE_URL . '/library/images/options/none.png', 'right' => TEMPLATE_URL . '/library/images/options/right.png'), 'default' => 'right'))
			->textarea($themeslug.'_custom_404', __('Custom 404 Content', 'response-admin'))
		->subsection_end()
	->section(__('Footer', 'response-admin'))
		->open_outersection()
			->section_order($themeslug.'_footer_section_order', __('Drag & Drop Elements', 'response-admin'), array('options' => array('response_footer_element' => __('Footer', 'response-admin'),'response_afterfooter_element' => __('Afterfooter', 'response-admin'), 'response_footer_banner_element' => __('Banner', 'response-admin')), 'default' => 'response_footer_element,response_banner_element'))
		->close_outersection()
		->subsection(__('Footer Options', 'response-admin'))
			->text($themeslug.'_footer_copyright_text', __('Footer Copyright Text', 'response-admin'))
			->checkbox($themeslug.'_hide_link', __('CyberChimps Link', 'response-admin'), array('default' => true))
		->subsection_end()	
		->subsection(__('Banner Options', 'response-admin'))
				->select($themeslug.'_footer_banner_type', __('footer Banner Type', 'response-admin'), array( 'options' => array('key1' => __('CyberChimps Affilaite', 'response-admin'), 'key2' => __('Image/URL', 'response-admin'), 'key3' => __('Code Embed', 'response-admin'))))
				->images($themeslug.'_footer_banner_affiliate_image', __('Affiliate Image', 'response-admin'), array( 'options' => array('key1' => 'http://placehold.it/100x100','key2' => 'http://placehold.it/100x100', 'key3' => 'http://placehold.it/100x100')))
				->text($themeslug.'_footer_banner_affiliate_link', __('Affiliate Link', 'response-admin'), array('default' => home_url()))				
				->upload($themeslug.'_footer_banner_image', __('Footer Banner Image', 'response-admin') , array('default' => array('url' => 'http://placehold.it/150x150')))
				->text($themeslug.'_footer_banner_image_url', __('Banner URL', 'response-admin'), array('default' => home_url()))
				->textarea($themeslug.'_footer_banner_code_emebed', __('Code Embed', 'response-admin'))
			->subsection_end()	
	->section(__('Banners',  'response-admin'))
		->info('Placeholder for Banners/Affilaite info. ')
	->section(__('Events',  'response-admin'))
		->info("Info about events calendar will go here<br/>". $install_link)
	->section(__('Import / Export',  'response-admin'))
		->open_outersection()
			->export(__('Export Settings', 'response-admin'))
			->import(__('Import Settings', 'response-admin'))
		->close_outersection()
;
}