<?php
/**
 * File Name 404.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.3
 * @updated 01.20.14
 **/
#################################################################################################### */

get_template_part( 'header' );
?>
<div class="row-fluid">
	<div class="span8">
		<div id="loop-default" class="loop">
			<div class="hentry p1">
				<?php

				if ( get__option( '_404', '_404title' ) ) {
					$title = get__option( '_404', '_404title' );
				} else {
					$title = __( '404 Not Founds', 'parenttheme' );
				}

				echo "<h1 class=\"title _404_title\">$title</h1>";

				echo "<div class=\"entry 404_entry\">" . wpautop( get__option( '_404', '_404explain' ) ) . "</div>";

				?>
			</div>
			<div class="clear"></div>
		</div>

		<div id="content-sitemap" class="loop layout-sitemap">
			<?php 

			// Display Search Form
			if ( get__option( '_404', 'search_form' ) ) {
				vc_search();
			}


			// Display List of Pages
			if ( get__option( '_404', 'list_pages_on_404' ) ) { 

				?>

				<div class="display-list display-list-pages">
					<h3>Pages</h3>
					<ul>
						<?php wp_list_pages( array( 'depth' => 0, 'sort_column' => 'menu_order', 'title_li' => '' ) ); ?>		
					</ul>
				</div>

				<?php

			} // end if ( list_pages_on_404 )


			// Display list of Categories
			if ( get__option( '_404', 'list_cats_on_404' ) ) {

				?>

				<div class="display-list display-list-categories">
					<h3><?php echo __( 'Categories', 'parenttheme' ); ?></h3>
					<ul>
						<?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => 0, 'show_count' => 1 ) ) ?>
					</ul>
				</div>

				<?php

			} // end if ( list_cats_on_404 )


			// Display list of Posts by category
			if ( get__option( '_404', 'list_post_by_cat_on_404' ) ) {

				echo "<div class=\"display-list display-list-post_per_cat\">";

					echo "<h3>" . __( 'Recent Posts', 'parenttheme' ) . "</h3>";

					echo "<ul id=\"404-category-list_posts\" class=\"category-list_posts\">";

						$terms = get_terms( 'category' );

						foreach ( $terms as $term ) {

							$query = array(
								'cat' => $term->term_id,
								'post_type' => 'post',
								'posts_per_page' => 5,
								);

							// New wp_query
							$wp_query = new WP_Query();
							$wp_query->query( $query );

							if ( have_posts() ) {

								echo "<li class=\"list_posts-$term->slug\">";

									echo "<h4><a href=\"" . get_term_link( $term->slug, 'category' ) . "\">$term->name</a></h4>";

									echo "<ul class=\"category-list_posts\">";

										while ( have_posts() ) { 
											the_post(); 

											vc_title( $post, array(
												'permalink' => true,
												'element' => 'li'
											) );

										} // end while

									echo "</ul>";

								echo "</li>";

							} // end if ( $wp_query->have_posts() )

							wp_reset_postdata();

						} // End if loop

						wp_reset_query();

					echo "</ul>";

				echo "</div>";

			} // end if ( list_post_by_cat_on_404 )

			?>
			<div class="clear"></div>
		</div><!-- end #content-sitemap -->
	</div>
	<div class="span4">
		<?php vc_sidebars( 'Primary Sidebar' ); ?>
	</div>
</div>
<?php
get_template_part( 'footer' );