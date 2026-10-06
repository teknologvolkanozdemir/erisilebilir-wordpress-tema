<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
<aside class="col-lg-4" aria-label="<?php esc_attr_e( 'Kenar çubuğu', 'erisilebilir' ); ?>">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside>
<?php endif; ?>
