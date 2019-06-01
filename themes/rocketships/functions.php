<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	function understrap_remove_scripts() {
		wp_dequeue_style( 'understrap-styles' );
		wp_deregister_style( 'understrap-styles' );

		wp_dequeue_script( 'understrap-scripts' );
		wp_deregister_script( 'understrap-scripts' );

		// Removes the parent themes stylesheet and scripts from inc/enqueue.php
	}

	add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {

		// Get the theme data
		$the_theme = wp_get_theme();
		wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	function add_child_theme_textdomain() {
		load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
	}

	add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


	/** Change Understrap's site footer to suit this theme. */
	function ac_site_info() {
		$site_info = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( __( 'http://rocketships.ca/', 'ac' ) ),
			sprintf(
			/* translators:*/
				esc_html__( 'A Rocketships Production.', 'ac' )
			)
		);

		echo $site_info; // WPCS: XSS ok.
	}

	/** Change Understrap's entry footer to suit this theme. */
	function ac_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'ac' ) );
			if ( $categories_list && understrap_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( '%s', 'ac' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ac' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'ac' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'ac' ), esc_html__( '1 Comment', 'ac' ), esc_html__( '% Comments', 'ac' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'ac' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

	/** Enqueue child theme javascript. */
	function ac_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/js/functions.js' );
		wp_enqueue_script( 'ac-script', get_stylesheet_directory_uri() . '/js/functions.js', array(), $js_version, true );

	}

	add_action( 'wp_enqueue_scripts', 'ac_scripts' );


	function generate_random_category_posts( $query ) {
		if ( $query->is_category() && $query->is_main_query() ) {
			$query->set( 'orderby', 'rand' );
		}
	}
	add_action( 'pre_get_posts', 'generate_random_category_posts', 100 );
