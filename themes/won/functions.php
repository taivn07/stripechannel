<?php
	if(defined('OVATHEME_URL') 	== false) 	define('OVATHEME_URL', get_template_directory());
	if(defined('OVATHEME_URI') 	== false) 	define('OVATHEME_URI', get_template_directory_uri());

	
	
	// require libraries, function
	require( OVATHEME_URL.'/framework/init.php' );

	// Add js, css
	require( OVATHEME_URL.'/extend/add_js_css.php' );

	// register menu, widget
	require( OVATHEME_URL.'/extend/register_menu_widget.php' );
	

	// require menu
	require_once (OVATHEME_URL.'/extend/ova_walker_nav_menu_default.php');
	require_once (OVATHEME_URL.'/extend/ova_walker_nav_menu.php');

	require_once( OVATHEME_URL.'/templates/open_layout.php' );

	require_once( OVATHEME_URL.'/templates/close_layout.php' );

	// require content
	require_once (OVATHEME_URL.'/content/define_blocks_content.php');
	
	// require breadcrumbs
	require( OVATHEME_URL.'/extend/breadcrumbs.php' );

	
	
	// Require customize
	if( is_user_logged_in() ){
		require( OVATHEME_URL.'/framework/customize_google_font/customizer_google_font.php' );
		require( OVATHEME_URL.'/extend/customizer.php' );
	}

	// Require metabox
	if( is_admin() ){
		require( OVATHEME_URL.'/extend/metabox.php' );
		// Require TGM
		require_once ( OVATHEME_URL.'/extend/active_plugins.php' );		
	}
	
	
	



