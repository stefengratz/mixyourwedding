<?php
//Required password to comment
if ( post_password_required() ) { ?>
	<p><?php _e( 'This post is password protected. Enter the password to view comments.', THEMEDOMAIN ); ?></p>
<?php
	return;
}

//Display Comments
if( have_comments() ) : ?> 
<hr/>					
<h4><?php comments_number('No comment', 'Comment', '% Comments'); ?></h4>

<?php wp_list_comments( array('callback' => 'pp_comment', 'avatar_size' => '40') ); ?>

<!-- End of thread -->  
<br class="clear"/><br/>

<?php endif; ?>  


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

<div class="pagination"><p><?php previous_comments_link(); ?> <?php next_comments_link(); ?></p></div><br class="clear"/><div class="line"></div><br/><br/>

<?php endif; // check for comment navigation ?>


<?php 
//Display Comment Form
if ('open' == $post->comment_status) : ?> 

<?php comment_form(); ?>
			
<?php endif; ?> 