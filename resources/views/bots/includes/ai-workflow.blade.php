<div class="modal fade" id="ai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('bot.workflow.ai.store')}}" method="post">
            @csrf
            <input type="hidden" name="bot_id" value="{{$bot->id}}">
            <input type="hidden" name="option_type" value="2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Configure ai knowledge base</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body row">

                    <div class="mb-3 col-md-12">
                        <label for="exampleFormControlTextarea1" class="form-label">AI Instructions</label>
                        <p class="text-muted tx-13 mb-1">How the bot should operate.</p>
                        <textarea class="form-control" name="instructions" id="instructions" rows="5" spellcheck="false">@if($ai_node_options) {{$ai_node_options->instructions}} @endif</textarea>
                        <span class="text-danger instruction-error"></span>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="exampleFormControlTextarea1" class="form-label">AI knowledge base</label>
                        <p class="text-muted tx-13 mb-1">knowledge base to answer questions from.</p>
                        <textarea class="form-control" name="workflow" id="workflow" rows="5" spellcheck="false">@if($ai_node_options) {{$ai_node_options->workflow}} @endif</textarea>
                        <span class="text-danger workflow-error"></span>
                    </div>

                    <div class="mb-4 col-md-12">
                        <label for="out_of_context_msg" class="form-label">Out of context message</label>
                        <p class="text-muted tx-13 mb-1">Enter message to return when user enters out of context question.</p>
                        <input class="form-control" name="out_of_context_msg"  @if($ai_node_options) value="{{$ai_node_options->out_of_context_msg}}" @endif id="out_of_context_msg" autocomplete="off">
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <label for="temperature" class="form-label">Temperature</label>
                            </div>
                            <div >
                                <div style="border: 1px solid black; padding: 2px 6px 2px 6px; border-radius: 4px;" class="pl-2 pr-2">
                                    <p  id="temp_value"></p>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted tx-13 mb-1">Controls randomness: Lowering results in less random completions. As the temperature approaches zero, the model will become deterministic and repetitive.</p>
                        <input type="range" name="temperature" @if($ai_node_options) value="{{$ai_node_options->temperature}}" @endif id="temperature" min="0" max="2" step="0.1" class="form-range" >
                    </div>

                    <div class="mb-3 col-md-12">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <label for="token" class="form-label">Tokens</label>
                            </div>
                            <div >
                                <div style="border: 1px solid black; padding: 2px 6px 2px 6px; border-radius: 4px;" class="pl-2 pr-2">
                                    <p  id="token_value"></p>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted tx-13 mb-1">The maximum number of tokens to generate shared between the prompt and completion. The exact limit varies by model. (One token is roughly 4 characters for standard English text)</p>
                        <input type="range" name="tokens" @if($ai_node_options) value="{{$ai_node_options->tokens}}" @else value="256" @endif id="tokens" min="1" max="4095" step="1" class="form-range" >
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
