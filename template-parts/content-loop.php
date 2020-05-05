<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	

	<div style="margin: auto;max-width: 100rem;" class="visible-nav">
		<table style="width:95%;border:0;margin-left:auto;margin-right:auto;box-shadow: 0.1em 0.1em 2em #888888;">
			<tr>
				<td style="<?php if(has_post_thumbnail()){echo('width:35%;');}else{echo('width:0%;');} ?> background-image:url(<?php echo(get_the_post_thumbnail_url()); ?>); background-position: center; background-repeat: no-repeat; background-size: cover;border:0;padding:0;">

				
				</td>
				
				<td style="<?php if(has_post_thumbnail()){echo('width:65%;');}else{echo('width:100%;');} ?>border:0;padding:0; padding-left:2.2rem; padding-right:2rem;">
				<?php get_template_part( 'template-parts/entry-header-loop' ); ?>
					<?php if(is_single(get_the_ID())){
						echo('<div style="margin-top:-2rem;margin-bottom:1rem;">');
					}
					else{
						echo('<div>');
					} ?>
					<?php twentytwenty_the_post_meta( get_the_ID(), 'single-top' ); ?>
					</div>

					<div class="post-inner summary-content <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?>">
			
						<div class="entry-content summary-content has-small-font-size" style="margin-top:1rem;padding-bottom:2rem;">
							<?php
								echo('<p class="has-very-small-font-size" style="margin-block-end:0;width:100%;max-width:none;">' . get_the_excerpt() . '</p>');
							?>

						</div><!-- .entry-content -->
					</div><!-- .post-inner -->
				</td>
			</tr>
		</table>
	</div>

	<div style="margin: auto;max-width: 100rem;" class="visible-mob">
		<table style="width:95%;border:0;margin-left:auto;margin-right:auto;box-shadow: 0.1em 0.1em 2em #888888;">
			<tr>
				<td style="width:100%; <?php if(has_post_thumbnail()){echo('height:30rem;');}else{echo('height:0;');} ?>background-image:url(<?php echo(get_the_post_thumbnail_url()); ?>); background-position: center; background-repeat: no-repeat; background-size: cover;border:0;padding:0;">

				
				</td>
			</tr>
			<tr>
				<td style="<?php if(has_post_thumbnail()){echo('width:65%;');}else{echo('width:100%;');} ?>border:0;padding:0; padding-left:2.2rem; padding-right:2rem;">
				<?php get_template_part( 'template-parts/entry-header-loop' ); ?>
					<?php if(is_single(get_the_ID())){
						echo('<div style="margin-top:-2rem;margin-bottom:1rem;">');
					}
					else{
						echo('<div>');
					} ?>
					<?php twentytwenty_the_post_meta( get_the_ID(), 'single-top' ); ?>
					</div>

					<div class="post-inner summary-content <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?>">
			
						<div class="entry-content summary-content has-small-font-size" style="margin-top:1rem;padding-bottom:2rem;">
							<?php
								echo('<p class="has-small-font-size" style="margin-block-end:0;width:100%;max-width:none;">' . get_the_excerpt() . '</p>');
							?>

						</div><!-- .entry-content -->
					</div><!-- .post-inner -->
				</td>
			</tr>
		</table>
	</div>

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		//edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
