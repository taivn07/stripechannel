<?php
add_action('init','init_visual_composer_custom',1000);
function init_visual_composer_custom(){
    if(function_exists('vc_map')){

vc_map( array(
	 "name" => esc_html__("Slideshow", 'ova-won'),
	 "base" => "ova_won_slideshow",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",   
	 "as_parent" => array('only' => 'ova_won_slideshow_item'),
	 "js_view" => 'VcColumnView',
	 "params" => array(
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));

vc_map( array(
	 "name" => esc_html__("Slideshow Item", 'ova-won'),
	 "base" => "ova_won_slideshow_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "as_child" => array('only' => 'ova_won_slideshow'),
	 "params" => array(
	 	
	 		array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image",'ova-won'),
		       "param_name" => "img",
		    ),
		    array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		    ),
		    array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Heading",'ova-won'),
		       "param_name" => "heading",
		    ),
		    array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("description",'ova-won'),
		       "param_name" => "desc",
		    ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_slideshow extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_slideshow_item extends WPBakeryShortCode {
  }
}



vc_map( array(
	 "name" => esc_html__("Slideshow 2", 'ova-won'),
	 "base" => "ova_won_slideshow_two",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",   
	 "as_parent" => array('only' => 'ova_won_slideshow_two_item'),
	 "js_view" => 'VcColumnView',
	 "params" => array(
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));

vc_map( array(
	 "name" => esc_html__("Slideshow 2 Item", 'ova-won'),
	 "base" => "ova_won_slideshow_two_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "as_child" => array('only' => 'ova_won_slideshow_two'),
	 "params" => array(
	 	
	 		array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image Desktop",'ova-won'),
		       "param_name" => "img",
		    ),
		    array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image Mobile",'ova-won'),
		       "param_name" => "img_mobile",
		    ),
		    array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		    ),
		    array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Heading",'ova-won'),
		       "param_name" => "heading",
		    ),
		    array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("description",'ova-won'),
		       "param_name" => "desc",
		    ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_slideshow_two extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_slideshow_two_item extends WPBakeryShortCode {
  }
}



vc_map( array(
	 "name" => esc_html__("About", 'ova-won'),
	 "base" => "ova_won_about",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Heading title",'ova-won'),
		       "param_name" => "heading_title"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Heading sub title",'ova-won'),
		       "param_name" => "heading_sub_title"
		    ),
	 	array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image",'ova-won'),
		       "param_name" => "img"
		    ),
	 	array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image Popup",'ova-won'),
		       "param_name" => "img_popup"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "description" => esc_html__( "Use like: {{WON Creative Hub}} is fully focused on high-end programs and functional apps.", 'ova-won' ),
		       "param_name" => "title"
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("button text",'ova-won'),
		       "param_name" => "btn_text"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("button link",'ova-won'),
		       "param_name" => "btn_link"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("text top",'ova-won'),
		       "param_name" => "text_top"
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Style",'ova-won'),
		       "param_name" => "style",
		       "value" => array(
		       		"style1" => "style1",
		       		"style2" => "style2",
		       	),
		       "default" => "style1"
		    ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Heading", 'ova-won'),
	 "base" => "ova_won_heading",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "description" => esc_html__("Format like: What we {{ OFFERS }} ",'ova-won'),
		       "param_name" => "desc"
		    ),
	 	array(
		     "type" => "dropdown",
		     "holder" => "div",
		     "class" => "",
		     "heading" => __("Style",'ova-won'),
		     "param_name" => "style",
		     "value" => array(
		     	esc_html__( 'style 1', 'ova-won' ) => "style1",
		     	esc_html__( 'style 2', 'ova-won' ) => "style2"
		     ),
		     "default" => 'style1'
		),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));

