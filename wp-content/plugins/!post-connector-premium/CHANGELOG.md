### 1.6.12: January 21, 2016
* Fixed a bug that caused translation not to load properly.
* Updated translation files.

### 1.6.11: January 12, 2016
* Fixed a bug where wp_reset_postdata() did not actually reset post data because admin.

### 1.6.10: August 21, 2015
* Fixed shortcode and widget get_parent/get_child bug.

### 1.6.9: August 17, 2015
* Tweak: Added filter to allow display of backwards linking meta box on same post type relation: pc_display_backwards_linking_same_post_type.

### 1.6.8: July 22, 2015
* Tweak: Set default 'display thumbnail' option in children widget to false.
* Tweak: Added possibility to display thumbnail image to parent widget.

### 1.6.7: July 20, 2015
* Tweak: Added possibility of displaying thumbnail in children widget.

### 1.6.6: June 18, 2015
* Tweak: Fixed a get hook/filter object bug.

### 1.6.5: April 26, 2015
* Fixed a display excerpt bug in shortcode.
* Added 'pc_manual_link_post_statuses' filter to allow modification of post statuses of posts in link existing screen.

### 1.6.4: April 20, 2015
* Escaped view filter URL when manually linking posts to prevent possible XSS.

### 1.6.3: April 11, 2015
* Shortcode now uses generate_list method.
* Shortcode now supports images (image="true").
* After post filter now uses generate_list method.
* Optimized generate_list method.
* Added filter 'pc_list_excerpt_length' to set excerpt length in generate_list method.

### 1.6.2: April 8, 2015
* Fixed a bug where the incorrect excerpt was displayed in children list.

### 1.6.1: March 24, 2015
* Set correct pagination when no pagination is set.
* Add license page to network admin when it's a multisite.

### 1.6.0: March 1, 2015
* Added pagination to create link table screen.
* Added show parents widget.
* Removed redundant SP_Create_Link_List_Table class in premium package.
* Fixed an excerpt length bug.
* Minified all backend assets.
* License Manager update.

### 1.5.4: December 29th, 2014
* Fixed a post object bug in backwards linking meta box.
* Changed the way the plugin is initiated to prevent conflicts with lite version.
* Removed related functionality.
* Fixed TinyMCE bug that removed all buttons if user had insufficient permissions, props remyvv.

### 1.5.3: August 15th, 2014
* Featured images of automatically displayed linked posts can now be shown.

### 1.5.2: July 13th, 2014
* BIG code architecture changes.
* Improved the generate_children_list method in SP_Post_Link_Manager by no longer using global post functions.
* Fixed a notice in bulk post linking.

### 1.5.1: June 9th, 2014
* Fixed a link sorting bug.
* Added ru_RU and hu_HU
* Updated .pot file

### 1.5.0: April 15th, 2014
* Introduced related connections.
* Introduced backwards linking.
* Introduced automatic display of linked posts after post.
* Introduced get_children method in SP_Post_Connector_API.
* Introduced pc_children_list_header_tag filter.
* Deprecated get_childs method in SP_Post_Connector_API, use get_children instead.
* Changed get_childs method to get_children method in SP_Post_Link_Manager.
* Deprecated SP_SubPostsAPI class.
* Deprecated SubPosts class.
* Created and implemented an Autoloader.
* Created SP_Meta_Box_Manage_Parent metabox.
* Fixed plugin links.
* Current queried object is now current page.
* Widget and shortcode children lists now have a regular bold heading instead of a h3/h4.
* Changed TinyMCE vars to Post Connector.
* Changed plugin admin page GET page variable.
* Corrected children typo in labels.
* Changed the sidebar, added 3 new boxes to sidebar.
* Changed the connection overview screen.
* Changed the connection add/edit screen.
* Changed 'Post Type Link' label to Connection(s).
* Renamed SP_Post_Type_Link_Manager to SP_Connection_Manager.
* Renamed SP_Post_Type_Link to SP_Connection.
* Renamed JavaScript file name prefix to post-connector.
* Renamed CSS file name to post-connector.css.
* Introduced POSTCONNECTOR_LICENSE constant to globally define the license key.
* We dropped support for SUB_POSTS_LICENSE constant, please use POSTCONNECTOR_LICENSE instead.
* Implemented the new Yoast license framework, license keys entered prior 1.5 will be migrated.
* Moved AJAX hook wp_ajax_sp_delete_link to one single location.
* Changed menu icon.
* Changed shortcode icon.
* Added wrapper around shortcode and widget output.
* Changed old shortcode 'subposts_show_childs' to 'post_connector_show_children' (old shortcode will still work).
* Renamed translation domain to post-connector.
* Updated de_DE translation.
* Added fa_IR, he_IL, hi_IN, it_IT & ro_RO languages.

