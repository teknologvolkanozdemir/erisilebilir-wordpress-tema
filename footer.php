</main>
<?php get_sidebar(); ?>
</div>
</div>
<footer class="site-footer py-4 mt-4" role="contentinfo">
	<div class="container">
		<?php erisilebilir_render_menu( 'footer', __( 'Alt menü', 'erisilebilir' ) ); ?>
		<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
			<div class="footer-widgets"><?php dynamic_sidebar( 'footer-widgets' ); ?></div>
		<?php endif; ?>
		<p class="mb-0">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
