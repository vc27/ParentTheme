<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header-head' );

?>
<!-- Start Body -->
<body <?php body_class(); echo apply_filters( 'tag_body_attr', '' ); ?>>
	<?php do_action('after_body_tag'); ?>
	<div id="page">
			
		<!-- Start Header -->
		<div id="header" class="outer-wrap">
			<header class="inner-wrap">
				<?php 
				
				wp_nav_menu( array( 
					'fallback_cb' => '', 
					'theme_location' => 'primary-navigation', 
					'container' => 'div', 
					'container_id' => 'primary-navigation', 
					'menu_class' => 'sf-menu' 
				) );
				
				?>
				<div class="clear"></div>
			</header>
		</div>
		
		<!-- Start Main Content -->
		<div id="content" class="outer-wrap">
			<div class="inner-wrap">