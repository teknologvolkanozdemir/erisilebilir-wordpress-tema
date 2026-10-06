<?php
/**
 * Bootstrap 5 açılır alt menü destekli, sınırsız derinlikte menü yürütücüsü.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Erisilebilir_Bootstrap_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="dropdown-menu">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );
		$active       = in_array( 'current-menu-item', (array) $item->classes, true ) || in_array( 'current-menu-ancestor', (array) $item->classes, true );

		$li_class = $has_children ? 'nav-item dropdown' : 'nav-item';
		if ( $depth > 0 ) {
			$li_class = $has_children ? 'dropend' : '';
		}
		$output .= '<li' . ( $li_class ? ' class="' . esc_attr( $li_class ) . '"' : '' ) . '>';

		$class = $depth > 0 ? 'dropdown-item' : 'nav-link';
		if ( $has_children ) {
			$class .= ' dropdown-toggle';
		}
		if ( $active ) {
			$class .= ' active';
		}

		$attr = array(
			'class' => $class,
			'href'  => ! empty( $item->url ) ? $item->url : '#',
		);
		if ( ! empty( $item->target ) ) {
			$attr['target'] = $item->target;
			if ( '_blank' === $item->target ) {
				$attr['rel'] = 'noopener noreferrer';
			}
		}
		if ( $active && ! $has_children && ( in_array( 'current-menu-item', (array) $item->classes, true ) ) ) {
			$attr['aria-current'] = 'page';
		}
		if ( $has_children ) {
			$attr['role']          = 'button';
			$attr['data-bs-toggle'] = 'dropdown';
			$attr['aria-expanded'] = 'false';
			$attr['aria-haspopup'] = 'true';
		}

		$attributes = '';
		foreach ( $attr as $k => $v ) {
			$attributes .= ' ' . $k . '="' . esc_attr( $v ) . '"';
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$output .= '<a' . $attributes . '>' . $title;
		if ( '_blank' === $item->target ) {
			$output .= '<span class="screen-reader-text"> ' . esc_html__( '(yeni sekmede açılır)', 'erisilebilir' ) . '</span>';
		}
		$output .= '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}
