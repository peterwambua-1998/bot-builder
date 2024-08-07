<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function index()
    {
        $bots = Bot::all();
        return response($bots);
    }

    public function store(Request $request)
    {
        $json = json_decode($request->getContent(), true);

        $bot = new Bot();
        $bot->name = $json['name'];
        if ($bot->save()) {
            return response(1);
        }
        return response(0);
    }

    public function edit(Request $request)
    {
        $json = json_decode($request->getContent(), true);

        $bot = new Bot($json['bot_id']);
        $bot->name = $json['name'];
        if ($bot->update()) {
            return response(1);
        }
        return response(0);
    }
}
