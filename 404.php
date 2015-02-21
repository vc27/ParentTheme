<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header' );

if ( get__option( '_404_page_title' ) ) {
	$title = get__option( '_404_page_title' );
} else {
	$title = __( '404 Not Founds', 'parenttheme' );
}

?>
<div id="section-main" class="outer-wrap">
	<div class="inner-wrap">
		<?php do_action('section-main-top'); ?>
		<div class="row-fluid">
			<div class="span8">
				<?php do_action( 'before-loop' );  ?>
				<div id="section-content-page" class="inside-wrapper">
					<div class="hentry">
						<h1 class="h1"><?php echo $title; ?></h1>
						<div class="entry"><?php echo get__option( '_404_content' ); ?></div>
					</div>
				</div>
				<?php do_action( 'after-loop' ); ?>
			</div>
			<div class="span4">
				<?php get__widget_area( 'Primary Sidebar' ); ?>
			</div>
		</div>
		<?php do_action('section-main-bottom'); ?>
	</div>
</div>
<?php
get_template_part( 'footer' );