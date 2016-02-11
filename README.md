# REST

```
hub clone kobabasu/rest api
```

## git
1. 必要があればdevelopブランチを使う  
   `git checkout develop`

## npm
1. `npm install`
1. `npm run build`

## composer
1. `composer install --no-dev`

## vagrant
1. `hub clone cores/cores-vagrant coreos`
1. `cd coreos`
1. 必要なファイルをリネーム  
   * `mv user-data.sample user-data`
   * `mv config.rb.sample config.rb`
1. Vagrantfile編集  
   `vim Vagrantfile`
   * `$instance_name_prefix = "任意の名前"`
   * NFSの設定 ローカルのディレクトリは'..'で。'../app'だと変更が必要
   * portの設定 80->8080, 443->3443, 3306->3306, 1025->1025, 1080->1080
1. `vagrant up`

## docker
1. `vagnrat ssh`
1. mysqlコンテナ起動
```
docker run --net=host --name mysql -p 3306:3306 -e "ROOT_PW=..." -e "DB_NAME=..." -e "DB_USER=..." -e "DB_PASS=..." -d kobabasu/mysql:0.75
```
1. apacheコンテナ起動
```
docker run --net=host --name apache -p 80:80 -p 443:443 -v /home/core/share:/var/www/html -d kobabasu/apache:0.24
```
1. smtpコンテナ起動
```
docker run --net=host --name smtp -p 1025:1025 -p 1080:1080 -d kobabasu/smtp:0.11
```
1. `exit`

## mysql
1. DB作成
```
mysql -h 0.0.0.0 --port 3306 -u[username] -p[password] -D [dbname] < sql api/sql/users.create.sql
```
1. table作成
```
mysql -h 0.0.0.0 --port 3306 -u[username] -p[password] -D [dbname] < sql api/sql/users.create.sql
```
1. http://localhost:8080/api/users/で確認

## phpunit
1. `phpunit`
1. すべてテストをパスすればOK
1. testdox形式で出力する場合は
   `phpunit --testdox`
1. http://localhost:8080/api/docs/reports/にアクセス
1. レポートがすべて100%であればOK

## mailcatcher
1. まずphpunitを実行
1. http://localhsot:1080にアクセス
1. メールが届いていればOK
1. Plain Textタブではfrom, toはメールアドレスが表示。
   To, Subjectは文字化けせず表示。
1. Sourceタブでは文字化けが散見していてOK。
   Content-Typeがtext/plain。charsetがiso-2022-jpでOK
1. ダウンロードしダブルクリックでメーラが開く。
1. 問題なく表示されていればOK

## phpdoc
1. `phpdoc`を実行
1. エラーがでず完了すればOK
1. http://localhost:8080/api/docs/api/にアクセス
1. 問題なく表示されればOK

## frisby
1. `npm run test`
1. すべてテストをパスすればOK

## dbext
1. vagrantでmysqlコンテナを起動
1. `vim sql/db.api.sql`
1. let g:dbext...をヤンク
1. :<C-r>0
1. DBSetOptionをヤンク
1. :<C-r>0
1. sqlを実行し結果が表示されればOK

## cURL sample
1. INDEXを表示
```
curl -i -X GET -H 'Content-Type:application/json;charset=utf-8' http://localhost:8080/api/users/
```
1. レコードを表示
```
curl -i -X GET -H 'Content-Type:application/json;charset=utf-8' http://localhost:8080/api/users/{存在するid}
```
1. レコードをinsert
```
curl -i -X POST -H 'Content-Type:application/json;charset=utf-8' -d '{"name":"taro", "email":"taro@example.com"}' http://localhost:8080/api/users/
```
1. レコードを変更
```
curl -i -X PUT -H 'Content-Type:application/json;charset=utf-8' -d '{name":"curl", "email":"curl@example.com"}' http://localhost:8080/api/user/{存在するid}
```
1. レコードを削除
```
curl -i -X DELETE  -H 'Content-Type:application/json;charset=utf-8' http://localhost:8080/api/users/{存在するid}
```

