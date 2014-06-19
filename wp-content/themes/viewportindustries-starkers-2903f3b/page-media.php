<?php
/*
Template Name: Media Page
*/
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php // create $videos array ?>
 	<?php
 	$videos = get_field('video_files');
 	?>	

<?php // Pull VideoID from URL arg, set to -1 by default ?>
	<?php
	$videoid = -1;
	if (isset($_GET['videoid'])) {
		$videoid = $_GET['videoid'];
	}
	?>



<div id="content" class="c">

<div id="project-wrapper" class="wrapper c">
	
<?php // Grab Gallery ID, if exists

	if ( get_field('gallery_id') ) {
	$gallery = get_field('gallery_id');
	} ?>
			
<?php // Grab actual video URL ?>
 <?php if ( $videos[$videoid] ) {
 	// echo '<p>Video URL: ';
 	$video = $videos[$videoid];
 	// echo $video['video_upload']['url'];
 	$videourl = $video['video_upload']['url'];
 	$videotitle = $video['video_upload']['video_title'];
 	// echo '</p>';
 	$customheight = get_field('customheight');
 	?>
 	<div id="project-video-wrapper" <?php if ($customheight) { echo 'style="height:'. ( (int) $customheight + 16 ).'px"';} ?>>
		<script type="text/javascript">
		// <![CDATA[
			
			// create the qtobject and write it to the page, this includes plugin detection
			// be sure to add 15px to the height to allow for the controls
			<?php echo 'var myQTObject = new QTObject("' . $videourl . '", "' . $videotitle . '", "100%", "100%");'; ?>
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
 }	
elseif ( ($gallery) && ($videoid == -1) ) {
	echo ('<div id="gallery-wrapper">');
	echo do_shortcode('[nivoslider id="'.$gallery.'"]');
	echo ('</div>');
	$galleryshow = -1;
} 
?>
	
	
<h1 class="title"><?php the_title(); ?></h1>
<?php the_content(); ?>

<?php // Display Gallery ?>

<?php if ( $galleryshow != -1 ) {
		if (get_field('gallery_name')) {
				$galleryname = get_field('gallery_name');
		}

		?>
		<h3 class="gallery-link"><a href="<?php echo get_permalink() ?>">View <?php echo $galleryname ?></a></h3>
	<?php } ?>


<?php // Display Video Listing ?>

<?php if ( $videos ) { 
	$videocount = 0;
		?>
		<h3 id="videos_list_link">Videos (<?php echo count($videos); ?>)</h3>
		<ol id="project-videos" class="c">
	<?php foreach ($videos as $video ) { ?>
	
		<?php if ( $videocount == $videoid ) {
		echo '<li class="c current">';
		} 
		else echo '<li class="c">'
		?>

			<?php echo '<a href="' . get_permalink() . '?videoid=' . $videocount . '">' . $video['video_title'] ?>
	
			<?php echo '<span class="runtime">TRT: ' . $video[runtime] . '</a>' ?>
	
			<?php $videocount++;
		echo '</li>';
	}
	echo '</ol>';
	} 

	?>
	
	
<?php // create $mhfiles array ?>
 	<?php
 	$mhfiles = get_field('files');
 	?>
	
<?php // Display File Listing - Pdf_16x16_Crystal_SVG.png ?>	

<?php if ( $mhfiles ) { 
	$filecount = 0;
		?>
		<h3 id="files_list_link"><?php echo get_field('files_heading') ?> (<?php echo count($mhfiles); ?>)</h3>
		<ol id="project-files" class="c">
	<?php foreach ($mhfiles as $mhfile ) { 
		echo '<li class="c pdf">'
		?>
		
		<?php // Grab actual file title, URL ?>
 		<?php 
		 	$mhfileurl = $mhfile['file_upload']['url'];
		 	$mhfiletitle = $mhfile['file_title'];
		 	?>	
		 	

		<?php echo '<a href="'. $mhfileurl .'" target="_blank">' . $mhfiletitle ?>
	
		<?php echo '<span class="downloadPDFlink">Click to Download</span></a>' ?>
	
		<?php $filecount++;
		echo '</li>';
	}
	echo '</ol>';
	} 

	?>
	
<?php endwhile; ?>
</div>
</div>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>