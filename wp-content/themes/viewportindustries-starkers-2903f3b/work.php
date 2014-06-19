<?php /*
        Template Name: Work Custom Template
*/ ?>

<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div id="content" class="c">
	<div id="projects" class="c">
		<div id="projects-wrapper" class="c">

<?php $loop = new WP_Query( array( 'post_type' => 'work', 'posts_per_page' => 25 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	
	<?php if (!get_field('sub-project')) { ?>
	
	<div class="project c">
	
	<?php $medal_url = get_field('medal_image'); ?>
	<?php echo '<a href="' . get_permalink() . '" class="project thumb"><img src="' . $medal_url[url] . '" class="project_thumb"><div class="overlay"></div></a>' ?>
	<div class="entry-content project-description wrapper c">
		<?php the_title( '<h1 class="title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h1>' ); ?>
		<?php the_content(); ?>
	</div>
	<?php echo '<p class="read-more"><a href="' . get_permalink() . '">Read more</a></p>' ?>
	</div>
	
	<?php } ?>
	
<?php endwhile; ?>

<!-- Display Archives Link -->

	<div class="project c noborder">
	
	<?php $archive_link = 131;
	$archive_url = get_page_link($archive_link); ?>
	<?php echo '<a href="' . get_page_link($archive_link) . '" class="project thumb"><img src="/images/archived_work.png" class="project_thumb"><div class="overlay"></div></a>' ?>
	<div class="entry-content project-description wrapper c">
	<?php echo '<h1 class="title"><a href="' . get_page_link($archive_link) . '" title="Archived Work" rel="bookmark">Archived Work</a></h1>' ?>
		<p>Take a look at our back catalog of work. While many of our past projects are here, we also have quite a few that we can't post publicly due to client confidentiality constraints, so please let us know if you can't find an example of what you're after!</p>
	</div>
	<?php echo '<p class="read-more"><a href="' . get_page_link($archive_link) . '">View The Archives</a></p>' ?>
	</div>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>