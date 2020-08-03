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

        $slack_id = $request->input('event.user');
        $user = new User;
        $user->slack_id = $slack_id;
        $user->user_name = 'テスト';
        $user->introduced_count = 0;
        $user->introduced_last_time = false;

        logger($slack_id);

//        $user->save();

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
