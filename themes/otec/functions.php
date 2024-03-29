<?php
/**
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */

/***************************************************
 * :: Load Kleo framework
 ***************************************************/

require_once( trailingslashit( get_template_directory() ) . 'kleo-framework/kleo.php' );


if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}


/***************************************************
 * :: Load Theme specific functions
 ***************************************************/

require_once( trailingslashit( get_template_directory() ) . 'lib/theme-functions.php' );


/***************************************************
 * :: SideKick Integration
 ***************************************************/

define( 'SK_PRODUCT_ID', 457 );
define( 'SK_ENVATO_PARTNER', 'Qjq0CBU+3zqUohNf6gfTpvfnRX3eCVM+HwoqKeVL4/k=' );
define( 'SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=' );


/**
 * Sets up theme defaults and registers the various WordPress features
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 *    custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Kleo Framework 1.0
 */
function kleo_setup() {


	global $kleo_config;

	/*
	 * Makes theme available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'kleo_framework', get_template_directory() . '/languages' );

	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'audio',
		'quote',
		'link',
		'gallery',
	) );

	/* This theme uses wp_nav_menu() in two locations. */
	register_nav_menu( 'primary', __( 'Primary Menu', 'kleo_framework' ) );
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'kleo_framework' ) );
	register_nav_menu( 'top', __( 'Top Menu', 'kleo_framework' ) );
	register_nav_menu( 'side', __( 'Side Menu', 'kleo_framework' ) );

	/* This theme uses a custom image size for featured images, displayed on "standard" posts. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 9999 ); // Unlimited height, soft crop

	$blog_img_single_crop   = sq_option( 'blog_img_single_crop', false ) ? true : false;
	$blog_img_standard_crop = sq_option( 'blog_img_standard_crop', true ) ? true : false;
	$blog_img_grid_crop     = sq_option( 'blog_img_grid_crop', false ) ? true : false;
	$blog_img_small_crop    = sq_option( 'blog_img_small_crop', true ) ? true : false;

	//Single post image size
	add_image_size( 'kleo-full-width',
		sq_option( 'blog_img_single_width', 1038 ),
		sq_option( 'blog_img_single_height', 9999 ),
		$blog_img_single_crop
	); //default 480x270

	//check for custom image sizes
	if ( sq_option( 'blog_custom_img', 0 ) == 1 ) {
		add_image_size( 'kleo-post-gallery',
			sq_option( 'blog_img_standard_width', $kleo_config['post_gallery_img_width'] ),
			sq_option( 'blog_img_standard_height', $kleo_config['post_gallery_img_height'] ),
			$blog_img_standard_crop
		); //default 480x270
		add_image_size( 'kleo-post-grid',
			sq_option( 'blog_img_grid_width', $kleo_config['post_gallery_img_width'] ),
			sq_option( 'blog_img_grid_height', 9999 ),
			$blog_img_grid_crop
		); //default 480xauto-height
		add_image_size( 'kleo-post-small-thumb',
			sq_option( 'blog_img_small_width', $kleo_config['post_gallery_img_width'] ),
			sq_option( 'blog_img_small_height', $kleo_config['post_gallery_img_height'] ),
			$blog_img_small_crop
		); //default 480xauto-height
	}

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
	) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'kleo_get_featured_posts',
		'max_posts'               => 6,
	) );

	/* Specific framework functionality */
	add_theme_support( 'kleo-sidebar-generator' );
	add_theme_support( 'kleo-facebook-login' );
	add_theme_support( 'kleo-mega-menu' );
	add_theme_support( 'kleo-menu-items' );

	/* Third-party plugins */
	add_theme_support( 'bbpress' );
	add_theme_support( 'woocommerce' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 'kleo_setup' );


if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function kleo_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}

	add_action( 'wp_head', 'kleo_slug_render_title' );
}


if ( ! function_exists( 'kleo_wp_title' ) ):
	/**
	 * Creates a nicely formatted and more specific title element text
	 * for output in head of document, based on current view.
	 *
	 * @since Kleo Framework 1.0
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 *
	 * @return string Filtered title.
	 */
	function kleo_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}
		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'kleo_framework' ), max( $paged, $page ) );
		}

		return $title;
	}

	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		add_filter( 'wp_title', 'kleo_wp_title', 10, 2 );
	}
endif;


/***************************************************
 * :: Main menu Navigation
 ***************************************************/

require_once( KLEO_LIB_DIR . '/menu-walker.php' );


/***************************************************
 * :: Featured content
 ***************************************************/

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Kleo 1.0
 *
 * @return array An array of WP_Post objects.
 */
function kleo_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Kleo.
	 *
	 * @since Kleo 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'kleo_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Kleo 1.0
 *
 * @return bool Whether there are featured posts.
 */
function kleo_has_featured_posts() {
	return ! is_paged() && (bool) kleo_get_featured_posts();
}


/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/lib/featured-content/featured-content.php';
}
//------------------------------------------------------------------------------


if ( ! function_exists( 'kleo_widgets_init' ) ) :
	/**
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @since Kleo 1.0
	 */
	function kleo_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Main Sidebar', 'kleo_framework' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Default sidebar', 'kleo_framework' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => 'Footer column 1',
			'id'            => 'footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer column 2',
			'id'            => 'footer-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer column 3',
			'id'            => 'footer-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer column 4',
			'id'            => 'footer-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => 'Extra - for 3 columns pages',
			'id'            => 'extra',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => 'Shop sidebar',
			'id'            => 'shop-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

	}
endif;
add_action( 'widgets_init', 'kleo_widgets_init' );


