<?php
/**
 * Displays the content when the cover-summary template is used.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
	// On the cover page template, output the cover header.
	$cover_header_style   = '';
	$cover_header_classes = '';

	$color_overlay_style   = '';
	$color_overlay_classes = '';

	$image_url = ! post_password_required() ? get_the_post_thumbnail_url( get_the_ID(), 'twentytwenty-fullscreen' ) : '';

	if ( $image_url ) {
		$cover_header_style   = ' style="background-image:linear-gradient(black, black),  url( ' . esc_url( $image_url ) . ' );"';
		$cover_header_classes = ' bg-image';
	}

	// Get the color used for the color overlay.
	$color_overlay_color = get_theme_mod( 'cover_template_overlay_background_color' );
	if ( $color_overlay_color ) {
		$color_overlay_style = ' style="color: ' . esc_attr( $color_overlay_color ) . ';"';
	} else {
		$color_overlay_style = '';
	}

	// Get the fixed background attachment option.
	if ( get_theme_mod( 'cover_template_fixed_background', true ) ) {
		$cover_header_classes .= ' bg-attachment-fixed';
	}

	// Get the opacity of the color overlay.
	$color_overlay_opacity  = get_theme_mod( 'cover_template_overlay_opacity' );
	$color_overlay_opacity  = ( false === $color_overlay_opacity ) ? 80 : $color_overlay_opacity;
	$color_overlay_classes .= ' opacity-' . $color_overlay_opacity;
	?>

<meta property="og:image" content="<?php echo $image_url ?>">

	<div class="cover-header cover-header-summary <?php echo $cover_header_classes; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>"<?php echo $cover_header_style; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;) ?>>
		<div class="cover-header-inner-wrapper half-screen-height">
			<div class="cover-header-inner">
				<div class="cover-color-overlay color-accent<?php echo esc_attr( $color_overlay_classes ); ?>"<?php echo $color_overlay_style; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;) ?>></div>

					<header class="entry-header has-text-align-center">
						<div class="entry-header-inner section-inner medium">

							<?php

							/**
							 * Allow child themes and plugins to filter the display of the categories in the article header.
							 *
							 * @since 1.0.0
							 *
							 * @param bool Whether to show the categories in article header, Default true.
							 */


							echo('<h1 class="entry-title" style="text-align:left; margin-bottom:1rem;"><a href="'. esc_url( get_permalink() ) . '"> À la une : </a></h1>');
							$show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

							if ( true === $show_categories && has_category() ) {
								?>

								<div class="entry-categories">
									<span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
									<div class="entry-categories-inner">
										<?php the_category( ' ' ); ?>
									</div><!-- .entry-categories-inner -->
								</div><!-- .entry-categories -->

								<?php
							}
							the_title( '<h4 class="entry-title visible-mob" style="text-align:left; margin-top:0;margin-right:1em;"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' );
							
							echo('<div><div style="width:50%;float: left;">');
							the_title( '<h3 class="entry-title visible-nav" style="text-align:left; margin-top:0;margin-right:1em;"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );
							if ( is_singular() ) {
								$intro_text_width = ' small';
							} else {
								$intro_text_width = ' thin';
							}
							echo('</div><div style="width:50%;float: left; margin-top: 0rem;"><div class="intro-text section-inner max-percentage visible-nav' . esc_attr( $intro_text_width ) . '" style="color:#000000;text-align:left;font-weight: 600;font-family:Aileron;padding: 2em; background-color:#ffffff;text-shadow: 0px 0px;margin-top:0;box-shadow: 0.2em 0.2em 0.6em;">'.get_the_excerpt().'</div></div></div>');
							echo('<div style="margin-top: 0rem;"><div class="intro-text section-inner max-percentage visible-mob toggle-low-height' . esc_attr( $intro_text_width ) . '" style="color:#000000;text-align:left;font-weight: 600;font-family:Aileron;padding: 2em; background-color:#ffffff;text-shadow: 0px 0px;margin-top:0;box-shadow: 0.2em 0.2em 0.6em;">'.get_the_excerpt().'</div></div>');
							
							edit_post_link();
							if ( is_page() ) {
								?>

								<div class="to-the-content-wrapper">

									<a href="#post-inner" class="to-the-content fill-children-current-color">
										<?php twentytwenty_the_theme_svg( 'arrow-down' ); ?>
										<div class="screen-reader-text"><?php _e( 'Scroll Down', 'twentytwenty' ); ?></div>
									</a><!-- .to-the-content -->

								</div><!-- .to-the-content-wrapper -->

								<?php
							} else {
								
								$intro_text_width = '';

								if ( is_singular() ) {
									$intro_text_width = ' small';
								} else {
									$intro_text_width = ' thin';
								}

								if ( has_excerpt() ) {
									?>

									<div class="intro-text section-inner max-percentage<?php echo esc_attr( $intro_text_width ); ?>">
										<?php the_excerpt(); ?>
									</div>

									<?php
								}

								echo('<div style="width:100%;float:right;">');
								twentytwenty_the_post_meta( get_the_ID(), 'single-top' );
								echo('</div>');

							}
							?>

						</div><!-- .entry-header-inner -->
					</header><!-- .entry-header -->

			</div><!-- .cover-header-inner -->
		</div><!-- .cover-header-inner-wrapper -->
	</div><!-- .cover-header -->

	<div style="padding-top: 1em;" class="post-inner" id="post-inner" >

		<div class="entry-content visible-high-height">
							
		<?php
			echo('<p class="has-small-font-size">'.get_the_excerpt().'</p>');
		?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->
	
	

</article><!-- .post -->
