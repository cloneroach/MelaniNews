	<?php global $theme_options, $newspaper; ?>
	<?php wp_footer(); ?>
	<div id="footernavbar">
		<div id="footerCatInner">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_FooterCategories') ) : ?>	
			<ul>
				<?php wp_list_categories('orderby='.$theme_options["orderBy"].'&order='.$theme_options["order"].'&title_li=&depth=1&exclude='.$theme_options["excludeCategories"]); ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
	
	<div id="footerPages">
		<div id="footerPageInner">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_FooterPages') ) : ?>	
			<ul>
				<?php $pages = get_pages();
					foreach($pages as $page) {
					print '<li>[<a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a>]</li>';
					}
				?>
				<li>[<a href="<?php bloginfo('rss2_url'); ?>">RSS</a>]</li>
			</ul>
			<?php endif; ?>
			<span id="themeInfo">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_FooterThemeInfo') ) : ?>	

				<?php wp_loginout(); ?>
				<?php if ( is_user_logged_in() ) { ?> - 
				<a href="<?php bloginfo('url'); ?>/wp-admin/edit.php"><?php echo $newspaper["manage"]; ?></a> - 
				<a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php"><?php echo $newspaper["writeNew"]; ?></a><?php } ?> / 
				<a href="http://www.wpnewspaper.com/advanced">WpAdvanced NewsPaper</a> by <a href="http://www.gabfirethemes.com">Gabfire Themes</a>
				<?php endif; ?>
			</span>
		</div>
	</div>