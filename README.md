# 開発環境
- Laravel5.7
    - Botman [公式ドキュメント](http://botman.io).
- MySQL
- ngrok

# セットアップ手順
## クローン&必要なパッケージのインストール
```
$ git clone https://github.com/ttmone/like_like.git
$ cd like_like
$ composer install
$ npm install
```

## 環境変数の設定
```
$ cp .env.example .env
```

コピーした.envに以下の環境変数を設定
- APP_KEY
- SLACK_TOKEN

DBのユーザー名とパスワードは任意で変更
- DB_USERNAME
- DB_PASSWORD

## 起動
```
$ php artisan serve
```
http://localhost:8000/botman/tinker にアクセス


## Slack APIの設定
1. slack-driverのインストール
    ```
    $ php artisan botman:install-driver slack
    ```
2. Slack APIで任意のBOTを作成
3. サーバーを起動
    ```
    $ php artisan serve
    ```
4. ngrokで公開
    ```
    $ ngrok http 8000
    ```
5. events APIで http://~~~~.ngrok.io/botman を設定(~~~~の部分にはランダム文字列が入る)
