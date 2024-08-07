<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function index()
    {
        $bots = Bot::all();
        return view('bots.index', compact('bots'));
    }

    public function create()
    {
        return view('bots.create');
    }

    public function store(Request $request)  
    {
        $request->validate([
            'name' => 'required'
        ]);

        $bot = new Bot();
        $bot->name = $request->name;
        if ($bot->save()) {
            return redirect()->route('bot.workflow', $bot->id)->with('success', 'Bot created successfully');
        }
        return redirect()->back()->with('error', 'System error please try again!');
    }

    public function workflow($id)
    {
        $bot = Bot::find($id);
        return view('bots.workflow', compact('bot'));
    }

    public function workflowStore(Request $request)
    {
        $request->validate([
            'bot_id' => 'required'
        ]);
    }
}
