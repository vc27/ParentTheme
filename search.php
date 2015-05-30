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
<div id="section-main" class="outer-wrap">
	<div class="inner-wrap">
		<?php do_action('section-main-top'); ?>
		<div class="row-fluid">
			<div class="span8">
				<div id="section-content-archive" class="layout-archive">
				<?php if ( have_posts() ) { ?>
					<h1 class="h1"><?php echo get__option( '_search_title' ) . " " . $s; ?></h1>
					<?php while ( have_posts() ) { the_post(); ?>
					<div <?php post_class(); ?>>
						<div class="post-wrap">
							<?php the__title( $post, array(
								'element' => 'h3'
								,'class' => 'h3'
								,'permalink' => true
							) ); ?>
							<div class="meta-data">
								<?php the__date( $post ); ?>
								<?php the__comments( $post ); ?>
								<?php the__category( $post ); ?>
							</div>
							<?php the__excerpt( $post, array(
								'count' => 55
								,'read_more' => 'Read More'
								,'strip_tags' => '<p>'
							) ); ?>
						</div>
					</div>
					<?php } ?>
				<?php } else { ?>
					<?php
					if ( get__option( '_search_no_results_title' ) ) {
						$search = sprintf( __( get__option( '_search_no_results_title' ) . ' %1$s', 'parenttheme' ), $s );
					} else {
						$search = sprintf( __( 'Search: %1$s', 'parenttheme' ), $s );
					}
					?>
					<h1 class="h1"><?php echo $search; ?></h1>
					<div class="entry"><?php echo get__option( '_search_no_results_content' ); ?></div>
				<?php } ?>
				</div>
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