if ( ! function_exists( 'kleo_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 * Create your own kleo_entry_meta() to override in a child theme.
	 * @since 1.0
	 */
	function kleo_entry_meta( $echo = true, $att = array() ) {

		global $kleo_config;
		$meta_list     = array();
		$author_links  = '';
		$meta_elements = sq_option( 'blog_meta_elements', $kleo_config['blog_meta_defaults'] );

		// Translators: used between list items, there is a space after the comma.
		if ( in_array( 'categories', $meta_elements ) ) {
			$categories_list = get_the_category_list( __( ', ', 'kleo_framework' ) );
		}

		// Translators: used between list items, there is a space after the comma.
		if ( in_array( 'tags', $meta_elements ) ) {
			$tag_list = get_the_tag_list( '', __( ', ', 'kleo_framework' ) );
		}

		$date = sprintf( '<a href="%1$s" rel="bookmark" class="post-time">' .
		                 '<time class="entry-date" datetime="%2$s">%3$s</time>' .
		                 '<time class="modify-date hide hidden updated" datetime="%4$s">%5$s</time>' .
		                 '</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_html( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);


		if ( is_array( $meta_elements ) && ! empty( $meta_elements ) ) {


			if ( in_array( 'author_link', $meta_elements ) || in_array( 'avatar', $meta_elements ) ) {

				/* If buddypress is active then create a link to Buddypress profile instead */
				if ( function_exists( 'bp_is_active' ) ) {
					$author_link  = esc_url( bp_core_get_userlink( get_the_author_meta( 'ID' ), $no_anchor = false, $just_link = true ) );
					$author_title = esc_attr( sprintf( __( 'View %s\'s profile', 'kleo_framework' ), get_the_author() ) );
				} else {
					$author_link  = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
					$author_title = esc_attr( sprintf( __( 'View all POSTS by %s', 'kleo_framework' ), get_the_author() ) );
				}

				$author = sprintf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s %4$s</a>',
					$author_link,
					$author_title,
					in_array( 'avatar', $meta_elements ) ? get_avatar( get_the_author_meta( 'ID' ), 50 ) : '',
					in_array( 'author_link', $meta_elements ) ? '<span class="author-name">' . get_the_author() . '</span>' : ''
				);

				$meta_list[] = '<small class="meta-author author vcard">' . $author . '</small>';
			}

			if ( function_exists( 'bp_is_active' ) ) {
				if ( in_array( 'profile', $meta_elements ) ) {
					$author_links .= '<a href="' . bp_core_get_userlink( get_the_author_meta( 'ID' ), $no_anchor = false, $just_link = true ) . '">' .
					                 '<i class="icon-user-1 hover-tip" ' .
					                 'data-original-title="' . esc_attr( sprintf( __( 'View profile', 'kleo_framework' ), get_the_author() ) ) . '"' .
					                 'data-toggle="tooltip"' .
					                 'data-placement="top"></i>' .
					                 '</a>';
				}

				if ( bp_is_active( 'messages' ) && is_user_logged_in() ) {
					if ( in_array( 'message', $meta_elements ) ) {
						$author_links .= '<a href="' . wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( get_the_author_meta( 'ID' ) ) ) . '">' .
						                 '<i class="icon-mail hover-tip" ' .
						                 'data-original-title="' . esc_attr( sprintf( __( 'Contact %s', 'kleo_framework' ), get_the_author() ) ) . '" ' .
						                 'data-toggle="tooltip" ' .
						                 'data-placement="top"></i>' .
						                 '</a>';
					}
				}
			}

			if ( in_array( 'archive', $meta_elements ) ) {
				$author_links .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' .
				                 '<i class="icon-docs hover-tip" ' .
				                 'data-original-title="' . esc_attr( sprintf( __( 'View all posts by %s', 'kleo_framework' ), get_the_author() ) ) . '" ' .
				                 'data-toggle="tooltip" ' .
				                 'data-placement="top"></i>' .
				                 '</a>';
			}
		}

		if ( '' != $author_links ) {
			$meta_list[] = '<small class="meta-links">' . $author_links . '</small>';
		}

		if ( in_array( 'date', $meta_elements ) ) {
			$meta_list[] = '<small>' . $date . '</small>';
		}

		$cat_tag = array();

		if ( isset( $categories_list ) && $categories_list ) {
			$cat_tag[] = $categories_list;
		}

		if ( isset( $tag_list ) && $tag_list ) {
			$cat_tag[] = $tag_list;
		}
		if ( ! empty( $cat_tag ) ) {
			$meta_list[] = '<small class="meta-category">' . implode( ', ', $cat_tag ) . '</small>';
		}

		//comments
		if ( ( ! isset( $att['comments'] ) || ( isset( $att['comments'] ) && false != $att['comments']  ) ) && in_array( 'comments', $meta_elements ) ) {
			$meta_list[] = '<small class="meta-comment-count"><a href="' . get_permalink() . '#comments">' . get_comments_number() .
			               ' <i class="icon-chat-1 hover-tip" ' .
			               'data-original-title="' . sprintf( _n( 'This article has one comment', 'This article has %1$s comments', get_comments_number(), 'kleo_framework' ), number_format_i18n( get_comments_number() ) ) . '" ' .
			               'data-toggle="tooltip" ' .
			               'data-placement="top"></i>' .
			               '</a></small>';
		}

		$meta_separator = isset( $att['separator'] ) ? $att['separator'] : sq_option( 'blog_meta_sep', ', ' );

		if ( $echo ) {
			echo implode( $meta_separator, $meta_list );
		} else {
			return implode( $meta_separator, $meta_list );
		}


	}
endif;


/***************************************************
 * :: Comments functions
 ***************************************************/


if ( ! function_exists( 'kleo_custom_comments' ) ) {
	/**
	 * Display customized comments
	 *
	 * @param object $comment
	 * @param array $args
	 * @param integer $depth
	 */
	function kleo_custom_comments( $comment, $args, $depth ) {
		$GLOBALS['comment']       = $comment;
		$GLOBALS['comment_depth'] = $depth;
		?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class( 'clearfix' ) ?>>
			<div class="comment-wrap clearfix">
				<div class="comment-avatar kleo-rounded">
					<?php
					if ( function_exists( 'get_avatar' ) ) {
						echo get_avatar( $comment, '100' );
					}
					?>
					<?php if ( get_the_author_meta( 'email' ) == $comment->comment_author_email ) { ?>
						<span class="tooltip"><?php _e( 'Author', 'kleo_framework' ); ?><span class="arrow"></span></span>
					<?php } ?>
				</div>
				<div class="comment-content">
					<div class="comment-meta">
						<?php
						printf( '<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
							get_comment_author_link(),
							human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'kleo_framework' )
						);
						?>
					</div>
					<?php
					if ( '0' == $comment->comment_approved ) {
						_e( "<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'kleo_framework' );
					}
					?>
					<div class="comment-body">
						<?php comment_text() ?>
					</div>
					<div class="comment-meta-actions">
						<?php
						edit_comment_link( __( 'Edit', 'kleo_framework' ), '<span class="edit-link">', '</span><span class="meta-sep"> |</span>' );
						?>
						<?php if ( 'all' == $args['type'] || 'comment' == get_comment_type() ) :
							comment_reply_link( array_merge( $args, array(
								'reply_text' => __( 'Reply', 'kleo_framework' ),
								'login_text' => __( 'Log in to reply.', 'kleo_framework' ),
								'depth'      => $depth,
								'before'     => '<span class="comment-reply">',
								'after'      => '</span>',
							) ) );
						endif; ?>
					</div>
				</div>
			</div>
	<?php }
} // end kleo_custom_comments


if ( ! function_exists( 'kleo_comment_form' ) ) :
	/**
	 * Outputs a complete commenting form for use within a template.
	 * Most strings and form fields may be controlled through the $args array passed
	 * into the function, while you may also choose to use the comment_form_default_fields
	 * filter to modify the array of default fields if you'd just like to add a new
	 * one or remove a single field. All fields are also individually passed through
	 * a filter of the form comment_form_field_$name where $name is the key used
	 * in the array of fields.
	 *
	 * @param array $args Options for strings, fields etc in the form
	 * @param mixed $post_id Post ID to generate the form for, uses the current post if null
	 *
	 * @return void
	 */
	function kleo_comment_form( $args = array(), $post_id = null ) {
		global $id;

		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		if ( null === $post_id ) {
			$post_id = $id;
		} else {
			$id = $post_id;
		}

		if ( comments_open( $post_id ) ) :
			?>
			<div id="respond-wrap">
				<?php
				$commenter = wp_get_current_commenter();
				$req       = get_option( 'require_name_email' );
				$aria_req  = ( $req ? " aria-required='true'" : '' );
				$fields    = array(
					'author' => '<div class="row"><p class="comment-form-author col-sm-4"><label for="author">' . __( 'Name', 'kleo_framework' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
					'email'  => '<p class="comment-form-email col-sm-4"><label for="email">' . __( 'Email', 'kleo_framework' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
					'url'    => '<p class="comment-form-url col-sm-4"><label for="url">' . __( 'Website', 'kleo_framework' ) . '</label><input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
				);

				if ( function_exists( 'bp_is_active' ) ) {
					$profile_link = bp_get_loggedin_user_link();
				} else {
					$profile_link = admin_url( 'profile.php' );
				}

				$comments_args = array(
					'fields'            => apply_filters( 'comment_form_default_fields', $fields ),
					'logged_in_as'      => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'kleo_framework' ), $profile_link, $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
					'title_reply'       => __( 'Leave a reply', 'kleo_framework' ),
					'title_reply_to'    => __( 'Leave a reply to %s', 'kleo_framework' ),
					'cancel_reply_link' => __( 'Click here to cancel the reply', 'kleo_framework' ),
					'label_submit'      => __( 'Post comment', 'kleo_framework' ),
					'comment_field'     => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'kleo_framework' ) . '</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
					'must_log_in'       => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'kleo_framework' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
				);

				comment_form( $comments_args );
				?>
			</div>

			<?php
		endif;

	}
endif;


if ( ! function_exists( 'kleo_the_attached_image' ) ) :
	/**
	 * Print the attached image with a link to the next attached image.
	 *
	 * @since Kleo 1.0
	 *
	 * @return void
	 */
	function kleo_the_attached_image() {
		$post = get_post();
		/**
		 * Filter the default attachment size.
		 *
		 * @since Kleo 1.0
		 *
		 * @param array $dimensions {
		 *     An array of height and width dimensions.
		 *
		 * @type int $height Height of the image in pixels. Default 810.
		 * @type int $width Width of the image in pixels. Default 810.
		 * }
		 */
		$attachment_size     = apply_filters( 'kleo_attachment_size', array( 810, 810 ) );
		$next_attachment_url = wp_get_attachment_url();

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => - 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( isset( $next_id ) && $next_id ) {
				$next_attachment_url = get_attachment_link( $next_id );
			} // or get the URL of the first image attachment.
			else {
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}
		}

		printf( '<a href="%1$s" rel="attachment">%2$s</a>',
			esc_url( $next_attachment_url ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif;


/***************************************************
 * :: Sidebar logic
 ***************************************************/
if ( ! function_exists( 'kleo_switch_layout' ) ) {
	/**
	 * Change site layout
	 *
	 * @param bool $layout
	 * @param int $priority
	 */
	function kleo_switch_layout( $layout = false, $priority = 10 ) {
		if ( false == $layout ) {
			$layout = sq_option( 'global_sidebar', 'right' );
		}

		$main_width_2cols = (int) sq_option( 'main_width_2cols', 9 ) == 0 ? 9 : (int) sq_option( 'main_width_2cols', 9 );
		$main_width_3cols = (int) sq_option( 'main_width_3cols', 6 ) == 0 ? 6 : (int) sq_option( 'main_width_3cols', 6 );

		$sidebar_width_2cols = 12 - $main_width_2cols;
		$sidebar_width_3cols = ( 12 - $main_width_3cols ) / 2;

		switch ( $layout ) {

			case 'left':
				add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
				remove_action( 'kleo_after_content', 'kleo_extra_sidebar' );

				add_filter( 'kleo_main_template_classes', function( $cols ) use( $main_width_2cols, $sidebar_width_2cols ) {
					$cols = "col-sm-$main_width_2cols col-sm-push-$sidebar_width_2cols tpl-left";
					return $cols;
				}, $priority );

				add_filter( 'kleo_sidebar_classes', function( $cols ) use( $sidebar_width_2cols, $main_width_2cols ) {
					$cols = "col-sm-$sidebar_width_2cols sidebar-left col-sm-pull-$main_width_2cols";
					return $cols;
				}, $priority );

				remove_filter( 'kleo_main_container_class', 'kleo_ret_full_container', $priority );
				break;

			case 'no':    //full width
			case 'full':    //full width
				remove_action( 'kleo_after_content', 'kleo_sidebar' );
				remove_action( 'kleo_after_content', 'kleo_extra_sidebar' );

				add_filter( 'kleo_main_template_classes', function() {
					$cols = 'col-sm-12 tpl-no';
					return $cols;
				}, $priority );

				//enable full-width elements
				$has_vc = kleo_has_shortcode( 'vc_row' );
				sq_kleo()->set_option( 'has_vc_shortcode', $has_vc );

				if ( ! is_singular( 'product' ) && $has_vc ) {
					add_filter( 'kleo_main_container_class', 'kleo_ret_full_container', $priority );
				}

				break;

			case '3ll':
				add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
				add_action( 'kleo_after_content', 'kleo_extra_sidebar', $priority );

				add_filter( 'kleo_main_template_classes', function( $cols ) use( $main_width_3cols, $sidebar_width_3cols ) {
					$cols = 'col-sm-' . $main_width_3cols . ' col-sm-push-' . ( $sidebar_width_3cols * 2 ) . ' tpl-3ll';
					return $cols;
				}, $priority );

				add_filter( 'kleo_sidebar_classes', function( $cols ) use( $sidebar_width_3cols, $main_width_3cols ) {
					$cols = 'col-sm-' . $sidebar_width_3cols . ' col-sm-pull-' . $main_width_3cols . ' sidebar-3ll';
					return $cols;
				}, $priority );

				add_filter( 'kleo_extra_sidebar_classes', function( $cols ) use( $sidebar_width_3cols, $main_width_3cols ) {
					$cols = 'col-sm-' . $sidebar_width_3cols . ' col-sm-pull-' . '$main_width_3cols' . ' sidebar-3ll';
					return $cols;
				}, $priority );

				remove_filter( 'kleo_main_container_class', 'kleo_ret_full_container', $priority );
				break;

			case '3lr':
				add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
				add_action( 'kleo_after_content', 'kleo_extra_sidebar', $priority );
				add_filter( 'kleo_main_template_classes', function( $cols) use( $main_width_3cols, $sidebar_width_3cols ) {
					$cols = 'col-sm-' . $main_width_3cols . ' col-sm-push-' . $sidebar_width_3cols . ' tpl-3lr';
					return $cols;
				}, $priority );

				add_filter( 'kleo_sidebar_classes', function( $cols ) use( $sidebar_width_3cols, $main_width_3cols ) {
					$cols = 'col-sm-' . $sidebar_width_3cols . ' col-sm-pull-' . $main_width_3cols . ' sidebar-3lr';
					return $cols;
				}, $priority );

				add_filter( 'kleo_extra_sidebar_classes', function( $cols ) use( $sidebar_width_3cols ) {
					$cols = 'col-sm-' . $sidebar_width_3cols . ' sidebar-3lr';
					return $cols;
				}, $priority );

				remove_filter( 'kleo_main_container_class', 'kleo_ret_full_container', $priority );
				break;

			case '3rr':
				add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
				add_action( 'kleo_after_content', 'kleo_extra_sidebar', $priority );

				add_filter( 'kleo_main_template_classes', function( $cols ) use ( $main_width_3cols ) {
					$cols = "col-sm-$main_width_3cols tpl-3rr";
					return $cols;
				}, $priority );

				add_filter( 'kleo_sidebar_classes', function( $cols ) use( $sidebar_width_3cols ) {
					$cols = "col-sm-$sidebar_width_3cols sidebar-3rr";
					return $cols;
				}, $priority );

				add_filter( 'kleo_extra_sidebar_classes', function( $cols ) use( $sidebar_width_3cols ) {
					$cols = "col-sm-$sidebar_width_3cols sidebar-3rr";
					return $cols;
				}, $priority );

				remove_filter( 'kleo_main_container_class', 'kleo_ret_full_container', $priority );
				break;

			case 'right':
			default:
				add_action( 'kleo_after_content', 'kleo_sidebar', $priority );
				remove_action( 'kleo_after_content', 'kleo_extra_sidebar' );

				add_filter( 'kleo_main_template_classes', function( $cols ) use( $main_width_2cols ) {
					$cols = "col-sm-$main_width_2cols tpl-right";
					return $cols;
				}, $priority );

				add_filter( 'kleo_sidebar_classes', function( $cols ) use( $sidebar_width_2cols ) {
					$cols = "col-sm-$sidebar_width_2cols sidebar-right";
					return $cols;
				}, $priority );

				remove_filter( 'kleo_main_container_class', 'kleo_ret_full_container', $priority );
				break;
		}
	}
}

if ( ! function_exists( 'kleo_prepare_layout' ) ) {
	/**
	 * Prepare site layout with different customizations
	 * @global string $kleo_custom_logo
	 */
	function kleo_prepare_layout() {

		//Change the template
		$layout = sq_option( 'global_sidebar', 'right' );

		if ( is_home() ) {
			$layout = sq_option( 'blog_layout', 'right' );
		} elseif ( is_archive() ) {
			$layout = sq_option( 'cat_layout', 'right' );
		} elseif ( is_single() ) {
			if ( get_cfield( 'post_layout' ) && get_cfield( 'post_layout' ) != 'default' ) {
				$layout = get_cfield( 'post_layout' );
			} elseif ( sq_option( 'blog_post_layout', 'default' ) != 'default' ) {
				$layout = sq_option( 'blog_post_layout', 'right' );
			}
		}

		$layout = apply_filters( 'kleo_page_layout', $layout );
		kleo_switch_layout( $layout );

		/* Single post of any post type */
		if ( is_singular() || is_home() ) {
			$topbar_status = get_cfield( 'topbar_status' );
			//Top bar
			if ( isset( $topbar_status ) ) {
				if ( '1' === $topbar_status ) {
					add_filter( 'kleo_show_top_bar', function() { return 1; } );
				} elseif ( '0' === $topbar_status ) {
					add_filter( 'kleo_show_top_bar', '__return_zero' );
				}
			}

			//Header and Footer settings
			if ( get_cfield( 'hide_header' ) && get_cfield( 'hide_header' ) == 1 ) {
				remove_action( 'kleo_header', 'kleo_show_header' );
			}
			if ( get_cfield( 'hide_footer' ) && get_cfield( 'hide_footer' ) == 1 ) {
				add_filter( 'kleo_footer_hidden', '__return_true' );
			}
			if ( get_cfield( 'hide_socket' ) && get_cfield( 'hide_socket' ) == 1 ) {
				remove_action( 'kleo_after_footer', 'kleo_show_socket' );
			}

			//Custom logo
			if ( get_cfield( 'logo' ) ) {
				global $kleo_custom_logo;
				$kleo_custom_logo = get_cfield( 'logo' );
				add_filter( 'kleo_logo', function() use( $kleo_custom_logo ) {
					return $kleo_custom_logo;
				});
			}

			//Remove shop icon
			if ( get_cfield( 'hide_shop_icon' ) && get_cfield( 'hide_shop_icon' ) == 1 ) {
				remove_filter( 'wp_nav_menu_items', 'kleo_woo_header_cart', 9 );
				remove_filter( 'kleo_mobile_header_icons', 'kleo_woo_mobile_icon', 10 );
			}
			//Remove search icon
			if ( get_cfield( 'hide_search_icon' ) && get_cfield( 'hide_search_icon' ) == 1 ) {
				remove_filter( 'wp_nav_menu_items', 'kleo_search_menu_item', 200, 2 );
			}

			if ( get_cfield( 'header_layout' ) && get_cfield( 'header_layout' ) != 'default' ) {
				add_filter( 'sq_option', 'kleo_override_header_layout', 10, 2 );
			}

			//title section css
			global $kleo_theme;
			if ( get_cfield( 'title_top_padding' ) && get_cfield( 'title_top_padding' ) != '' ) {
				$kleo_theme->add_css( '.main-title {padding-top: ' . get_cfield( 'title_top_padding' ) . 'px;}' );
			}
			if ( get_cfield( 'title_bottom_padding' ) && get_cfield( 'title_bottom_padding' ) != '' ) {
				$kleo_theme->add_css( '.main-title {padding-bottom: ' . get_cfield( 'title_bottom_padding' ) . 'px;}' );
			}
			if ( get_cfield( 'title_color' ) && get_cfield( 'title_color' ) != '#' && get_cfield( 'title_color' ) != '' ) {
				$kleo_theme->add_css( '.main-title, .main-title h1, .main-title a, .main-title span, .breadcrumb > li + li:before {color: ' . get_cfield( 'title_color' ) . ' !important;}' );
			}
			if ( get_cfield( 'title_bg_color' ) && get_cfield( 'title_bg_color' ) != '#' && get_cfield( 'title_bg_color' ) != '' ) {
				$kleo_theme->add_css( '.main-title {background-color: ' . get_cfield( 'title_bg_color' ) . ' !important;}' );
			}
			if ( get_cfield( 'title_bg' ) && is_array( get_cfield( 'title_bg' ) ) ) {
				$title_bg = get_cfield( 'title_bg' );
				if ( isset( $title_bg['url'] ) && '' != $title_bg['url'] ) {
					$kleo_theme->add_css( '.main-title {' .
						'background-image: url("' . $title_bg['url'] . '");' .
						'background-repeat: ' . $title_bg['repeat'] . ';' .
						'background-size: ' . $title_bg['size'] . ';' .
						'background-attachment: ' . $title_bg['attachment'] . ';' .
						'background-position: ' . $title_bg['position'] . ';' .
						'}'
					);
				}
			}
		}

		//Show title in main content - if set from Theme options
		add_action( 'kleo_before_main_content', 'kleo_title_main_content' );
	}
}

add_action( 'wp_head', 'kleo_prepare_layout' );


//get the global sidebar
if ( ! function_exists( 'kleo_sidebar' ) ) :
	function kleo_sidebar() {
		get_sidebar();
	}
endif;

//get the extra sidebar
if ( ! function_exists( 'kleo_extra_sidebar' ) ) :
	function kleo_extra_sidebar() {
		$classes = apply_filters( 'kleo_extra_sidebar_classes', '' );

		echo '<div class="sidebar sidebar-extra ' . $classes . '">'
		     . '<div class="inner-content">';

		generated_dynamic_sidebar( 'extra' );

		echo '</div>'
		     . '</div> <!--end sidebar columns-->';
	}
endif;

function kleo_ret_full_container() {
	return 'container-full';
}

if ( ! function_exists( 'kleo_title_main_content' ) ) {
	/**
	 * Echo the title if it was set to show in main content area
	 */
	function kleo_title_main_content() {
		if ( sq_option( 'title_location', 'breadcrumb' ) == 'main' ) {

			$title_status = true;
			if ( ( is_singular() || is_home() ) && get_cfield( 'title_checkbox' ) == 1 ) {
				$title_status = false;
			}

			if ( $title_status ) {
				if ( ( is_singular() || is_home() ) && get_cfield( 'custom_title' ) && get_cfield( 'custom_title' ) != '' ) {
					$title = get_cfield( 'custom_title' );
				} else {
					$title = kleo_title();
				}

				echo '<div class="container">';
				echo '<h1 class="page-title">' . $title . '</h1>';
				echo '</div>';
			}
		}
	}
}

/* Change the html page title if we set a custom title */
add_filter( 'single_post_title', 'kleo_check_single_post_title', 10, 2 );
function kleo_check_single_post_title( $title, $post = false ) {

	if ( ! $post || ! isset( $post->ID ) ) {
		return $title;
	}

	if ( get_cfield( 'custom_title', $post->ID ) && get_cfield( 'custom_title', $post->ID ) != '' ) {
		return get_cfield( 'custom_title', $post->ID );
	}

	return $title;
}


/***************************************************
 * :: Render the header section with the menus
 ***************************************************/

function kleo_show_header() {
	get_template_part( 'page-parts/general-header-section' );
}

add_action( 'kleo_header', 'kleo_show_header' );


/***************************************************
 * :: Extra body classes
 ***************************************************/

add_filter( 'body_class', 'kleo_body_classes' );

/**
 * Adds specific classes to body element
 *
 * @param array $classes
 *
 * @return array
 * @since 1.0
 */
function kleo_body_classes( $classes = array() ) {

	if ( is_admin_bar_showing() && sq_option( 'admin_bar', 1 ) == 1 ) {
		$classes[] = 'adminbar-enable';
	}

	if ( sq_option( 'responsive_design', 1 ) == 0 ) {
		$classes[] = 'not-responsive';
	}

	if ( sq_option( 'sticky_menu', 1 ) == 1 ) {
		$classes[] = 'kleo-navbar-fixed';

		if ( sq_option( 'resize_logo', 1 ) == 1 ) {
			$classes[] = 'navbar-resize';
		}
	}

	if ( ( sq_option( 'sticky_menu', 1 ) == 1 && sq_option( 'transparent_logo', 1 ) == 1 )
	     || ( ( is_singular() || ( is_home() && get_option( 'page_for_posts' ) ) ) && get_cfield( 'transparent_menu' ) )
	) {
		$classes[] = 'navbar-transparent';

		if ( get_cfield( 'transparent_menu_color' ) === 'black' ) {
			$classes[] = 'on-light-bg';
		} else {
			$classes[] = 'on-dark-bg';
		}

		if ( sq_option( 'header_overlay_hover', 0 ) == 1 ) {
			$classes[] = 'navbar-hover-opacity';
		}
	}

	if ( sq_option( 'sitewide_animations', 'enabled' ) == 'disable-all' ) {
		$classes[] = 'disable-all-animations';
	}

	if ( sq_option( 'sitewide_animations', 'enabled' ) == 'disable-mobile' ) {
		$classes[] = 'disable-all-animations-on-mobile';
	}

	if ( sq_option( 'menu_full_width', 0 ) == 1 || ( is_singular() && get_cfield( 'menu_full_width' ) ) ) {
		$classes[] = 'navbar-full-width';
	}

	/* Flexmenu */
	if ( sq_option( 'header_flexmenu', 0 ) == 1 ) {
		$classes[] = 'header-overflow';
		$classes[] = 'header-flexmenu';
	}

	/* Two row header */
	$header_style = sq_option( 'header_layout', 'normal' );
	if ( 'left_logo' == $header_style || 'center_logo' == $header_style ) {
		$classes[] = 'header-two-rows';
	}

	/* Stick footer */
	if ( 1 == sq_option( 'footer_bottom', 0 ) ) {
		$classes[] = 'footer-bottom';
	}

	return $classes;
}

// -----------------------------------------------------------------------------


/***************************************************
 * :: Theme options link in Admin bar
 ***************************************************/

add_action( 'admin_bar_menu', 'kleo_add_adminbar_options', 100 );

/**
 * @param WP_Admin_Bar $admin_bar
 */
function kleo_add_adminbar_options( $admin_bar ) {
	if ( is_super_admin() && ! is_admin() ) {
		$admin_bar->add_menu( array(
			'id'    => 'theme-options',
			'title' => __( 'Theme options', 'kleo_framework' ),
			'href'  => get_admin_url() . 'admin.php?page=kleo_options',
			'meta'  => array(
				'title'  => __( 'Theme options', 'kleo_framework' ),
				'target' => '_blank',
			),
		) );
	}

}

/***************************************************
 * :: Add mp4, webm and ogv mimes for uploads
 ***************************************************/

add_filter( 'upload_mimes', 'kleo_add_upload_mimes' );
if ( ! function_exists( 'kleo_add_upload_mimes' ) ) {
	function kleo_add_upload_mimes( $mimes ) {
		return array_merge( $mimes, array( 'mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm' ) );
	}
}


/***************************************************
 * :: Scripts/Styles load
 ***************************************************/

add_action( 'wp_enqueue_scripts', 'kleo_frontend_files' );
if ( ! function_exists( 'kleo_frontend_files' ) ) :
	// Register some javascript files
	function kleo_frontend_files() {
		$min = sq_option( 'dev_mode', 0 ) == 1 ? '' : '.min';

		/* If remove query option is ON */
		if ( sq_option( 'perf_remove_query', 0 ) == 1 ) {
			$version = null;
		} else {
			$version = KLEO_THEME_VERSION;
		}

		//head scripts
		//wp_register_script( 'kleo-init', get_template_directory_uri() . '/assets/js/init.js', array(), $version, false );
		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.46504.js', array(), $version, false );
		wp_register_script( 'pad-fullpage', get_template_directory_uri() . '/assets/js/jquery.fullPage.js', array(), $version, false );
		wp_register_script( 'pad-custmor', get_template_directory_uri() . '/assets/js/pad-custmor.js', array(), $version, false );

		/* Footer scripts */
		if ( sq_option( 'perf_combine_js', 0 ) == 1 ) {
			wp_register_script( 'kleo-combined', get_template_directory_uri() . '/assets/js/combined' . $min . '.js', array( 'jquery' ), $version, true );
		} else {
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap' . $min . '.js', array( 'jquery' ), $version, true );
			wp_register_script( 'waypoints', get_template_directory_uri() . '/assets/js/plugins/waypoints.min.js', array( 'jquery' ), $version, true );
			wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/plugins/magnific-popup/magnific.min.js', array( 'jquery' ), $version, true );
			wp_register_script( 'caroufredsel', get_template_directory_uri() . '/assets/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js', array( 'jquery' ), $version, true );
			wp_register_script( 'jquery-mousewheel', get_template_directory_uri() . '/assets/js/plugins/carouFredSel/helper-plugins/jquery.mousewheel.min.js', array(
				'jquery',
				'caroufredsel',
			), $version, true );
			wp_register_script( 'jquery-touchswipe', get_template_directory_uri() . '/assets/js/plugins/carouFredSel/helper-plugins/jquery.touchSwipe.min.js', array(
				'jquery',
				'caroufredsel',
			), $version, true );
			wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/plugins/jquery.isotope.min.js', array( 'jquery' ), $version, true );

		}
		wp_register_script( 'app', get_template_directory_uri() . '/assets/js/app' . $min . '.js', array( 'jquery' ), $version, true );

		//not loaded by default. Only when needed by shortcodes
		wp_register_script( 'three-canvas', get_template_directory_uri() . '/assets/js/plugins/snow/ThreeCanvas.js', array( 'app' ), $version, true );
		wp_register_script( 'snow', get_template_directory_uri() . '/assets/js/plugins/snow/Snow.js', array( 'three-canvas' ), $version, true );
		wp_register_script( 'particles-js', get_template_directory_uri() . '/assets/js/plugins/particles.min.js', array( 'jquery' ), $version, true );
		wp_register_script( 'bootstrap-multiselect', get_template_directory_uri() . '/assets/js/plugins/bootstrap-multiselect.js', array( 'jquery' ), $version, true );

		//enqueue them
		//wp_enqueue_script( 'kleo-init' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'pad-fullpage' );
		wp_enqueue_script( 'pad-custmor' );

		if ( sq_option( 'perf_combine_js', 0 ) == 1 ) {
			wp_enqueue_script( 'kleo-combined' );
		} else {
			wp_enqueue_script( 'bootstrap' );
			wp_enqueue_script( 'waypoints' );
			wp_enqueue_script( 'magnific-popup' );
			wp_enqueue_script( 'caroufredsel' );
			wp_enqueue_script( 'jquery-touchswipe' );
			wp_enqueue_script( 'isotope' );
		}
		wp_enqueue_script( 'mediaelement' );
		wp_enqueue_script( 'app' );


		$regular_logo = sq_option_url('logo', '');
		if (is_singular() && get_cfield('logo')) {
			$regular_logo = get_cfield('logo');
		}
		$retina_logo = sq_option_url('logo_retina') != '' ? sq_option_url('logo_retina') : '';
		if (is_singular() && get_cfield('logo_retina')) {
			$retina_logo = get_cfield('logo_retina');
		}

		if( wp_is_mobile() ) {
			$mobile_logo = false;
			if(sq_option_url('mobile_logo', '') != '') {
				$regular_logo = sq_option_url('mobile_logo', '');
				$mobile_logo = true;
			}
			if (is_singular() && get_cfield('mobile_logo')) {
				$regular_logo = get_cfield('mobile_logo');
				$mobile_logo = true;
			}
			if($mobile_logo) {
				add_filter('kleo_logo', function ($logo) use ($regular_logo) {
					return $regular_logo;
				});
			}
			if( sq_option_url('mobile_logo_retina') != '' ) {
				$retina_logo = sq_option_url('mobile_logo_retina');
			}
			if (is_singular() && get_cfield('mobile_logo_retina')) {
				$retina_logo = get_cfield('mobile_logo_retina');
			}
		}

		$header_height              = intval( sq_option( 'menu_height', 88 ) );
		$header_height_scrolled     = intval( sq_option( 'menu_height_scrolled', '' ) );
		$header_two_height          = intval( sq_option( 'menu_two_height', 88 ) );
		$header_two_height_scrolled = intval( sq_option( 'menu_two_height_scrolled', '' ) );
		$header_resize_offset = sq_option( 'menu_scroll_offset', '' ) != '' ? intval( sq_option( 'menu_scroll_offset', '' ) ) : '';

		$obj_array = array(
			'ajaxurl'                    => admin_url( 'admin-ajax.php' ),
			'themeUrl'                   => get_template_directory_uri(),
			'loginUrl'                   => site_url( 'wp-login.php', 'login_post' ),
			'goTop'                      => sq_option( 'go_top', 1 ),
			'ajaxSearch'                 => sq_option( 'ajax_search', 1 ),
			'alreadyLiked'               => sq_option( 'likes_already', 'You already like this' ),
			'logo'                       => $regular_logo,
			'retinaLogo'                 => $retina_logo,
			'headerHeight'               => $header_height,
			'headerHeightScrolled'       => $header_height_scrolled,
			'headerTwoRowHeight'         => $header_two_height,
			'headerTwoRowHeightScrolled' => $header_two_height_scrolled,
			'headerResizeOffset'         => $header_resize_offset,
			'loadingmessage'             => '<i class="icon icon-spin5 animate-spin"></i> ' . __( 'Sending info, please wait...', 'kleo_framework' ),
			'DisableMagnificGallery'     => sq_option( 'magnific_disable_gallery', '0' ),
			'flexMenuEnabled'            => sq_option( 'header_flexmenu', 0 ),
            'errorOcurred'               => __('Sorry, an error occurred','kleo_framework'),
		);
		$obj_array = apply_filters( 'kleo_localize_app', $obj_array );

		wp_localize_script( 'app', 'kleoFramework', $obj_array );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* Register the styles */

		/* register only when Theme options - combine option is OFF */
		if ( sq_option( 'perf_combine_css', 0 ) == 0 ) {
			wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap' . $min . '.css', array(), $version, 'all' );
			wp_register_style( 'kleo-app', get_template_directory_uri() . '/assets/css/app' . $min . '.css', array(), $version, 'all' );
			wp_register_style( 'magnific-popup', get_template_directory_uri() . '/assets/js/plugins/magnific-popup/magnific.css', array(), $version, 'all' );
			wp_register_style( 'pad-fullpage', get_template_directory_uri() . '/assets/css/jquery.fullPage.css', array(), $version, 'all' );
			wp_register_style( 'pad-custmor', get_template_directory_uri() . '/assets/css/pad-custmor.css', array(), $version, 'all' );

			wp_enqueue_style( 'bootstrap' );
			wp_enqueue_style( 'kleo-app' );
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_style( 'pad-fullpage' );
			wp_enqueue_style( 'pad-custmor' );
		}

		/* Load font icons */
		$override_fonts = false;
		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/css/fontello.css' ) ) {
			$fonts_path     = get_stylesheet_directory_uri() . '/assets/css/fontello.css';
			$override_fonts = true;
		} else {
			$fonts_path = get_template_directory_uri() . '/assets/css/fontello' . $min . '.css';
		}

		wp_register_style( 'kleo-fonts', $fonts_path, array(), $version, 'all' );
		wp_register_style( 'kleo-style', CHILD_THEME_URI . '/style.css', array(), $version, 'all' );
		wp_register_style( 'kleo-rtl', get_template_directory_uri() . '/rtl.css', array(), $version, 'all' );

		//load fonts file if we not overriding font file in child theme
		if ( 0 == sq_option( 'perf_combine_css', 0 ) || ( 1 == sq_option( 'perf_combine_css', 0 ) && true === $override_fonts ) ) {
			wp_enqueue_style( 'kleo-fonts' );
		}

		//enqueue required styles
		wp_enqueue_style( 'mediaelement' );

	} // end kleo_frontend_files()
endif;


add_action( 'wp_enqueue_scripts', 'kleo_load_files_plugin_compat', 1000 );

function kleo_load_files_plugin_compat() {
	$min = sq_option( 'dev_mode', 0 ) == 0 ? '.min' : '';

	/* If remove query option is ON */
	if ( 1 == sq_option( 'perf_remove_query', 0 ) ) {
		$version = null;
	} else {
		$version = KLEO_THEME_VERSION;
	}

	/* Combine CSS option */
	if ( sq_option( 'perf_combine_css', 0 ) == 0 ) {
		wp_register_style( 'kleo-plugins', get_template_directory_uri() . '/assets/css/plugins' . $min . '.css', array(), $version, 'all' );
		wp_enqueue_style( 'kleo-plugins' );
	}

	//wp_enqueue_style( 'mediaelement-skin' );

	do_action( 'kleo_late_styles' );

	//enqueue child theme style only if activated
	if ( is_child_theme() ) {
		if ( is_rtl() ) {
			wp_enqueue_style( 'kleo-rtl' );
		}
		wp_enqueue_style( 'kleo-style' );
	}


} // kleo_load_css_files_plugin_compat()

add_action( 'wp_enqueue_scripts', 'kleo_load_combined_files', 20 );

function kleo_load_combined_files() {
	$min = sq_option( 'dev_mode', 0 ) == 0 ? '.min' : '';

	/* If remove query option is ON */
	if ( sq_option( 'perf_remove_query', 0 ) == 1 ) {
		$version = null;
	} else {
		$version = KLEO_THEME_VERSION;
	}

	if ( sq_option( 'perf_combine_css', 0 ) == 1 ) {

		$override_fonts = false;
		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/css/fontello.css' ) ) {
			$override_fonts = true;
		}

		//Load
		if ( true === $override_fonts ) {
			$combined_file = 'combined';
		} else {
			$combined_file = 'combined-and-fonts';
		}

		wp_register_style( 'kleo-combined', get_template_directory_uri() . '/assets/css/' . $combined_file . $min . '.css', array(), $version, 'all' );
		wp_enqueue_style( 'kleo-combined' );
	}
}

/* Remove all query strings from all static resources */

if ( sq_option( 'perf_remove_query', 0 ) == 1 ) {

	function pre_remove_query_strings_static_resources()
	{
		function remove_cssjs_ver($src)
		{
			if (strpos($src, '?ver='))
				$src = remove_query_arg('ver', $src);
			return $src;
		}

		add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
		add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);
	}

	add_action('init', 'pre_remove_query_strings_static_resources');
}

