<?php
/* Template Name: Wide */

/**
 * File Name tpl-wide.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.0
 * @updated 01.20.14
 **/
#################################################################################################### */


get_template_part( 'header' );

?>
<div id="content">
	<?php get_template_part( 'loop-page-default' ); ?>
	<div class="clear"></div>
</div><!-- End Content -->

<?php

get_template_part( 'footer' );