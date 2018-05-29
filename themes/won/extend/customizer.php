<?php


function won_customize_register( $wp_customize ) {

	/* Remove Colors &  Header Image Customize */
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');


	// Typography setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'typography_section' , array(
	    'title'      => esc_html__( 'Typography setting', 'won' ),
	    'priority'   => 29,
	) );


	$wp_customize->add_setting( 'body_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'Work Sans',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( 
		new Google_Font_Dropdown_Custom_Control( 
		$wp_customize, 
		'body_font', 
		array(
			'label'          => esc_html__('Body font','won'),
            'section'        => 'typography_section',
            'settings'       => 'body_font',
		) ) 
	);



	

	$wp_customize->add_setting( 'main_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#f0f8ff',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'main_color', 
		array(
			'label'          => esc_html__("Main color",'won'),
            'section'        => 'typography_section',
            'settings'       => 'main_color',
		) ) 
	);

	$wp_customize->add_setting( 'second_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#000000',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'second_color', 
		array(
			'label'          => esc_html__("Second color",'won'),
            'section'        => 'typography_section',
            'settings'       => 'second_color',
		) ) 
	);


	$wp_customize->add_setting( 'won_custom_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('won_custom_font', array(
		'label' => esc_html__('Custom Font','won'),
		'description' => esc_html__('Step 1: Insert font-face in style.css file: Refer https://css-tricks.com/snippets/css/using-font-face/.  Step 2: Insert name-font here. For example: name-font1, name-font2. Step 3: Refresh customize page to display new font in dropdown font field.','won'),
		'section' => 'typography_section',
		'settings' => 'won_custom_font',
		'type' =>'textarea'
	));	

	
	// /Typography setting ////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Header setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'header_section' , array(
	    'title'      => esc_html( 'Header Global', 'won' ),
	    'priority'   => 30,
	) );

	
	$wp_customize->add_setting( 'loader', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'yes',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('loader', array(
		'label' => esc_html('Loader','won'),
		'description' => esc_html('A text Loading will display when access to page','won'),
		'section' => 'header_section',
		'settings' => 'loader',
		'type' =>'select',
		'choices' => array(
			"yes" => "yes",
			"no" => "no",
		)

	));

	$wp_customize->add_setting( 'header_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'default',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );


	$wp_customize->add_control('header_version', array(
		'label' => esc_html('Header version','won'),
		'description' => esc_html('Select Global Header. You can override Header in config of Post/Page','won'),
		'section' => 'header_section',
		'settings' => 'header_version',
		'type' =>'select',
		'choices' => won_load_header()

	));

	$wp_customize->add_setting( 'logo', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
	    'label'    => esc_html__( 'Logo', 'won' ),
	    'section'  => 'header_section',
	    'settings' => 'logo'
	)));


	$wp_customize->add_setting( 'logo_scroll', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_scroll', array(
	    'label'    => esc_html__( 'Logo Scroll', 'won' ),
	    'section'  => 'header_section',
	    'settings' => 'logo_scroll'
	)));


	$wp_customize->add_setting( 'header_bg', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );


	$wp_customize->add_setting( 'show_header_bg', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'yes',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('show_header_bg', array(
		'label' => esc_html('Show header background','won'),
		'section' => 'header_section',
		'settings' => 'show_header_bg',
		'type' =>'select',
		'choices' => array(
			"yes" => "yes",
			"no" => "no",
			
		)

	));

	$wp_customize->add_setting( 'header_bg', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_bg', array(
	    'label'    => esc_html__( 'Header Background Global', 'won' ),
	    'section'  => 'header_section',
	    'settings' => 'header_bg'
	)));

	
	// /Header setting ////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'footer_section' , array(
	    'title'      => esc_html( 'Footer Global', 'won' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'footer_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'default',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('footer_version', array(
		'label' => esc_html('Footer version','won'),
		'description' => esc_html('Select Global Footer. You can override Footer in config of Post/Page','won'),
		'section' => 'footer_section',
		'settings' => 'footer_version',
		'type' =>'select',
		'choices' => won_load_footer()

	));
	
	// /Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Blog setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'blog_section' , array(
	    'title'      => esc_html( 'Blog Global', 'won' ),
	    'priority'   => 30,
	) );

	
	$wp_customize->add_setting( 'blog_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'basic',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('blog_version', array(
		'label' => esc_html('Blog Version','won'),
		'section' => 'blog_section',
		'settings' => 'blog_version',
		'type' =>'select',
		'choices' => array(
			"basic" => "basic",
			"version1" => "version1"
		)

	));

	// /Blog setting ////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Layout setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'layout_section' , array(
	    'title'      => esc_html( 'Layout Global', 'won' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'main_layout', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'right_sidebar',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('main_layout', array(
		'label' => esc_html__('Global Layout for site','won'),
		'section' => 'layout_section',
		'settings' => 'main_layout',
		'description' => esc_html__('You can override Layout in config of Post/Page', 'won'),
		'type' =>'select',
		'choices' => array(
			'right_sidebar' => esc_html__('Right Sidebar', 'won'),
			'left_sidebar' => esc_html__('Left Sidebar', 'won'),
			'no_sidebar' => esc_html__('No Sidebar','won')
			)

	));


	$wp_customize->add_setting( 'width_site', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'wide',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('width_site', array(
		'label' => esc_html__('Width of site','won'),
		'section' => 'layout_section',
		'settings' => 'width_site',
		'type' =>'select',
		'choices' => array(
			'wide' => esc_html__( 'Wide', 'won' ),
            'boxed'   => esc_html__('Boxed', 'won')
			)

	));

	// Sidebar column setting
	$wp_customize->add_setting( 'sidebar_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '4',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('sidebar_column', array(
		'label' => esc_html__('Sidebar column','won'),
		'description' => esc_html__('main column + sidebar column = 12 columns','won'),
		'section' => 'layout_section',
		'settings' => 'sidebar_column',
		'type' =>'select',
		'choices' => array(
			'1' => esc_html__('1 column', 'won'),
			'2' => esc_html__('2 columns', 'won'),
			'3' => esc_html__('3 columns', 'won'),
			'4' => esc_html__('4 columns', 'won'),
			'5' => esc_html__('5 columns', 'won'),
			'6' => esc_html__('6 columns', 'won')
			)
	));

	// Main column settings
	$wp_customize->add_setting( 'main_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '8',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'won_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('main_column', array(
		'label' => esc_html__('Main column','won'),
		'description' => esc_html__('main column + sidebar column = 12 columns','won'),
		'section' => 'layout_section',
		'settings' => 'main_column',
		'type' =>'select',
		'choices' => array(
			'11' => esc_html__('11 columns', 'won'),
			'10' => esc_html__('10 columns', 'won'),
			'9' => esc_html__('9 columns', 'won'),
			'8' => esc_html__('8 columns', 'won'),
			'7' => esc_html__('7 columns', 'won'),
			'6' => esc_html__('6 columns', 'won'),
			)
	));
	
	// /Layout setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	



}

function won_fun_sanitize_callback($value){
    return $value;
}


add_action( 'customize_register', 'won_customize_register' );	

