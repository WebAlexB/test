<?php
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'hanata' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'hanata'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php esc_html__( 'Comment navigation', 'hanata' ); ?></h3>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'hanata' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'hanata' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<div class="comment-list">
		<?php
			wp_list_comments( array(
				
				'short_ping' => true,
				'callback' => 'hanata_walker_comment',
				
			) );
		?>
	</div><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'hanata' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'hanata' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'hanata' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'hanata' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
		echo '<div class="comment-form">';	
			$args = array(
			'fields' => apply_filters(
				'comment_form_default_fields', array(
					'author' =>'<div class="form-group col-md-4 col-sm-4">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'hanata'  ) . '" name="author"  type="text" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" class="form-control" />'.
						( $req ? '<span class="required">*</span>' : '' )  .
						'</div>'
						,
					'email'  => '<div class="form-group col-md-4 col-sm-4">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'hanata'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30" class="form-control"   />'  .
						( $req ? '<span class="required">*</span>' : '' ) 
						 .
						'</div>',
					'url'    => '<div class="form-group col-md-4 col-sm-4">' .
					 '<input id="url" name="url" placeholder="' . esc_html__( 'Website', 'hanata' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" class="form-control"   /> ' .
					   '</div>',
					   
				)
			),
			 'comment_field' =>  '<div class="form-group col-md-12 col-sm-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'hanata' ) . '" class="form-control"  >' .
			'</textarea></div>',
			
			'comment_notes_after' => '',
			'class_form'      => 'row ',
			'title_reply_before'	=> ' <div class="section-header comment_reply_header"><h3>',
			'title_reply_after'	=>	'</h3></div>',
			 'logged_in_as' => '<div class="logged-in-as col-md-12 col-sm-12">' .
			sprintf(
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="'.esc_attr__('Log out of this account','hanata').'">'.esc_html__('Log out?','hanata').'</a>','hanata' ),
			  admin_url( 'profile.php' ),
			  $user_identity,
			  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			) . '</div>',
			'must_log_in' => '<div class="must-log-in col-md-12 col-sm-12">' .
			sprintf(
			  __( 'You must be <a href="%s">logged in</a> to post a comment.','hanata' ),
			  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			) . '</div>',
			'comment_notes_before' => '<div class="comment-notes col-md-12 col-sm-12">' .
			__( 'Your email address will not be published.','hanata' ) .
			'</div>',
			 'class_submit'      => 'btn',
			'submit_button' => '<div class="form-group col-md-12 text-center">
					<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />
				</div>'
			
			);
		comment_form($args);
		echo '</div>';
	?>

</div><!-- #comments -->