function kleo_add_inline_js_helper_classes() {
	?>
	<script type="text/javascript">
		/*
		 prevent dom flickering for elements hidden with js
		 */
		"use strict";

		document.documentElement.className += ' js-active ';
		document.documentElement.className += 'ontouchstart' in document.documentElement ? ' kleo-mobile ' : ' kleo-desktop ';

		var prefix = ['-webkit-', '-o-', '-moz-', '-ms-', ""];
		for (var i in prefix) {
			if (prefix[i] + 'transform' in document.documentElement.style) document.documentElement.className += " kleo-transform ";
		}
	</script>
	<?php
}

add_action( 'wp_head', 'kleo_add_inline_js_helper_classes' );


if ( ! function_exists( 'remove_wp_open_sans' ) ) {
	/**
	 * Remove duplicate Open Sans from WordPress
	 */
	function kleo_remove_wp_open_sans() {
		$font_link = get_transient( KLEO_DOMAIN . '_google_link' );
		if ( strpos( $font_link, 'Open+Sans' ) !== false ) {
			wp_deregister_style( 'open-sans' );
			wp_register_style( 'open-sans', false );
		}
	}

	add_action( 'wp_enqueue_scripts', 'kleo_remove_wp_open_sans' );
}


/***************************************************
 * :: ADMIN CSS & JS
 ***************************************************/
