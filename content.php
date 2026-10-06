<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-4' ); ?>>
	<h2 class="h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php if ( 'post' === get_post_type() ) : ?>
		<p class="text-body-secondary"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
	<?php endif; ?>
	<?php the_excerpt(); ?>
</article>
