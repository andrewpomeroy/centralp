<div id="page" class="c">
<header>
	<h2 class="title"><a href="/"><?php bloginfo( 'name' ); ?></a></h2>
<!-- 
		<?php bloginfo( 'description' ); ?>
<meta property="og:image" conent="http://www.centralplanning.tv/wp-content/uploads/2013/06/P1010222thumb.jpg" />

-->
</header>
	<!-- 
	<?php get_sidebar(); ?>
	 -->
	<!-- 
	<?php clean_custom_menus(); ?>
 -->
 <?php
 wp_nav_menu( array(
 'container' =>'nav',
 'menu_class' => 'nav-primary',
 'menu_id' => 'vertical_nav',
 'echo' => true,
 'before' => '',
 'after' => '',
 'link_before' => '<span>',
 'link_after' => '</span>',
 'depth' => 0)
 );
 ?>
 