function kleo_admin_styles() {

	wp_register_style( 'kleo-admin', KLEO_LIB_URI . '/assets/admin-custom.css', array(), KLEO_THEME_VERSION, 'all' );
	wp_register_style( 'kleo-fonts', kleo_get_fonts_path(), array(), KLEO_THEME_VERSION, 'all' );

	wp_enqueue_style( 'kleo-admin' );

	wp_register_script( 'kleo-admin', KLEO_LIB_URI . '/assets/admin-custom.js', array(), KLEO_THEME_VERSION, true );
	wp_enqueue_script( 'kleo-admin' );
}

add_action( 'admin_enqueue_scripts', 'kleo_admin_styles' );



function kleo_get_fonts_path() {
	$fonts_path = get_template_directory_uri() . '/assets/css/fontello.css';
	if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/css/fontello.css' ) ) {
		$fonts_path = get_stylesheet_directory_uri() . '/assets/css/fontello.css';
	}

	return $fonts_path;
}

/***************************************************
 * :: Customize wp-login.php
 ***************************************************/
function custom_login_css() {

	echo "\n<style>";

	//echo $kleo_theme->get_bg_css('header_background', 'body.login');

	echo '.login h1 a { background-image: url("' . sq_option_url( 'logo', 'none' ) . '");background-size: contain;min-height: 88px;width:auto;}';
	echo '#login {padding: 20px 0 0;}';
	echo '.login #nav a, .login #backtoblog a {color:' . sq_option( 'header_primary_color' ) . '!important;text-shadow:none;}';

	echo "</style>\n";
}

