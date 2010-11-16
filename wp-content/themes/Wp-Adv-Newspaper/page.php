<?php global $theme_options, $newspaper; ?>
<?php get_header(); ?>

	<div id="innerLeft">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="entryMeta">		
				<h2 class="singlePageTitle"><?php the_title(); ?></h2>
			</div>
			<div id="innerContent">
				<div class="post">
					<?php the_content(); ?>
				</div>
			</div><!-- Enf of innerContent -->
		<?php endwhile; else : endif; ?>
		
		<div id="midSidebar">
			<div id="midSidebarInner">
			<?php include (TEMPLATEPATH . '/innerMidSidebar.php'); ?>
			</div>
		</div><!-- End of midSidebar -->
		<div class="clear"></div>
	</div><!-- End of innerLeft (Content + Middle sidebar) -->
	
	<div id="rightSidebar">
		<?php include (TEMPLATEPATH . '/innerRightSidebar.php'); ?>
	</div><!-- End of rightSidebar -->
	<div class="clear"></div>
	
	<?php get_footer(); ?>

</div><!-- enf od wrapper -->

</body>
</html>