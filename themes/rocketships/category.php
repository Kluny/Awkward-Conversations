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
                <header class="entry-header">
					<?php
						$category = get_the_category();
						$parent   = get_the_category_by_ID( $category[0]->category_parent );
						?>
                    <h1 class="entry-title">
						<?php echo esc_html( $parent ); ?>
                    </h1>

                </header><!-- .entry-header -->


                <div class="row cards">
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'templates/subcategory', 'card' );
						endwhile;
					?>
                </div>
            </main><!-- #main -->

        </div><!-- .row -->


    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
