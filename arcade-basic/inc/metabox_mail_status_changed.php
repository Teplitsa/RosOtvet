<?

function ro_add_metabox_mail_status_updated() {
	add_meta_box(
		'metabox_mail_status_updated',
		__( 'Mail Request Status Updated', 'arcade' ),
		'ro_add_metabox_status_updated',
		'post',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ro_add_metabox_mail_status_updated' );

function ro_add_metabox_status_updated($post) {
	echo '<input type="button" id="mail_status_updated_button" value="' . __( 'Send Request Status Updated Mail', 'arcade' ) . '" data-post_id="'.$post->ID.'" />';
}

function ajax_mail_request_status_updated() {
	global $REQUEST_FIELD_STATUS;
	
    $post_id = (int)$_POST['post_id'] > 0 ? (int)$_POST['post_id'] : 0;	
    if($post_id && current_user_can( 'manage_options' )) {
		$post_status_key = get_field('request_status', $post_id);
		$post_status = @$REQUEST_FIELD_STATUS['choices'][$post_status_key] ? $REQUEST_FIELD_STATUS['choices'][$post_status_key] : __('Not set', 'arcade');
		$post_link = get_permalink($post_id);
		$post_title = htmlspecialchars_decode(get_the_title($post_id));
		
		$body = '';
		if($post_status_key == 'answered') {
			$body = sprintf(
					__("email_request_answered_body", 'arcade'),
					$post_title, $post_link, $post_status
			);
		}
		else {
			$body = sprintf(
				__("email_request_status_updated_body", 'arcade'),
				$post_title, $post_link, $post_status
			);
		}
		
		$success = wp_mail(
			$to = trim(get_field('request_email', $post_id)),
			__('email_request_status_updated_title', 'arcade'),
			$body
		);
		die(json_encode(array(
			'status' => 'ok',
		)));
    } else {
        die(json_encode(array(
            'status' => 'error',
        )));
    }
}
add_action('wp_ajax_mail_request_status_updated', 'ajax_mail_request_status_updated');

?>