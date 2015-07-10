( function( $ ) {
	// Responsive videos
	var $all_videos = $( '.entry-content' ).find( 'iframe[src*="player.vimeo.com"], iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="dailymotion.com"],iframe[src*="kickstarter.com"][src*="video.html"], object, embed' ),
		$window = $(window),
		$more_site = $( '#more-site' ),
		$card = $( '.title-card' ),
		window_height, window_width,
		is_rtl = ( $( 'body' ).hasClass( 'rtl' ) ) ? false : true;

	$all_videos.not( 'object object' ).each( function() {
		var $video = $(this);

		if ( $video.parents( 'object' ).length )
			return;

		if ( ! $video.prop( 'id' ) )
			$video.attr( 'id', 'rvw' + Math.floor( Math.random() * 999999 ) );

		$video
			.wrap( '<div class="responsive-video-wrapper" style="padding-top: ' + ( $video.attr( 'height' ) / $video.attr( 'width' ) * 100 ) + '%" />' )
			.removeAttr( 'height' )
			.removeAttr( 'width' );
	} );

	// Image anchor
	$( 'a:has(img)' ).addClass( 'image-anchor' );

	$( 'a[href="#"]' ).click( function(e) {
		e.preventDefault();
	} );

	// Shortcode
	if ( theme_js_vars.carousel ) {
		var autoplay = ( theme_js_vars.autoplay ) ? '' : 'pause';
		$( '.carousel' ).carousel( autoplay );
	}

	if ( theme_js_vars.tooltip )
		$( 'a[rel="tooltip"]' ).tooltip();

	if ( theme_js_vars.tabs ) {
		$( '.nav-tabs a' ).click( function(e) {
			e.preventDefault();
			$(this).tab( 'show' );
		} );
	}

    // Arc the site title
    if ( 0 != theme_js_vars.arc )
        $( '#site-title a' ).arctext( {
        	radius: theme_js_vars.arc,
        	rotate: is_rtl,
        	fitText	: theme_js_vars.fittext
        } );
    // Set up jumbo header image
    if ( $card.length ) {
        $window
            .on( 'resize.title-card', function() {
                window_width = $window.width();
				window_height = ( $( 'body' ).hasClass( 'admin-bar' ) ) ? $window.height() - 32 : $window.height();
//				window_height = ( $( 'body' ).hasClass( 'admin-bar' ) ) ? 490 + 32 : 490;
//				window_height = 522;
				
				var min_height_on_mobile = 180;
				$card.css( 'height', min_height_on_mobile );
				if ( window_width < 769 || ! $( 'body' ).hasClass( 'home' ) || ( $( 'body' ).hasClass( 'home' ) && $( 'body' ).hasClass( 'paged' ) ) ) {
					$card.css( 'height', min_height_on_mobile );
					$more_site.removeData( 'scroll-to' ).attr( 'data-scroll-to', min_height_on_mobile );
				} else {
					$card.css( 'height', window_height );
					$more_site.removeData( 'scroll-to' ).attr( 'data-scroll-to', window_height );
				}
			} )
			.trigger( 'resize.title-card' )
			.scroll( function () {
				if ( $window.scrollTop() >= ( $more_site.data( 'scroll-to' ) - 50 ) )
					$( '#site-navigation' ).addClass( 'black' );
				else
					$( '#site-navigation' ).removeClass( 'black' );
			} );

        $card.fillsize( '> img.header-img' );
	}

    // Scroll past jumbo header image
	$more_site.click( function() {
		$( 'html, body' ).animate( { scrollTop: ( $more_site.data( 'scroll-to' ) - 50 ) }, 'slow', 'swing' );
	} );
	
	$('.fill-form-link').click(function(){
		var top_margin = 0;
		
		var $user_top_bar = $('#wpadminbar');		
		if($user_top_bar) {
			top_margin += $user_top_bar.height();
		}
		
		var $main_menu_bar = $('#main-menu-navbar');
		if($main_menu_bar) {
			top_margin += $main_menu_bar.height();
		}
		
		$('html,body').animate({
			scrollTop: $("#fill-form").offset().top - top_margin - 30
		});
		return false;
	});
} )( jQuery );