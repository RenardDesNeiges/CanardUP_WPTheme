<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header(); //first we load the header from the wordpress DB 
?>

<main id="site-content" class="index" role="main">

	<?php
	//Then we actually get to displaying the page
	
	
	$archive_title    = '';
	$archive_subtitle = '';
	//If we are currently in a search, then we run the search routine (WhICh I DoNT UnDERsTAnD)
	//but basically we forward the query to the wp server, magic happens and hopefully the loop will make it look good later
	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span>' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
	}

	//This is 		T H E   L O O P
	if ( have_posts() ) {
		//the index page is displayed differently than the categories/search pages
		//this is the index
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if(is_home() and $paged === 1){
			the_post();
			get_template_part( 'template-parts/content-cover-summary', get_post_type() );
			$i = 0;
			//this is the part of the loop that goes through every post (or a fixed max number but it is the server that handles that) to display it
			while ( have_posts()) {
				$i++;
				if ( $i == 1 ) {
					// this is a separator
					echo '<hr class="post-separator styled-separator is-style-wide section-inner visible-high-height" aria-hidden="true" margin-top:2em;margin-bottom:2em;"; />';
				}
				if ( $i > 1 ) {
					// this is a separator
					//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
				}
				//here we call the post function (which gets the post)
				the_post();
				//then the template function which displays the post (so here content is the template part file that we use)
				get_template_part( 'template-parts/content-loop', get_post_type() );

			}
		}//this is the rest
		else{
			$i = 0;
			while ( have_posts() ) {
				$i++;
				if ( $i > 1 ) {
					// this is a separator
					//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
				}
				//here we call the post function (which gets the post)
				the_post();
				//then the template function which displays the post (so here content is the template part file that we use)
				get_template_part( 'template-parts/content-loop', get_post_type() );

			}
		}
	} elseif ( is_search() ) {
		?>

		<div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'label' => __( 'search again', 'twentytwenty' ),
				)
			);
			?>

		</div><!-- .no-search-results -->

		<?php
	}
	?>
	
	<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
