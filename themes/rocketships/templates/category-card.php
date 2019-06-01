<?php
	/**
	 * @WP_Term Object $category
	 */

	// If there is a parent.
    if( $category->category_parent ) {
	    $color = get_term_meta( $category->category_parent, '_category_color', $single = true );
    } else {
        // If there is no parent.
	    $color = get_term_meta( $category->term_id, '_category_color', $single = true );
    }

    // If no color is set.
	$color = ( $color ) ? $color : '#303030';
?>


<div class="col-md col-sm-6 col-xs-12 columns">
    <a href="<?php echo get_category_link( $category->term_id ); ?>">
    <div class="top-category-card wiggle card text-white mb-3" style="background-color: <?php echo esc_attr( $color ); ?>; width: 18rem;">
        <figure class="front">
            <figcaption>
                <h3><?php echo esc_html( $category->name ); ?></h3>
            </figcaption>
        </figure>
    </div>
    </a>
</div>