
	<h1 class="entry-title taggedlink">
		<?php if ( is_single() ) : ?>
			<?php the_title(); ?>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php endif; // is_single() ?>
	</h1>

	<?php if ( ! is_front_page() || 1 < $paged ) { ?>
	<div class="entry-meta">
		<?php
		
		if ( is_single() ) the_tags( '<p class="tags"><i class="fa fa-tags"></i> <span>' . __( 'Tags:', 'arcade' ) . '</span>', ' ', '</p>' );
	
		$display_author = $bavotasan_theme_options['display_author'];
		if ( $display_author )
			printf( __( 'by %s', 'arcade' ),
				'<span class="vcard author"><span class="fn"><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . esc_attr( sprintf( __( 'Posts by %s', 'arcade' ), get_the_author() ) ) . '" rel="author">' . get_the_author() . '</a></span></span>'
			);

		$display_date = $bavotasan_theme_options['display_date'];
		if( $display_date ) {
			if( $display_author )
				echo ',&nbsp;&nbsp;';

		    echo '<a href="' . get_permalink() . '" class="time"><time class="date published updated" datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date() . '</time></a>';
	    
		}
		
		$request_region = get_post_meta(get_the_ID(), 'request_region', true);
		$request_city = get_post_meta(get_the_ID(), 'request_city', true);
		
			?>
	</div>
	<?php } ?>

	    <div class="entry-content description clearfix">
	    <div class="request-raw-data">
		    <?php
			if ( is_singular() && ! is_front_page() ) {
			    echo get_the_content( __( 'Read more', 'arcade') );
			?></div>
			
				<?if($request_region || $request_city):?>
					<?
						$region_filter_url = '';
						if($request_region) {
							$region_filter_url = site_url( '/requests/?region_filter=' . $request_region );
						}
						
						$city_filter_url = '';
						if($request_region && $request_city) {
							$city_filter_url = site_url( '/requests/?region_filter=' . $request_region . '&city_filter=' . $request_city );
						}
						elseif($request_city) {
							$city_filter_url = site_url( '/requests/?city_filter=' . $request_city );
						}
					?>
					<div class="ro-request-region-block">
						<?if($request_region):?><a href="<?=$region_filter_url?>"><?=$request_region?></a><?endif?><?if($request_region && $request_city):?>, <?endif?>
						<?if($request_city):?><a href="<?=$city_filter_url?>"><?=$request_city?></a><?endif?>
					</div>
				<?endif?>
			
				<div class="request-process-data">

				<?if(get_field('request_status') == 'sent'):?>
					<h2><?_e('Request sent', 'arcade')?></h2>
				<?elseif(get_field('request_status') == 'answered'):?>
					<h2><?_e('Response received', 'arcade')?></h2>
				<?else:?>
					<div class="sysmessage"><h3><?_e('Request processing is in progress', 'arcade')?></h3></div>
				<?endif?>
				
				<?				
				if(get_field('request_status') == 'sent' || get_field('request_status') == 'answered') {
					$request_official_cycle = get_field('request_official_cycle');
					if(is_array($request_official_cycle)) {
						foreach($request_official_cycle as $index => $request_official) {
							echo '<div class="panel panel-default">';
							$request_index = $index + 1;
							$request_text = $request_official['request_text'];
							if($request_text) {
								?>
								<div class="rosotvet-request_text panel-heading">
									<div class="clearfix">
										<h4 class="ro-official-request-block pull-left"><?=__('Official request block', 'arcade') . ' #' . $request_index?></h4>
										<a href="#" class="ro-toggle-request-text pull-right" data-expanded="0" data-request-index="<?=$request_index?>"><span class="ro-toggle-request-text-expand"><?php _e('Expand request text', 'arcade') ?></span><span class="ro-toggle-request-text-collapse"><?php _e('Collapse request text', 'arcade') ?></span></a>
									</div>
								</div>
								<div class="panel-body">
									<div class="rosotvet-field-text ro-request-collapsable" id="request-text-<?=$request_index?>">
										<h2 class="ro-official-request-header"><?=__('Official request text', 'arcade') . ' #' . $request_index?></h2>
										<?=$request_text?>
									</div>
								<?if(@$request_official['request_send_date']):?>
									<div class="single_req_resp_date">
										<?_e('Request Date', 'arcade')?>: <i><?=month_en2ru(date('F j, Y', strtotime(@$request_official['request_send_date'])))?></i>
										<?php
											$request_authority_tags_id = array();
											if(is_array($request_official['request_authority'])) {
												$request_authority_tags_id = array_merge($request_authority_tags_id, $request_official['request_authority']);
											}
											elseif($request_official['request_authority']) {
												$request_authority_tags_id[] = $request_official['request_authority'];
											}
											
											if(count($request_authority_tags_id) > 0) {
												_e('to authority', 'arcade');
											}
											foreach($request_authority_tags_id as $atag_index => $authority_tag_id) {
												$tag = get_term( $authority_tag_id, 'authority');
												if($tag) {
												?>
													<a href="<?php echo get_term_link( $tag, 'authority' )?>"><?php echo $tag->name ?></a><?php if($atag_index + 1 < count($request_authority_tags_id)):?>, <?php endif?>
												<?php
												} 
											}
										?>
									</div>
								<?endif?>
								<?
							}

							$request_responses = @$request_official['request_response'];
							if(is_array($request_responses) && count($request_responses)) {
								foreach($request_responses as $index1 => $request_response) {
									$request_responses_index = $index1 + 1;
									$request_response_text = $request_response['request_response_text'];
									if($request_response_text) {?>
										<div class="rosotvet-request_response_text">
											<h2><?=__('Response text', 'arcade') . ' #' . $request_index . '.' . $request_responses_index?></h2>
											<div class="rosotvet-field-text"><?=$request_response_text?></div>
											<?if(@$request_response['request_response_date']):?>
												<div class="single_req_resp_date">
													<?_e('Response Date', 'arcade')?>: <i><?=month_en2ru(date('F j, Y', strtotime(@$request_response['request_response_date'])))?></i>
													
													<?php
														$authority_tags_id = array();
														if(is_array($request_response['request_response_authority'])) {
															$authority_tags_id = array_merge($authority_tags_id, $request_response['request_response_authority']);
														}
														elseif($request_response['request_response_authority']) {
															$authority_tags_id[] = $request_response['request_response_authority'];
														}
														
														if(count($authority_tags_id) > 0) {
															_e('from authority', 'arcade');
														}
														
														foreach($authority_tags_id as $a_resp_tag_index => $authority_tag_id) {
															$tag = get_term( $authority_tag_id, 'authority');
															if($tag) {
															?>
																<a href="<?php echo get_term_link( $tag, 'authority' )?>"><?php echo $tag->name ?></a><?php if($a_resp_tag_index + 1 < count($authority_tags_id)):?>, <?php endif?>
															<?php
															} 
														}
													?>
													
												</div>
											<?endif?>
										</div>
									<?}
									
									$request_response_files = $request_response['request_files'];
									if(is_array($request_response_files)) {
										foreach($request_response_files as $index2 => $file) {
											$file = $file['request_file'];
											if($file) {
												$file_index = $index2 + 1;
												$file_index_full = $request_index . '.' . $request_responses_index . '.' . $file_index;
												?>
												<br />
												<a href="<?=$file['url']?>"><?=__('Download response file', 'arcade') ?> <?=$file['title']?></a>
												<?
											}
										}
									}
									?>
									
									<?$request_comment = $request_response['request_lower_comment']?>
									<?if($request_comment):?>
										<div class="rosotvet-request_lower_comment">
											<h2><?_e('Lower comment', 'arcade')?></h2>
											<div class="rosotvet-field-text"><?=$request_comment?></div>
										</div>
									<?endif?>
								<?
								}
							}
							else {
								$delta_days = floor((time() - strtotime($request_official['request_send_date'])) / (3600 * 24));
								$delay_days = $delta_days - 10;
								if($request_official['request_send_date'] && $delay_days > 0) {									
									?>
									<h5 class="response_delay"><?=__('rosotvet_response_delay', 'arcade') . " " . sprintf(_n('%s day', 'days', $delay_days), $delay_days) ?></h5>
									<?
								}
							}
							
							if($request_text) {
								echo "</div><!-- end panel body -->";
							}
							echo "</div> <!-- end panel -->";
						}
					}
				}
				?>
					
				<?$request_comment = get_field('request_admin_comment')?>					
				<?if($request_comment):?>
					<div class="rosotvet-request_lower_comment">
						<h2><?_e('Site administration comment', 'arcade')?></h2>
						<div class="rosotvet-field-text"><?=$request_comment?></div>
					</div>
				<?endif?>
				
				</div>
			<?
			}
			else
				the_excerpt();
			?>
	    </div><!-- .entry-content -->
