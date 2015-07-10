jQuery(function(){
	$ = jQuery;
	if($('#originalaction').val() == 'editpost' && $('#acf-field-request_type').length > 0) {
		$('#acf-field-request_id').prop('readonly', true);
		
		$('tr.field_type-wysiwyg').each(function(){
			try {
				if($(this).attr('data-field_name') == 'request_text') {
					if($(this).find('textarea[name*="acfcloneindex"]').length == 0) {
						var $text_field = $(this).find('textarea[name^="fields"]');
						var name = $text_field.attr('name');
						var field_index = name.match(/\[(\d+)\]/);
						if(field_index) {
							field_index = field_index[1];
						}
						var post_requests = rosotvet_post_response_delay_data;
						if(post_requests[field_index] && post_requests[field_index]['response_delay']) {
							$(this).find('textarea[name^="fields"]').parent().parent().append('<h2 class="response_delay">' + post_requests[field_index]['response_delay'] + '</h2>');
						}
					}
				}
			} catch(ex) {};
		});

		$('#post_response_delay_data').parent().hide();
	}
	
	$('#mail_status_updated_button').click(mail_request_status_updated);
	
	$('.post-type-authority_info').find('#postimagediv h3 span').text('Герб');
	$('.post-type-authority_info').find('#authoritydiv').hide();
	$('#menu-posts-authority_info').find('a[href^="edit-tags.php"]').hide();
	
});

function mail_request_status_updated() {
	if(confirm(admin_frontend.lang_mail_request_status_updated_confirm)) {
		$.post(admin_frontend.ajaxurl, {
			'action': 'mail_request_status_updated',
			'post_id': $(this).data('post_id'),
		}, function(resp){
			var json = jQuery.parseJSON(resp);
			if(json.status != 'ok') {
				alert(admin_frontend.lang_mail_request_status_updated_failed);
			}
			else {
				alert(admin_frontend.lang_mail_request_status_updated_sent);
			}
		});
	}
}
