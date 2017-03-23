<?php 
/*
 * Template name: Modal
 */

global $post;
wp_redirect( home_url( '/' ) . '#' . $post->post_name );
die();