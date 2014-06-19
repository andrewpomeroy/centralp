<?php
/**
 * Single Work Posts
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<?php // create $workvideos array ?>
 	<?php
 	$workvideos = get_field('work-videos-files');
 	?>	

<?php // Pull VideoID from URL arg, set to 0 by default ?>
	<?php
	$videoid = 0;
	if (isset($_GET['videoid'])) {
		$videoid = $_GET['videoid'];
	}
	?>
 	
<div id="content" class="c">
	<div id="project-wrapper" class="c">

<?php // Grab actual video URL ?>
 <?php if ( $workvideos[$videoid] ) {
 	// echo '<p>Video URL: ';
 	$workvideo = $workvideos[$videoid];
 	// echo $workvideo['work-video-upload']['url'];
 	$workvideourl = $workvideo['work-video-upload']['url'];
 	$workvideotitle = $workvideo['work-video-upload']['video-title'];
 	// echo '</p>';
 	$customheight = get_field('customheight');
 	?>
 	<div id="project-video-wrapper"<?php if ( get_field('4by3') ) { echo 'style="height:495px"'; }
 	 elseif ($customheight) { echo 'style="height:'. ( (int) $customheight + 16 ).'px"';} ?>>
		<script type="text/javascript">
		// <![CDATA[
			
			// create the qtobject and write it to the page, this includes plugin detection
			// be sure to add 15px to the height to allow for the controls
			<?php echo 'var myQTObject = new QTObject("' . $workvideourl . '", "' . $workvideotitle . '", "100%", "100%");'; ?>
			myQTObject.addParam("autostart", "true");
			myQTObject.addParam("scale", "aspect");
			myQTObject.addParam("loop", "false");
			myQTObject.addParam("kioskmode", "true");
			myQTObject.addParam("ShowDisplay", "false");
			myQTObject.addParam("ShowControls", "true");
			myQTObject.addParam("WMODE", "transparent");
			myQTObject.write();
			
		// ]]>
		</script>
		<noscript>
			<p>You must enable Javascript to view this content.</p>
		</noscript>
	</div>
	
	<?php
 } ?>	
 	
	<h1 class="title"><?php the_title(); ?></h1>
	<?php if ( get_field('tagline') ) { echo '<h2 class="title">' . get_field('tagline') . '</h2>'; 
	} ?>
	
<?php // post text goes here ?>	

<div id="project-body" class="c">
	<?php the_content(); ?>			


 </div> 
 
  	<?php
 	$workvideos = get_field('work-videos-files');
 	?>
 	
 
 
	<?php if (( $workvideos ) && (count($workvideos) > 1)) { 
	$videocount = 0;
		?>
		<h3 id="videos_list_link">Videos (<?php echo count($workvideos); ?>)</h3>
		<ol id="project-videos" class="c">
	<?php foreach ($workvideos as $workvideo ) { ?>
	
		<?php if ( $videocount == $videoid ) {
		echo '<li class="c current">';
		} 
		else echo '<li class="c">'
		?>

			<?php echo '<a href="' . get_permalink() . '?videoid=' . $videocount . '">' . $workvideo['video-title'] ?>
	
			<?php echo '<span class="runtime">TRT: ' . $workvideo[runtime] . '</a>' ?>
	
			<?php $videocount++;
		echo '</li>';
	}
	echo '</ol>';
	} 

	?>

<?php
// Get "credits" field 
$credits = get_field('credits');
$multicredits = get_field('multiple-credits');
	if ( $credits || $multicredits) {
	echo '<div id="project-description" class="project-description c">';
	}

	if ( $credits ) { 

		echo '<p><strong>CREDITS:</strong></p>';
		foreach ($credits as $credit ) {
			echo '<p><strong>'. $credit['role'].'</strong>: ';
			if ($credit['link']) {
				echo '<a href="'.$credit['link'].'" target="_blank">';
			}
			echo $credit['name'];
			if ($credit['link']) {
				echo '</a>';
			}
			echo '</p>';
		}
		echo '</div>';
		} 


	if ( $multicredits ) {
	echo '<ul>';

		while (has_sub_field('multiple-credits')) {
			echo '<li>';
			echo '<h2>';
			the_sub_field('project_name');
			echo '</h2>';
			if ( get_sub_field('credits') ) {
			echo '<p>';
				while ( has_sub_field('credits') ) {
									echo '<strong>';
									the_sub_field('role');
									echo '</strong>: ';
									if (get_sub_field('link')) {
										echo '<a href="';
										the_sub_field('link');
										echo '" target="_blank">';
									}
									the_sub_field('name');
									if (get_sub_field('link')) {
										echo '</a>';
									}
									echo '<br>';
					}
			echo '</p>';

				}
			echo '</li>';
		}
	echo '</ul>';
	echo '</div>';
	}

?>
<?php if ( get_sub_field('credit_additional_unnamed') ) {
echo '<p>+ many more great people too extensive to list.</p>';
}
?>

<?php if ( get_field('additional-html') ) {
the_field('additional-html');
} ?>

</div>
</div>

	<?php endwhile; ?>
	


<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>