Issues, Notes, Current task
====================

### Current Task

### Issues

### Notes

ChangeLog
====================

### 10.09.15 - randy-c-7.8.0
- ignore codekit
- tidy functions.php
- update scss from child theme

### 08.25.15 - 7.7.0
- update register_sidebars, remove old filter

### 08.18.15 - 7.6.0
- remove theme support oembed video
- minor class cleaning
- update .gitignor to remove .DS_Store

### 08.17.15 - 7.5.0
- remove ThemeOptions from includes / classes
- update get__option in theme-support.php

### 05.30.15 - 7.4.0
- remove CreatePosts, GetRemoteDataWP from include/classes - if needed they can be added as addons
- remove loader and modal scss files
- remove admin js and admin enqueue scripts
- remove editor-style.css

### 03.29.15 - 7.3.0
- update HavePostsWP::the_content with proper filter

### 02.27.15 - 7.2.0
- remove all traces of VC
- remove all unused classes
- update a few naming conventions

### 02.21.15 - 7.1.1
- update featured image to use ACFWP
- remove widget_init
- remove FeaturedImageWP.php

### 02.21.15 - 7.1.0
- update page html, 404, search, comments

### 02.21.15 - 7.0.0
- update template files to static html template approach
- remove tpl-site-map.php
- remove tpl-wide.php
- update HavePostsVCWP css classes
- update page.php
- update single.php

### 02.11.15 - 6.9.7
- remove clearfix css class from div's

### 12.01.14 - 6.9.6
- update body_class if statement
- update have posts class with no [&hellip;]

### 09.25.14 - 6.9.5
- update GetRemoteDataVCWP::_parse_xml

### 09.07.14 - 6.9.4
- minor cleaning to functions.php
- finish ArchiveTitlesVCWP()
- finish options for ACF

### 09.06.14 - 6.9.3.0
- update theme options from parent theme to ACF
- add do__comments() to theme-supports
- replace all comment checking with do__comments()

### 08.19.14 - 6.9.2.0
- finish archive titles
- moved admin custom columns to child theme admin customization class
- removed all classes that were not being used

### 08.02.14 - 6.9.1.3
- remove featured image post type and add default featured images to functions.php
- convert comments callback into class
- convert navigation functions to a class with wrapper functions

### 07.19.14 - 6.9.1.2
- functions.php cleanup
- loop depreciate
- additional class HavePostsVCWP to handle new loop functions

### 07.19.14 - 6.8.1
- update oembed script
- update is__user

### 05.08.14 - 6.8.0
- update post object
- update wide template
- remove comment for sitemap

### 04.30.14 - 6.7.0
- update to OptionPageVCWP to allow for filtering and better conditional checking

### 04.22.14 - 6.6.0
- update to OEmbedPostMetaVCWP for quick edit on save post action.

### 04.21.14 - 6.5.0
- update to create posts
- remove old post meta attr

### 03.13.14 - 6.4.4
- added inline notes for update
- updated require paths in wrapper functions for localization
- update header-head.php to remove IE conditionals
- added fade in out to reset.css
- update comments callback function

### 02.05.14 - 6.4.3
- add filters to tags: html and head for angular usage.
- add fade, in, out to reset css based on bootstrap usage

### 02.05.14 - 6.4.2
- remove wp_print_styles in favor of wp_enqueue_scripts
- remove "ck" version of "compiled-scripts"

Pre Markedown
====================

== 6.4.0 - 6.4.1 ==
01.20.14
- update templates to utilize bootstrap columns
- update templates with ThemeOptions::parentTheme
- tidy up template html, css and php
- remove do_action from header footer template files

01
- add ThemeOptions to wrapper functions via get__option
- update change-log.txt to mardown file

== 6.3.4 ==
12.11.13
- update vc_navigation_posts to fix echo issue

== 6.3.3 ==
12.05.13
- update compiled-scripts.js
- minified compiled-scripts.js to compiled-scripts-ck.js
- update "helpers" to call minified js

== 6.3.2 ==
11.22.13
- merge respond.js into scripts.js

== 6.3.1 ==
11.20.13
- update fontawesome

