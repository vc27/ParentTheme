<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header' );
the_post();

?>
<div id="section-main" class="outer-wrap">
	<div class="inner-wrap">
		<?php do_action('section-main-top'); ?>
		<div class="row-fluid">
			<div class="span8">
				<?php do_action( 'before-loop' ); ?>
				<div id="section-content-single" class="inside-wrapper">
					<div class="hentry">
						<?php the__title( $post, array(
							'element' => 'h1'
							,'class' => 'h1'
						) ); ?>
						<div class="meta-data">
							<?php the__date( $post ); ?>
							<?php the__comments( $post ); ?>
						</div>
						<?php the__comments( $post ); ?>
					</div>
				</div>
				<?php if ( do__comments() ) { comments_template( '', true ); } ?>
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