<?php

/**
* Exit if file is directly accessed. 
*/ 
if ( !defined('ABSPATH')) exit;


function response_blog_slider() {
	do_action ('response_blog_slider');
}
function response_blog_content_slider() {
	do_action ('response_blog_content_slider');
}
function response_page_slider() {
	do_action ('response_page_slider');
}
function response_page_content_slider() {
	do_action ('response_page_content_slider');
}

function response_portfolio_element() {
	do_action ('response_portfolio_element');
}

function response_product_element() {
	do_action ('response_product_element');
}

function response_carousel_element() {
	do_action ('response_carousel_element');
}

function response_magazine_element() {
	do_action ('response_magazine_element');
}

?>