vc_map( array(
	 "name" => esc_html__("Offer", 'ova-won'),
	 "base" => "ova_won_offer",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_parent" => array('only' => 'ova_won_offer_item'),
	 "js_view" => 'VcColumnView',
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("auto play",'ova-won'),
		       "param_name" => "auto_play",
		       "value" =>'4000'
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("navigation",'ova-won'),
		       "param_name" => "navigation",
		       "value" => array(
		       		"true" => "true",
		       		"false" => "false"
		       	),
		       "default" => "true"
		    ),
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Offer item", 'ova-won'),
	 "base" => "ova_won_offer_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	  "as_child" => array('only' => 'ova_won_offer'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Icon",'ova-won'),
		       "description" => esc_html__("You can find class here: https://themify.me/themify-icons",'ova-won'),
		       "param_name" => "icon"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title"
		    ),
	 	
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("btn text",'ova-won'),
		       "param_name" => "btn_text"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("btn link",'ova-won'),
		       "param_name" => "btn_link"
		    ),
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_offer extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_offer_item extends WPBakeryShortCode {
  }
}




vc_map( array(
	 "name" => esc_html__("Offer two", 'ova-won'),
	 "base" => "ova_won_offer_two",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Icon",'ova-won'),
		       "description" => esc_html__("You can find class here: https://themify.me/themify-icons",'ova-won'),
		       "param_name" => "icon"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title"
		    ),
	 	
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc"
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("style",'ova-won'),
		       "param_name" => "style",
		       "value" => array(
		       	"style1" => "style1",
		       	"style2" => "style2",
		       	),
		       "default" => "style1"
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Link",'ova-won'),
		       "param_name" => "link"
		    ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));



vc_map( array(
	 "name" => esc_html__("Mobile", 'ova-won'),
	 "base" => "ova_won_mobile",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Mobile",'ova-won'),
		       "param_name" => "mobile",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Icon",'ova-won'),
		       "description" => esc_html__("You can find class here: https://themify.me/themify-icons",'ova-won'),
		       "param_name" => "icon",
		       "value" =>''
		    ),
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Info", 'ova-won'),
	 "base" => "ova_won_info",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "description" => esc_html__("Format like: Be a part of{{ Creative Process}}",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc",
		       "value" =>''
		    ),
	 
	 array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button text",'ova-won'),
		       "param_name" => "btn_text",
		       "value" =>''
		    ),
	 array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button link",'ova-won'),
		       "param_name" => "btn_link",
		       "value" =>''
		    ),
	 
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));



vc_map( array(
       "name" => __("Portfolio", 'ova-won'),
		"base" => "won_portfolio",
		"class" => "",
		"category" => esc_html__("Won", 'ova-won'),
		"icon" => "icon-qk",   
		"params" => array(
			
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Insert list slug of portfolio categories",'ova-won'),
		       "description" => esc_html__("From Menu click Portfolio >> Category >> See column slug. Example: website, branding, ui-ux, motion-gfx",'ova-won'),
		       "param_name" => "array_slug",
		       "value" => "website, branding, ui-ux, motion-gfx",
		  ),		
		 
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Replace All Filter text.",'ova-won'),
		       "description" => esc_html__( "Empty to remove All Filter" ),
		       "param_name" => "all_filter_text",
		       "value" => "All"
		  ),
		  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Count Item each category",'ova-won'),
		       "param_name" => "count",
		       "value" => "9",
		  ),
		  
		  array(
		     "type" => "dropdown",
		     "holder" => "div",
		     "class" => "",
		     "heading" => __("Order Portoflio",'ova-won'),
		     "param_name" => "order",
		     "value" => array(
		     	esc_html__( 'Increase', 'ova-won' ) => "ASC",
		     	esc_html__( 'Decrease', 'ova-won' ) => "DESC"
		     ),
		     "default" => 'ASC'
		),

		  array(
		     "type" => "dropdown",
		     "holder" => "div",
		     "class" => "",
		     "heading" => __("Show info",'ova-won'),
		     "param_name" => "show_info",
		     "value" => array(
		     	esc_html__( 'Yes', 'ova-won' ) => "true",
		     	esc_html__( 'No', 'ova-won' ) => "false"
		     ),
		     "default" => 'true'
		),

		  
		  array(
		     "type" => "dropdown",
		     "holder" => "div",
		     "class" => "",
		     "heading" => __("Column",'ova-won'),
		     "param_name" => "column",
		     "value" => array(
		     	esc_html__( '3 Column', 'ova-won' ) => "b-isotope-3 b-isotope_3-col",
		     	esc_html__( '4 Column', 'ova-won' ) => "b-isotope-4 b-isotope_4-col",
		     	esc_html__( '5 Column', 'ova-won' ) => "b-isotope-5 b-isotope_5-col"
		     ),
		     "default" => 'b-isotope-3 b-isotope_3-col'
		),
		  
		  
		
		  array(
		     "type" => "dropdown",
		     "holder" => "div",
		     "class" => "",
		     "heading" => __("Style",'ova-won'),
		     "param_name" => "style",
		     "value" => array(
		     	esc_html__( 'Style 1', 'ova-won' ) => "style1",
		     	esc_html__( 'Style 2', 'ova-won' ) => "style2"
		     ),
		     "default" => 'style1'
		),
		 
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Replace view all works text ",'ova-won'),
		       "param_name" => "display_all_text",
		       "value" => "view all works"
		  ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Link to display all portoflio",'ova-won'),
		       "param_name" => "display_all_link",
		       "value" => ""
		  ),
		  
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__('Insert class to use for your style','ova-won')
		  )

)));





