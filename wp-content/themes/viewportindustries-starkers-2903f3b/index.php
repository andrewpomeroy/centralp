<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div id="content">
<?php
global $query_string;
$posts = query_posts($query_string.'&posts_per_page=1000');
?>
<?php if ( have_posts() ): ?>
<ol>
<?php while ( have_posts() ) : the_post(); ?>


<?php
if (get_field('linked_work_item')) { 
$workpost = get_field('linked_work_item');
// $workpost_link = '<a href="'. $workpost .'title="Permalink to ' . get_title() . '" rel="bookmark">';
}
// else $workpost_link = "";
// echo $workpost_link;
?>

	<li>
		<article class="wrapper c news">
			<h2 class="title">
			<?php if (get_field('linked_work_item')) { 
			echo '<a href="'. $workpost .'" title="Permalink to ';
			the_title();
			echo '" rel="bookmark">';
			the_title();
			echo '</a>';
			}
			else {
				the_title();
			}
			?>
			</h2>		
<!-- 			
			<a href="<?php echo $workpost; ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			 -->
			<h3 class="post_date"><time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>Posted on <?php the_date(); ?></time> </h3>
			<?php the_content(); ?>
			<p class="thumbnail">
			
			<?php if (get_field('linked_work_item')) { 
			echo '<a href="'. $workpost .'" title="Permalink to ';
			the_title();
			echo '" rel="bookmark">';
			the_post_thumbnail();
			echo '</a>';
			}
			else {
				the_post_thumbnail();
			}
			?>
			</h2>			
<!-- 		
				<a href="<?php echo $workpost ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a></p>
	 -->	
		
		</article>
	</li>
<?php endwhile; ?>
</ol>
<?php else: ?>
<h2>No posts to display</h2>
<?php endif; ?>

</div>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>