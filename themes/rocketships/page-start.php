<?php
	/* Template Name: Start */
	/**
	 * The template for displaying all pages.
	 *
	 * This is the template that displays all pages by default.
	 * Please note that this is the WordPress construct of pages
	 * and that other 'pages' on your WordPress site will use a
	 * different template.
	 *
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	get_header();

	$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <main class="site-main" id="main">
                <div class="row">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="row cards">
					<?php
						$args = array(
							'orderby' => 'id',
							'parent'  => 0,
							'exclude' => 1  //uncategorized
						);

						$categories = get_categories( $args );


						foreach ( $categories as $category ): ?>

							<?php require 'templates/category-card.php'; ?>

						<?php endforeach; // end of the loop. ?>
                </div>
            </main><!-- #main -->

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
