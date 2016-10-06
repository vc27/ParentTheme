<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * 
 * @since 0.0.0
 **/
####################################################################################################





/**
 * ArchiveTitlesWP
 * @since 0.0.0
 **/
class ArchiveTitlesWP {



	/**
	 * description
	 *
	 * @access public
	 * @var string
	 * @since 0.0.0
	 * Description: Term description
	 **/
	var $description = false;



	/**
	 * errors
	 *
	 * @access public
	 * @var array
	 * @since 0.0.0
	 **/
	var $errors = array();



	/**
	 * have_errors
	 *
	 * @access public
	 * @var bool
	 * @since 0.0.0
	 **/
	var $have_errors = 0;






	/**
	 * __construct
	 * @since 0.0.0
	 **/
	function __construct() {

	} // end function __construct






	/**
	 * set
	 * @since 0.0.0
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set






	/**
	 * error
	 * @since 0.0.0
	 **/
	function error( $error_key ) {

		$this->errors[] = $error_key;

	} // end function error






	/**
	 * get
	 * @since 0.0.0
	 **/
	function get( $key ) {

		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}

	} // end function get






	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################






	/**
	 * get_title
	 * @since 0.0.0
	 **/
	function get_title( $args = array() ) {

		$this->set_type();
		if ( ! $this->have_type() ) {
			return false;
		}

		global $wp_query;
		$defaults = array(
			'class' => '',
			'echo' => 1,
		);
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$this->set_the_title();
		$this->set_description();


		$output = "<div class=\"layout-archive-title $class\">";

			$output .= "<h1>" . apply_filters( 'ArchiveTitlesWP-title', $this->the_title, $this ) . "</h1>";

			if ( $this->have_description() ) {
				$output .= "<div class=\"entry\">";
					$output .= wpautop( $this->description );
				$output .= '</div>';
			}

		$output .= '</div>';


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}


	} // end function get_title






	/**
	 * Set type, this is used in various locations to
	 * help correlate title and descriptions.
	 * @since 7.0.0
	 **/
	function set_type() {
		
		if ( is_home() ) {
			$this->set( 'type', 'home' );
		} else if ( is_front_page() ) {
			$this->set( 'type', 'front-page' );
		} else if ( is_tax() ) {
			$this->set( 'type', 'custom-taxonomy' );
		} else if ( is_category() ) {
			$this->set( 'type', 'category' );
		} else if ( is_tag() ) {
			$this->set( 'type', 'tag' );
		} else if ( is_author() ) {
			$this->set( 'type', 'author' );
		} else if ( ( is_day() OR is_month() OR is_year() ) ) {
			$this->set( 'type', 'date' );
		} else if ( is_404() ) {
			$this->set( 'type', '404' );
		} else if ( is_search() ) {
			$this->set( 'type', 'search' );
		} else {
			return false;
		}


	} // end function set_type






	/**
	 * set_the_title
	 * @since 0.0.0
	 **/
	function set_the_title() {
		global $wp_query;

		// taxonomy term
		if ( in_array( $this->type, array( 'custom-taxonomy', 'category', 'tag' ) ) ) {
			$this->set( 'the_title', $wp_query->queried_object->name );
		// date
		} else if ( $this->type == 'date' ) {
			$the_title = '';
			if ( isset( $wp_query->query['year'] ) ) {
				$the_title .= $wp_query->query['year'];
			}
			if ( isset( $wp_query->query['monthnum'] ) ) {
				$the_title .= " " . $wp_query->query['monthnum'];
			}
			if ( isset( $wp_query->query['day'] ) ) {
				$the_title .= " " . $wp_query->query['day'];
			}
			$this->set( 'the_title', $the_title );

		// author
		} else if ( $this->type == 'author' ) {
			$this->set( 'the_title', "Author " . $wp_query->queried_object->data->display_name );

		} else if ( $this->type == 'front-page' ) {
			$this->set( 'the_title', get_bloginfo( 'name' ) );

		// home
		} else if ( $this->type == 'home' ) {
			if ( get_option( 'page_for_posts' ) ) {
				$this->set( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) );
			} else {
				$this->set( 'the_title', get_bloginfo( 'name' ) );
			}

		// search
		} else if ( $this->type == 'search' ) {
			global $s;
			$this->set( 'the_title', get__option( '_search_title' ) . " " . $s );

		// 404
		} else if ( $this->type == '404' ) {
			if ( get__option( '_404_page_title' ) ) {
				$title = get__option( '_404_page_title' );
			} else {
				$title = __( '404 Not Founds', 'parenttheme' );
			}
			$this->set( 'the_title', $title );
		}

	} // end function set_the_title






	/**
	 * set_description
	 * @since 0.0.0
	 **/
	function set_description() {
		global $wp_query;

		if (
			isset( $wp_query->queried_object->taxonomy )
			AND isset( $wp_query->queried_object->description )
			AND ! empty( $wp_query->queried_object->description )
		) {
			$this->set( 'description', $wp_query->queried_object->description );
		} else if ( $this->type == 'author' ) {
			$this->set( 'description', get_the_author_meta( 'description', $wp_query->queried_object->data->ID ) );
		} else if ( $this->type == 'home' ) {
			// is it worth the query to get the page content?
			// $this->set( 'description', '');
		}

	} // end function set_description






	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################






	/**
	 * have_errors
	 * @since 0.0.0
	 **/
	function have_errors() {

		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}

		return $this->have_errors;

	} // end function have_errors






	/**
	 * have_description
	 * @since 0.0.0
	 **/
	function have_description() {

		if ( isset( $this->description ) AND ! empty( $this->description ) ) {
			$this->set( 'have_description', 1 );
		} else {
			$this->set( 'have_description', 0 );
		}

		return $this->have_description;

	} // end function have_description






	/**
	 * have_type
	 * @since 0.0.0
	 **/
	function have_type() {

		if ( isset( $this->type ) AND ! empty( $this->type ) ) {
			$this->set( 'have_type', 1 );
		} else {
			$this->set( 'have_type', 0 );
		}

		return $this->have_type;

	} // end function have_type



} // end class ArchiveTitlesWP
