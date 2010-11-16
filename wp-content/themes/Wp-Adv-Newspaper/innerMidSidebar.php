<?php include (TEMPLATEPATH . '/AD250x250_inner.php'); ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_innerMidSidebar_R') ) : ?>	
<?php if (function_exists('zap_recent_commented')) { ?>
<div class="widget midSidebarWidget">
	<h3 class="redBgTitle"><?php echo $newspaper["rCommented"]; ?></h3>
	<ul>
		<?php zap_recent_commented(); ?>
	</ul>
</div>
<?php } ?>
						
<div class="widget midSidebarWidget" style="text-align:center">
	<h3 class="redBgTitle" style="text-align:left;"><?php echo $newspaper["aByTag"]; ?></h3>
	<?php wp_tag_cloud('smallest=10&largest=14&number=45&orderby=name'); ?>	
</div>
			
<div class="widget midSidebarWidget">
	<h3 class="redBgTitle"><?php echo $newspaper["rEntries"]; ?> </h3>
	<ul>
		<?php get_archives('postbypost','10'); ?>
	</ul>
</div>
<?php endif; ?>