<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="comment-none">Detta inlägg är lösenordsskyddat. Skriv in lösenordet för visa kommentarerna.</p>

			<?php
			return;
		}
	}
?>

<!-- You can start editing here. -->

<?php if ('open' == $post->comment_status) : ?>

<a name="comments"></a>
<h5 class="comment-respond">Lämna en kommentar</h5>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Du måste vara <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">inloggad</a> för kunna lämna kommentar.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php echo $user_identity; ?>" class="comment-logged">Logga ut</a></p>

<?php else : ?>
  <p><span class="comment-label">Namn</span><br><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /></p>
  <p><span class="comment-label">E-post</span><br><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /></p>
<?php endif; ?>

<p><span class="comment-label">Kommentar</span><br><textarea name="comment" id="comment" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Skicka" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // If you delete this the sky will fall on your head ?>

<?php if ($comments) : ?>

	<ol class="comment-list">

	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<div class="comment-meta"><?php echo get_avatar( $comment, 64 ); ?> <span class="author"><?php comment_author() ?></span> <span class="date"><?php comment_date('j F Y'); ?></span> <div class="u-cf"></div> </div>

			<?php comment_text() ?>
      
      <?php if ($comment->comment_approved == '0') : ?>
        <p class="comment-wait">Väntar på godkännande!</p>
			<?php endif; ?>
		</li>

	<?php endforeach; /* End for each comment */ ?>

	</ol>


 <?php else : // This is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // Comments are closed ?>
		<!-- If comments are closed. -->
		<p class="comment-close">Kommentarsfältet är stängt!</p>

	<?php endif; ?>
<?php endif; ?>