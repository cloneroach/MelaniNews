			<?php global $theme_options, $newspaper; ?>
			<form id="searchform" action="<?php bloginfo('url'); ?>">
				<input type="text" id="s" name="s" value="<?php echo $newspaper["search"]; ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
				<input type="submit" id="searchSubmit" value="" />
			</form>