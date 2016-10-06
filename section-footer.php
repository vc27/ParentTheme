<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
#################################################################################################### */

?>
<div id="section-footer" class="row">
	<?php
	wp_nav_menu( array(
		'depth' => 1,
		'fallback_cb' => '',
		'theme_location' => 'footer-menu',
		'container' => 'ul', 
	) );
	?>
</div>
