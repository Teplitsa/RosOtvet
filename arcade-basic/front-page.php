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
			<div class="row front-page-row">
				<div class="col-md-12">
					<div class="home-jumbotron jumbotron">
						<h2>Нужна информация о деятельности органов власти, но не знаете, как ее получить?</h2>
							<div class="ro-scheme-images">
								<img src="<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/scheme-1.png' ) )?>" />
								<img src="<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/scheme-2.png' ) )?>" />
								<img src="<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/scheme-3.png' ) )?>" />
								<img src="<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/scheme-4.png' ) )?>" />
							</div>
					</div>
                                    
				</div>
                           
			</div>

			<div class="row front-page-row">
				<div class="col-md-12">
					<div class="home-jumbotron jumbotron ro-req-stats-jumbotron">
						<div class="row">
							<a class="col-md-4 ro-req-stats-item" href="<?=esc_url( home_url( '/requests/' ) )?>">
								<div class="ro-req-stats-number center-block"><?=$RO_STATS_REQUESTS_TOTAL_NUM?></div>
								<div class="ro-req-stats-label">Запросов</div>
							</a>
							<a class="col-md-4 ro-req-stats-item" href="<?=esc_url( home_url( '/requests/answered/' ) )?>">
								<div class="ro-req-stats-number center-block"><?=$RO_STATS_REQUESTS_ANSWERED_NUM?></div>
								<div class="ro-req-stats-label">Ответов</div>
							</a>
							<a class="col-md-4 ro-req-stats-item" href="<?=esc_url( home_url( '/requests/sent/' ) )?>">
								<div class="ro-req-stats-number center-block"><?=$RO_STATS_REQUESTS_SENT_NUM?></div>
								<div class="ro-req-stats-label">Ждут ответа</div>
							</a>
						</div>					
					</div>                                    
				</div>                           
			</div>
			<div id="send-req">&nbsp;</div>
		</div>
		
		<div class="container">
			<div class="row front-page-row">
				<div class="center-block shadow-z-3 main-form-block">
		            <div class="main-page-form" style="margin:40px auto;" id="fill-form">
		                <h2>Заполните форму</h2>
		                <p>Перед заполнением формы, пожалуйста, ознакомьтесь с <a href="http://rosotvet.ru/rules/">правилами</a>. </p>
						<?php echo do_shortcode("[formidable id=2]") ?>
		            </div>
	            </div>
            </div>
		</div>
            
		<div class="container">
			<div class="row front-page-row">
				<div class="center-block shadow-z-3 main-form-block main-form-block-second">
					<div class="main-page-form" style="margin:40px auto;">
		                <h2>Подпишитесь на новости</h2>
		                <?php echo do_shortcode("[formidable id=7]") ?>
		            </div>
	            </div>
            </div>
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

$city = $TEST_IPGEO->getRecord(@$_SERVER['REMOTE_ADDR']);
if($city['region'] == 'Крым') {
	$city['region'] = 'Республика Крым';
}
if($city) {
	?>
	<script>
		jQuery(function(){
			jQuery('#field_e3oy9j').val('<?=$city['region']?>');
			jQuery('#field_6ndeaa').val('<?=$city['city']?>');
		});
	</script>
	<?
}

get_footer();
