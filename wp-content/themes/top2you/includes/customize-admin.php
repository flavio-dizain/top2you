<?php 

function custom_login_logo() { 
	?><style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url("<?php echo get_stylesheet_directory_uri() . '/img/top2you.png'; ?>");
            padding-bottom: 30px;
            width: 100%;
            background-size: contain;
        }
    </style><?php 
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

function custom_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

function custom_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );