<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */



add_action( 'cmb2_init', 'won_metaboxes_default' );
function won_metaboxes_default() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'won_met_';

    

    
    /* Page Settings ***************************************************************************/
    /* ************************************************************************************/
    $page_settings = new_cmb2_box( array(
        'id'            => 'page_heading_settings',
        'title'         => esc_html__( 'Show Page Heading', 'won' ),
        'object_types'  => array( 'page'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        
    ) );

        // Display title of page
        $page_settings->add_field( array(
            'name'       => esc_html__( 'Show title of page', 'won' ),
            'desc'       => esc_html__( 'Allow display title of page', 'won' ),
            'id'         => $prefix . 'page_heading',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'yes' => esc_html__( 'Yes', 'won' ),
                'no'   => esc_html__('No', 'won' )
            ),
            'default' => 'yes',
            
        ) );


 
   

    
    /* Post Settings *********************************************************************************/
    /* *******************************************************************************/
    $post_settings = new_cmb2_box( array(
        'id'            => 'post_video',
        'title'         => esc_html__( 'Post Settings', 'won' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

        // Video or Audio
        $post_settings->add_field( array(
            'name'       => esc_html__( 'Link audio or video', 'won' ),
            'desc'       => esc_html__( 'Insert link audio or video use for video/audio post-format', 'won' ),
            'id'         => $prefix . 'embed_media',
            'type'             => 'oembed',
        ) );


        // Gallery image
        $post_settings->add_field( array(
            'name'       => esc_html__( 'Gallery image', 'won' ),
            'desc'       => esc_html__( 'image in gallery post format', 'won' ),
            'id'         => $prefix . 'file_list',
            'type'             => 'file_list',
        ) );


    /* Portoflio Settings *********************************************************************************/
    /* *******************************************************************************/
    $portfolio_settings = new_cmb2_box( array(
        'id'            => 'portoflio_settings',
        'title'         => esc_html__( 'Portoflio Settings', 'won' ),
        'object_types'  => array( 'portfolio'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Order at frontend', 'won' ),
            'id'         => $prefix . 'portfolio_order',
            'type'             => 'text',
            'default'   => 1
        ) );

        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Sub title', 'won' ),
            'id'         => $prefix . 'portfolio_sub_title',
            'type'             => 'text',
        ) );

        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Client name', 'won' ),
            'id'         => $prefix . 'portfolio_client_name',
            'type'             => 'text',
        ) );

        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Service', 'won' ),
            'id'         => $prefix . 'portfolio_service',
            'type'             => 'text',
            
        ) );

        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Lauch Date', 'won' ),
            'id'         => $prefix . 'portfolio_lauch_date',
            'type'             => 'text',
            
        ) );

        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Project Details', 'won' ),
            'id'         => $prefix . 'portfolio_detail',
            'type'             => 'textarea',
            
        ) );

        // Gallery image
        $portfolio_settings->add_field( array(
            'name'       => esc_html__( 'Gallery image display in detail', 'won' ),
            'id'         => $prefix . 'portoflio_galleries',
            'type'             => 'file_list',
        ) );

       
    /* Header Background Settings ***************************************************************/
    /* ********************************************************************************/
    $general_settings = new_cmb2_box( array(
        'id'            => 'header_bg_settings',
        'title'         => esc_html__( 'Header Settings', 'won' ),
        'object_types'  => array( 'page', 'post', 'portfolio'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));       
        $general_settings->add_field( array(
            'name'       => esc_html__( 'Display Header Background', 'won' ),
            'id'         => $prefix . 'header_bg',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'no'    => esc_html__('no', 'won'),
                'yes' => esc_html__( 'yes', 'won' )
            ),
            'default' => 'no',
            
        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Header Title', 'won' ),
            'id'         => $prefix . 'header_title',
            'type'             => 'text',
            'show_option_none' => false,
            'default' => '',
            
        ) );
        $general_settings->add_field( array(
            'name'       => esc_html__( 'Header Sub Title', 'won' ),
            'id'         => $prefix . 'header_sub_title',
            'type'             => 'text',
            'show_option_none' => false,
            'default' => '',
            
        ) );
         $general_settings->add_field( array(
            'name'       => esc_html__( 'Header Background', 'won' ),
            'id'         => $prefix . 'header_img',
            'type'             => 'file',
            'show_option_none' => false,
            'default' => '',
            
        ) );
         $general_settings->add_field( array(
            'name'       => esc_html__( 'Display Breadcrumbs', 'won' ),
            'id'         => $prefix . 'header_breadcrumbs',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'yes' => esc_html__( 'yes', 'won' ),
                'no'    => esc_html__('no', 'won')
            ),
            'default' => 'yes',
            
        ) );



    /* General Settings ***************************************************************/
    /* ********************************************************************************/
    $general_settings = new_cmb2_box( array(
        'id'            => 'layout_settings',
        'title'         => esc_html__( 'General Settings', 'won' ),
        'object_types'  => array( 'page', 'post', 'portfolio'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Header Version', 'won' ),
            'id'         => $prefix . 'header_version',
            'description' => esc_html__( 'This value will override value in customizer', 'won' ),
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => won_load_header_metabox(),
            'default' => 'global'
            
        ));


        $general_settings->add_field( array(
            'name'       => esc_html__( 'Footer Version', 'won' ),
            'id'         => $prefix . 'footer_version',
            'description' => esc_html__( 'This value will override value in customizer', 'won'  ),
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => won_load_footer_metabox(),
            'default' => 'global'

        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Main Layout', 'won' ),
            'desc'       => esc_html__( 'This value will override value in theme customizer', 'won' ),
            'id'         => $prefix.'main_layout',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'global'   => esc_html__('Global in customizer', 'won' ),
                'right_sidebar' => esc_html__( 'Right Sidebar', 'won' ),
                'left_sidebar'   => esc_html__('Left Sidebar', 'won' ),
                'no_sidebar'   => esc_html__('No Sidebar', 'won' )
            ),
            'default' => 'global',
            
        ) );


        $general_settings->add_field( array(
            'name'       => esc_html__( 'Width of site', 'won' ),
            'desc'       => esc_html__( 'This value will override value in theme customizer', 'won' ),
            'id'         => $prefix . 'width_site',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'global'    => esc_html__('Global in customizer', 'won'),
                'wide' => esc_html__( 'Wide', 'won' ),
                'boxed'   => esc_html__('Boxed', 'won' ),
            ),
            'default' => 'global',
            
        ) );

        

   
}