### 1.4.1: February 7th, 2014
* Prefixed the EDD updater class to prevent conflicts with other plugins using the same EDD class.

### 1.4.0: January 28th, 2014
* Renamed Sub Posts to Post Connector
* Renamed sub-posts.php to post-connector.php
* Renamed SubPosts class to Post_Connector
* Renamed SP_SubPostsAPI class to SP_Post_Connector_API
* Added deprecated file for backwards compatibility
* Changed store URL to yoast.com
* Only load admin assets on Sub Posts admin pages
* Save post hook check
* Optimise query to increase performance
* Only check if post type link exists if WP_DEBUG is true to increase performance
* Disable changing PTL slug enhancement
* Remove SP_InstallManager
* Implement upgrade manager
* Multiple PTL with same parent and child post type bug
* Fixed shortcode overlay styling in MP6

### 1.3.3.2: January 25th, 2014
* Widget will now not display if there are not links

### 1.3.3.1: January 24th, 2014
* Fixed a widget bug that prevent 'Current queried object' from working

### 1.3.3.0: January 11th, 2014
* Sub Posts meta box with meta data is now hidden again
* Added WPML support
* Fixed MP6 icon alignment bug

### 1.3.2.1: December 10th, 2013
* Fixed an installation error

### 1.3.2.0: December 4th, 2013
* Code format refactor
* Updates Spanish translation
* License key can now be set by constant SUB_POSTS_LICENSE

### 1.3.1.0: November 11th, 2013
* Updated German translation
* Fixed a bug with the concept state of posts

### 1.3.0.0: September 17th, 2013
* Fixed bug of invaled current post object in backend by storing the current post object in the get_childs method
* Changed return type of API method
* Fixed a no permission error in the link exiting post screen
* Fixed 2 strict error on the manage link page
* Added has_child method to API
* The get_childs method now throws a notice if the PTL slug does not exists
* Added JavaScript hooks, more info at http://www.subposts.com/documentation/javascript-hooks/
* Updated Dutch translation

### 1.2.3.1: August 20th, 2013
* Fixed PHP strict notices

### 1.2.3.0: August 5th, 2013
* Added current queried object to shortcode get_childs
* Added current queried object to widget get_childs
* Replaced h3 with 'before_title' and 'after_title' in widget show_childs

### 1.2.2.1: August 3th, 2013
* Replaced wpdb::escape with esc_sql

### 1.2.2.0: July 31th, 2013
* Added wp_reset_postdata to various post link methods
* Updated API PHP documentation
* Added add_link_by_slug to API

### 1.2.1.1: July 23th, 2013
* Changed capability requirement for settings pages
* Changed capability check on the (existing) link post screen
* Updated Spanish translation, props Rocío Valdivia

### 1.2.1.0: July 18th, 2013
* Added props to changelog
* Fixed bug that hides the manage meta box when linking two of the same post types to each other.

### 1.2.0: July 2th, 2013
* Fixed strict PHP error, array_pop now has a variable as parameter
* Updated PHP documentation
* Added Spanish Translation, props Rocío Valdivia
* Post Type Link options default value set to 'Yes'

### 1.1.0: June 21th, 2013
* Added hook 'sp_after_link_add'
* Added hook 'sp_before_link_delete'
* Added hook 'sp_after_link_delete'
* Added hook 'sp_after_post_type_link_add'
* Added hook 'sp_after_post_type_link_edit'
* Added hook 'sp_before_post_type_link_delete'
* Added hook 'sp_after_post_type_link_delete'

### 1.0.1: June 20th, 2013
* Updated German translation

### 1.0.0: June 7th, 2013
* Initial release
* German Translation, props Remy van Velthuijsen