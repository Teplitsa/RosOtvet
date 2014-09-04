<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */
get_header(); ?>
	<div class="container rosotvet-requests">
		<div class="row">
        	<div id="primary" <?php bavotasan_primary_attr(); ?>>
        		<?php
        		if ( have_posts() ) :
        			while ( have_posts() ) : the_post();
?>					
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
		<?php
		// Display a thumbnail if one exists and not on single post
		bavotasan_display_post_thumbnail();

$bavotasan_theme_options = bavotasan_theme_options();
global $paged;
?>

	<h1 class="entry-title taggedlink">
		<?php if ( is_single() ) : ?>
			<?php the_title(); ?>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php endif; // is_single() ?>
	</h1>

	<?php if ( ! is_front_page() || 1 < $paged ) { ?>
	<div class="entry-meta">
		<?php
		
		$display_date = $bavotasan_theme_options['display_date'];
		if( $display_date ) {
			if( $display_author )
				echo '&nbsp;' . __( 'on', 'arcade' ) . '&nbsp;';

		    echo '<a href="' . get_permalink() . '" class="time"><time class="date published updated" datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date() . '</time></a>';
	    }
		?>
	</div>
	<?php } ?>

		
	</article><!-- #post-<?php the_ID(); ?> -->
<?	
        			endwhile;

        			tst_content_nav();
        		else :
        			get_template_part( 'content', 'none' );
        		endif;
        		?>
        	</div>
            <?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>