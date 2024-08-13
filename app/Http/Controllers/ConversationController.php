<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Conversation;
use App\Models\ConversationChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function getConversations()
    {
        $bots = Bot::where('user_id', '=', Auth::user()->id)->get();
        // foreach ($bots as $bot) {
        //     $conversations = Conversation::where('bot_id', '=', $bot->id)->get();
        //     foreach ($conversations as $key => $conversation) {
        //         $texts = ConversationChat::where('conversation_id', '=', $conversation->id)->get();
        //     }
        // }
        return view('bots.conversations', compact('bots'));
    }
}
