<?php global $theme_options, $suvi; ?>
<?php get_header(); ?>

	<div id="innerLeft">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="entryMeta">		
				<h2 class="singlePageTitle"><?php the_title(); ?></h2>
				<p><?php echo get_avatar( get_the_author_email(), '26' ); ?>
				<?php echo $newspaper["postedBy"]; ?>  <?php the_author_posts_link(); ?> 
					<?php /* This is commented, because it requires a little adjusting sometimes.
						You'll need to download this plugin, and follow the instructions:
						http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
						/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
					on <?php the_time('M jS, Y') ?> <?php echo $newspaper["filedUnder"]; ?> <?php the_category(', ') ?>.
					<?php echo $newspaper["rssLink"]; ?> <?php comments_rss_link('RSS 2.0'); ?>.
					<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
						// Both Comments and Pings are open ?>
					<?php echo $newspaper["postInfo"]; ?>
					<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
						// Only Pings are Open ?>
					<?php echo $newspaper["postInfo2"]; ?>
					<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
						// Comments are open, Pings are not ?>
					<?php echo $newspaper["postInfo3"]; ?>
					<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
						// Neither Comments, nor Pings are open ?>
					<?php echo $newspaper["postInfo4"]; ?>
					<?php } edit_post_link('Edit This Entry','',''); ?></p>
			</div>
			<div id="innerContent">
				<div class="post">
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
					<?php the_content(); ?>
				</div>
				<?php comments_template(); ?>
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