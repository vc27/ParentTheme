<?php
/* Template Name: Static Single */

/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header' );
?>
<div id="section-main" class="outer-wrap">
	<div class="inner-wrap">
		<?php do_action('section-main-top'); ?>
		<div class="row-fluid">
			<div class="span8">
				<div id="section-content-single" class="inside-wrapper">
					<div class="hentry">
						<h1 class="h1">Page Title</h1>
						<div class="meta-data">
							<a href="#" class="item item-category">Category</a>
							<a href="#" class="item item-comments">Comments</a>
							<a href="#" class="item item-author">Post by John Doe</a>
						</div>
						<div class="entry"><p>Pellentesque aliquam, risus vitae rhoncus fermentum, urna dui suscipit nulla, in bibendum nisl lectus quis augue. Nulla non sem vitae sapien pharetra posuere a sed tellus. Nam rutrum condimentum felis eget pellentesque. Sed id aliquet metus. Nam vulputate rhoncus gravida. Nunc a faucibus enim. Quisque varius convallis justo at pulvinar. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut cursus elementum libero eu blandit. Phasellus et gravida tellus, id aliquam urna. Etiam efficitur mattis nisl a ornare.</p></div>
					</div>
				</div>
				<?php if ( do__comments() ) { comments_template( '', true ); } ?>
			</div>
			<div class="span4">
				<?php get__widget_area( 'Primary Sidebar' ); ?>
			</div>
		</div>
		<?php do_action('section-main-bottom'); ?>
	</div>
</div>
<?php
get_template_part( 'footer' );