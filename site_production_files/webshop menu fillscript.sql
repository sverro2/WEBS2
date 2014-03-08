INSERT INTO `sbrettsc_db`.`menu_top` (`label`, `link`, `sort`, `icon`) VALUES ('Home', '#home', '1', '');
INSERT INTO `sbrettsc_db`.`menu_top` (`label`, `link`, `sort`, `icon`) VALUES ('Products', '#products', '2', '');
INSERT INTO `sbrettsc_db`.`menu_top` (`label`, `link`, `sort`, `icon`) VALUES ('About Us', '#about', '3', '');
INSERT INTO `sbrettsc_db`.`menu_top` (`label`, `link`, `sort`) VALUES ('Shopping Cart', '#shopping_cart', '4');

INSERT INTO `sbrettsc_db`.`category` (`label`, `url`, `parent_label`, `description`, `thumbnail`) VALUES ('Portal Guns', '#portal_guns', 'Products', 'Gun to shoot portals', NULL);
INSERT INTO `sbrettsc_db`.`category` (`id`, `label`, `url`, `parent_label`, `description`) VALUES (NULL, 'Turrets', '#turrets', 'Products', 'Turret shoots everyone');
INSERT INTO `sbrettsc_db`.`category` (`label`, `url`, `parent_label`, `description`) VALUES ('Neurotoxin', '#neurotoxin', 'Products', 'Warning: only for military purposes');
INSERT INTO `sbrettsc_db`.`category` (`label`, `url`, `parent_label`, `description`) VALUES ('Misc', '#misc', 'Products', 'All you lab stuff');

