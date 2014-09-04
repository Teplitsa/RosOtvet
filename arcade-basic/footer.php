<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the main and #page div elements.
 *
 * @since 1.0.0
 */
$bavotasan_theme_options = bavotasan_theme_options();
?>
	</main><!-- main -->

	<footer id="footer" role="contentinfo">
		<div id="footer-content" class="container">
			<div class="row">
				<div class="copyright col-lg-12">
					<span class="pull-left"><?php printf( __( '%s Лицензия Creative Commons CC-BY-SA. %s %s %s', 'arcade' ), 
                                                date( 'Y' ), ' <a href="' . home_url() . '">РосОтвет</a>. <br />',
                                                'Сайт создан в результате сотрудничества <br /><a href="http://svobodainfo.org/">Фонда Свободы Информации</a> и <a href="http://te-st.ru">Теплицы социальных технологий</a>',
                                                '<br />Исходный дизайн: <a href="https://themes.bavotasan.com/">bavotasan.com</a>'); ?>
                                        </span>
					<div class="credit-link pull-right">
						<?php 
							wp_nav_menu(array(
								'container'       => 'div',
								'menu'            => 3,
								'container_class' => 'social-holder',
								'menu_class'      => 'cf',
								'menu_id'         => 'social-links',
								'echo'            => true,                
								'depth'           => 0, 
							));
						?>	
					</div>
				</div><!-- .col-lg-12 -->
			</div><!-- .row -->
		</div><!-- #footer-content.container -->
	</footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>