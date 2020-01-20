INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Article\\Controller\\ArticleController', 'Add', '', '', 0),
('edit', 'OnePlace\\Article\\Controller\\ArticleController', 'Edit', '', '', 0),
('view', 'OnePlace\\Article\\Controller\\ArticleController', 'View', '', '', 0),
('index', 'OnePlace\\Article\\Controller\\ArticleController', 'Index', 'Articles', '/article', 1),
('list', 'OnePlace\\Article\\Controller\\ApiController', 'List', '', '', 1);
COMMIT;