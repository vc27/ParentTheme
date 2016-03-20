<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
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
