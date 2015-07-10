<?php

$authorities = wp_get_post_terms( get_the_ID(), 'authority' );
if($authorities) {
    ?>
    <span class="ro-req-list-sent-to"><?php _e('отправлено в ');?></span>
    <?php 
    $a_resp_tag_index = 0;
    foreach($authorities as $tag) {
    ?>
    	<a href="<?php echo get_term_link( $tag, 'authority' )?>"><?php echo $tag->name ?></a><?php if($a_resp_tag_index + 1 < count($authorities)):?>, <?php endif?>
    <?php 
	}
}
