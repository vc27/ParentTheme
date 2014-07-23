<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header' );
?>
<div class="row-fluid">
	<div class="span8">
		<?php get_template_part( 'loop-single-default' ); ?>
	</div>
	<div class="span4">
		<?php vc_sidebars( 'Primary Sidebar' ); ?>
	</div>
</div>
<?php
get_template_part( 'footer' );