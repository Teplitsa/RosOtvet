<?php 

$RO_CUSTOM_ADMIN_FILTERS_POST_TYPES = array('post');

add_action( 'restrict_manage_posts', 'ro_admin_data_filter' );
function ro_admin_data_filter(){
	global $RO_CUSTOM_ADMIN_FILTERS_POST_TYPES, $REQUEST_FIELD_STATUS;
	
    $type = 'post';
    if(isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if(array_search($type, $RO_CUSTOM_ADMIN_FILTERS_POST_TYPES) !== false){
		$field = $REQUEST_FIELD_STATUS;
		if($field) {
			$choices = $field['choices'];
			echo '<select name="ADMIN_RO_FILTER_STATUS">';
			echo '<option value="">'. __('All Statuses', 'arcade') . '</option>';
			$current_v = isset($_GET['ADMIN_RO_FILTER_STATUS']) ? $_GET['ADMIN_RO_FILTER_STATUS'] : '';
			foreach($choices as $k => $v) {
				printf('<option value="%s"%s>%s</option>', $k, $k == $current_v ? ' selected="selected" ' : '', $v);
			}
			echo '</select>';
		}
    }
    
	echo "\n<script>jQuery('#posts-filter').find('select[name=cat]').remove();</script>\n";
}

add_filter( 'parse_query', 'ro_custom_posts_filter' );
function ro_custom_posts_filter( $query ){
	global $RO_CUSTOM_ADMIN_FILTERS_POST_TYPES;
	global $pagenow;
	
    $type = 'post';    
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    
    if(array_search($type, $RO_CUSTOM_ADMIN_FILTERS_POST_TYPES) !== false && is_admin() && $pagenow=='edit.php') {
	    if(isset($_GET['ADMIN_RO_FILTER_STATUS']) && $_GET['ADMIN_RO_FILTER_STATUS'] != '') {
			$query->query_vars['meta_query'] = array(
				array(
					'key'     => 'request_status',
					'value'   => $_GET['ADMIN_RO_FILTER_STATUS']
				)
			);
	    }
    }
}

