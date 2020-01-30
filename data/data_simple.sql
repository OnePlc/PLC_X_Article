--
-- Extra Form Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_ist`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'currency', 'Price', 'price', 'article-base', 'article-single', 'col-md-3', '', '', '0', '1', '0', '', '', ''),
(NULL, 'multiselect', 'Categories', 'category', 'article-base', 'article-single', 'col-md-3', '', '/tag/api/list/article-single_1', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Tag\\Controller\\CategoryController');

--
-- Extra Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Tag\\Controller\\CategoryController', 'Add Category', '', '', 0);