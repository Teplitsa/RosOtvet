<?php
/**
 * Template Name: Techpage
 * 
 */
 
get_header();
if(current_user_can( 'manage_options' )) {
?>

<br />
***********************************
<br /><br />

<?php 

$posts = get_posts(array(
	'numberposts'     => 0,
	'posts_per_page'  => 1000,
	'offset'          => 0,
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'any',	
#	'post__in'        => array( 574 ),
));
 
$to_fix_count = 0;
$req_data_exits_count = 0;
setlocale(LC_ALL, array('ru_RU.UTF-8'));

foreach($posts as $post) {
	setup_postdata($post);
	$post_id = get_the_ID();
	
	echo $post_id . "<br />";
	$request_region = get_post_meta( $post_id, 'request_region', true );
	$request_city = get_post_meta( $post_id, 'request_city', true );
	
	echo 'request_region='.$request_region . "<br />";
	echo 'request_city='.$request_city . "<br />";
	
	if(!$request_region && !$request_city) {
		$matches = null;
		preg_match_all('/.*Населенный пункт:\s*([-а-я. _]+)\s*\(([-а-я. _]+?)\)/ui', get_the_content(), $matches);
		print_r($matches);
		echo "<br />";
		if(@$matches[0][0]) {
			$request_city = @$matches[1][0];
			$request_region = @$matches[2][0];
			
			echo "city=".$request_city . "<br />";
			echo "region=".$request_region . "<br />";
			
			if($request_city || $request_region) {
				$req_data_exits_count++;
			
				if($request_city) {
					update_field('request_city', $request_city);
				}
				
				if($request_region) {
					update_field('request_region', $request_region);
				}				
			}
		}
		
		$to_fix_count++;
	}

	if($request_region || $request_city) {
		$content = get_the_content();
		echo "===clean all===<br /><br />";
		echo $content . "<br /><br />";
		$content = preg_replace('/\s*Населенный пункт:\s*[-а-я. _]+\s*\([-а-я. _]+?\)/sui', '', $content);
		$content = preg_replace('/\s*Текст запроса:\s*/sui', '', $content);
		
		wp_update_post(array(
			'ID' => $post_id,
			'post_content' => $content
		));
		
		echo $content . "<br /><br />";
	}
	else {
		$content = get_the_content();
		echo "===leave region in text===<br /><br />";
		echo $content . "<br /><br />";
		$content = preg_replace('/\s*Текст запроса:\s*/sui', '', $content);
		
		wp_update_post(array(
			'ID' => $post_id,
			'post_content' => $content
		));
		
		echo $content . "<br /><br />";
	}
	
	echo "------------------------------------<br />";
}

echo "<br /><br />";
echo "to_fix_count=" . $to_fix_count . "<br />";
echo "req_data_exits_count=" . $req_data_exits_count . "<br />";

?>
<br />
***********************************
<br /><br /><br /><br /><br /><br />

<?php 
}
get_footer();
?>