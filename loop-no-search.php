<?php
/**
 * File Name loop-no-search.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.1
 * @updated 01.20.14
 **/
#################################################################################################### */
global $s;

?>
<div id="loop-default" class="loop loop-page">
	<div class="hentry p1">
		<?php
		
		if ( get__option( 'search', 'noresults_title' ) ) {
			$search = get__option( 'search', 'noresults_title' );
		} else {
			$search = sprintf( __( 'Search: %1$s', 'parenttheme' ), $s );
		}

		echo "<h1 class=\"h1\">$search</h1>";
		
		echo "<div class=\"entry\">" . wpautop( get__option( 'search', 'noresults_explain' ) ) . "</div>";
		
		?>
	</div>
	<div class="clear"></div>
</div>

<div id="content-sitemap" class="loop layout-sitemap">
	<?php

	// Display Search Form
	if ( get__option( 'search', 'search_form' ) ) {
		vc_search();
	}


	// Display List of Pages
	if ( get__option( 'search', 'list_pages_on_search' ) ) {
	
		?>

		<div class="display-list display-list-pages">
			<div class="h3"><?php echo __( 'Pages', 'parenttheme' ); ?></div>
			<ul>
				<?php 
				wp_list_pages( array( 
					'depth' => 0, 
					'sort_column' => 'menu_order', 
					'title_li' => '' 
				) );
				?>
			</ul>
		</div>

		<?php
	
	} // end if ( list_pages_on_search )
	
	
	// Display list of Categories
	if ( get__option( 'search', 'list_cats_on_search' ) ) {
	
		?>

		<div class="display-list display-list-categories">
			<div class="h3"><?php echo __( 'Categories', 'parenttheme' ); ?></div>
			<ul>
				<?php 
				wp_list_categories( array( 
					'title_li' => '', 
					'hierarchical' => 0, 
					'show_count' => 1 
				) );
				?>
			</ul>
		</div>

		<?php
	
	} // end if ( list_cats_on_search )


	// Display list of Posts by category
	if ( get__option( 'search', 'list_post_by_cat_on_search' ) ) {
		
		echo "<div class=\"display-list display-list-post_per_cat\">";
		
			echo "<div class=\"h3\">" . __( 'Recent Posts', 'parenttheme' ) . "</div>";

			echo "<ul id=\"search-category-list_posts\" class=\"category-list_posts\">";

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

							echo "<div class=\"h4\"><a href=\"" . get_term_link( $term->slug, 'category' ) . "\">$term->name</a></div>";

							echo "<ul class=\"category-list_posts\">";

								while ( have_posts() ) { 
									the_post(); 
									
									vc_title( $post, array(
										'permalink' => true,
										'element' => 'li'
									) );
								
								} // end while ( $term_query->have_posts() )
								
								wp_reset_postdata();

							echo "</ul>";

						echo "</li>";

					} // end if ( $term_query->have_posts() )
					
					wp_reset_query();

				} // end foreach ( $terms as $term )

			echo "</ul>";
		
		echo "</div>";

	} // check to show item
	
	?>
	<div class="clear"></div>
</div>