<?php
/*
Template Name: Movie Test
*/
?>
<?php
/**
 * Test movie template
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>


	<div id="video">
		<script type="text/javascript">
		// <![CDATA[
			
			// create the qtobject and write it to the page, this includes plugin detection
			// be sure to add 15px to the height to allow for the controls
			var myQTObject = new QTObject("wp-content/uploads/2012/11/Videostore_No_More_SUBTITLED.mov", "bushfinger", "640", "100%");
			myQTObject.addParam("autostart", "true");
			myQTObject.addParam("scale", "aspect");
			myQTObject.addParam("loop", "false");
			myQTObject.addParam("kioskmode", "true");
			myQTObject.addParam("ShowDisplay", "false");
			myQTObject.addParam("ShowControls", "true");
			myQTObject.write();
			
		// ]]>
		</script>
		<noscript>
			<p>You must enable Javascript to view this content.</p>
		</noscript>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>	
	
	