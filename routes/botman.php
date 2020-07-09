<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('好きなもの：{item}', function ($bot, $name) {
    $bot->reply('あなたの好きなものは' . $name . 'ですね');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
