<?php /*
        Template Name: Work Archive Template
*/ ?>

<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div id="content" class="c">
	<div id="projects" class="c">
		<div id="projects-wrapper" class="c">

<?php $loop = new WP_Query( array( 'post_type' => 'work', 'offset' => 25, 'post_count' => -1, 'posts_per_page' => 1000 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<div class="project c">
	
	<?php $medal_url = get_field('medal_image'); ?>
	<?php $subhead = get_field('tagline'); ?>
	<?php echo '<a href="' . get_permalink() . '" class="project thumb"><img src="' . $medal_url[url] . '" class="project_thumb">' ?>
	<div class="overlay"></div>
		<?php the_title( '<h2 class="title">', '</h2>' ); ?>
		<?php if (!$subhead) {
			$subhead='&nbsp;';
		} ?>
		<?php echo '<h3 class="title">' . $subhead . '</h3>' ?>
		</a>
	</div>
<?php endwhile; ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>