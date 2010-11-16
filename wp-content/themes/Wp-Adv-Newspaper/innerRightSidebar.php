<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_innerRightSidebar_R') ) : ?>
<?php if($theme_options['enablePhotoGallery'] == 1) { ?>
<h3 class="rightSidebarTitle"><?php echo $newspaper["photoGal"]; ?></h3>
<ul id="rightSidebarGallery">
	<?php $photoGal = new WP_Query();$photoGal->query('showposts='.$theme_options["postCountPhotoBar"].'&cat='.$theme_options["photoGalCatID"]); ?>
	<?php while ($photoGal->have_posts()) : $photoGal->the_post(); ?>
	<li><a class="highslide" onclick="return vz.expand(this)" href="<?php viva('NpAdvHover','1'); ?>"><img src="<?php viva('NpAdvMainPGThumb','8'); ?>" alt="<?php the_title(); ?>" /></a><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
	<?php endwhile; wp_reset_query(); ?>	
</ul>
<?php } ?>
<?php endif; ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_innerRightSidebar') ) : ?>
<?php endif; ?>
		
<?php if($theme_options['enable120x600_inner'] == 1)  { include (TEMPLATEPATH . '/AD120x600_inner.php'); } ?>