--
-- Skeleton Base Form Fields
--

INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'select', 'Model', 'model_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/model', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\ModelController'),
(NULL, 'select', 'System', 'system_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/system', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\SystemController'),
(NULL, 'select', 'Coolant', 'coolant_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/coolant', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\CoolantController'),
(NULL, 'select', 'Condition', 'condition_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/condition', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\ConditionController'),
(NULL, 'select', 'Loadbase', 'loadbase_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/loadbase', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\LoadbaseController'),
(NULL, 'select', 'Location', 'location_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/location', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\LocationController'),
(NULL, 'select', 'Origin', 'origin_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/origin', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\OriginController'),
(NULL, 'select', 'State', 'state_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/state', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\StateController'),
(NULL, 'multiselect', 'Categories', 'categories', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/categories', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\CategoryController'),
(NULL, 'select', 'Owner', 'owner_idfs', 'article-base', 'article-single', 'col-md-2', '', '/contact/api/list/0', '0', '1', '0', 'contact-single', 'OnePlace\\Contact\\Model\\ContactTable','add-OnePlace\\Contact\\Controller\\ContactController'),
(NULL, 'select', 'Warranty', 'warranty_idfs', 'article-base', 'article-single', 'col-md-2', '', '/tag/api/list/article-single/warranty', '0', '1', '0', 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Article\\Controller\\WarrantyController'),
(NULL, 'text', 'Year of Construction', 'year_of_construction', 'article-base', 'article-single', 'col-md-1', '', '', '0', '1', '0', '', '', ''),
(NULL, 'text', 'Caliber', 'caliber', 'article-base', 'article-single', 'col-md-1', '', '', '0', '1', '0', '', '', ''),
(NULL, 'text', 'Descriptive Nr', 'descriptive_nr', 'article-base', 'article-single', 'col-md-2', '', '', '0', '1', '0', '', '', ''),
(NULL, 'text', 'Lifetime', 'lifetime', 'article-base', 'article-single', 'col-md-2', '', '', '0', '1', '0', '', '', ''),
(NULL, 'text', 'Weight', 'weight', 'article-base', 'article-single', 'col-md-2', '', '', '0', '1', '0', '', '', ''),
(NULL, 'text', 'Specialaddons', 'special_addons', 'article-base', 'article-single', 'col-md-1', '', '', '0', '1', '0', '', '', ''),
(NULL, 'textarea', 'Description', 'description', 'article-base', 'article-single', 'col-md-12', '', '', '0', '1', '0', '', '', ''),
(NULL, 'gallery', 'Gallery', 'gallery', 'article-gallery', 'article-single', 'col-md-12', '', '', '0', '1', '0', '', '', '');


--
-- Skeleton Form Tabs
--

INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('article-dates', 'article-single', 'Dates', 'Deadlines', 'fas fa-calendar', '', '1', '', ''),
('article-finance', 'article-single', 'Finance', 'Financial', 'fas fa-money-check-alt', '', '2', '', ''),
('article-internal', 'article-single', 'Internal', 'Internal Stuff', 'fas fa-user-secret', '', '3', '', ''),
('article-gallery', 'article-single', 'Gallery', 'Images', 'fas fa-images', '', '4', '', ''),
('article-matching', 'article-single', 'Matching', 'Related Pleas', 'fas fa-list', '', '5', '', '');


--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Article\\Controller\\ModelController', 'Add Model', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\SystemController', 'Add System', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\CoolantController', 'Add Coolant', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\ConditionController', 'Add Condition', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\LoadbaseController', 'Add Loadbase', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\OriginController', 'Add Origin', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\StateController', 'Add State', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\WarrantyController', 'Add Warranty', '', '', 0),
('add', 'OnePlace\\Article\\Controller\\CategoriesController', 'Add Categories', '', '', 0);

--
-- Custom Tags
--
INSERT IGNORE INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'model', 'Model', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'system', 'System', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'coolant', 'Coolant', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'condition', 'Condition', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'loadbase', 'Loadbase', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'origin', 'Origin', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'state', 'State', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'warranty', 'Warranty', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');



