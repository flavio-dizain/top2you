<?php
// Adiciona o favicon no painel e personaliza a tela de login
require get_template_directory() . '/includes/customize-admin.php';

// Cria os campos no "Personalizar"
require get_template_directory() . '/includes/customizer.php';

// Remove acentuação dos arquivos no upload
add_filter('sanitize_file_name', 'remove_accents');

function top2you_setup() {
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slider', '9999', '9999', true );

	register_nav_menus( array(
		'menu-topo' => 'Menu Topo',
		'menu-rodape' => 'Menu Rodapé',
		'redes-sociais' => 'Redes Sociais',
	) );

	add_theme_support( 'custom-logo', array(
		'width' => 255,
		'height' => 73,
		'flex-width' => true,
		'header-text' => array( 'site-title' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
add_action( 'after_setup_theme', 'top2you_setup' );

function top2you_init_scripts() {
	// Arquivos CSS
	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . "/css/bootstrap.min.css" );
	wp_enqueue_style( 'beauty-font', get_template_directory_uri() . "/css/beauty-font.css" );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css" );
	wp_enqueue_style( 'slick', get_template_directory_uri() . "/css/slick.css" );
	wp_enqueue_style( 'style', get_template_directory_uri() . "/css/style.css" );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . "/css/responsive.css" );

	// Javascripts
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . "/js/jquery.min.js", array(), false, true );
	wp_enqueue_script( 'progress', get_template_directory_uri() . "/js/progress.js", array( 'jquery' ), false, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . "/js/bootstrap.min.js", array( 'jquery' ), false, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . "/js/slick.min.js", array( 'jquery' ), false, true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . "/js/script.js", array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'top2you_init_scripts', 11 );

function top2you_document_title_separator( $separator ) {
	return '|';
}
add_filter( 'document_title_separator', 'top2you_document_title_separator' );

function youtube_id_from_url( $url ) {
    $pattern =
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x';
    $result = preg_match( $pattern, $url, $matches );
    if ( false !== $result ) {
        return $matches[1];
    }
    return false;
}

function top2you_pagination( $query = NULL, $range = 2, $get_param = NULL ) {
	global $wp_query;
	if ( ! $query ) {
		$query = $wp_query;
	}

	// Sem paginação se só tem uma página
	if( $query->max_num_pages <= 1 ) {
		return;
	}

	if ( $get_param ) {
		$paged = $_GET[ $get_param ] ? absint( $_GET[ $get_param ] ) : 1;
	} else {
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	}
	$max = intval( $query->max_num_pages );

	// Adiciona a página atual no array...
	if ( $paged >= 1 )
		$links[] = $paged;

	// ... e as páginas vizinhas
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<ul class="paginacao">' . "\n";

	// Página anterior
	if ( $paged > 1 AND $max > 1 )
		printf( '<li class="prevnext"><a href="%s">&lt;</a></li>' . "\n", get_pagenum_link( $paged - 1 ) );

	// Link para a primeira página e ... se necessário
	if ( ! in_array( 1, $links ) ) {
		$class = ( 1 == $paged ) ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( 1 ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li><span class="paginacao-sep">…</span></li>';
	}

	// Link para a página atual com 2 páginas antes e depois, se necessário
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = ( $paged == $link ) ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $link ), $link );
	}

	// Link para a última página e ... se necessário
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><span class="paginacao-sep">…</span></li>' . "\n";

		$class = ( $paged == $max ) ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $max ), $max );
	}

	// Link para a próxima página
	if ( $paged < $max )
		printf( '<li class="prevnext"><a href="%s">&gt;</a></li>' . "\n", get_pagenum_link( $paged + 1 ) );

	echo '</ul>' . "\n";
}

function top2you_ajax_function() {
	// Código aqui
	wp_die();
}
add_action( 'wp_ajax_top2you_function', 'top2you_ajax_function' );
add_action( 'wp_ajax_nopriv_top2you_function', 'top2you_ajax_function' );

function top2you_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( in_array( 'li-btn-success', $item->classes ) ) {
		$atts['class'] .= ' btn btn-danger';
	}
	if ( in_array( 'modal-trigger', $item->classes ) ) {
		$post = get_post( $item->object_id );
		$atts['data-toggle'] = 'modal';
		$atts['data-target'] = '#'.$post->post_name;
		$atts['href'] = '#';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'top2you_nav_menu_link_attributes', 10, 4 );

function top2you_wp_video_shortcode( $output, $atts, $video, $post_id, $library ) {
	if ( empty( $atts['src'] ) ) {
		$default_types = wp_get_video_extensions();
		foreach ( $default_types as $ext ) {
			if ( ! empty( $atts[ $ext ] ) ) {
				$type = wp_check_filetype( $atts[ $ext ], wp_get_mime_types() );
			}
		}
		if ( is_array( $type ) ) {
			$ext = $type['ext'];
			$output = '
				<video controls poster="' . get_template_directory_uri() . '/img/poster.jpg" style="width: 100%; height: auto;">
				  	<source src="' . $atts[ $ext ] . '" type="' . $type['type'] . '">
				  	Seu navegador não suporta HTML5 vídeo.
				</video>';
		}
	}
	return $output;
}
add_filter( 'wp_video_shortcode', 'top2you_wp_video_shortcode', 10, 5 );

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );

function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    $my_attr = 'v-code';

    if ( isset( $atts[$my_attr] ) ) {
        $out[$my_attr] = $atts[$my_attr];
    }

    return $out;
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'speakers',
    array(
      'labels' => array(
        'name' => __( 'Speakers' ),
        'singular_name' => __( 'Speaker' )
      ),
      'public' => true,
      'has_archive' => true,
			'hierarchical' => true,
			'supports' => array('thumbnail','title', 'excerpt', 'editor')
    )
  );
}
