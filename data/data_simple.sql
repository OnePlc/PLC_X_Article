
--
-- Core Form - Article Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'multiselect', 'Categories', 'category_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/category', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\CategoryController'),
(NULL, 'currency', 'Sell Price', 'price_sell', 'article-base', 'article-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'textarea', 'Description', 'description', 'article-base', 'article-single', 'col-md-12', '', '', 0, 1, 0, '', '', '');

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Article\\Controller\\CategoryController', 'Add Category', '', '', 0);
