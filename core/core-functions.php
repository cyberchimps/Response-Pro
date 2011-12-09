<?php
/**
* CyberChimps Core Framework functions
*
* Authors: Tyler Cunningham, Ben Allfree
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Core
* @since 1.0
*/

/**
* Establishes 'core' as the textdomain, sets $locale and file path
*
* @since 1.0
*/
function chimps_text_domain() {
	load_theme_textdomain( 'core', TEMPLATEPATH . '/core/languages' );

	    $locale = get_locale();
	    $locale_file = TEMPLATEPATH . "/core/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );
		
		return;    
}

	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);
	
//Add title to untitled posts

add_filter('the_title', 'startup_title');

function startup_title($title) {

	if ($title == '') {
		return 'Untitled';
	} else {
		return $title;
	}
}
//Shorten previous/next post links to avoid text overlap
function filter_shorten_linktext($linkstring,$link) {
	$characters = 33;
	preg_match('/<a.*?>(.*?)<\/a>/is',$linkstring,$matches);
	$displayedTitle = $matches[1];
	$newTitle = shorten_with_ellipsis($displayedTitle,$characters);
	return str_replace('>'.$displayedTitle.'<','>'.$newTitle.'<',$linkstring);
}

function shorten_with_ellipsis($inputstring,$characters) {
  return (strlen($inputstring) >= $characters) ? substr($inputstring,0,($characters-3)) . '...' : $inputstring;
}

// This adds filters to the next and previous links, using the above functions
// to shorten the text displayed in the post-navigation bar. The last 2 arguments
// are necessary; the last one is the crucial one. Saying "2" means the function
// "filter_shorten_linktext()" takes 2 arguments. If you don't say so here, the
// hook won't pass them when it's called and you'll get a PHP error.
add_filter('previous_post_link','filter_shorten_linktext',10,2);
add_filter('next_post_link','filter_shorten_linktext',10,2);

/**
* End
*/
		    
?>