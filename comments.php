<?php


$disable_comments_chk = ( "on" === pegasus_get_option( 'disable_comment_chk' ) ) ? true : false;

if ( false === $disable_comments_chk ) {
	/**
	 * @package WordPress
	 * @subpackage Default_Theme
	 */
	// Do not delete these lines
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die( 'Please do not load this page directly. Thanks!' );
	}
	if ( post_password_required() ) {
		?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
		<?php
		return;
	}
	?>
	<!-- You can start editing here. -->
	<?php if ( have_comments() ) : ?>
		<h3 id="comments"><?php comments_number( 'No Responses', 'One Response', '% Responses' ); ?> to &#8220;<?php the_title(); ?>&#8221;</h3>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		<ol class="commentlist">
			<?php
			wp_list_comments(
				array(
					'style'             => 'ol',
					'max_depth'         => 8,
					'avatar_size'       => 32,
					'format'            => 'html5',
					'short_ping'        => true,
					'reverse_top_level' => null,
					'reverse_children'  => '',
				)
			);
			?>
		</ol>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	<?php else : // this is displayed if there are no comments so far ?>
		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->
		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments">Comments are closed.</p>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( comments_open() ) : ?>
		<div id="respond">
			<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
			<div class="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
			</div>
			<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
				<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
			<?php else : ?>
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>/wp-comments-post.php" method="post" id="commentform">
					<?php
						$commenter = wp_get_current_commenter();
						$user = wp_get_current_user();
						$user_identity = $user->exists() ? $user->display_name : '';
					?>
					<?php if ( is_user_logged_in() ) : ?>
						<p>Logged in as <a href="<?php echo esc_url( home_url( '/' ) ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
							<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Log out of this account">Log out &raquo;</a></p>
					<?php else : ?>
						<?php
							if ( $req ) {
								$req_final = "aria-required='true'";
							} else {
								$req_final = '';
							}
						?>

						<p>
							<input type="text" name="author" id="author" value="<?php echo esc_attr( $commenter['comment_author'] ); ?>" size="22" tabindex="1" <?php echo $req_final; ?> />
							<label for="author">
								<small>Name <?php echo $req_final; ?></small>
							</label>
						</p>
						<p>
							<input type="text" name="email" id="email" value="<?php echo esc_attr( $commenter['comment_author_email'] ); ?>" size="22" tabindex="2" <?php echo $req_final; ?> />
							<label for="email">
								<small>Mail (will not be published) <?php echo $req_final; ?></small>
							</label>
						</p>
						<p>
							<input type="text" name="url" id="url" value="<?php echo esc_attr( $commenter['comment_author_url'] ); ?>" size="22" tabindex="3"/>
							<label for="url">
								<small>Website</small>
							</label>
						</p>

					<?php endif; ?>
					<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php //echo allowed_tags(); ?></code></small></p>-->
					<p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>
					<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment"/>
						<?php comment_id_fields(); ?>
					</p>
					<?php do_action( 'comment_form', $post->ID ); ?>
				</form>

				<?php //comment_form(); ?>
			<?php endif; // If registration required and not logged in ?>
		</div>
	<?php endif; // if you delete this the sky will fall on your head ?>

<?php } //end if statement for pegasus global comments off option
