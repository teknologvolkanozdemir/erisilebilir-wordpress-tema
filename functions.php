<?php
/**
 * Erişilebilir Tema functions.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/class-bootstrap-walker.php';
require_once get_template_directory() . '/inc/customizer.php';

function erisilebilir_setup() {
	load_theme_textdomain( 'erisilebilir', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array(
		'header' => __( 'Üst Menü (Header)', 'erisilebilir' ),
		'footer' => __( 'Alt Menü (Footer)', 'erisilebilir' ),
	) );
}
add_action( 'after_setup_theme', 'erisilebilir_setup' );

function erisilebilir_widgets_init() {
	$areas = array(
		'header-widgets'  => __( 'Header Alanı', 'erisilebilir' ),
		'sidebar'         => __( 'Kenar Çubuğu', 'erisilebilir' ),
		'footer-widgets'  => __( 'Footer Alanı', 'erisilebilir' ),
	);
	foreach ( $areas as $id => $name ) {
		register_sidebar( array(
			'id'            => $id,
			'name'          => $name,
			'description'   => __( 'Sınırsız sayıda "Gezinti Menüsü" ve diğer klasik widgetları ekleyin.', 'erisilebilir' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s mb-3">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title h5">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'erisilebilir_widgets_init' );

function erisilebilir_scripts() {
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
	wp_enqueue_style( 'erisilebilir', get_stylesheet_uri(), array( 'bootstrap' ), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
	wp_add_inline_style( 'erisilebilir', erisilebilir_color_css() );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'erisilebilir_scripts' );

/**
 * Tüm menüler (konum ve Gezinti Menüsü widget'ı) Bootstrap 5 yürüticisini kullanır.
 */
function erisilebilir_nav_menu_args( $args ) {
	$args['walker']     = new Erisilebilir_Bootstrap_Walker();
	$args['container']  = false;
	$args['menu_class'] = 'navbar-nav flex-column flex-lg-row';
	$args['fallback_cb'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'erisilebilir_nav_menu_args' );

/**
 * Gezinti Menüsü widget'ını Bootstrap açılır (hamburger) menüye sarar.
 */
function erisilebilir_widget_nav_menu_args( $nav_menu_args, $nav_menu, $args, $instance ) {
	static $n = 0;
	$n++;
	$id    = 'widget-menu-' . $n;
	$label = ! empty( $instance['title'] ) ? $instance['title'] : $nav_menu->name;
	$nav_menu_args['container']       = 'nav';
	$nav_menu_args['container_class'] = 'navbar navbar-expand-lg p-0 align-items-start';
	$nav_menu_args['container_aria_label'] = $label;
	$nav_menu_args['items_wrap']      = '<button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#' . esc_attr( $id ) . '" aria-controls="' . esc_attr( $id ) . '" aria-expanded="false" aria-label="' . esc_attr( sprintf( __( '%s menüsünü aç/kapat', 'erisilebilir' ), $label ) ) . '"><span class="navbar-toggler-icon"></span></button><div class="collapse navbar-collapse" id="' . esc_attr( $id ) . '"><ul id="%1$s" class="%2$s">%3$s</ul></div>';
	return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args', 'erisilebilir_widget_nav_menu_args', 10, 4 );


/**
 * Bir menü konumunu hamburger menü olarak yazdırır.
 */
function erisilebilir_render_menu( $location, $label ) {
	if ( ! has_nav_menu( $location ) ) {
		return;
	}
	$id = 'menu-' . $location;
	?>
	<nav class="navbar navbar-expand-lg" aria-label="<?php echo esc_attr( $label ); ?>">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $id ); ?>" aria-controls="<?php echo esc_attr( $id ); ?>" aria-expanded="false" aria-label="<?php echo esc_attr( sprintf( __( '%s menüsünü aç/kapat', 'erisilebilir' ), $label ) ); ?>">
			<span class="navbar-toggler-icon" aria-hidden="true"></span>
		</button>
		<div class="collapse navbar-collapse" id="<?php echo esc_attr( $id ); ?>">
			<?php wp_nav_menu( array( 'theme_location' => $location ) ); ?>
		</div>
	</nav>
	<?php
}
