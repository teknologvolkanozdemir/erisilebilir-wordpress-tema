<form role="search" method="get" class="d-flex gap-2 my-3" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field" class="screen-reader-text"><?php esc_html_e( 'Ara', 'erisilebilir' ); ?></label>
	<input type="search" id="search-field" class="form-control" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Ara…', 'erisilebilir' ); ?>">
	<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Ara', 'erisilebilir' ); ?></button>
</form>
