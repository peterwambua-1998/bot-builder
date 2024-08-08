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
                        <label for="exampleFormControlTextarea1" class="form-label">Ai Instructions</label>
                        <p class="text-muted tx-13 mb-1">knowledge base on how to answer questions.</p>
                        <textarea class="form-control" name="instructions" id="exampleFormControlTextarea1" rows="5" spellcheck="false"></textarea>
                    </div>

                    <div class="mb-4 col-md-12">
                        <label for="out_of_context_msg" class="form-label">Out of context message</label>
                        <p class="text-muted tx-13 mb-1">Enter message to return when user enters out of context question.</p>
                        <input class="form-control" name="out_of_context_msg" id="out_of_context_msg">
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
                        <input type="range" name="temperature" id="temperature" min="0" max="2" step="0.1" class="form-range" >
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
