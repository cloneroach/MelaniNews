		<?php global $theme_options, $newspaper; ?>
		<?php if($theme_options['enable300250_bottom'] == 1) { include (TEMPLATEPATH . '/AD300x250_bottom.php'); } ?>	
	
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainPageSidebar_R') ) : ?>	
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainSidebar_BelowAd') ) : ?>	
			<?php endif; ?>
		
			<ul id="sidebarAjaxTabs">
				<?php if($theme_options['enableVideo'] == 1) { ?><li><a href="#sideone"><?php echo $newspaper["tabVideo"]; ?></a></li><?php } ?>
				<li><a href="#sidetwo"><?php echo $newspaper["tabArchive"]; ?></a></li>
				<li><a href="#sidethree"><?php echo $newspaper["tabFeaLinks"]; ?></a></li>
			</ul><div style="clear:both"></div>
						
			<?php if($theme_options['enableVideo'] == 1) { ?>		
			<?php query_posts('cat='.$theme_options["videoCatID"].'&showposts='.$theme_options["videoPostCount"]); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			<div id="sideone" class="tabcontainer">
				<h3 class="videoTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<object type="application/x-shockwave-flash" style="width:290px; height:235px;" data="<?php echo get_post_meta($post->ID, 'video', true); ?>">
				<param name="movie" value="<?php echo get_post_meta($post->ID, 'video', true); ?>" /></object>
			</div>			
			<?php endwhile; else : ?>
			<?php endif; ?>
			<?php } ?>
						
			<div id="sidetwo" class="tabcontainer">
				<span><?php echo $newspaper["archDate"]; ?></span>
				<form id="archiveform" action="<?php bloginfo('url'); ?>"  method="get" > 
					<select name="archive_chrono" onchange="window.location = (document.forms.archiveform.archive_chrono[document.forms.archiveform.archive_chrono.selectedIndex].value);">
						<option value=''><?php echo $newspaper["archMonth"]; ?></option>
						<?php get_archives('monthly','','option'); ?>
					</select>
				</form>
				<span><?php echo $newspaper["archCat"]; ?></span>
				<form id="searchCat" action="<?php bloginfo('url'); ?>"  method="get" > 
				<?php wp_dropdown_categories('orderby=Name&hierarchical=1&show_count=1'); ?>
				</form>
				<script type="text/javascript"><!--
				    var dropdown = document.getElementById("cat");
				    function onCatChange() {
						if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
							location.href = "<?php echo get_option('home'); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
						}
				    }
				    dropdown.onchange = onCatChange;
				--></script>
				
				<span><?php echo $newspaper["archGoogle"]; ?></span>
				<form method="get" action="http://www.google.com/search">
					<input name="q" maxlength="255" value="<?php echo $newspaper["valueSe"]; ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" id="googlequery" /> 
					<input type="hidden" name="sitesearch" value="<?php bloginfo('url'); ?>" />
				</form>		
			</div>
			<div id="sidethree" class="tabcontainer">
				<ul>
					<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
				</ul>
			</div>
			<script type="text/javascript">new Control.Tabs('sidebarAjaxTabs');</script>

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainSidebar_BelowAJaxTabs') ) : ?>	
			<?php endif; ?>		
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainSidebar_BelowAJaxTabs_R') ) : ?>	
			<div id="tagcloud">
				<h3 class="redBgTitle" style="text-align:left;"><?php echo $newspaper["tabTags"]; ?></h3>
				<?php wp_tag_cloud('smallest=10&largest=14&number=45&orderby=name'); ?>	
			</div>
			<?php endif; ?>		
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainSidebar_BelowTagCloud') ) : ?>	
			<?php endif; ?>
		<?php endif; ?>