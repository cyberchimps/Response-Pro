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
		->tab(__('Slider Options', 'response-admin'))
			->single_image($themeslug.'_slider_image', __('Slider Image', 'response-admin'), '')
			->text($themeslug.'_slider_text', __('Slider Text', 'response-admin'), __('Enter your slider text here', 'response-admin'))
			->checkbox($themeslug.'_slider_hidetitle', __('Title Bar', 'response-admin'), '', array('std' => 'on'))
			->single_image($themeslug.'_slider_custom_thumb', __('Custom Thumbnail', 'response-admin'), __('Use the image uploader to upload a custom navigation thumbnail', 'response-admin'))
			->sliderhelp('', 'Need Help?', '')
		->end();
		
	$mb = new Chimps_Metabox(__('Carousel', 'response-admin'), __('Featured Post Carousel', 'response-admin'), array('pages' => array($themeslug.'_carousel_images')));
	$mb
		->tab(__('Featured Post Carousel Options', 'response-admin'))
			->single_image($themeslug.'_carousel_image', __('Featured Post Image', 'response-admin'), '')
			->checkbox($themeslug.'_carousel_image_lightbox', __('Lightbox', 'response-admin'), '', array('std' => 'on'))
			->text($themeslug.'_carousel_url', __('Featured Post URL', 'response-admin'), '')
			->reorder($themeslug.'_reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();
		
	$mb = new Chimps_Metabox(__('Portfolio', 'response-admin'), __('Portfolio Element', 'response-admin'), array('pages' => array($themeslug.'_portfolio_images')));
	$mb
		->tab(__('Portfolio Element', 'response-admin'))
			->single_image($themeslug.'_portfolio_image', __('Portfolio Image', 'response-admin'), '')
		->end();

	$mb = new Chimps_Metabox('slides', __('Custom Feature Slides', 'response-admin'), array('pages' => array($themeslug.'_custom_slides')));
	$mb
		->tab(__('Custom Slide Options', 'response-admin'))
			->single_image($themeslug.'_slider_image', __('Image', 'response-admin'), '')
			->text($themeslug.'_slider_url', __('Link', 'response-admin'), '')
			->text($themeslug.'_slider_caption', __('Caption', 'response-admin'), '')
			->checkbox($themeslug.'_slider_hidetitle', __('Title', 'response-admin'), '', array('std' => 'on'))
			->single_image($themeslug.'_slider_custom_thumb', __('Custom Thumbnail', 'response-admin'), '')
			->text($themeslug.'_slider_thumb_text', __('Thumbnail Text', 'response-admin'), '' , array('std' => 'Thumb'))
			->sliderhelp('', 'Need Help?', '')
			->reorder('reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();

	$mb = new Chimps_Metabox('pages', $themenamefull. __('Page Options', 'response-admin'), array('pages' => array('page')));
	$elements = array(
					'page_slider' => __('Feature Slider', 'response-admin'),
					'callout_element' => __('Callout', 'response-admin'),
					'twitterbar_element' => __('Twitter Bar', 'response-admin'),
					'portfolio_element' => __('Portfolio', 'response-admin'),
					'product_element' => __('Product', 'response-admin'),
					'page_element' => __('Page', 'response-admin'),
					'box_element' => __('Boxes', 'response-admin'),
					'breadcrumbs' => __('Breadcrumbs', 'response-admin'),
					'carousel_element' => __('Carousel', 'response-admin')
					);
					
	/* checking whether event plugin is active or not */				
    if(is_plugin_active('the-events-calendar/the-events-calendar.php')) {
		$elements['events_element'] = 'Events'; 
	}	
	
	$mb
		->tab("Page Options")
			->image_select($themeslug.'_page_sidebar', __('Select Page Layout', 'response-admin'), '',  array('options' => array(TEMPLATE_URL . '/library/images/options/right.png' , TEMPLATE_URL . '/library/images/options/left.png', TEMPLATE_URL . '/library/images/options/rightleft.png', TEMPLATE_URL . '/library/images/options/tworight.png', TEMPLATE_URL . '/library/images/options/none.png')))
			->checkbox($themeslug.'_hide_page_title', __('Page Title', 'response-admin'), '', array('std' => 'on'))
			->section_order($themeslug.'_page_section_order', __('Page Elements', 'response-admin'), '', array('options' => $elements, 
					'std' => 'breadcrumbs,page_section'
				))

			->pagehelp('', 'Need Help?', '')
		->tab($themenamefull.__('Slider Options', 'response-admin'))
			->select($themeslug.'_page_slider_type', __('Select Slider Type', 'response-admin'), '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select($themeslug.'_slider_category', __('Custom Slide Category', 'response-admin'), '', array('options' => $slideroptions) )
			->select($themeslug.'_slider_blog_category', __('Blog Post Category', 'response-admin'), '', array('options' => $blogoptions, 'all') )
			->text($themeslug.'_slider_blog_posts_number', __('Number of Featured Blog Posts', 'response-admin'), '', array('std' => '5'))
			->text($themeslug.'_slider_height', __('Slider Height', 'response-admin'), '', array('std' => '340'))
			->text($themeslug.'_slider_delay', __('Slider Delay Time (MS)', 'response-admin'), '', array('std' => '3500'))
			->select($themeslug.'_page_slider_animation', __('Slider Animation Type', 'response-admin'), '', array('options' => array('key1' => __('Horizontal-Push', 'response-admin'), 'key2' => __('Fade', 'response-admin'), 'key3' => __('Horizontal-Slide', 'response-admin'), 'key4' => __('Vertical-Slide', 'response-admin'))))
			->select($themeslug.'_page_slider_navigation_style', 'Slider Navigation Style', '', array('options' => array('key1' => __('Dots', 'response-admin'), 'key2' => __('Image Thumbnails', 'response-admin'), 'key3' => __('Text Thumbnails', 'response-admin'), 'key4' => __('None', 'response-admin'))))
			->select($themeslug.'_page_slider_caption_style', __('Slider Caption Style', 'response-admin'), '', array('options' => array('key1' => __('Bottom', 'response-admin'), 'key2' => __('Right', 'response-admin'), 'key3' => __('Left', 'response-admin'), 'key4' => __('None', 'response-admin'))))
			->checkbox($themeslug.'_slider_arrows', __('Navigation Arrows', 'response-admin'), '', array('std' => 'on'))
			->checkbox($themeslug.'_wp_resize', __('Image Resizing', 'response-admin'), '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab(__('Callout Options', 'response-admin'))
			->textarea($themeslug.'_callout_text', __('Callout Text', 'response-admin'), '')
			->checkbox($themeslug.'_extra_callout_options', __('Custom Callout Options', 'response-admin'), '', array('std' => 'off'))
			->color($themeslug.'_custom_callout_text_color', __('Custom Text Color', 'response-admin'), '')
			->pagehelp('', 'Need help?', '')
		->tab(__('Product Options', 'response-admin'))
			->select($themeslug.'_product_text_align', __('Text Align', 'response-admin'), '', array('options' => array('Left', 'Right')) )
			->text($themeslug.'_product_title', __('Product Title', 'response-admin'), '', array('std' => 'Product'))
			->textarea($themeslug.'_product_text', 'Proudct Text', '', array('std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. '))
			->select($themeslug.'_product_type', __('Media Type', 'response-admin'), '', array('options' => array('Image', 'Video')) )
			->single_image($themeslug.'_product_image', __('Product Image', 'response-admin'), '', array('std' =>  TEMPLATE_URL . '/library/images/pro/product.jpg'))
			->textarea($themeslug.'_product_video', __('Video Embed', 'response-admin'), '')
			->checkbox($themeslug.'_product_link_toggle', __('Product Link', 'response-admin'), '', array('std' => 'on'))
			->text($themeslug.'_product_link_url', __('Link URL', 'response-admin'), '', array('std' => home_url()))
			->text($themeslug.'_product_link_text', __('Link URL', 'response-admin'), '', array('std' => 'Buy Now'))
		->tab(__('Carousel Options', 'response-admin'))
			->select($themeslug.'_carousel_category', __('Carousel Category', 'response-admin'), '', array('options' => $carouseloptions) )
			->text($themeslug.'_carousel_speed', __('Carousel Animation Speed (ms)', 'response-admin') , '', array('std' => '750'))
			->checkbox($themeslug.'_carousel_autoplay', __('Carousel Autoplay', 'response-admin'), '')
			->text($themeslug.'_carousel_autoplay_speed', __('Carousel Autoplay Speed (ms)', 'response-admin') , '', array('std' => '750'))
		->tab(__('Portfolio Options', 'response-admin'))
			->select($themeslug.'_portfolio_row_number', __('Images per row', 'response-admin'), '', array('options' => array('Four (default)', 'Three', 'Two')) )
			->select($themeslug.'_portfolio_category', __('Portfolio Category', 'response-admin'), '', array('options' => $portfoliooptions) )
			->checkbox($themeslug.'_portfolio_title_toggle', __('Portfolio Title', 'response-admin'), '')
			->text($themeslug.'_portfolio_title', __('Title', 'response-admin'), '', array('std' => 'Portfolio'))
		->tab('Twitter Options')
			->text($themeslug.'_twitter_handle', __('Twitter Handle', 'response-admin'), '')
			->checkbox($themeslug.'_twitter_reply', __('Show @ Replies', 'response-admin'), '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}
