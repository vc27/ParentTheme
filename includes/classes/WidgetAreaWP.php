<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * WidgetAreaWP
 **/
class WidgetAreaWP {






	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {

	} // end function __construct






	/**
	 * get_widget_area
	 **/
	static function get_widget_area( $name, $args = array() ) {

		$defaults = array(
			'class' => '',
			'element' => 'div',
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$name = apply_filters( 'WidgetAreaWP-name', $name );

		if ( ! is_active_sidebar( $name ) ) {
			return false;
		}

		echo "<$element id=\"" . sanitize_title_with_dashes( $name ) . "\" class=\"sidebar $class\">";
			dynamic_sidebar( $name );
		echo "</$element>";


	} // end function get_widget_area



} // end class WidgetAreaWP