vc_map( array(
	 "name" => esc_html__("Review", 'ova-won'),
	 "base" => "ova_won_review",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_parent" => array('only' => 'ova_won_review_item'),
	 "js_view" => 'VcColumnView',
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("auto play. Insert number: 4000",'ova-won'),
		       "param_name" => "auto_play",
		       "value" =>'4000'
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Number review in each slide",'ova-won'),
		       "param_name" => "slide",
		       "value" =>'2'
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Navigation",'ova-won'),
		       "param_name" => "navigation",
		       "value" =>array(
		       	"true" => "true",
		       	"false" => "false"
		       	),
		       "default" => "true"
		    ),
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Review Item", 'ova-won'),
	 "base" => "ova_won_review_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_child" => array('only' => 'ova_won_review'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Name",'ova-won'),
		       "param_name" => "name",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Job",'ova-won'),
		       "param_name" => "job",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc",
		       "value" =>''
		    ),
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_review extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_review_item extends WPBakeryShortCode {
  }
}




vc_map( array(
	 "name" => esc_html__("Team", 'ova-won'),
	 "base" => "ova_won_team",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_parent" => array('only' => 'ova_won_team_item'),
	 "js_view" => 'VcColumnView',
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("auto play. Insert number: 4000",'ova-won'),
		       "param_name" => "auto_play",
		       "value" =>'4000'
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Number review in each slide",'ova-won'),
		       "param_name" => "slide",
		       "value" =>'4'
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Navigation",'ova-won'),
		       "param_name" => "navigation",
		       "value" =>array(
		       	"true" => "true",
		       	"false" => "false"
		       	),
		       "default" => "true"
		    ),
	 	
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Team Item", 'ova-won'),
	 "base" => "ova_won_team_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_child" => array('only' => 'ova_won_team'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Job",'ova-won'),
		       "param_name" => "job",
		       "value" =>''
		    ),
	 	array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image",'ova-won'),
		       "param_name" => "img",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Link",'ova-won'),
		       "param_name" => "link",
		       "value" =>''
		    ),
	 	
	 	array(
		       "type" => "textarea_html",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Social",'ova-won'),
		       "description" => esc_html__("Format: [ova_won_team_item_social icon='fa-facebook' link='https://facebook.com']",'ova-won'),
		       "param_name" => "content",
		       "value" =>''
		    )

	 
)));

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_team extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_team_item extends WPBakeryShortCode {
  }
}