== 6.3 ==
11.18.13
- update file commenting to abstract ParentTheme for re-branding

== 6.2.1 ==
10.17.13
- finish prep on ThemeOptions.php - this is still more to be done.

== 6.2.0 ==
10.17.13
- functions.php restructuring

== 6.1.2 ==
10.04.13
- update img {} in reset.css

== 6.1.1 ==
09.04.13
- update PostMetaVCWP::meta_box() to include a default value for each custom field

== 6.1 ==
08.23.13
- update PostMetaVCWP::meta_box - temporarily removed "side" as an option for metabox position
- update PostMetaVCWP::sanitize_post_meta - added secondary input-hidden for localizing metabox "metabox-id-vcwp"

== 6.0.1 ==
08.15.13
- added field__select_terms::FormFieldsVCWP

== 6.0 ==
08.13.13
- update OEmbedPostMetaVCWP nonce name {post-type}-nonce is already in use. update to {post-type}-nonce-vcwp

== 5.9.1 ==
08.12.13
- added filter "vc_custom_page_meta" to PageAttrPostMetaVCWP::register__postmeta()

== 5.9 ==
08.05.13
- update comments-callback.php for backward compatible.

== 5.8.1 ==
08.05.13
- update vc_title() to include target=""

== 5.8 ==
08.03.13
- add GeoMetaTagsVCWP class and get__meta_tags wrapper function

== 5.7 ==
07.31.13
- update wp_head and wp_footer to include html_entity_decode
08.01.13
- added a str_replace for single quotes, not sure why they were not converting.
- respond.js to registered scripts

== 5.6 ==
07.16.13
- added load_theme_textdomain()

== 5.5 ==
07.05.13
- update shortcodes default - vc_excerpt()
- update class LatestPostWidgetVCWP

07.03.13
- add var $filter_name__parenttheme_localize_script__handle = 'parenttheme-localize_script-handle';
- update vc_sidebars to include $args as second parameter, removed "class" as second parameter

== 5.4 ==
07.02.13
- Added register_style for bootstrap-responsive & font-awesome

== 5.3 ==
06.22.13
- update depreciated forms-validation.php to return properly.
- update ParentThemeOptionsVCWP filter options array moved to after_theme_setup

== 5.2 ==
06.21.13
- update FeaturedImageVCWP

== 5.1 ==
06.19.13
- update html frame to include outer-wrap and inner-wrap.
- removed html above and below both header and footer

== 5.0 ==
06.13.13
- FormFieldsVCWP.php added field select_post
06-12.13
- FormFieldsVCWP.php added field select_page
06-10.13
- update -nonce to -nonce-vcwp
- PostMetaVCWP nonce check

== 4.9 ==
- added OptionPageVCWP
- added ParentThemeOptionsVCWP - removed old options from functions
- removed constants for VC_VERSION, VC_OPTION_NAME, VC_OPTION_GROUP

== 4.8 ==
05.16.13
- added FeaturedImageVCWP class w/ wrapper function featured__image() and depreciated vc_featured_image() from featured-image.php

== 4.7 ==
05.15.13
- added FormFieldsVCWP class w/ wrapper function and depreciated form_fields_vc from forms-validation.php

== 4.6 ==
05.08.13
- update featured-image
- update default options $this->current_version
- added SanitizeValueVCWP class w/ wrapper function and depreciated sanitize_value_vc from forms-validation.php

== 4.5 ==
05.07.13
- update PostMetaVCWP updated wrapper-function - register__postmeta

== 4.4 ==
05.02.13
- update register__post_type - was cutting off usage, bad formatting.

== 4.3 ==
04.03.13
- update php page title comments.

== 4.2 ==
03.26.13
- Update vc_title - added esc_attr
- update modernizer

== 4.1 ==
03.22.13
- update admin-style.css - #header_area .vc-sortable-wrap li { position:relative; }
- Added AppendPostData and AppendPostData Wrapper
- update options class to include as $field['args']
- update page header comments

== 4.0 ==
03.16.13
- oembed-post-meta.php - commented out "send to editor" button

== 3.9 ==
03.12.13
- post-meta.php added to save_post - if ( defined('DOING_AJAX') AND DOING_AJAX )

