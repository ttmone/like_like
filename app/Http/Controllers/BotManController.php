<?php

namespace App\Http\Controllers;

use App\User;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle(Request $request)
    {
        // Slackのリクエストが再送された場合、キャンセルする
        // 参考: https://dev.classmethod.jp/articles/slack-resend-matome/
        if($request->header('X-Slack-Retry-Num')) {
            return [
                'statusCode' => 200,
                'body' => ['message' => "No need to resend"]
            ];
        };

        $botman = app('botman');
        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
}
