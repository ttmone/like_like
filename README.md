# 開発環境
- php v7.6.4
- Node.js v11.15.0
    - npm v6.14.7
- PostgreSQL v12.3
- Laravel v5.7
    - Botman [公式ドキュメント](http://botman.io).
        - 参考: [BotmanでのSlackBot作成手順](https://blog.pusher.com/building-bot-using-botman-slack-telegram/)
- ngrok

# セットアップ手順
## クローン&必要なパッケージのインストール
```shell script
$ git clone https://github.com/ttmone/like_like.git
$ cd like_like
$ composer install
$ npm install
$ php artisan botman:install-driver slack
```

## 環境変数の設定
1. .env.exampleから.envファイルを作成
    ```shell script
    $ cp .env.example .env
    ```
2. 以下の環境変数をチャットで送信し、コピーした.envに設定
    - APP_KEY
    - SLACK_TOKEN

3. DBのユーザー名とパスワードを手元のPostgreSQLのものに変更
    - DB_USERNAME
    - DB_PASSWORD

## データベースの準備
1. PostgreSQLで "like_like" データベースを作成
2. マイグレーション
    ```shell script
    $ php artisan migrate
    ```
## 起動
```shell script
$ php artisan serve
```
http://localhost:8000/botman/tinker にアクセス

# Slackでの動作確認
## Slack APIの設定
1. Slackで任意のワークスペースを作成
2. SlackAPI上で任意のBotユーザーを作成
3. 1で作成したワークスペースにインストール
4. Permissonsを設定
    - channels:history
    - chat:write
    - im:history
    - im:read
    - im:write
    - users:read

## 動作確認方法
1. サーバーを起動
    ```shell script
    $ php artisan serve
    ```
2. ngrokで公開
    ```shell script
    $ ngrok http 8000
    ```
3. events APIで http://〇〇〇〇.ngrok.io/botman を設定(〇〇〇〇の部分にはランダム文字列が入る)
    - 2つURLが出てくるが、httpsではなく、httpの方を選ぶ