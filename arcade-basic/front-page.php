<?php
/**
 * The front page template.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0.0
 */
get_header();

global $paged;
$bavotasan_theme_options = bavotasan_theme_options();

if ( 2 > $paged ) {
	// Display jumbo headline is the option is set
	if ( ! empty( $bavotasan_theme_options['jumbo_headline_title'] ) ) {
	?>
	<div class="home-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="home-jumbotron jumbotron">
						<h2>Хочешь узнать информацию о деятельности органов власти, но не знаешь как ее получить?</h2>
						 <img src="http://rosotvet.ru/wp-content/themes/arcade-basic/library/images/scheme.png" />
                                                 
					</div>
                                    
				</div>
                           
			</div>
                     
		</div>
            <div class="main-page-form" style="margin:40px auto;" id="fill-form">
                <h2>Заполните форму</h2>
                <p>Перед заполнением формы, пожалуйста, ознакомьтесь с <a href="http://rosotvet.ru/?page_id=13">правилами</a>. </p>
                                                     <?php echo do_shortcode("[formidable id=2]") ?>
            </div>
            <div class="main-page-form" style="margin:40px auto; padding-top: 40px; border-top:1px solid #CCC;">
                <h2>Подпишитесь на новости</h2>
                <?php echo do_shortcode("[formidable id=7]") ?>
            </div>
	</div>
	<?php
	}

	// Display home page top widgetized area
	if ( is_active_sidebar( 'home-page-top-area' ) ) {
		?>
		<div id="home-page-widgets">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'home-page-top-area' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}
if ( 'page' == get_option('show_on_front') ) {
	
} else {
?>
	<div class="container">
		<div class="row">
			<div id="primary" <?php bavotasan_primary_attr(); ?>>
                <?php
				if ( have_posts() ) {
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;

					bavotasan_pagination();
				} else {
					if ( current_user_can( 'edit_posts' ) ) {
						// Show a different message to a logged-in user who can add posts.
						?>
						<article id="post-0" class="post no-results not-found">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'arcade' ); ?></h1>

							<div class="entry-content description clearfix">
								<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'arcade' ), admin_url( 'post-new.php' ) ); ?></p>
							</div><!-- .entry-content -->
						</article>
						<?php
					} else {
						get_template_part( 'content', 'none' );
					} // end current_user_can() check
				}
				?>
			</div><!-- #primary.c8 -->
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php
}
get_footer(); ?>