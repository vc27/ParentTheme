<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */
global $s;

?>
<div id="section-loop-default" class="loop loop-page">
	<div class="hentry">
		<?php
		
		if ( get__option( '_search_no_results_title' ) ) {
			$search = sprintf( __( get__option( '_search_no_results_title' ) . ' %1$s', 'parenttheme' ), $s );
		} else {
			$search = sprintf( __( 'Search: %1$s', 'parenttheme' ), $s );
		}

		echo "<h1 class=\"h1\">$search</h1>";
		echo "<div class=\"entry\">" . get__option( '_search_no_results_content' ) . "</div>";
		
		?>
	</div>
</div>

<div id="section-sitemap" class="loop layout-sitemap">
	<?php

	// Display Search Form
	if ( get__option( '_search_no_results_show_search_form' ) ) {
		echo get_search_form();
	}
	
	?>
</div>