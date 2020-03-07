
--
-- Core Form - Article Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'multiselect', 'Categories', 'category_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/category', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\CategoryController'),
(NULL, 'textarea', 'Description', 'description', 'article-base', 'article-single', 'col-md-12', '', '', 0, 1, 0, '', '', ''),
(NULL, 'featuredimage', 'Featured Image', 'featured_image', 'article-base', 'article-single', 'col-md-3', '', '', '0', '1', '0', '', '', ''),
(NULL, 'gallery', 'Gallery', 'gallery', 'article-gallery', 'article-single', 'col-md-12', '', '', '0', '1', '0', '', '', ''),
(NULL, 'partial', 'Web Gallery', 'webgallery', 'article-gallerysort', 'article-single', 'col-md-12', '', '', '0', '1', '0', '', '', ''),
(NULL, 'select', 'web show', 'show_on_web_idfs', 'article-base', 'article-single', 'col-md-2', '', '/application/selectbool', '', '0', '1', '0', '', 'OnePlace\\BoolSelect', ''),
(NULL, 'select', 'web spotlight', 'web_spotlight_idfs', 'article-base', 'article-single', 'col-md-2', '', '/application/selectbool', '', '0', '1', '0', '', 'OnePlace\\BoolSelect', '');
--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Article\\Controller\\CategoryController', 'Add Category', '', '', 0);

--
-- Core Tabs
--
INSERT INTO core_form_tab (Tab_ID, form, title, subtitle, icon, counter, sort_id, filter_check, filter_value) VALUES
('article-gallery', 'article-single', 'Gallery', 'Images', 'fas fa-images', '', '4', '', ''),
('article-gallerysort', 'article-single', 'Gallery Sorting', 'sorted', 'fas fa-images', '', '4', '', '');

--
-- module icon
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES ('article-icon', 'fas fa-tag');