vc_map( array(
	 "name" => esc_html__("Progress", 'ova-won'),
	 "base" => "ova_won_progress",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_parent" => array('only' => 'ova_won_progress_item'),
	 "js_view" => 'VcColumnView',
	 "icon" => "icon-qk",
	 "params" => array(
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Progress Item", 'ova-won'),
	 "base" => "ova_won_progress_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_child" => array('only' => 'ova_won_progress'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Percent",'ova-won'),
		       "param_name" => "percent",
		       "value" =>''
		    )
	 
)));

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_progress extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_progress_item extends WPBakeryShortCode {
  }
}





$args = array(
  'orderby' => 'name',
  'order' => 'ASC'
  );

$categories=get_categories($args);
$cate_array = array();
$arrayCateAll = array('All categories ' => 'all' );
if ($categories) {
	foreach ( $categories as $cate ) {
		$cate_array[$cate->cat_name] = $cate->slug;
	}
} else {
	$cate_array["No content Category found"] = 0;
}


vc_map( array(
       "name" => __("Blog", 'ova-won'),
		"base" => "ova_won_blog",
		"class" => "",
		"category" => esc_html__("Won", 'ova-won'),
		"icon" => "icon-qk",   
		"params" => array(
		
		  array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => __("Category",'ova-won'),
		       "param_name" => "category",
		       "value" => array_merge($arrayCateAll,$cate_array),
		       "description" => __("Choose a Content Category from the drop down list.", 'ova-won')
		   ),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Count Items",'ova-won'),
		       "param_name" => "total_count",
		       "value" => "20",
		  ),		
		   array(
			     "type" => "dropdown",
			     "holder" => "div",
			     "class" => "",
			     "heading" => __("Show Read More",'ova-won'),
			     "param_name" => "show_read_more",
			     "value" => array(
			     	esc_html__( 'true', 'ova-won' ) => "true",
			     	esc_html__( 'false', 'ova-won' ) => "false"
			     ),
			     "default" => 'true'
			),
		   array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Replace read more text",'ova-won'),
		       "param_name" => "read_more_text",
		       "value" => "Read more",
		  ),
		  array(
			     "type" => "dropdown",
			     "holder" => "div",
			     "class" => "",
			     "heading" => __("Show intro",'ova-won'),
			     "param_name" => "show_intro",
			     "value" => array(
			     	esc_html__( 'true', 'ova-won' ) => "true",
			     	esc_html__( 'false', 'ova-won' ) => "false"
			     ),
			     "default" => 'true'
			),
		  array(
			     "type" => "dropdown",
			     "holder" => "div",
			     "class" => "",
			     "heading" => __("Show time",'ova-won'),
			     "param_name" => "show_time",
			     "value" => array(
			     	esc_html__( 'true', 'ova-won' ) => "true",
			     	esc_html__( 'false', 'ova-won' ) => "false"
			     ),
			     "default" => 'true'
			),
		 
		  array(
			     "type" => "dropdown",
			     "holder" => "div",
			     "class" => "",
			     "heading" => __("Show Category",'ova-won'),
			     "param_name" => "show_cat",
			     "value" => array(
			     	esc_html__( 'true', 'ova-won' ) => "true",
			     	esc_html__( 'false', 'ova-won' ) => "false"
			     ),
			     "default" => 'true'
			),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__('Insert class to use for your style','ova-won')
		  )

)));




vc_map( array(
	 "name" => esc_html__("brands", 'ova-won'),
	 "base" => "ova_won_brands",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_parent" => array('only' => 'ova_won_brands_item'),
	 "js_view" => 'VcColumnView',
	 "icon" => "icon-qk",
	 "params" => array(
	 		array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("auto play. Insert number: 4000",'ova-won'),
		       "param_name" => "auto_play",
		       "value" =>'4000'
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Number review in each slide",'ova-won'),
		       "param_name" => "slide",
		       "value" =>'5'
		    ),
	 	array(
			     "type" => "dropdown",
			     "holder" => "div",
			     "class" => "",
			     "heading" => __("Display background color",'ova-won'),
			     "param_name" => "bg",
			     "value" => array(
			     	esc_html__( 'Yes', 'ova-won' ) => "bg-primary",
			     	esc_html__( 'No', 'ova-won' ) => "no-bg-primary"
			     ),
			     "default" => 'bg-primary'
			),
		  array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" => "",
		       "description" => esc_html__("Insert class to use for your style",'ova-won')
		    )

	 
)));


