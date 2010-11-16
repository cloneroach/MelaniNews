<?php global $theme_options, $newspaper; ?>
<?php get_header(); ?>

	<div id="innerLeft">
			<div id="entryMeta">		
				<h2 class="singlePageTitle"><?php echo $newspaper["seresults"]; ?> &#8216;<?php echo wp_specialchars($s, 1); ?>&#8217;</h2>
			</div>
			<div id="innerContent">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post">
					<h2 class="archiveTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					
					<?php if($theme_options['enablePhotoGallery'] == 1) { ?>
						<?php if ( in_category($theme_options["photoGalCatID"]) ): ?>
							<img src="<?php viva('NpAdvSinglePhoto','17'); ?>" alt="<?php the_title(); ?>" class="phLargePhoto" />
						<?php endif; ?>
					<?php } ?>
					
					<?php if($theme_options['enableVideo'] == 1) { ?>		
						<?php if ( in_category($theme_options["videoCatID"]) ): ?>
							<div class="video">
								<object type="application/x-shockwave-flash" style="width:506px; height:280px;" data="<?php echo get_post_meta($post->ID, 'video', true); ?>">
								<param name="movie" value="<?php echo get_post_meta($post->ID, 'video', true); ?>" /></object> 
							</div>
						<?php endif; ?>			
					<?php } ?>
					<?php the_excerpt(); ?>
					
					<div class="postinfo">
						<?php the_time('F j, Y'); ?> | <?php echo $newspaper["postedIn"]; ?> <?php the_category(',') ?> | <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["readMore"]; ?> &raquo;</a>
					</div>
				</div>
				
				<?php endwhile; else : ?>
					<h2 class="archiveTitle"><?php echo $newspaper["seNothing"]; ?></h2>
				<?php endif; ?>
				
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