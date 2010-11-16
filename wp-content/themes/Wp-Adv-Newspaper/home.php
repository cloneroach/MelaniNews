<?php global $theme_options, $newspaper; ?>
<?php get_header(); ?>

	<div id="mainContentWrapper">
		<div id="mainContent">
			<!-- featured entries -->
			<div id="slider2" class="sliderwrapper">
				<?php $a = 1; $query1 = new WP_Query();$query1->query('showposts='.$theme_options["feaPostCount"].'&&cat='.$theme_options["featuredCatID"]); ?>
				<?php while ($query1->have_posts()) : $query1->the_post(); ?>	
				<div class="contentdiv">
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainFea','1'); ?>" alt="" /></a>
					<h2 class="featuredTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> &raquo;</a></h2>
				</div>
				<?php $a++; endwhile; wp_reset_query(); ?>
			</div>

			<div id="paginate-slider2" class="pagination">
				<?php $b = 1; $query2 = new WP_Query();$query2->query('showposts='.$theme_options["feaPostCount"].'&cat='.$theme_options["featuredCatID"]); ?>
				<?php while ($query2->have_posts()) : $query2->the_post(); ?>
					<a href="#" class="toc"><img src="<?php viva('NpAdvFeaThumb','2'); ?> " alt="" /></a>
				<?php $b++; endwhile; wp_reset_query(); ?>
				<div class="clear"></div>
			</div>

			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/slideItFeatured.js"></script>
			<!-- End of featured entries -->
			
			<!-- Entries below the featured section -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget1_R') ) : ?>	
			<?php  $c = 1; $query3 = new WP_Query();$query3->query('showposts='.$theme_options["fea2PostCount"].'&cat='.$theme_options["fea2CatID"]); ?>
			<?php while ($query3->have_posts()) : $query3->the_post(); ?>
			<div class="featuredPost2">
				<?php if ($c == 1) { ?><h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["fea2CatID"]);?>"><?php echo get_cat_name($theme_options["fea2CatID"]); ?></a></h2><?php } ?>
				<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvSubFea','3'); ?>" alt="<?php the_title(); ?>" class="alignleft"/></a>
				<h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> &raquo;</a></h2>
				<p><?php print string_limit_words(get_the_excerpt(), 35); ?>...</p> 
				<span class="featuredPost2Meta"<?php if ($c == $theme_options["fea2PostCount"]) { ?> style="border:none;"<?php } ?>><?php the_time('F j Y') ?> / <?php comments_popup_link(__($newspaper["noComment"]), __($newspaper['comment1']), __($newspaper['comments']));?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["readMore"]; ?> &raquo;</a></span>
			</div>
			<?php $c++; endwhile; wp_reset_query(); ?>
			<?php endif; ?>
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget1') ) : ?>	
			<?php endif; ?>
			<!-- End of entries below the featured section -->
		</div><!-- Enf of mainContent -->
		
		<div id="midColPosts">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget2_R') ) : ?>
			<!-- Entries on middle column on the right side of Featured section -->
			<?php $d = 1; $query4 = new WP_Query();$query4->query('showposts='.$theme_options["fea3PostCount"].'&cat='.$theme_options["fea3CatID"]); ?>
			<?php while ($query4->have_posts()) : $query4->the_post(); ?>	
			<div class="midColPost">
				<?php if ($d == 1) { ?><h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["fea3CatID"]);?>"><?php echo get_cat_name($theme_options["fea3CatID"]); ?></a></h2><?php } ?>
				<h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> &raquo;</a></h2>
				<img src="<?php viva('NpAdvSideFea','4'); ?> " alt="<?php the_title(); ?>" class="alignleft" />
				<p><?php print string_limit_words(get_the_excerpt(),24); ?>...</p>
				<span class="midColPostMeta" <?php if ($d == $theme_options["fea3PostCount"]) { ?>style="border:none;"<?php } ?>><?php the_time('M j Y') ?> / <?php comments_popup_link(__($newspaper["noComment"]), __($newspaper['comment1']), __($newspaper['comments']));?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["readMore"]; ?> &raquo;</a></span>
			</div>
			<?php $d++; endwhile; wp_reset_query(); ?>
			<!-- End of entries on middle column on the right side of Featured section -->
			<?php endif; ?>
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget2') ) : ?>	
			<?php endif; ?>
		</div><!-- End of midColPosts -->
		
		<div id="rightColAd">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainPage120x600Spot') ) : ?>	
			<?php endif; ?>
			<?php if($theme_options['enable120x600_main'] == 1)  { include (TEMPLATEPATH . '/AD120x600_main.php'); } ?>
		</div><!-- End of rightColAd -->
		<div class="clear"></div>
	</div><!-- End of MainContentWrapper (Featured block + Mid colum block + 120+600 ad) -->
		
	<div id="secondaryContentWrapper">
		<div id="breakingNews">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_MainPageBreakingNews') ) : ?>
			<h3 class="redBgTitle"><?php echo $theme_options["titleBreakingNews"]; ?></h3>
			<ul>
			<?php $latest = get_posts('numberposts='.$theme_options["breakingNewsPostCount"].'&cat='.$theme_options["breakingNewsCatID"]); foreach( $latest as $post ): ?>
				<li><strong>&raquo; <?php the_time('H:i') ?></strong> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach ?>
			</ul>
			<?php endif; ?>
		</div><!-- End of breakingNews -->
		
		<div id="secondaryMidColumn">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget3_R') ) : ?>	
			<?php $e = 1; $query5 = new WP_Query();$query5->query('showposts='.$theme_options["secondaryMidPostCount"].'&cat='.$theme_options["secondaryMidCatID"]); ?>
			<?php while ($query5->have_posts()) : $query5->the_post(); ?>
			<div class="secondaryMidColPost" <?php if ($e == $theme_options["secondaryMidPostCount"]) { ?>style="padding-bottom:0;"<?php } ?>>
				<?php if ($e == 1) { ?><h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["secondaryMidCatID"]);?>"><?php echo get_cat_name($theme_options["secondaryMidCatID"]); ?></a></h2><?php } ?>
				<h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> &raquo;</a></h2>
				<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvSideFea','5'); ?> " alt="<?php the_title(); ?>" class="alignleft" /></a>
				<p><?php print string_limit_words(get_the_excerpt(), 45); ?>...</p>
				<span class="secondaryMidColPostMeta"><?php the_time('M j Y') ?> / <?php comments_popup_link(__($newspaper["noComment"]), __($newspaper['comment1']), __($newspaper['comments']));?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["readMore"]; ?> &raquo;</a></span>
			</div>
			<?php $e++; endwhile; wp_reset_query(); ?>
			<?php endif; ?>
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget3') ) : ?>	
			<?php endif; ?>
		</div><!-- End of secondaryMidColumn -->
		
		<div id="secondaryRightColumn">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget4_R') ) : ?>
			<?php $f = 1; $query6 = new WP_Query();$query6->query('showposts='.$theme_options["secondaryRightPostCount"].'&cat='.$theme_options["secondaryRightCatID"]); ?>
			<?php while ($query6->have_posts()) : $query6->the_post(); ?>	
			<div class="secondaryRightColPost">
				<?php if ($f == 1) { ?><h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["secondaryRightCatID"]);?>"><?php echo get_cat_name($theme_options["secondaryRightCatID"]); ?></a></h2><?php } ?>
				<h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?> &raquo;</a></h2>
				<p><a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvSecondaryRight','6'); ?>" alt="<?php the_title(); ?>" class="alignleft"/></a><?php print string_limit_words(get_the_excerpt(), 25); ?>...</p>
				<span class="secondaryRightColPostMeta"><?php the_time('M j Y') ?> / <?php comments_popup_link(__($newspaper["noComment"]), __($newspaper['comment1']), __($newspaper['comments']));?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["readMore"]; ?> &raquo;</a></span>
			</div>
			<?php $f++; endwhile;  wp_reset_query(); ?>
			<?php endif; ?>
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget4') ) : ?>
			<?php endif; ?>
			
			<?php if($theme_options['enable300250_up'] == 1) { include (TEMPLATEPATH . '/AD300x250_up.php'); } ?>
		</div><!-- End of secondaryRightColumn -->
		
		<div class="clear"></div>
	</div><!-- End of SecondaryContentWrapper (BreakingNews + 2 columns on the right side of breaking news spot) -->
	
	
	<?php if($theme_options['enablePhotoGallery'] == 1) { ?>
	<div id="photoGalleryBar">
		<ul>
			<?php $photoGal = new WP_Query();$photoGal->query('showposts='.$theme_options["postCountPhotoBar"].'&cat='.$theme_options["photoGalCatID"]); ?>
			<?php while ($photoGal->have_posts()) : $photoGal->the_post(); ?>
			<li><a class="highslide" onclick="return vz.expand(this)" href="<?php viva('NpAdvHover','7'); ?>"><img src="<?php viva('NpAdvMainPGThumb','8'); ?>" alt="<?php the_title(); ?>" /></a><br /><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>	
		</ul><div class="clear"></div>
	</div>
	<?php } ?>
	
	<div id="subNews">
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_1x8_R') ) : ?>
				<?php $bottomFirst = new WP_Query();$bottomFirst->query('showposts='.$theme_options["postCountBot1"].'&cat='.$theme_options["sub1stCatID"]); ?>
				<?php if ($bottomFirst->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub1stCatID"]);?>"><?php echo get_cat_name($theme_options["sub1stCatID"]); ?></a></h2>
				<?php while ($bottomFirst->have_posts()) : $bottomFirst->the_post(); ?>	
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','9'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 1st row / 1st column out of 4 -->
		
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_2x8_R') ) : ?>
				<?php $bottomSecond = new WP_Query();$bottomSecond->query('showposts='.$theme_options["postCountBot2"].'&cat='.$theme_options["sub2ndCatID"]); ?>
				<?php if ($bottomSecond->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub2ndCatID"]);?>"><?php echo get_cat_name($theme_options["sub2ndCatID"]); ?></a></h2>
				<?php while ($bottomSecond->have_posts()) : $bottomSecond->the_post(); ?>					
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','10'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 1st row / 2nd column out of 4 -->
		
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_3x8_R') ) : ?>
				<?php $bottomThird = new WP_Query();$bottomThird->query('showposts='.$theme_options["postCountBot3"].'&cat='.$theme_options["sub3rdCatID"]); ?>
				<?php if ($bottomThird->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub3rdCatID"]);?>"><?php echo get_cat_name($theme_options["sub3rdCatID"]); ?></a></h2>
				<?php while ($bottomThird->have_posts()) : $bottomThird->the_post(); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','11'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 1st row / 3rd column out of 4 -->
		
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_4x8_R') ) : ?>
				<?php $bottomFourth = new WP_Query();$bottomFourth->query('showposts='.$theme_options["postCountBot4"].'&cat='.$theme_options["sub4thCatID"]); ?>
				<?php if ($bottomFourth->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub4thCatID"]);?>"><?php echo get_cat_name($theme_options["sub4thCatID"]); ?></a></h2>
				<?php while ($bottomFourth->have_posts()) : $bottomFourth->the_post(); ?>				
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','12'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 1st row / 4th column out of 4 -->
		
		<div class="border"></div>

		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_5x8_R') ) : ?>
				<?php $bottomFirst2 = new WP_Query();$bottomFirst2->query('showposts='.$theme_options["postCountBot5"].'&cat='.$theme_options["sub5thCatID"]); ?>
				<?php if ($bottomFirst2->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub5thCatID"]);?>"><?php echo get_cat_name($theme_options["sub5thCatID"]); ?></a></h2>
				<?php while ($bottomFirst2->have_posts()) : $bottomFirst2->the_post(); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','13'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 2nd row / 1st column out of 4 -->
		
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_6x8_R') ) : ?>
				<?php $bottomSecond2 = new WP_Query();$bottomSecond2->query('showposts='.$theme_options["postCountBot6"].'&cat='.$theme_options["sub6thCatID"]); ?>
				<?php if ($bottomSecond2->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub6thCatID"]);?>"><?php echo get_cat_name($theme_options["sub6thCatID"]); ?></a></h2>
				<?php while ($bottomSecond2->have_posts()) : $bottomSecond2->the_post(); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','14'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 2nd row / 2ndcolumn out of 4 -->
		
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_7x8_R') ) : ?>
				<?php $bottomThird2 = new WP_Query();$bottomThird2->query('showposts='.$theme_options["postCountBot7"].'&cat='.$theme_options["sub7thCatID"]); ?>
				<?php if ($bottomThird2->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub7thCatID"]);?>"><?php echo get_cat_name($theme_options["sub7thCatID"]); ?></a></h2>
				<?php while ($bottomThird2->have_posts()) : $bottomThird2->the_post(); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','15'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 2nd row / 3rd column out of 4 -->
		
		<div class="subNewsContainer">
			<div class="subNewsInner">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('NpAdv_Widget_8x8_R') ) : ?>
				<?php $bottomFourth2 = new WP_Query();$bottomFourth2->query('showposts='.$theme_options["postCountBot8"].'&cat='.$theme_options["sub8thCatID"]); ?>
				<?php if ($bottomFourth2->have_posts()) : ?>
					<h2 class="titleCatName"><a href="<?php echo get_category_link($theme_options["sub8thCatID"]);?>"><?php echo get_cat_name($theme_options["sub8thCatID"]); ?></a></h2>
				<?php while ($bottomFourth2->have_posts()) : $bottomFourth2->the_post(); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php viva('NpAdvMainBottom','16'); ?>" alt="<?php the_title(); ?>" /></a>
					<h2 class="subnewsEntryTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<p><?php print string_limit_words(get_the_excerpt(), 33); ?>...</p>
					<span class="subNewsContainerMeta"><?php the_time('M j, Y') ?> / <a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $newspaper["rMore"]; ?> &raquo;</a></span>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</div><!-- End of 2nd row / 4th column out of 4 -->
	</div><!-- enf od subnews -->
	
	<div id="mainPageSidebar">
		<?php get_sidebar(); ?>
	</div><div class="clear"></div><!-- enf od mainpagesidebar -->
	
	<?php get_footer(); ?>

</div><!-- enf od wrapper -->

</body>
</html>