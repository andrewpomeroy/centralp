 <!-- old video URL grab
	<?php if( $workvideos[$videoid] ) { ?>
		<p>Video URL: 
	<?php $workvideo = $workvideos[$videoid];
	echo get_permalink( $workvideo->ID ); ?>
		</p>
	<?php echo '<a href="' . get_permalink() . '?videoid='. $videoid . '">'?>
	<?php echo 'Current Video' ?>
	<?php echo '</a>' ?>
	
	
	<?php } ?>	
-->

<!-- OLD 'RELATIONSHIP' VIDEO META PARSING

	<?php if( $workvideos ) { ?> 
	<ul>
	<?php foreach ( $workvideos as $workvideo ) : ?>
							<li>
								<a href="<?php echo get_permalink( $workvideo->ID ); ?>">
								<?php echo get_the_title( $workvideo->ID ); ?> 
								</a>
								<?php if (get_post_meta( $workvideo->ID, 'runtime-value', true )) { ?>
								(<?php echo get_post_meta( $workvideo->ID, 'runtime-value', true ) ?>)
								<?php } ?>									
							</li>	
	<?php endforeach; ?>
	</ul>
	<?php } ?>
 -->
 
 <!-- 	
	<?php if (get_post_meta( $workvideo->ID, 'runtime', true )) { ?>
	<?php echo '(' . get_post_meta( $workvideo->ID, 'runtime', true ) . ')' ?>
	<?php } ?>
	 -->