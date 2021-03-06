-- create databases サーバ名を変更
DROP DATABASE IF EXISTS `api`;
CREATE DATABASE `api` CHARACTER SET utf8;

DROP DATABASE IF EXISTS `api_test`;
CREATE DATABASE `api_test` CHARACTER SET utf8;

-- for server サーバ名、ユーザ名を環境にあわせて変更すること
GRANT ALL PRIVILEGES ON `api`.* TO 'api'@'%' IDENTIFIED BY 'api012' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `api`.* TO 'api'@'localhost' IDENTIFIED BY 'api012' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `api_test`.* TO 'api'@'%' IDENTIFIED BY 'api012' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `api_test`.* TO 'api'@'localhost' IDENTIFIED BY 'api012' WITH GRANT OPTION;

-- for vim ユーザapiを作成 サーバ名のみ変更
GRANT ALL PRIVILEGES ON `api`.* TO 'api'@'%' IDENTIFIED BY 'api012' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `api`.* TO 'api'@'localhost' IDENTIFIED BY 'api012' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `api_test`.* TO 'api'@'%' IDENTIFIED BY 'api012' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `api_test`.* TO 'api'@'localhost' IDENTIFIED BY 'api012' WITH GRANT OPTION;
