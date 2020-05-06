<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

$entry_header_classes = '';

if ( is_singular() ) {
	$entry_header_classes .= ' header-footer-group';
}

?>

<header class="entry-header has-text-align-center <?php echo esc_attr( $entry_header_classes ); ?>">

	<div style="margin-left:0rem;margin-right:1rem;">

	<div class="entry-categories" style="margin-bottom:1rem;margin-top:2rem;">
		<span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
			<div class="entry-categories-inner">
					<?php //the_category( ' ' ); 
						$categories = get_the_category();
						$separator = ' ';
						$output = '';
						if ( ! empty( $categories ) ) {
							if(is_singular() && !is_home()){$white = 'white-entry';}
							else{$white = "";}
						    foreach( $categories as $category ) {
						        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="'. $white. '"' . '>' . esc_html( $category->name ) . '</a>' . $separator;
						    }
					    echo trim( $output, $separator );
}
					?>
			</div><!-- .entry-categories-inner -->
	</div><!-- .entry-categories -->

		<?php
			/**
			 * Allow child themes and plugins to filter the display of the categories in the entry header.
			 *
			 * @since 1.0.0
			 *
			 * @param bool   Whether to show the categories in header, Default true.
			 */
		$show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

		
		if(has_post_thumbnail()){the_title( '<h4 class="entry-title heading-size-4" style="text-align:center;margin:0 0 0;"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' );}
		else{the_title( '<h2 class="entry-title heading-size-2" style="text-align:center;margin:0 0 0;"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );}

		$intro_text_width = '';

		if ( is_singular() ) {
			$intro_text_width = ' small';
		} else {
			$intro_text_width = ' thin';
		}

		if ( has_excerpt() && is_singular() ) {
			?>

			<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
				<?php the_excerpt(); ?>
			</div>

			<?php
		}

		// Default to displaying the post meta.
		//twentytwenty_the_post_meta( get_the_ID(), 'single-top' );
		?>

	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->
