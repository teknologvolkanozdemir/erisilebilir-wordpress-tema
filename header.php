<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'İçeriğe geç', 'erisilebilir' ); ?></a>
<header class="site-header py-2" role="banner">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-between">
			<p class="navbar-brand h4 mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php erisilebilir_render_menu( 'header', __( 'Ana menü', 'erisilebilir' ) ); ?>
		</div>
		<?php if ( is_active_sidebar( 'header-widgets' ) ) : ?>
			<div class="header-widgets"><?php dynamic_sidebar( 'header-widgets' ); ?></div>
		<?php endif; ?>
	</div>
</header>
<div class="container my-4">
<div class="row">
<main id="content" class="col-lg-8" tabindex="-1">
