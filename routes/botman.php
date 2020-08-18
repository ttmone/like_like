<?php
use App\Http\Controllers\BotManController;
use App\User;
use App\Item;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('好きなもの：{item}', function ($bot, $item_content) {
    // slackのリクエストから、メッセージを送信したユーザーのslack_idを取得
    $request = request();
    $slack_id = $request['event']['user'];

    // slack_idを元に、WebAPI経由でユーザー名を取得
    // "laravel-slack-api"パッケージを利用
    // 参考: https://github.com/vluzrmos/laravel-slack-api
    $user_info = SlackUser::info($slack_id); // APIにリクエストを送信
    $user_info = json_decode(json_encode($user_info, JSON_PRETTY_PRINT), true); //単なる文字列→JSON化→PHPの連想配列化
    $user_name = $user_info['user']['name'];

    // まだ登録されていないユーザーなら登録。登録済みのユーザーはfind。
    // 参考: https://readouble.com/laravel/5.7/ja/eloquent.html
    $user = User::firstOrNew(['slack_id' => $slack_id], ['name' => $user_name]);
    if (!$user->exists) {
        $user->slack_id = $slack_id;
        $user->save();
    }


    // 上記で呼び出しor作成したユーザーに紐づいたアイテムを作成
    $item = new Item();
    $item->content = $item_content;
    $user->items()->save($item);

    $bot->reply("好きなものとして $item_content が追加されました！");
});

$botman->hears('リマインダー : 紹介', function ($bot) {
    SlackChat::postMessage(env('CHANNEL_ID'), 'これはユーザーのアイテム紹介用のダミーテキストです');
    return;
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
