<?php global $theme_options, $newspaper; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>
		<?php if(is_home() ) { bloginfo('name'); ?> | <?php bloginfo('description'); } ?>
		<?php if(is_single() || is_page() || is_archive() || is_tag() || is_category() ) { wp_title('',true); ?> | <?php bloginfo('name'); } ?>
		<?php if(is_404()) { ?> <?php echo $newspaper["404"]; ?> | <?php bloginfo('name'); } ?>
		<?php if(is_search()) { ?><?php echo $newspaper["seresults"]; ?> <?php echo wp_specialchars($s, 1); ?> | <?php bloginfo('name'); } ?>
	</title>
	
	<style type="text/css" media="screen">@import url( <?php bloginfo('stylesheet_url'); ?> );</style>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $theme_options["style"]; ?>.css" type="text/css" media="screen" />
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/prototype.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/control.tabs.2.1.1.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/dropdown.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/contentslider.js"></script>	
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />	
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />	
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
	<?php wp_get_archives('type=monthly&format=link'); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>	
	<?php wp_head(); ?>
</head>

<body>

<?php if($theme_options['enable728'] == 1)  { ?><div id="headerAd"><?php echo $theme_options["ad728x90"]; ?></div> <?php } ?>

<div id="wrapper">
	<div id="header1">
		<div id="subscribe"><a href="<?php bloginfo('rss_url'); ?>" rel="nofollow" title="<?php echo $newspaper["titleFeed"]; ?>"><?php echo $newspaper["rssFeed"]; ?></a> | <a href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow" title="<?php echo $newspaper["titleCFed"]; ?>"><?php echo $newspaper["rssCom"]; ?></a><?php if($theme_options['enableMailSubscribe'] == 1) { ?> | <a href="<?php echo $theme_options["emailSubscribeLink"]; ?>" rel="nofollow" title="<?php echo $newspaper["titleMFed"]; ?>"><?php echo $newspaper["rssEmail"]; ?></a><?php } ?> / </div>
		<div id="date"><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/date.js"></script></div>
		<div id="search"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
		<div class="clear"></div>
	</div><!-- enf od topBar -->
	
	<div id="header2">
		<?php 
			if($theme_options['switchheader'] == 1) { include (TEMPLATEPATH . '/headerWithQ.php'); } 
			if($theme_options['switchheader'] == 0) { include (TEMPLATEPATH . '/headerWithAd.php'); } 
		?>
	</div><!-- enf od header -->

	<div id="navbar">
		<ul id="navcatlist">
			<li<?php if(is_home() ) { ?> class="current-cat"<?php } ?>><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><?php echo $newspaper["home"]; ?></a></li>
			<?php wp_list_categories('orderby='.$theme_options["orderBy"].'&order='.$theme_options["order"].'&title_li=&depth=2&exclude='.$theme_options["excludeCategories"]); ?>
		</ul><div class="clear"></div>	
	</div>
<div class="clear"></div>	