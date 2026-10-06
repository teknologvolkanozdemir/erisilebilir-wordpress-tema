<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1><?php the_title(); ?></h1>
	<?php if ( 'post' === get_post_type() ) : ?>
		<p class="text-body-secondary"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
	<?php endif; ?>
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<nav aria-label="' . esc_attr__( 'Sayfa bölümleri', 'erisilebilir' ) . '">', 'after' => '</nav>' ) ); ?>
</article>
<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
