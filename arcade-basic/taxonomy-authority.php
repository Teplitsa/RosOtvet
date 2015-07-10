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
 
global $RO_PAGE;
$RO_PAGE = 'REQUESTS_LIST';
 
get_header(); ?>
	<div class="container rosotvet-requests">
		
		<div class="ro-row">
			<?php 
				$term_id = $wp_query->get_queried_object_id();
				
				$args = array(
					'post_type' => 'authority_info',
					'tax_query' => array(
						array(
							'taxonomy' => 'authority',
							'field' => 'id',
							'terms' => $term_id,
						)
					)
				);
				$infos = get_posts( $args );
				$authority_info = @$infos[0];
				
				global $post;
				$post = $authority_info;
				setup_postdata( $post );
			?>
			
			<?php if($post):?>
				<h1><?php the_title(); ?></h1>
			<?php else:?>
				<h1><?php echo single_term_title(); ?></h1>
			<?php endif?>
			
			<div class="row clearfix">
				<?php if(has_post_thumbnail()):?>
					<div class="col-md-2">
						<?php the_post_thumbnail() ?>
					</div>
				<?php endif?>			
				<div class="col-md-10">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		
		<div class="row">
        	<div id="primary" <?php bavotasan_primary_attr(); ?>>
        		<?php
        		if ( have_posts() ) :
        			$term = get_term_by('id', $term_id, 'authority');
        		?>
        		<h2 style="margin-bottom:20px;margin-top:0px;"><?php _e('Authority related problems', 'arcade') ?> ( <?php echo $term->count - 1 ?> ):</h2>
        		<?php 
        		
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
			if( @$display_author )
				echo '&nbsp;' . __( 'on', 'arcade' ) . '&nbsp;';

		    echo '<a href="' . get_permalink() . '" class="time"><time class="date published updated" datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date() . '</time></a>';
	    }
		?>
		<div class="rosotvet-list-tags" style="margin-top:10px;">
		<?the_tags( '<p class="tags"><i class="fa fa-tags"></i> <span>' . __( 'Tags:', 'arcade' ) . '</span>', ' ', '</p>' )?>
		</div>
	</div>
	<?php } ?>

		
	</article><!-- #post-<?php the_ID(); ?> -->
<?	
        			endwhile;

        			tst_content_nav('ro_requests_pages');
        		else :
        			get_template_part( 'content', 'none' );
        		endif;
        		?>
        	</div>
            <?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>