## setup
1. 一度composer.jsonのautoloadを確認しておく
1. config内のdevelopment, prodcutionをそれぞれ設定
1. phpunit.php内を設定
1. phpunitを実行
1. phpdocを実行
1. npm run testを実行


## files
|name            |desc                                        |
|:---------------|:-------------------------------------------|
|.babelrc        |es2015のpresetを設定                        |
|.gitattributes  |marge oursが必要であれば変更                |
|.gitignore      |cache,logs,reportsを除外                    |
|.htaccess       |Slimのrewriteとhttp methodをlocalhostに限定 |
|README.md       |このファイル                                |
|bootstrap.php   |Slimの設定                                  |
|composer.json   |PSR-4のautoloadの設定があるので注意         |
|composer.lock   |composerのlockファイル                      |
|index.php       |server environmentの設定                    |
|note.md         |メモ                                        |
|package.json    |es6変換,frisbyを読込。scriptsは要確認       |
|phpdoc.xml      |lib,routes,testsに限定。出力先はdocs/api    |
|phpunit.xml     |lib,routesに限定。テスト用DBの設定含む      |

## directories
|name            |desc                                        |
|:---------------|:-------------------------------------------|
|/.git           |gitディレクトリ                             |
|/cache          |twig専用cache                               |
|/config         |設定はここにまとめる。要パーミッション      |
|/docs           |テストのレポートとphpdoc                    |
|/lib            |汎用コード                                  |
|/logs           |Slim,mailのログとcoverage                   |
|/mail           |twigによるmailテンプレート                  |
|/node_modules   |npmディレクトリ                             |
|/reports        |frisbyのjunitreport                         |
|/routes         |Slimのroutesをまとめる                      |
|/spec           |frisbyのテストコード                        |
|/sql            |本番DB,テストDBの作成。usersテーブルの作成  |
|/src            |Slimの汎用コード                            |
|/tests          |phpunitのテストコード                       |
|/vendor         |composerディレクトリ                        |

## docs
テストのレポートとphpdoc

|name            |desc                                        |
|:---------------|:-------------------------------------------|
|api             |phpdocによる出力                            |
|reports         |phpunitによるcoverage reporter              |

## mail
twigによるmailテンプレート

|name            |desc                                        |
|:---------------|:-------------------------------------------|
|default.twig    |twigによるmailテンプレートsample。未使用    |
|defaultTest.twig|tests/lib/SwiftMailer/MailerTest.phpで使用  |

## spec
frisbyのテストコード

|name            |desc                                        |
|:---------------|:-------------------------------------------|
|dist            |未使用                                      |
|js              |frisbyはこの中のファイルをすべて読み込む    |
|src             |この中のファイルを編集しbabelで変換         |

## sql
sqlに関するディレクトリ
パーミッションでアクセス制限をかける

|name            |desc                                        |
|:---------------|:-------------------------------------------|
|db.api.sql      |dbextで利用するsql編集ファイル              |
|install.sql     |DBの作成。初期設定時のみ使用                |
|users.create.sql|usersテーブルの作成。初期設定時のみ使用     |

## src
Slim3の各種設定

|name            |desc                                        |
|:---------------|:-------------------------------------------|
|app.php         |アプリケーション全体の設定。Content-Typeなど|
|dependencies.php|コンテナ関連                                |
|middleware.php  |middleware                                  |
|settings.php    |定数やloggerの設定など                      |

## tests
phpunitのテストコード

|name            |desc                                        |
|:---------------|:-------------------------------------------|
|/fixtures       |フィクスチャ                                |
|/lib            |libを対象のテストコード                     |
|/routes         |routesを対象のテストコード                  |
|/bootstrap.php  |テスト用の起動。phpunit.xmlで利用           |
