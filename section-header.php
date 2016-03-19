<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
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