== x3.9 ==
02.14.13
- Updating Create Posts class, under construction. Neither of these files are called during theme load yet.
	- PostMetaVCWP.php
	- CreatePostsVCWP.php

== 3.8 ==
02.09.13
- theme-support.php - update get_vc_option archive title
- SendMailVCWP.php - replaces send-mail.php will perform old class tasks as depreciated.

== 3.7 ==
02.03.13
- theme_support.php - added value checking
- loop-no-search.php - update loop object
- loop-page-list-children.php - update loop object
- page-meta.php - update metabox position, added description

1.29.13
- forms-validation.php - added 'paragraph-text' case

01.19.13
- post-type-vc.php - added granulation to class. Added further conditional checking. Removed flush_rewrites.
- options-vc.php - added value checking.
- post-meta-meta.php - added value checking.
- forms-validation.php - added value checking.
- oembed-post-meta.php - added value checking.

01.14.13
- forms-validation.php - added 'upload' to form validations, same as image.

== v3.6.21 ==
12.22.12
- post-type-vc.php - added var post_type_tax_filters

12.04.12
- header.php - add do_action('after_body_tag');

== v3.6.2 ==
11.30.12
- comments.php - added if ( get_vc_option( 'comments', 'remove_comments' ) ) return;

11.21.12
- oembed-post-meta.php - added delete post meta

== v3.6.1 ==
11.18.12
- Removed parent-theme-vc.php
- reworked the main class structure to allow for all items to be called from functions.php
- unfortunately there are to many items to that have been tweaked in small ways to count. Though all adjustments were moving code to a more appropriate location.

== v3.6.0 ==

11.16.12
- theme-support.php added is_page_for_posts__vc()
- navigation-breadcrumb.php add $before & $after function breadcrumb_navigation
- loop-default.php add vc_OddOrEven() to post_class

11.12.12
- custom.js - removed MBP.scaleFix();

11.09.12
- header-head.php - remove
	<meta content="True" name="HandheldFriendly">
	<meta content="320" name="MobileOptimized">  
	"target-densitydpi=160dpi"

11.07.12
- search.php - update "id" to "class"
- loop-page-default.php -- added get_vc_option( 'comments', 'remove_comments' ) to check for comments
- custom.js moved $().mobileMenu({}); to child theme.

10.30.12
- default-options.php - default_options() - added 'pinterest' to social networks metabox.

10.08.12
- parent-theme-vc.php - added shortcode_clear() [clear]

09.29.12
- oembed-post-meta.php update custom field names, removed _oembed_ from the beginning of the name. There was a conflict with an oembed cache removal function.
- optional work around "not implemented" -- if ( defined( 'DOING_AJAX' ) AND DOING_AJAX ) remove_action( 'save_post', array( $GLOBALS['wp_embed'], 'delete_oembed_caches') );

09.14.12
- remote-data-vc.php - added filter 'vc-remote_data-transient_timeout' to set_transient

09.10.12
- forms-validation.php - update image_multi validation

09.09.12
- post-meta-vc.php - sanitize_post_meta update validation name
- forms-validation.php - sanitize_value_vc update switch case filter

09.07.12
- featured-image.php update to target attr
- theme-support.php - vc_sidebars() - added is_active_sidebar check

08.24.12
- vc_page_title_category() added specific filter for the "title" text.

08.16.12
- re-Add favicon to "header_footer" option and "wp_head"
- added global & function $is_ipad to functions.php
- added global & function $is_mobile to functions.php
- added global & function $is_msie to functions.php
- add filter parenttheme-localize_script array to functions.php
- update - sanitize_post_meta() - includes / custom-fields / oembed-post-meta.php

08.14.12
- Update default options, change category options

08.10.12

- Update default.css - change font and padding "em" to "px" - more consistent across browsers.
- Update Default Options array - removed website_title - was not getting any use.


== v3.5.9 ==

/**
 * Password Form, for password protected pages
 *
 * @version 0.4
 * @updated	07.31.12
 **/
function the_password_form()

- updated form action from: wp-pass.php to: wp-login.php?action=postpass
