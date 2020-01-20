--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`) VALUES ('article-single', 'Article');

--
-- Form Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Article', 'fas fa-save', 'Save Article', '#', 'primary saveForm', '', 'article-single', 'link', '', ''),
(NULL, 'Edit Article', 'fas fa-edit', 'Edit Article', '/article/edit/##ID##', 'primary', '', 'article-view', 'link', '', ''),
(NULL, 'Add Article', 'fas fa-plus', 'Add Article', '/article/add', 'primary', '', 'article-index', 'link', '', '');

--
-- Form Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES ('article-base', 'article-single', 'Article', 'Base', 'fas fa-info-circle', '', '0', '', '');

--
-- Form Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_ist`, `show_widget_left`, `allow_clear`, `tbl_cached_name`, `tbl_class`) VALUES (NULL, 'text', 'Label', 'label', 'article-base', 'article-single', 'col-md-3', '/article/view/##ID##', '', '0', '1', '', '');

--
-- Index Tables
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES ('article-index', 'article-single', 'Article Index');

COMMIT;