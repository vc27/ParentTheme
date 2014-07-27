<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */
global $s;

get_template_part( 'header' );
?>
<div class="row-fluid">
	<div class="span8">
		<?php
		if ( ! have_posts() ) {

			get_template_part( 'loop-no-search' ); 

		} else {

			echo "<div class=\"page-title-wrapper\">";
				echo '<h1 class="h1">' . get__option( 'search', 'results_title' ) . '</h1>';
			echo '</div>';

			get_template_part( 'loop-default' );

		}
		?>
	</div>
	<div class="span4">
		<?php get__widget_area( 'Primary Sidebar' ); ?>
	</div>
</div>
<?php
get_template_part( 'footer' );