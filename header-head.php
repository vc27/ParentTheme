<?php
/**
 * File Name header-head.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.5
 * @updated 07.16.13
 **/
#################################################################################################### */

?><!doctype html>
<html <?php language_attributes(); echo apply_filters( 'tag_html_attr', '' ); ?>>
<head <?php echo apply_filters( 'tag_head_attr', '' ); ?>>

	<title><?php wp_title(); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<meta name="viewport" content="<?php echo apply_filters( 'meta-viewport-content', 'width=device-width, initial-scale=1.0' ); ?>">
	
	<?php 

		echo "\n<!-- " . __( 'Start', 'parenttheme' ) . " wp_head -->\n";
		wp_head();
		echo "\n<!-- " . __( 'End', 'parenttheme' ) . " wp_head -->\n";

	?>
</head>
