# デモ
<img width="618" alt="スクリーンショット 2020-08-07 12 21 45" src="https://user-images.githubusercontent.com/39648121/89605512-ad310e00-d8a8-11ea-9d49-ca9dff11b59a.png">

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
    ![image](https://user-images.githubusercontent.com/39648121/90381368-3e2d9380-e0b8-11ea-859a-13c3989d84d3.png)
2. [SlackAPIのyour apps](https://api.slack.com/apps)でBotを作成
    ![image](https://user-images.githubusercontent.com/39648121/90382306-8dc08f00-e0b9-11ea-93ce-f303a8b7d16b.png)
2. [SlackAPI](https://api.slack.com/)のPermissonsでBot Token Scopesを設定
    ![image](https://user-images.githubusercontent.com/39648121/90381396-4980bf00-e0b8-11ea-85e4-390d38a41d55.png)
    - channels:history
    - chat:write
    - im:history
    - im:read
    - im:write
    - users:read
    ![image](https://user-images.githubusercontent.com/39648121/90383051-95ccfe80-e0ba-11ea-97f5-3d199de09711.png)
3. 1で作成したワークスペースにインストール
    ![image](https://user-images.githubusercontent.com/39648121/90381471-65846080-e0b8-11ea-9bc2-ef61ecdf97ca.png)
4. Bot User OAuth Access Tokenを .envの SLACK_TOKENに設定    

## 動作確認方法
1. サーバーを起動
    ```shell script
    $ php artisan serve
    ```
2. ngrokで公開
    ```shell script
    $ ngrok http 8000
    # dockerを使用している場合は 8080
    ```
    ![image](https://user-images.githubusercontent.com/39648121/90381814-df1c4e80-e0b8-11ea-929c-4a67f7907772.png)
3. ngrokのURLにアクセス
    - 成功していればbotmanの初期画面が表示される
    ![image](https://user-images.githubusercontent.com/39648121/90381967-1985eb80-e0b9-11ea-9a72-2c29b480a49b.png)
4. events APIで http://〇〇〇〇.ngrok.io/botman を設定(〇〇〇〇の部分にはランダム文字列が入る)
    - 2つURLが出てくるが、httpsではなく、httpの方を選ぶ
    ![image](https://user-images.githubusercontent.com/39648121/90381814-df1c4e80-e0b8-11ea-929c-4a67f7907772.png)
    ![image](https://user-images.githubusercontent.com/39648121/90383213-c9a82400-e0ba-11ea-9868-1de60df28ce8.png)
    １度目では成功せず、２度目のretryで成功することがある。
5. Subscribe to bot eventsに以下の2つを設定
    - message.channels
    - message.im
    ![image](https://user-images.githubusercontent.com/39648121/90381623-96fd2c00-e0b8-11ea-81c2-d4e6ad5dad16.png)
6. Botとのメッセージで"Hi"と打って、"Hello"と返ってきたら成功
    ![image](https://user-images.githubusercontent.com/39648121/90383367-0247fd80-e0bb-11ea-936b-baf5ee8266ad.png)