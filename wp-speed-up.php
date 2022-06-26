<?php 
//remove any script using handler
add_action( 'wp_enqueue_scripts', 'my_deregister_javascript' );

function my_deregister_javascript() {
  if ( is_front_page() ) {
    wp_deregister_script( 'react' );
    wp_deregister_script( 'jquery' );
 }
}
//add defer attr to all js path
function defer_parsing_of_js ( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.min.js' ) ) return $url;
    return "$url' defer='defer";
  }
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

//css media controll path 
function defer_parsing_of_css ( $url ) {
    if ( FALSE === strpos( $url, '.css' ) ) return $url;
    return "$url' media='handheld";
  }
add_filter( 'clean_url', 'defer_parsing_of_css', 11, 1 );

