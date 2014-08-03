<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

?>
			<?php do_action('section-main-bottom'); ?>
			<div class="clear"></div>
		</div>
	</div><!-- End section-main -->
	
	<!-- Start Footer -->
	<div id="footer" class="outer-wrap">
		<div class="clearfix inner-wrap">
			<?php 
			
			wp_nav_menu( array( 
				'depth' => 1, 
				'fallback_cb' => '', 
				'theme_location' => 'footer-navigation', 
				'container' => 'div', 
				'container_id' => 'footer-navigation' 
			) );
			
			?>
		</div>
	</div><!-- End Footer -->

</div><!-- End Page -->

<!-- Start wp_footer -->
<?php wp_footer(); ?>
</body>
</html>