<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
#################################################################################################### */

get_template_part( 'header-head' );

?>
<!-- Start Body -->
<body <?php body_class(); echo apply_filters( 'tag_body_attr', '' ); ?>>
	<?php do_action('after_body_tag'); ?>
	<?php get_template_part('section-header'); ?>
