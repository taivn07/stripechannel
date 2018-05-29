<?php

function won_open_layout(){

	// Open layout
	$main_layout = won_get_current_main_layout();
	$width_main_content = ($main_layout == 'no_sidebar' ) ? 'ovatheme_nosidebar' : won_width_main_content();

	?>

		<section class="ova-page-section">
		    <div class="container">
		        <div class="row">
		            <div class=" <?php echo esc_attr($width_main_content); ?>" >
	<?php 

}

add_action( 'won_open_layout', 'won_open_layout' );



