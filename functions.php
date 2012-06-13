<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;

/**
* Theme functions used by the Response Starter Theme.
*
* Authors: Tyler Cunningham
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

/**
* Define global theme functions.
*/ 
	$themename = 'response';
	$themenamefull = 'Response';
	$themeslug = 're';
	$pagedocs = 'http://cyberchimps.com/question/using-the-response-page-options/';
	$sliderdocs = 'http://cyberchimps.com/question/how-to-use-the-response-slider/';
	$root = get_template_directory_uri(); 
	
/**
* Basic theme setup.
*/ 
function response_theme_setup() {
	if ( ! isset( $content_width ) ) $content_width = 608; //Set content width
	
	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);

	add_theme_support( 'post-thumbnails' );    
    if ( function_exists( 'add_image_size' ) ) { 
        add_image_size( 'featured-thumb', 100, 80);
        add_image_size( 'headline-thumb', 200, 225, true);
    }       
	add_theme_support('automatic-feed-links');
	add_editor_style();
	
	if ( function_exists('get_custom_header')) {
        add_theme_support('custom-background');
	} 
	else {
       	add_custom_background(); //For WP 3.3 and below.	
	}
}
add_action( 'after_setup_theme', 'response_theme_setup' );

/**
* Redirect user to theme options page after activation.
*/ 
if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
	wp_redirect( 'themes.php?page=response' );
}

/**
* Add link to theme options in Admin bar.
*/ 
function response_admin_link() {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'Response', 'title' => 'Response Options', 'href' => admin_url('themes.php?page=response')  ) ); 
}
add_action( 'admin_bar_menu', 'response_admin_link', 113 );

