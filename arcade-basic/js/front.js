jQuery(function(){
	$ = jQuery;
	
	// place focus on first field of question form
	$('.fill-form-link').click(function(){
		$('textarea[name="item_meta[8]"]').focus();
	});
	
	$('#menu-menu-1 a[href~="/#send-req"]').click(function(){
		$('textarea[name="item_meta[8]"]').focus();
	});
	
	if ("onhashchange" in window) {
		$(window).bind( 'hashchange', function(e) {
			if(window.location.hash == '#send-req') {
				$('textarea[name="item_meta[8]"]').focus();
			}
		});		
	}
	$('textarea[name="item_meta[8]"]').focus();
	
	$('.ro-toggle-request-text').click(function(){
		var request_index = $(this).data('request-index');
		if($(this).data('expanded') == 0) {
			$('#request-text-' + request_index).show();
			$(this).data('expanded', 1);
			$(this).find('.ro-toggle-request-text-expand').hide();
			$(this).find('.ro-toggle-request-text-collapse').show();
		}
		else {
			$('#request-text-' + request_index).hide();
			$(this).data('expanded', 0);
			$(this).find('.ro-toggle-request-text-expand').show();
			$(this).find('.ro-toggle-request-text-collapse').hide();
		}
		return false;
	});
	
	//$('#field_e3oy9j').dropdown({"optionClass": "withripple"});
	
	$('#form_nju0v6').find('.btn').addClass('btn-primary btn-raised');
	$('#form_a4xzyk').find('.btn').addClass('btn-primary btn-raised');
	$('.ro-req-stats-number').addClass('shadow-z-1');
	$('.ro-req-stats-number').hover(
			function(){ $(this).addClass('shadow-z-4') },
			function(){ $(this).removeClass('shadow-z-4') }
	);
	
	$('#frm_field_9_container').prepend($('<span class="mdi-action-account-circle form-field-icon"></span>'));
	$('#frm_field_8_container').prepend($('<span class="mdi-action-help form-field-icon"></span>'));
	$('#frm_field_88_container').prepend($('<span class="mdi-maps-pin-drop form-field-icon"></span>'));
	$('#frm_field_89_container').prepend($('<span class="mdi-maps-my-location form-field-icon"></span>'));
	$('#frm_field_87_container').prepend($('<span class="mdi-content-mail form-field-icon"></span>'));
	$('#frm_field_90_container').prepend($('<span class="mdi-content-mail form-field-icon"></span>'));
	
	
	$("#ro-ya-search-form").bind("DOMSubtreeModified", function() {
		$input_field = $(this).find('.ya-site-form__input-text');
		if($input_field.length) {
			if(!$input_field.data('is_customized')) {
				
				$input_field.focus(function(){
					$(this).data('placeholder', $(this).attr('placeholder'));
					$(this).attr('placeholder', '');
				});
				
				$input_field.blur(function(){
					$(this).attr('placeholder', $(this).data('placeholder'));
				});
				
				$input_field.data('is_customized', true);
			}
		}
	});
});
