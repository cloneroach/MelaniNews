		<?php global $theme_options; ?>
		<div id="leftQuote">
			<?php if($theme_options['enableLeftQuote'] == 1) { ?>
			<p class="leftQuoteWording">
				<?php if($theme_options['enableLinkLeftQ'] == 1) { ?><a href="<?php echo $theme_options["leftQuoteLink"]; ?>"><?php } ?>
				<span class="red"><?php echo $theme_options["titleFirstName"]; ?></span>
				“<?php echo $theme_options["titleFirstQuote"]; ?>”
				<?php if($theme_options['enableLinkLeftQ'] == 1) { ?></a><?php } ?>
			</p>
			<img src="<?php bloginfo('template_url'); ?>/images/<?php echo $theme_options["quoteFirstImageName"]; ?>" alt="" />
			<?php } ?>
		</div>
		<div id="sitename"><a href="<?php bloginfo('url'); ?>" class="name"><span id="name1stRow"><?php echo $theme_options["titleSiteNameFirstRow"]; ?></span><span id="name2ndRow"><?php echo $theme_options["titleSiteNameSecondRow"]; ?></span></a></div>
		<div id="rightQuote">
			<?php if($theme_options['enableRightQuote'] == 1) { ?>
			<img src="<?php bloginfo('template_url'); ?>/images/<?php echo $theme_options["quoteSecondImageName"]; ?>" alt="" />
			<p class="rightQuoteWording">
				<?php if($theme_options['enableLinkRightQ'] == 1) { ?><a href="<?php echo $theme_options["rightQuoteLink"]; ?>"><?php } ?>
				<span class="red"><?php echo $theme_options["titleSecondName"]; ?></span>
				“<?php echo $theme_options["titleSecondQuote"]; ?>”
				<?php if($theme_options['enableLinkRightQ'] == 1) { ?></a><?php } ?>
			</p>
			<?php } ?>
		</div>
		<div class="clear"></div>