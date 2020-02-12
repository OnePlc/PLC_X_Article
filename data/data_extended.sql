--
-- Core Form - Article Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'select', 'State', 'state_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/state', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\StateController'),
(NULL, 'select', 'Condition', 'condition_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/condition', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\ConditionController'),
(NULL, 'currency', 'Our Price', 'price_us', 'article-finance', 'article-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),(NULL, 'multiselect', 'Categories', 'category_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/category', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\CategoryController'),
(NULL, 'currency', 'Sell Price', 'price_sell', 'article-finance', 'article-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'textarea', 'Description', 'description', 'article-base', 'article-single', 'col-md-12', '', '', 0, 1, 0, '', '', '');

--
-- Core Form  Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('article-finance', 'article-single', 'Finance', 'prices', 'fas fa-university', '', 1, '', ''),
('article-history', 'article-single', 'History', '', 'fas fa-history', '', 1, '', '');

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Article\\Controller\\StateController', 'Add State', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\ConditionController', 'Add Condition', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\CategoryController', 'Add Category', '', '', 0);

--
-- Custom Tags
--
INSERT IGNORE INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'condition', 'Condition', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');







