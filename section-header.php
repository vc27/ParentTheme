<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
#################################################################################################### */

?>
<div id="section-header" class="row">
	<?php
	wp_nav_menu( array(
		'fallback_cb' => '',
		'theme_location' => 'primary-menu',
		'container' => 'ul',
	) );
	?>
</div>
