<?php
/**
 * Customizer callbacks
 *
 * @package Cosme
 */

/**
 * Archive Grid
 */
function cosme_archives_callback_grid() {
	$archive= get_theme_mod( 'cosme_archive_layout', 'simple' );

	if ( 'simple' !== $archive ) {
		return true;
	} else {
		return false;
	}
}
