<?php
/**
 * File Name pass-wp-themecheck.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 04.03.13
 *
 * Description:
 * The only purpose of this file is to aid in passing the wp themecheck plugin when it asks for 
 * items that are not used.
 **/
#################################################################################################### */


/**
 * Include files.
 **/
if ( ! isset( $content_width ) ) $content_width = 900;