<?php global $theme_options, $newspaper; ?>
<?php get_header(); ?>

	<div id="innerLeft">
			<div id="entryMeta">		
				<h2 class="singlePageTitle"><?php echo $newspaper["404"]; ?></h2>
			</div>
			<div id="innerContent">
					<h2 class="archiveTitle"><?php echo $newspaper["404"]; ?></h2>				
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