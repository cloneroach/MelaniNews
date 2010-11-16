<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	global $newspaper;
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p id="commentNotification"><?php echo $newspaper["passProtect"]; ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number(''.$newspaper['responseNo'].'', ''.$newspaper['response1'].'', ''.$newspaper['responses'].'' );?> <?php echo $newspaper['for']; ?> <span class="respondEntryTitle">&#8220;<?php the_title(); ?>&#8221;</span></h3>

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>
	<div class="navigation">
		<div class="previous"><?php previous_comments_link() ?></div>
		<div class="next"><?php next_comments_link() ?></div>
		<div class="clear"></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

 <?php endif; ?>
	
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p id="commentNotification"><?php echo $newspaper["comClosed"]; ?></p>
	
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p id="commentNotification"><cite><?php echo $newspaper["loggedIn"]; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo $newspaper["logIn"]; ?></a></cite></p>
<?php else : ?>

<h3 id="leaveComment"><?php comment_form_title( ''.$newspaper["leaveReply"].'', 'Leave a Reply to %s' ); ?></h3>
<div id="respond">

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>
<p><cite><?php echo $newspaper["loggedAs"]; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout"><?php echo $newspaper["logOut"]; ?> &raquo;</a></cite></p>
<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php echo $newspaper["name"]; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php echo $newspaper["mail"]; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php echo $newspaper["website"]; ?></small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>
</form>
</div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
