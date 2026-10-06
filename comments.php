<?php if ( post_password_required() ) { return; } ?>
<section id="comments" aria-labelledby="comments-title" class="mt-4">
	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title" class="h4"><?php esc_html_e( 'Yorumlar', 'erisilebilir' ); ?></h2>
		<ol class="comment-list"><?php wp_list_comments( array( 'style' => 'ol' ) ); ?></ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</section>
