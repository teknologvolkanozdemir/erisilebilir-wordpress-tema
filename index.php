<?php get_header(); ?>
<?php if ( is_archive() || is_search() ) : ?>
	<h1 class="h2">
		<?php
		if ( is_search() ) {
			printf( esc_html__( 'Arama sonuçları: %s', 'erisilebilir' ), esc_html( get_search_query() ) );
		} else {
			the_archive_title();
		}
		?>
	</h1>
<?php endif; ?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', is_singular() ? 'single' : '' ); ?>
	<?php endwhile; ?>
	<?php the_posts_pagination( array( 'aria_label' => __( 'Sayfalama', 'erisilebilir' ) ) ); ?>
<?php else : ?>
	<h1 class="h2"><?php esc_html_e( 'İçerik bulunamadı', 'erisilebilir' ); ?></h1>
	<?php get_search_form(); ?>
<?php endif; ?>
<?php get_footer(); ?>