/**
* Custom markup for gallery posts in main blog index.
*/ 
function response_custom_gallery_post_format( $content ) {
	global $options, $themeslug, $post;
	$root = get_template_directory_uri(); 
	
	ob_start();?>
	
		<?php if ($options->get($themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/library/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<!--Call @Core Meta hook-->
			<?php response_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
				
				<?php if (!is_single()): ?>
				<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					<br /><br />
					This gallery contains <?php echo $total_images ; ?> images
					<?php endif;?>
				</figure><!-- .gallery-thumb -->
				<?php endif;?>
				
				<?php if (is_single()): ?>
					<?php the_content(); ?>
				<?php endif;?>
				</div><!--end entry-->

				<div style=clear:both;></div>
	<?php	
	$content = ob_get_clean();
	
	return $content;
}
add_filter('response_post_formats_gallery_content', 'response_custom_gallery_post_format' ); 
	
/**
* Set custom post excerpt link text based on theme option.
*/ 
function response_excerpt_link($more) {

	global $themename, $themeslug, $options, $post;
    
    	if ($options->get($themeslug.'_excerpt_link_text') == '') {
    		$linktext = '(Read More...)';
   		}
    	else {
    		$linktext = $options->get($themeslug.'_excerpt_link_text');
   		}

	return '<a href="'. get_permalink($post->ID) . '"> <br /><br /> '.$linktext.'</a>';
}
add_filter('excerpt_more', 'response_excerpt_link');

/**
* Set custom post excerpt length based on theme option.
*/ 
function response_excerpt_length($length) {

	global $themename, $themeslug, $options;
	
		if ($options->get($themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    	else {
    		$length = $options->get($themeslug.'_excerpt_length');
    	}
    	
	return $length;
}
add_filter('excerpt_length', 'response_excerpt_length');

/* Prepares a 'Read the full story' link for post excerpts */
function response_read_full_story_link() {
	return '</p><p><a href="'. get_permalink() . '">' . 'Read the full story &raquo;' . '</a></p>';
}

/* Replaces [...] for ... in post excerpts and appends response_read_full_story_link() */
if(!function_exists('response_excerpt_more')){
    function response_excerpt_more($more) {
        return ' &hellip;' . response_read_full_story_link();
    }
}
/* add_filter('excerpt_more', 'response_excerpt_more'); */

/**
* Custom featured image size based on theme options.
*/ 
function response_featured_image() {	
	if ( function_exists( 'add_theme_support' ) ) {
	
	global $themename, $themeslug, $options;
	
	if ($options->get($themeslug.'_featured_image_height') == '') {
		$featureheight = '100';
	}		
	else {
		$featureheight = $options->get($themeslug.'_featured_image_height'); 
	}
	if ($options->get($themeslug.'_featured_image_width') == "") {
			$featurewidth = '100';
	}		
	else {
		$featurewidth = $options->get($themeslug.'_featured_image_width'); 
	} 
	set_post_thumbnail_size( $featurewidth, $featureheight, true );
	}	
}
add_action( 'init', 'response_featured_image', 11);	

/**
* Custom post types for Slider, Carousel.
*/ 
function create_post_type() {

	global $themename, $themeslug, $options, $root;
	
	register_post_type( $themeslug.'_custom_slides',
		array(
			'labels' => array(
				'name' => __( 'Feature Slides' ),
				'singular_name' => __( 'Slides' )
			),
			'public' => true,
			'show_ui' => true, 
			'supports' => array('custom-fields', 'title'),
			'taxonomies' => array( 'slide_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/library/images/pro/slider.png",
			'rewrite' => array('slug' => 'slides')
		)
	);
	
	register_post_type( $themeslug.'_carousel_images',
		array(
			'labels' => array(
				'name' => __( 'Image Carousel' ),
				'singular_name' => __( 'Carousel' )
			),
			'public' => true,
			'show_ui' => true, 
			'supports' => array('custom-fields', 'title' ),
			'taxonomies' => array( 'carousel_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/library/images/pro/carousel.png",
			'rewrite' => array('slug' => 'carousel_images')
		)
	);
	
	register_post_type( $themeslug.'_portfolio_images',
		array(
			'labels' => array(
				'name' => __( 'Portfolio' ),
				'singular_name' => __( 'Images' )
			),
			'public' => true,
			'show_ui' => true, 
			'supports' => array('custom-fields', 'title'),
			'taxonomies' => array( 'portfolio_categories'),
			'has_archive' => true,
			'menu_icon' => "$root/library/images/pro/portfolio.png",
			'rewrite' => array('slug' => 'portfolio_images')
		)
	);

}
add_action( 'init', 'create_post_type' );

/**
* Custom taxonomies for Slider, Carousel.
*/ 
function custom_taxonomies() {

	global $themename, $themeslug, $options;
	
	register_taxonomy(
		'slide_categories',		
		$themeslug.'_custom_slides',		
		array(
			'hierarchical' => true,
			'label' => 'Slide Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'slide_categories' ),	
		)
	);
	register_taxonomy(
		'carousel_categories',		
		$themeslug.'_carousel_categories',		
		array(
			'hierarchical' => true,
			'label' => 'Carousel Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'carousel_categories' ),	
		)
	);
	register_taxonomy(
		'portfolio_categories',		
		$themeslug.'_portfolio_categories',		
		array(
			'hierarchical' => true,
			'label' => 'Portfolio Categories',	
			'query_var' => true,	
			'rewrite' => array( 'slug' => 'portfolio_categories' ),	
		)
	);
}
add_action('init', 'custom_taxonomies', 0);

/**
* Assign default category for Slider, Carousel posts.
*/ 
function custom_taxonomy_default( $post_id, $post ) {

	global $themename, $themeslug, $options;	

	if( 'publish' === $post->post_status ) {

		$defaults = array(

			'slide_categories' => array( 'default' ), 'carousel_categories' => array( 'default' ), 'portfolio_categories' => array( 'default' ),

			);

		$taxonomies = get_object_taxonomies( $post->post_type );

		foreach( (array) $taxonomies as $taxonomy ) {

			$terms = wp_get_post_terms( $post_id, $taxonomy );

			if( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {

				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );

			}
		}
	}
}

add_action( 'save_post', 'custom_taxonomy_default', 100, 2 );

/**
* Edit columns for portfolio post type.
*/ 
add_filter('manage_edit-re_portfolio_images_columns', 'portfolio_edit_columns');
add_action('manage_re_portfolio_images_posts_custom_column',  'portfolio_columns_display', 10, 2);

function portfolio_edit_columns($portfolio_columns){
    $portfolio_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Title', 'column name'),
        "image" => __('Image'),
        "category" => __('Categories'),
        "author" => __('Author'),
        "date" => __('Date'),
    );
   
    return $portfolio_columns;
}
function portfolio_columns_display($portfolio_columns, $post_id){
	global $themeslug, $post;
	$cat = get_the_terms($post->ID, 'portfolio_categories');
	
    switch ($portfolio_columns)
    {
        case "image":
        	$images = get_post_meta($post->ID, $themeslug.'_portfolio_image' , true);
        	echo '<img src="';
        	echo $images;
        	echo '"style="height: 50px; width: 50px;">';
        break;
        
        case "category":
        	if ( !empty( $cat ) ) {
                $out = array();
                foreach ( $cat as $c )
                    $out[] = "<a href='edit.php?portfolio_categories=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'portfolio_categories', 'display')) . "</a>";
                echo join( ', ', $out );
            } else {
                _e('No Category.');  //No Taxonomy term defined
            }
        break;
	}
}

/**
* Edit columns for slider post type.
*/ 
add_filter('manage_edit-re_custom_slides_columns', 'slider_edit_columns');
add_action('manage_re_custom_slides_posts_custom_column',  'slides_columns_display', 10, 2);

function slider_edit_columns($portfolio_columns){
    $portfolio_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Title', 'column name'),
        "image" => __('Image'),
        "category" => __('Categories'),
        "author" => __('Author'),
        "date" => __('Date'),
    );
   
    return $portfolio_columns;
}
function slides_columns_display($portfolio_columns, $post_id){
	global $themeslug, $post;
	$cat = get_the_terms($post->ID, 'slide_categories');
	$images = get_post_meta($post->ID, $themeslug.'_slider_image' , true);
	
    switch ($portfolio_columns)
    {
        case "image":
        	if ( !empty( $images ) ) {
        		echo '<img src="';
        		echo $images;
        		echo '"style="height: 50px; width: 50px;">';
        	}
        break;
        
        case "category":
        	if ( !empty( $cat ) ) {
                $out = array();
                foreach ( $cat as $c )
                    $out[] = "<a href='edit.php?slide_categories=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'slide_categories', 'display')) . "</a>";
                echo join( ', ', $out );
            } else {
                _e('No Category.');  //No Taxonomy term defined
            }
        break;
	}
}

/**
* Edit columns for slider post type.
*/ 
add_filter('manage_edit-re_carousel_columns', 'carousel_edit_columns');
add_action('manage_re_carousel_posts_custom_column',  'carousel_columns_display', 10, 2);

function carousel_edit_columns($portfolio_columns){
    $portfolio_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Title', 'column name'),
        "image" => __('Image'),
        "category" => __('Categories'),
        "author" => __('Author'),
        "date" => __('Date'),
    );
   
    return $portfolio_columns;
}
function carousel_columns_display($portfolio_columns, $post_id){
	global $themeslug, $post;
	$cat = get_the_terms($post->ID, 'carousel_categories');
	$images = get_post_meta($post->ID, $themeslug.'_post_image' , true);
	
    switch ($portfolio_columns)
    {
        case "image":
        	if ( !empty( $images ) ) {
        		echo '<img src="';
        		echo $images;
        		echo '"style="height: 50px; width: 50px;">';
        	}
        break;
        
        case "category":
        	if ( !empty( $cat ) ) {
                $out = array();
                foreach ( $cat as $c )
                    $out[] = "<a href='edit.php?carousel_categories=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'carousel_categories', 'display')) . "</a>";
                echo join( ', ', $out );
            } else {
                _e('No Category.');  //No Taxonomy term defined
            }
        break;
	}
}

function response_lazy_load() {
	global $root;
    $placeholder = "$root/library/images/grey.gif";
    echo <<<EOF
<script type="text/javascript">
	jQuery(document).ready(function($){
  	jQuery("img").not("#orbitDemo img, .es-carousel img, #credit img").lazyload({
    	effect:"fadeIn",
    	placeholder: "$placeholder"
  	});
});
</script>
EOF;
}
//add_action('wp_head', 'response_lazy_load');

/**
* Add Google Analytics support based on theme option.
*/ 
function response_google_analytics() { // TODO: move to core and consider converting to element option
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_ga_code'));

}
add_action('wp_head', 'response_google_analytics');

/**
* Add custom header scripts support based on theme option.
*/ 
function response_custom_scripts() {
	global $themename, $themeslug, $options;
	
	echo stripslashes ($options->get($themeslug.'_custom_header_scripts'));

}
add_action('wp_head', 'response_custom_scripts');

	
/**
* Register custom menus for header, footer.
*/ 
function response_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu' ))
  );
}
add_action( 'init', 'response_register_menus' );
	
/**
* Menu fallback if custom menu not used.
*/ 
function response_menu_fallback() {
	global $post; ?>
	
	<ul id="nav_menu">
		<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul><?php
}
/**
* Register widgets.
*/ 
function response_widgets_init() {
    register_sidebar(array(
    	'name' => 'Full Sidebar',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the full sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));
    register_sidebar(array(
    	'name' => 'Left Half Sidebar',
    	'id'   => 'sidebar-left',
    	'description'   => 'These are widgets for the left half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));    	
    register_sidebar(array(
    	'name' => 'Right Half Sidebar',
    	'id'   => 'sidebar-right',
    	'description'   => 'These are widgets for the right half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
   	));
   	 register_sidebar(array(
		'name' => 'Box Left',
		'id' => 'box-left',
		'description' => 'This is the left widget of the three-box section',
		'before_widget' => '<div id="box1" class="four columns"><div style="padding:15px;">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="box-widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Box Middle',
		'id' => 'box-middle',
		'description' => 'This is the middle widget of the three-box section',
		'before_widget' => '<div id="box2" class="four columns"><div style="padding:15px;">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="box-widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Box Right',
		'id' => 'box-right',
		'description' => 'This is the right widget of the three-box section',
		'before_widget' => '<div id="box3" class="four columns"><div style="padding:15px;">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="box-widget-title">',
		'after_title' => '</h3>',
	));
   	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'description' => 'These are the footer widgets',
		'before_widget' => '<div class="three columns footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'response_widgets_init');

/**
* Initialize Response Core Framework.
*/ 


/**
* Call additional files required by theme.
*/ 

require_once ( get_template_directory() . '/core/init.php' ); // Initialize core
require_once ( get_template_directory() . '/pro/init.php' ); // Initialize pro

require_once ( get_template_directory() . '/includes/classy-options-init.php' ); // Theme options markup.
require_once ( get_template_directory() . '/includes/options-functions.php' ); // Custom functions based on theme options.
require_once ( get_template_directory() . '/includes/meta-box.php' ); // Meta options markup.


/*	gets post views */
function getPostViews($postID){ // TODO: add namespace to prevent conflict
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

/*	Sets post views	*/
function setPostViews($postID) { // TODO: add namespace to prevent conflict
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/* To correct issue: adjacent_posts_rel_link_wp_head causes meta to be updated multiple times */
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

?>