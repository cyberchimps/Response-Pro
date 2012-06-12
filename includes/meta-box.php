<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/********************* BEGIN DEFINITION OF META BOXES ***********************/

add_action('init', 'initialize_the_meta_boxes');

function initialize_the_meta_boxes() {

	global  $themename, $themeslug, $themenamefull, $options; // call globals.
	
	// Call taxonomies for select options
	
	$portfolioterms = get_terms('portfolio_categories', 'hide_empty=0');
	$portfoliooptions = array();

		foreach($portfolioterms as $term) {
			$portfoliooptions[$term->slug] = $term->name;
		}

	
	$carouselterms = get_terms('carousel_categories', 'hide_empty=0');
	$carouseloptions = array();

		foreach($carouselterms as $term) {
			$carouseloptions[$term->slug] = $term->name;
		}

	$terms = get_terms('slide_categories', 'hide_empty=0');
	$slideroptions = array();

		foreach($terms as $term) {
			$slideroptions[$term->slug] = $term->name;
		}

	$terms2 = get_terms('category', 'hide_empty=0');
	$blogoptions = array();
	$blogoptions['all'] = "All";

		foreach($terms2 as $term) {
			$blogoptions[$term->slug] = $term->name;
		}
	
	// End taxonomy call
	
	$meta_boxes = array();

	$mb = new Chimps_Metabox('post_slide_options', $themenamefull.' Slider Options', array('pages' => array('post')));
	$mb
		->tab("Slider Options")
			->single_image($themeslug.'_slider_image', 'Slider Image', '')
			->text($themeslug.'_slider_text', 'Slider Text', 'Enter your slider text here')
			->checkbox($themeslug.'_slider_hidetitle', 'Title Bar', '', array('std' => 'on'))
			->single_image($themeslug.'_slider_custom_thumb', 'Custom Thumbnail', 'Use the image uploader to upload a custom navigation thumbnail')
			->sliderhelp('', 'Need Help?', '')
		->end();
		
	$mb = new Chimps_Metabox('Carousel', 'Featured Post Carousel', array('pages' => array($themeslug.'_featured_posts')));
	$mb
		->tab("Featured Post Carousel Options")
			->text($themeslug.'_post_title', 'Featured Post Title', '')
			->single_image($themeslug.'_post_image', 'Featured Post Image', '')
			->text($themeslug.'_post_url', 'Featured Post URL', '')
			->reorder($themeslug.'_reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();
		
	$mb = new Chimps_Metabox('Portfolio', 'Portfolio Element', array('pages' => array($themeslug.'_portfolio_images')));
	$mb
		->tab("Portfolio Element")
			->single_image($themeslug.'_portfolio_image', 'Portfolio Image', '')
		->end();

	$mb = new Chimps_Metabox('slides', 'Custom Feature Slides', array('pages' => array($themeslug.'_custom_slides')));
	$mb
		->tab("Custom Slide Options")
			->single_image($themeslug.'_slider_image', 'Image', '')
			->text($themeslug.'_slider_url', 'Link', '')
			->text($themeslug.'_slider_caption', 'Caption', '')
			->checkbox($themeslug.'_slider_hidetitle', 'Title', '', array('std' => 'on'))
			->single_image($themeslug.'_slider_custom_thumb', 'Custom Thumbnail', '')
			->text($themeslug.'_slider_thumb_text', 'Thumbnail Text', '' , array('std' => 'Thumb'))
			->sliderhelp('', 'Need Help?', '')
			->reorder('reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();

	$mb = new Chimps_Metabox('pages', $themenamefull.' Page Options', array('pages' => array('page')));
	$elements = array(
					'page_slider' => 'Feature Slider',
					'callout_element' => 'Callout',
					'twitterbar_element' => 'Twitter Bar',
					'portfolio_element' => 'Portfolio',
					'page_section' => 'Page',
					'box_element' => 'Boxes',
					'breadcrumbs' => 'Breadcrumbs',
					'carousel_element' => 'Carousel'
					);
					
	/* checking whether event plugin is active or not */				
    if(is_plugin_active('eventstrunk1228/the-events-calendar.php')) {
		$elements['events_element'] = 'Events'; 
	}	
	
	$mb
		->tab("Page Options")
			->image_select($themeslug.'_page_sidebar', 'Select Page Layout', '',  array('options' => array(TEMPLATE_URL . '/library/images/options/right.png' , TEMPLATE_URL . '/library/images/options/left.png', TEMPLATE_URL . '/library/images/options/rightleft.png', TEMPLATE_URL . '/library/images/options/tworight.png', TEMPLATE_URL . '/library/images/options/none.png')))
			->checkbox($themeslug.'_hide_page_title', 'Page Title', '', array('std' => 'on'))
			->section_order($themeslug.'_page_section_order', 'Page Elements', '', array('options' => $elements, 
					'std' => 'breadcrumbs,page_section'
				))

			->pagehelp('', 'Need Help?', '')
		->tab($themenamefull." Slider Options")
			->select($themeslug.'_page_slider_type', 'Select Slider Type', '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select($themeslug.'_slider_category', 'Custom Slide Category', '', array('options' => $slideroptions) )
			->select($themeslug.'_slider_blog_category', 'Blog Post Category', '', array('options' => $blogoptions, 'all') )
			->text($themeslug.'_slider_blog_posts_number', 'Number of Featured Blog Posts', '', array('std' => '5'))
			->text($themeslug.'_slider_height', 'Slider Height', '', array('std' => '340'))
			->text($themeslug.'_slider_delay', 'Slider Delay Time (MS)', '', array('std' => '3500'))
			->select($themeslug.'_page_slider_animation', 'Slider Animation Type', '', array('options' => array("key1" => "Horizontal-Push", "key2" => "Fade", "key3" => "Horizontal-Slide", "key4" => "Vertical-Slide")) )
			->select($themeslug.'_page_slider_navigation_style', 'Slider Navigation Style', '', array('options' => array("key1" => "Dots", "key2" => "Image Thumbnails", "key3" => "Text Thumbnails", "key4" => "None")) )
			->select($themeslug.'_page_slider_caption_style', 'Slider Caption Style', '', array('options' => array("key1" => "Bottom", "key2" => "Right", "key3" => "Left", "key4" => "None")) )
			->checkbox($themeslug.'_slider_arrows', 'Navigation Arrows', '', array('std' => 'on'))
			->checkbox($themeslug.'_wp_resize', 'Image Resizing', '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab("Callout Options")
			->textarea($themeslug.'_callout_text', 'Callout Text', '')
			->checkbox($themeslug.'_extra_callout_options', 'Custom Callout Options', '', array('std' => 'off'))
			->color($themeslug.'_custom_callout_text_color', 'Custom Text Color', '')
			->pagehelp('', 'Need help?', '')
		->tab("Carousel Options")
			->select($themeslug.'_carousel_category', 'Carousel Category', '', array('options' => $carouseloptions) )
			->text($themeslug.'_carousel_speed', 'Carousel Animation Speed (ms)', '', array('std' => '750'))
		->tab("Portfolio Options")
			->select($themeslug.'_portfolio_row_number', 'Images per row', '', array('options' => array('Four (default)', 'Three', 'Two')) )
			->select($themeslug.'_portfolio_category', 'Portfolio Category', '', array('options' => $portfoliooptions) )
			->checkbox($themeslug.'_portfolio_title_toggle', 'Portfolio Title', '')
			->text($themeslug.'_portfolio_title', 'Title', '', array('std' => 'Portfolio'))
		->tab("Twitter Options")
			->text($themeslug.'_twitter_handle', 'Twitter Handle', '')
			->checkbox($themeslug.'_twitter_reply', 'Show @ Replies', '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}
