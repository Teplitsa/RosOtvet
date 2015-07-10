<?php
/**
 * The Template for displaying all single posts.
 *
 * @since 1.0.0
 */
get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" <?php bavotasan_primary_attr(); ?>>
				<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
		<?php
		// Display a thumbnail if one exists and not on single post
		bavotasan_display_post_thumbnail();

$bavotasan_theme_options = bavotasan_theme_options();
global $paged;
?>

	<?php include("ro_request_view.php") ?>

	    <?php if ( is_singular() && ! is_front_page() ):?>
		
	<footer class="clearfix">
	    <?php
	    if ( is_single() ) wp_link_pages( array( 'before' => '<p id="pages">' . __( 'Pages:', 'arcade' ) ) );
	    edit_post_link( __( '(edit)', 'arcade' ), '<p class="edit-link">', '</p>' );
		
	    ?>
	</footer><!-- .entry -->		
		
	    <? endif ?>
	</article><!-- #post-<?php the_ID(); ?> -->
	

					<div id="posts-pagination" class="clearfix">
						<h3 class="sr-only"><?php _e( 'Post navigation', 'arcade' ); ?></h3>
						<div class="previous pull-left"><?php previous_post_link( '%link', __( '&larr; %title', 'arcade' ) ); ?></div>
						<div class="next pull-right"><?php next_post_link( '%link', __( '%title &rarr;', 'arcade' ) ); ?></div>
					</div><!-- #posts-pagination -->

				<?php endwhile; // end of the loop. ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>