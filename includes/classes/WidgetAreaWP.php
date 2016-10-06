<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
####################################################################################################





/**
 * WidgetAreaWP
 **/
class WidgetAreaWP {



	/**
	 * __construct
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
