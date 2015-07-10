<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

<h1 class="entry-title taggedlink">
	<?php if ( is_single() ) : ?>
		<?php the_title(); ?>
	<?php else : ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	<?php endif; // is_single() ?>
</h1>

<div class="entry-meta">
	<?php
	
	if( @$display_author )
		echo '&nbsp;' . __( 'on', 'arcade' ) . '&nbsp;';

    echo '<a href="' . get_permalink() . '" class="time"><time class="date published updated" datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date() . '</time></a>';
    include('ro_request_authorities.php');
	?>
	<div class="rosotvet-list-tags" style="margin-top:10px;">
	<?the_tags( '<p class="tags"><i class="fa fa-tags"></i> <span>' . __( 'Tags:', 'arcade' ) . '</span>', ' ', '</p>' )?>
	</div>
</div>

</article>