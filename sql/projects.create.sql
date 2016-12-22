-- サーバ名を環境にあわせ変更すること
USE `api`;

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `client` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `projects` (
  `id`,
  `name`,
  'client'
) VALUES
(1, 'admin', 'ktd');


-- サーバ名を環境にあわせ変更すること
USE `api_test`;

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `client` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id`)
);