add_action( 'login_head', 'custom_login_css', 12 );

function kleo_new_wp_login_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'kleo_new_wp_login_url' );

function kleo_new_wp_login_title() {
	return get_option( 'blogname' );
}

add_filter( 'login_headertitle', 'kleo_new_wp_login_title' );


/***************************************************
 * :: Load Fonts and Quick CSS
 ***************************************************/
sq_kleo()->add_google_fonts_link();
add_action( 'wp_head', array( $kleo_theme, 'render_css' ), 15 );


/***************************************************
 * :: Dynamic CSS Logic
 ***************************************************/
require_once( KLEO_LIB_DIR . '/dynamic-css.php' );


/***************************************************
 * :: Modal Ajax login && Modal Lost Password
 ***************************************************/

add_action( 'wp_footer', 'kleo_load_popups', 12 );

function kleo_load_popups() {
	if ( ! is_user_logged_in() ) {
		get_template_part( 'page-parts/general-popups' );
	}
}

add_action( 'init', 'kleo_ajax_login' );

if ( ! function_exists( 'kleo_ajax_login' ) ) {
	function kleo_ajax_login() {

		/* If not our action, bail out */
		if ( ! isset( $_POST['action'] ) || ( isset( $_POST['action'] ) && 'kleoajaxlogin' != $_POST['action'] ) ) {
			return false;
		}

		/* If user is already logged in print a specific message */
		if ( is_user_logged_in() ) {
			$link = 'javascript:window.location.reload();return false;';
			echo wp_json_encode( array(
				'loggedin' => false,
				'message'  => '<i class="icon icon-info-circled"></i> ' . sprintf( __( 'You are already logged in. Please <a href="#" onclick="%s">refresh</a> page', 'kleo_framework' ), $link ),
			) );
			die();
		}

		// Check the nonce, if it fails the function will break
		check_ajax_referer( 'kleo-ajax-login-nonce', 'security' );

		// Nonce is checked, continue
		$secure_cookie = '';

		// If the user wants ssl but the session is not ssl, force a secure cookie.
		if ( ! empty( $_POST['log'] ) && ! force_ssl_admin() ) {
			$user_name = sanitize_user( $_POST['log'] );
			if ( $user = get_user_by( 'login', $user_name ) ) {
				if ( get_user_option( 'use_ssl', $user->ID ) ) {
					$secure_cookie = true;
					force_ssl_admin( true );
				}
			}
		}

		if ( isset( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $_REQUEST['redirect_to'];
			// Redirect to https if user wants ssl
			if ( $secure_cookie && false !== strpos( $redirect_to, 'wp-admin' ) ) {
				$redirect_to = preg_replace( '|^http://|', 'https://', $redirect_to );
			}
		} else {
			$redirect_to = '';
		}

		$user_signon = wp_signon( '', $secure_cookie );
		if ( is_wp_error( $user_signon ) ) {
			$error_msg = $user_signon->get_error_message();
			$error_msg = apply_filters( 'login_errors', $error_msg );
			echo wp_json_encode( array(
				'loggedin' => false,
				'message'  => '<span class="wrong-response"><i class="icon icon-attention"></i> ' . $error_msg . '</span>',
			) );
			//echo json_encode(array( 'loggedin' => false, 'message' => '<span class="wrong-response"><i class="icon icon-attention"></i> ' . __( 'Wrong username or password. Please try again.', 'kleo_framework' ) . '</span>' ));
		} else {
			if ( sq_option( 'login_redirect', 'default' ) == 'reload' ) {
				$redirecturl = null;
			} else {
				$requested_redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
				/**
				 * Filter the login redirect URL.
				 *
				 * @since 3.0.0
				 *
				 * @param string $redirect_to The redirect destination URL.
				 * @param string $requested_redirect_to The requested redirect destination URL passed as a parameter.
				 * @param WP_User|WP_Error $user WP_User object if login was successful, WP_Error object otherwise.
				 */
				$redirecturl = apply_filters( 'login_redirect', $redirect_to, $requested_redirect_to, $user_signon );

			}

			echo wp_json_encode( array(
				'loggedin'    => true,
				'redirecturl' => $redirecturl,
				'message'     => '<span class="good-response"><i class="icon icon-ok-circled"></i> ' . __( 'Login successful, redirecting...', 'kleo_framework' ) . '</span>',
			) );
		}

		die();
	}
}


if ( ! function_exists( 'kleo_lost_password_ajax' ) ) {
	function kleo_lost_password_ajax() {
		// Check the nonce, if it fails the function will break
		check_ajax_referer( 'kleo-ajax-login-nonce', 'security' );

		$errors = new WP_Error();

		if ( isset( $_POST ) ) {

			if ( empty( $_POST['user_login'] ) ) {
				$errors->add( 'empty_username', __( '<strong>ERROR</strong>: Enter a username or e-mail address.' ) );
			} elseif ( strpos( $_POST['user_login'], '@' ) ) {
				$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
				if ( empty( $user_data ) ) {
					$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: There is no user registered with that email address.' ) );
				}
			} else {
				$login     = trim( $_POST['user_login'] );
				$user_data = get_user_by( 'login', $login );
			}

			/**
			 * Fires before errors are returned from a password reset request.
			 *
			 * @since 2.1.0
			 * @since 4.4.0 Added the `$errors` parameter.
			 *
			 * @param WP_Error $errors A WP_Error object containing any errors generated
			 *                         by using invalid credentials.
			 */
			do_action( 'lostpassword_post', $errors );

			if ( $errors->get_error_code() ) {
				echo '<span class="wrong-response">' . $errors->get_error_message() . '</span>';
				die();
			}

			if ( ! $user_data ) {
				$errors->add(
					'invalidcombo', wp_kses_data( __( '<strong>ERROR</strong>: Invalid username or e-mail.', 'default' ) )
				);
				echo '<span class="wrong-response">' . $errors->get_error_message() . '</span>';
				die();
			}

			// Redefining user_login ensures we return the right case in the email.
			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;
			$key = get_password_reset_key( $user_data );

			if ( is_wp_error( $key ) ) {
				echo '<span class="wrong-response">' . $key->get_error_message() . '</span>';
				die();
			}

			$message = __( 'Someone requested that the password be reset for the following account:', 'kleo_framework' ) . "\r\n\r\n";
			$message .= network_home_url( '/' ) . "\r\n\r\n";
			$message .= sprintf( __( 'Username: %s' ), $user_login ) . "\r\n\r\n";
			$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'kleo_framework'  ) . "\r\n\r\n";
			$message .= __( 'To reset your password, visit the following address:', 'kleo_framework'  ) . "\r\n\r\n";
			$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

			if ( is_multisite() ) {
				$blogname = get_network()->site_name;
			} else /*
                 * The blogname option is escaped with esc_html on the way into the database
                 * in sanitize_option we want to reverse this for the plain text arena of emails.
                 */ {
				$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
			}

			$title = sprintf( esc_html__( '[%s] Password Reset' ), $blogname );

			/**
			 * Filters the subject of the password reset email.
			 *
			 * @since 2.8.0
			 * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
			 *
			 * @param string  $title      Default email title.
			 * @param string  $user_login The username for the user.
			 * @param WP_User $user_data  WP_User object.
			 */
			$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

			/**
			 * Filters the message body of the password reset mail.
			 *
			 * @since 2.8.0
			 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
			 *
			 * @param string  $message    Default mail message.
			 * @param string  $key        The activation key.
			 * @param string  $user_login The username for the user.
			 * @param WP_User $user_data  WP_User object.
			 */
			$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );


			if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
				echo '<span class="wrong-response">' . __( 'Failure!', 'kleo_framework' );
				echo __( 'The e-mail could not be sent.' );
				echo '</span>';
				die();
			} else {
				echo '<span class="good-response">' . __( 'Email successfully sent!', 'kleo_framework' ) . '</span>';
				die();
			}
		}
		die();
	}
}
add_action( "wp_ajax_kleo_lost_password", "kleo_lost_password_ajax" );
add_action( 'wp_ajax_nopriv_kleo_lost_password', 'kleo_lost_password_ajax' );
// -----------------------------------------------------------------------------
