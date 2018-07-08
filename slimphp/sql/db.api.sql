 /*
  * mysqlを起動すること
  * mysql.server start
  * <Leader> se で実行
  */

-- profile for local database;
-- profile名、DB名を変更すること ユーザ情報は変更する必要なし
let g:dbext_default_profile_api = 'type=mysql:user=api:passwd=api012:host=0.0.0.0:port=3306:dbname=api:extra=-vvv'
DBSetOption profile=api

-- profile for local testing database;
-- profile名、DB名を変更すること ユーザ情報は変更する必要なし
let g:dbext_default_profile_api_test = 'type=mysql:user=api:passwd=api012:host=0.0.0.0:port=3306:dbname=api_test:extra=-vvv'
DBSetOption profile=api_test

SHOW databases;
SHOW tables;

-- foreignkeyでエラーが起こる場合は
-- rootでログインしなおし、'SHOW ENGINE INNODB STATUS\G'で確認
-- 'pager less'でlessを使いながら確認
-- sarverでforeignkeyまわりでsqlが止まる場合は、dumpしてからインポート

-- users テーブル確認 /*{{{*/
SELECT * FROM `users`;
/*}}}*/
