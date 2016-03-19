<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */
global $s;

if ( get__option( '_search_no_results_title' ) ) {
	$search = sprintf( __( get__option( '_search_no_results_title' ) . ' %1$s', 'parenttheme' ), $s );
} else {
	$search = sprintf( __( 'Search: %1$s', 'parenttheme' ), $s );
}
?>
<h1 class="h1"><?php echo $search; ?></h1>
<div class="entry"><?php echo get__option( '_search_no_results_content' ); ?></div>
