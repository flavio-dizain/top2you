<?php 

function top2you_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'top2you_rodape', array(
	   'title'    => 'Rodapé',
	   'priority' => 125,
	) );
	$wp_customize->add_setting( 'rodape_logo_link', array(
	    'default'        => '',
	    'capability'     => 'edit_theme_options',	
	) );	
	$wp_customize->add_control( 'rodape_logo_link', array(
	    'label'      => 'Logo - Link',
	    'section'    => 'top2you_rodape',
	    'settings'   => 'rodape_logo_link',
	) );
	$wp_customize->add_setting( 'rodape_logo', array(
	    'default'        => '',
	    'capability'     => 'edit_theme_options',	
	) );	
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'rodape_logo',
		array(
			'label'      => 'Logo',
			'section'    => 'top2you_rodape',
			'settings'   => 'rodape_logo',
		)
	) );
	$wp_customize->add_setting( 'rodape_endereco', array(
	    'default'        => '',
	    'capability'     => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'rodape_endereco', array(
	    'label'      => 'Endereço',
	    'section'    => 'top2you_rodape',
	    'settings'   => 'rodape_endereco',
	    'type'   	 => 'textarea',
	) );
	$wp_customize->add_setting( 'rodape_copyright', array(
	    'default'        => '',
	    'capability'     => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'rodape_copyright', array(
	    'label'      => 'Copyright',
	    'section'    => 'top2you_rodape',
	    'settings'   => 'rodape_copyright',
	) );
}
add_action( 'customize_register', 'top2you_customize_register' );