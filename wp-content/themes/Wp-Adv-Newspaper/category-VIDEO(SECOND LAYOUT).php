<?php global $theme_options, $newspaper; ?>
<?php get_header(); ?>

	<div id="innerLeft">
			<div id="entryMeta">		
				<h2 class="singlePageTitle"><?php echo $newspaper["catVideo"]; ?> &#8216;<?php bloginfo('blogname'); ?>&#8217;</h2>	
			</div>
			<div id="innerContent">
				<div class="post">
				<?php
					$myqueryname = $wp_query;
					$wp_query = null;
					$wp_query = new WP_Query();
					$wp_query->query('cat='.$theme_options["videoCatID"].'&showposts='.$theme_options["videoPostCountArc"].'&paged='.$paged);
					if (have_posts()) : while (have_posts()) : the_post(); 
				?>	
					<div class="photoFrame">
						<div class="photoFrameInner">
						<h2 class="titlePhotoCat"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<object type="application/x-shockwave-flash" style="width:240px; height:200px;" data="<?php echo get_post_meta($post->ID, 'video', true); ?>">
						<param name="movie" value="<?php echo get_post_meta($post->ID, 'video', true); ?>" /></object> 
						<div class="postinfoPhotoCat"><?php the_time('F j, Y'); ?> | <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["permalink"]; ?></a></div>
						</div>
					</div>	
					<?php endwhile; else : endif; ?>
					<div class="clear"></div>
				</div>

				<div class="navigation">
					<div class="previous"><?php posts_nav_link('','','&laquo; '.$newspaper["previous"]) ?></div>
					<div class="next"><?php posts_nav_link('',''.$newspaper["next"].' &raquo;','') ?></div>
					<div class="clear"></div>
				</div>
				
			</div><!-- Enf of innerContent -->
		
		
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