<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Node;
use App\Models\NodeOption;
use App\Models\NodeOptionsAi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $welcome_node = Node::where('bot_id', '=', $bot->id)->where('type', '=', 'welcome')->first();
        $aiWorkflowNode = Node::where('bot_id', '=', $bot->id)->where('type', '=', 'ai')->first();

        $welcome_node_options = new Collection();
        if ($welcome_node) {
            $welcome_node_options = NodeOption::where('node_id', '=', $welcome_node->id)->get();
        }
        $ai_node_options = null;
        if ($aiWorkflowNode) {
            $ai_node_options = NodeOptionsAi::where('node_id', '=', $aiWorkflowNode->id)->first();
        }
        
        return view('bots.workflow', compact('bot', 'welcome_node', 'welcome_node_options', 'ai_node_options'));
    }

    public function workflowStore(Request $request)
    {
        $request->validate([
            'bot_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $node = new Node();
            $node->bot_id = $request->bot_id;
            $node->type = $request->type;
            if (count(($request->Type)) > 0) {
                $node->options = 1;
            }
            $node->message = $request->message;
            $node->save();

            if (count(($request->Type)) > 0) {
                for ($i=0; $i < count(($request->Type)); $i++) { 
                    $nodeOption = new NodeOption();
                    $nodeOption->node_id = $node->id;
                    $nodeOption->option_type = $request->option_type[$i];
                    $nodeOption->type = $request->Type[$i];
                    $nodeOption->value = $request->value[$i];
                    $nodeOption->display_value = $request->display_value[$i];
                    $nodeOption->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Record stored successfully');
        } catch (\PDOException $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', 'System error please try again');
        }
       
    }


    public function workflowStoreAi(Request $request)
    {
        $request->validate([
            'bot_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $node = new Node();
            $node->bot_id = $request->bot_id;
            $node->type ='ai';
            $node->options = 1;
            $node->save();
          
            $nodeOption = new NodeOptionsAi();
            $nodeOption->node_id = $node->id;
            $nodeOption->type = 1;
            $nodeOption->instructions = $request->instructions;
            $nodeOption->out_of_context_msg = $request->out_of_context_msg;
            $nodeOption->temperature = $request->temperature;
            $nodeOption->save();

            DB::commit();
            return redirect()->back()->with('success', 'Record stored successfully');
        } catch (\PDOException $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage(), $th->getLine());
            return redirect()->back()->with('error', 'System error please try again');
        }
       
    }

    public function getAiMessage(Request $request)
    {
        $bot = Bot::find($request->bot_id);
        $aiWorkflowNode = Node::where('bot_id', '=', $bot->id)->where('type', '=', 'ai')->first();
        $ai_node_options = null;
        if ($aiWorkflowNode) {
            $ai_node_options = NodeOptionsAi::where('node_id', '=', $aiWorkflowNode->id)->first();
        }
        $system_msg = 'From now on you are a chatbot nad you knowledge base is ' . $ai_node_options->instructions . 
        ' if user enters a question that is not answerable from your knowledge base answer the question with ' .
        $ai_node_options->out_of_context_msg . '. Take into account previous replies.';
        $user_msg = $request->user_msg;
        

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $system_msg,
                ],
                [
                    'role' => 'user',
                    'content' => $user_msg,
                ],
            ],
        ]);
        
        $responseData = $response->json();
        return response($responseData);
    }
}
