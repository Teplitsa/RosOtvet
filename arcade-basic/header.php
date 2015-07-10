<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main>
 * and the left sidebar conditional
 *
 * @since 1.0.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if IE]><script src="<?php echo BAVOTASAN_THEME_URL; ?>/library/js/html5.js"></script><![endif]-->
<?php wp_head(); ?>
<link rel="shortcut icon" href="http://rosotvet.ru/wp-content/themes/arcade-basic/library/images/favicon.png" />
</head>
<?php
$bavotasan_theme_options = bavotasan_theme_options();
$space_class = '';

global $RO_STATS_REQUESTS_TOTAL_NUM, $RO_STATS_REQUESTS_SENT_NUM, $RO_STATS_REQUESTS_ANSWERED_NUM;
global $RO_PAGE;

$RO_STATS_REQUESTS_TOTAL_NUM = get_stats_requests_total_num();
$RO_STATS_REQUESTS_ANSWERED_NUM = get_stats_requests_answered_num();
#$RO_STATS_REQUESTS_SENT_NUM = get_stats_requests_sent_num();
$RO_STATS_REQUESTS_SENT_NUM = $RO_STATS_REQUESTS_TOTAL_NUM - $RO_STATS_REQUESTS_ANSWERED_NUM;

?>
<body <?php body_class(); ?>>

	<div id="page">

		<header id="header">
			<nav id="site-navigation" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<h3 class="sr-only"><?php _e( 'Main menu', 'arcade' ); ?></h3>
				<a class="sr-only" href="#primary" title="<?php esc_attr_e( 'Skip to content', 'arcade' ); ?>"><?php _e( 'Skip to content', 'arcade' ); ?></a>

				<div class="navbar-header">
					<button type="button" class="navbar-toggle pull-left" style="margin-left:5px;" data-toggle="collapse" data-target=".navbar-collapse">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				</div>

				<div class="collapse navbar-collapse" id="main-menu-navbar">
					<?php
					$menu_class = ( is_rtl() ) ? ' navbar-right' : '';
					wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'nav navbar-nav' . $menu_class, 'fallback_cb' => 'bavotasan_default_menu', 'depth' => 2 ) );
					?>
					
					<div class="ro-ya-search-form" id="ro-ya-search-form">
						<div class="ya-site-form ya-site-form_inited_no" onclick="return {'action':'http://rosotvet.ru/search/','arrow':false,'bg':'transparent','fontsize':12,'fg':'#ffffff','language':'ru','logo':'rb','publicname':'Поиск по rosotvet.ru','suggest':true,'target':'_self','tld':'ru','type':2,'usebigdictionary':true,'searchid':2190137,'webopt':false,'websearch':false,'input_fg':'#ffffff','input_bg':'#263238','input_fontStyle':'normal','input_fontWeight':'normal','input_placeholder':'Поиск по сайту','input_placeholderColor':'#ffffff','input_borderColor':'#263238'}"><form action="http://yandex.ru/sitesearch" method="get" target="_self" class="frm-show-form"><input type="hidden" name="searchid" value="2190137"/><input type="hidden" name="l10n" value="ru"/><input type="hidden" name="reqenc" value=""/><input type="search" class="form-control" name="text" value=""/><input type="submit" value="Найти"/></form></div><style type="text/css">.ya-page_js_yes .ya-site-form_inited_no { display: none; }</style><script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0],e=d.documentElement;if((' '+e.className+' ').indexOf(' ya-page_js_yes ')===-1){e.className+=' ya-page_js_yes';}s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Form.init()})})(window,document,'yandex_site_callbacks');</script>
					</div>
					
				</div>
				
			</nav><!-- #site-navigation -->
			
			 <div class="title-card-wrapper">
                <div class="title-card">
    				<div id="site-meta">
									<?if(is_front_page()):?>
										<img src="<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/logo.svg?v=1.001' ) )?>" class="logo-block" onerror="this.onerror=null;this.src=<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/logo3.png' ) )?>"/>
									<?else:?>
										<a href="<?=esc_url( home_url( '/' ) )?>" ><img src="<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/logo.svg' ) )?>"  class="logo-block2" onerror="this.onerror=null;this.src=<?=esc_url( home_url( '/wp-content/themes/arcade-basic/library/images/logo3.png' ) )?>"/></a>
									<?endif?>
                                    <p class="after-logo-buttons">
										<a href="#" id="more-site" class="btn btn-default btn-lg"><?php _e( 'Как это работает', 'arcade' ); ?></a>
                                        <a href="#" id="more-site" class="btn btn-default btn-lg fill-form-link"><?php _e( 'Отправить запрос', 'arcade' ); ?></a>
                                    </p>
    				</div>

    				<?php
    				// Header image section
    				//bavotasan_header_images();
    				?>
                                <div class="alt-header-img">
                                </div>
                                
				</div>
			</div>

		</header>

		<main>