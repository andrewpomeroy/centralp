<?php
/*
Template Name: Motorhome Page
*/
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php // create $mhvideos array ?>
 	<?php
 	$mhvideos = get_field('mh-videos-files');
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
 <?php if ( $mhvideos[$videoid] ) {
 	// echo '<p>Video URL: ';
 	$mhvideo = $mhvideos[$videoid];
 	// echo $mhvideo['mh-video-upload']['url'];
 	$mhvideourl = $mhvideo['mh-video-upload']['url'];
 	$mhvideotitle = $mhvideo['mh-video-upload']['video-title'];
 	// echo '</p>';
 	$customheight = get_field('customheight');
 	?>
 	<div id="project-video-wrapper"<?php if ( get_field('4by3') ) { echo 'style="height:495px"'; }
 	 elseif ($customheight) { echo 'style="height:'. ( (int) $customheight + 16 ).'px"';} ?>>
		<script type="text/javascript">
		// <![CDATA[
			
			// create the qtobject and write it to the page, this includes plugin detection
			// be sure to add 15px to the height to allow for the controls
			<?php echo 'var myQTObject = new QTObject("' . $mhvideourl . '", "' . $mhvideotitle . '", "100%", "100%");'; ?>
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
elseif ($gallery) {
	echo ('<div id="gallery-wrapper">');
	echo do_shortcode('[nivoslider id="'.$gallery.'"]');
	echo ('</div>');
} 
?>
	
	
<h1 class="title"><?php the_title(); ?></h1>
<?php the_content(); ?>

<?php // Display Video Listing ?>

<?php if ( $mhvideos ) { 
	$videocount = 0;
		?>
		<h3 id="videos_list_link">Videos (<?php echo count($mhvideos); ?>)</h3>
		<ol id="project-videos" class="c">
	<?php foreach ($mhvideos as $mhvideo ) { ?>
	
		<?php if ( $videocount == $videoid ) {
		echo '<li class="c current">';
		} 
		else echo '<li class="c">'
		?>

			<?php echo '<a href="' . get_permalink() . '?videoid=' . $videocount . '">' . $mhvideo['video-title'] ?>
	
			<?php echo '<span class="runtime">TRT: ' . $mhvideo[runtime] . '</a>' ?>
	
			<?php $videocount++;
		echo '</li>';
	}
	echo '</ol>';
	} 

	?>
	
	
<?php // create $mhfiles array ?>
 	<?php
 	$mhfiles = get_field('mh-pdf-files');
 	?>
	
<?php // Display File Listing - Pdf_16x16_Crystal_SVG.png ?>	

<?php if ( $mhfiles ) { 
	$filecount = 0;
		?>
		<h3 id="files_list_link"><?php echo get_field('mh-pdf-heading') ?> (<?php echo count($mhfiles); ?>)</h3>
		<ol id="project-files" class="c">
	<?php foreach ($mhfiles as $mhfile ) { 
		echo '<li class="c pdf">'
		?>
		
		<?php // Grab actual file title, URL ?>
 		<?php 
		 	$mhfileurl = $mhfile['mh-pdf-upload']['url'];
		 	$mhfiletitle = $mhfile['pdf-title'];
		 	?>	
		 	

		<?php echo '<a href="'. $mhfileurl .'" target="_blank">' . $mhfiletitle ?>
	
		<?php echo '<span class="downloadPDFlink">Click to Download PDF</span></a>' ?>
	
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