vc_map( array(
	 "name" => esc_html__("Brands Item", 'ova-won'),
	 "base" => "ova_won_brands_item",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "as_child" => array('only' => 'ova_won_brands'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image",'ova-won'),
		       "param_name" => "img",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Link",'ova-won'),
		       "param_name" => "link",
		       "value" =>''
		    )
	 
)));

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_ova_won_brands extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_ova_won_brands_item extends WPBakeryShortCode {
  }
}




vc_map( array(
	 "name" => esc_html__("Pricing", 'ova-won'),
	 "base" => "ova_won_pricing",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Price",'ova-won'),
		       "param_name" => "price",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Time",'ova-won'),
		       "param_name" => "time",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "description" => esc_html__("Format: {{Insert desc}}{{Insert desc}} ",'ova-won'),
		       "param_name" => "desc",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button text",'ova-won'),
		       "param_name" => "btn_text",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button link",'ova-won'),
		       "param_name" => "btn_link",
		       "value" =>''
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button target",'ova-won'),
		       "param_name" => "btn_target",
		       "value" => array(
		       		"Same Window" => "_self",
		       		"New Window" => "_blank"
		       	),
		       "default" => "_self"
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Feature",'ova-won'),
		       "param_name" => "feature",
		       "value" => array(
		       		"No" => "no",
		       		"Yes" => "active"
		       	),
		       "default" => "no"
		    ),
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" =>''
		    ),
	 
)));




vc_map( array(
	 "name" => esc_html__("Skill", 'ova-won'),
	 "base" => "ova_won_skill",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image",'ova-won'),
		       "param_name" => "img",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "heading" => esc_html__("Format: The Creative Skills {{We Have!}}",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Skill Shortcode",'ova-won'),
		       "description" => esc_html__("Format: [ova_won_skill_item img='image_link' title='SEO Tools' /]",'ova-won'),
		       "param_name" => "content",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" =>''
		    ),
	 
)));



vc_map( array(
	 "name" => esc_html__("Parllax info", 'ova-won'),
	 "base" => "ova_won_parllax_info",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "attach_image",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Image",'ova-won'),
		       "param_name" => "img",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Title",'ova-won'),
		       "param_name" => "title",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textarea",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Description",'ova-won'),
		       "param_name" => "desc",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button text",'ova-won'),
		       "param_name" => "btn_text",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button link",'ova-won'),
		       "param_name" => "btn_link",
		       "value" =>''
		    ),
	 	array(
		       "type" => "dropdown",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Button target",'ova-won'),
		       "param_name" => "btn_target",
		       "value" =>array(
		       		"Same window" => "_self",
		       		"New window" => "_blank"
		       	)
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" =>''
		    )
	 
)));



vc_map( array(
	 "name" => esc_html__("Contact info", 'ova-won'),
	 "base" => "ova_won_contact_info",
	 "class" => "",
	 "category" => esc_html__("Won", 'ova-won'),
	 "icon" => "icon-qk",
	 "params" => array(
	 	
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Icon Class",'ova-won'),
		       "description" => esc_html__( "You can find class here: https://themify.me/themify-icons", 'ova-won' ),
		       "param_name" => "icon",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Name",'ova-won'),
		       "param_name" => "name",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Phone",'ova-won'),
		       "param_name" => "phone",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Fax",'ova-won'),
		       "param_name" => "fax",
		       "value" =>''
		    ),
	 	array(
		       "type" => "textfield",
		       "holder" => "div",
		       "class" => "",
		       "heading" => esc_html__("Class",'ova-won'),
		       "param_name" => "class",
		       "value" =>''
		    )
	 
)));


}} /* /if //function */
?>