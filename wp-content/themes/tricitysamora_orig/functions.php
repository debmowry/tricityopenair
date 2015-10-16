<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Custom Function to Include
function favicon_link() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/favicon.ico" />' . "\n";
}

add_action( 'wp_head', 'favicon_link' );

function displayDayCalendar(){
	$today = date("Ymd");
	$tomorrow  = date('Ymd', strtotime('+24 hours'));
	
	$calendar_url = "https://www.google.com/calendar/embed?mode=DAY&amp;dates=".$today."%2F".$tomorrow."&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=3citysamoraseller%40gmail.com&amp;color=%231B887A&amp;ctz=America%2FChicago;";
	return 	$calendar_url;

}
add_shortcode('displayDayCalendar', 'displayDayCalendar');

