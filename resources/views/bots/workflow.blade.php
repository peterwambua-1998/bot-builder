@extends('layouts.app')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@section('content')

<nav class="page-breadcrumb" style="display:flex; justify-content: space-between">
    <ol class="breadcrumb" style="width: 85%">
      <li class="breadcrumb-item"><a href="{{route('bots.index')}}">Bot</a></li>
      <li class="breadcrumb-item active" aria-current="page">workflow</li>
    </ol>
   
</nav>

@include('error-display')


<div class="row mb-2">
    <div class="col-md-12">
        <h6 class="card-title">{{$bot->name}}</h6>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome message</h5>
                <p class="card-text text-muted">add welcome message and dictate conversation directions with buttons.</p>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mt-2">Configure</button>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ai knowledge base</h5>
                <p class="card-text text-muted">configure ai knowledge base to enable answering based on your own context.</p>
                <button data-bs-toggle="modal" data-bs-target="#ai" class="btn btn-primary mt-2">Configure</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('bot.workflow.store')}}" method="post" id="welcome-workflow-form">
            @csrf
            <input type="hidden" name="bot_id" value="{{$bot->id}}">
            <input type="hidden" name="type" value="welcome">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Configure welcome message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body row">
                    {{-- node type of input with options --}}
                    <input type="hidden" name="node_type" value="1"> 

                    <div class="mb-4 col-md-12">
                        <label for="name" class="form-label">Define your welcome message</label>
                        <input id="welcome-msg-input" type="text" @if ($welcome_node) value="{{$welcome_node->message}}"` @endif class="form-control" name="message" autocomplete="off" placeholder="Ex: Hello you can checkout our products...">
                        <span class="text-danger welcome-msg-input-error"></span>
                    </div>

                    <div class="mb-4 col-md-12">
                        <input type="checkbox" name="is_options" class="form-check-input" @if ($welcome_node_options->count() > 0) checked @endif id="add_options" value="off">
                        <label class="form-check-label" for="checkDefault">
                        Add options to welcome message 
                        </label>
                    </div>

                    <input type="hidden" id="options_count" value="{{count($welcome_node_options)}}">

                    <div id="options_area">
                        @if (count($welcome_node_options) > 0)
                            @foreach ($welcome_node_options as $op)
                                <div class="mb-4 p-3" style="border: 1px solid #cbd5e1; border-radius: 5px;">
                                    <div class="mb-2 col-md-12">
                                        <label for="name" class="form-label">Define your welcome message</label>
                                        <select name="Type[]" class="form-select type-option">
                                            <option value="0">Choose option...</option>
                                            <option @if($op->type == 1) selected @endif value="1">conversational</option>
                                            <option @if($op->type == 2) selected @endif value="2">link</option>
                                        </select>
                                        <span class="text-danger type-option-error"></span>
                                    </div>
                                    <input type="hidden" name="option_type[]" value="1">
                                    <div class="mb-2 col-md-12">
                                        <label for="name" class="form-label">Button display value</label>
                                        <input type="text" class="form-control display_value" value="{{$op->display_value}}" name="display_value[]" autocomplete="off" placeholder="Enter display value">
                                        <span class="text-danger"></span>
                                    </div>
            
                                    <div class="mb-2 col-md-12">
                                        <label for="name" class="form-label">Button action</label>
                                        <input type="text" class="form-control button-action" name="value[]" value="{{$op->value}}" autocomplete="off" placeholder="Enter value">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="mb-4 p-3" style="border: 1px solid #cbd5e1; border-radius: 5px;">
                                <div class="mb-2 col-md-12">
                                    <label for="name" class="form-label">Type of button</label>
                                    <select name="Type[]" class="form-select type-option" >
                                        <option value="0">Choose option...</option>
                                        <option value="1">conversational</option>
                                        <option value="2">link</option>
                                    </select>
                                    <span class="text-danger type-option-error"></span>
                                </div>
                                <input type="hidden" name="option_type[]" value="1">
                                <div class="mb-2 col-md-12">
                                    <label for="name" class="form-label">Button value</label>
                                    <input type="text" class="form-control display_value" name="display_value[]" autocomplete="off" placeholder="Enter display value">
                                    <span class="text-danger"></span>
                                </div>
        
                                <div class="mb-2 col-md-12">
                                    <label for="name" class="form-label">Button action</label>
                                    <input type="text" class="form-control button-action" name="value[]" autocomplete="off" placeholder="Enter value">
                                    <span class="text-danger"></span>
                                </div>

                                

                            </div>
                        @endif
                        

                        <div class="extra_buttons">
                            
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-xs" id="add_button">Add option</button>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="submit-btn-welcome-msg">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>


@include('bots.includes.ai-workflow')
@include('bots.includes.bot')

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('js/validation.js') }}" defer></script>
@endpush

@push('custom-scripts')
    <script defer>
        $(document).ready( function () {
            let count_node_options = Number($('#options_count').val());
            if (count_node_options > 0) {
                $('#options_area').show();
            } else {
                $('#options_area').hide();
            }
            $('#add_options').on('click', () => {
                $('#options_area').toggle();
            })

            $('#add_button').on('click', (e) => {
                let template = `
                    <div class="mb-4 p-3" style="border: 1px solid #cbd5e1; border-radius: 5px;">
                        <div class="mb-2 col-md-12">
                            <label for="name" class="form-label">Type of button</label>
                            <select name="Type[]" class="form-select type-option" id="">
                                <option value="0">Choose option...</option>
                                <option value="1">conversational</option>
                                <option value="2">link</option>
                            </select>
                            <span class="text-danger type-option-error"></span>
                        </div>
                        <input type="hidden" name="option_type[]" value="1">
                        <div class="mb-2 col-md-12">
                            <label for="name" class="form-label">Button value</label>
                            <input type="text" class="form-control display_value" name="display_value[]" autocomplete="off" placeholder="Enter display value">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-2 col-md-12">
                            <label for="name" class="form-label">Button action</label>
                            <input type="text" class="form-control button-action" name="value[]" autocomplete="off" placeholder="Enter value">
                            <span class="text-danger"></span>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-outline-danger btn-xs remove_option" >remove</button>
                        </div>
                    </div>
                `;

                $('.extra_buttons').append(template)

                removeOptions();

            });


            $('#temp_value').text($('#temperature').val())
            $('#temperature').on('input', (e) => {
                $('#temp_value').text($('#temperature').val())
                
            })

            $('#token_value').text($('#tokens').val())
            $('#tokens').on('input', (e) => {
                $('#token_value').text($('#tokens').val())
                
            })


            $('.bot-test').on('click', () =>  {
                $('#other-chats').children().remove();
            });
            
        } );

        function removeOptions() {
            $('.remove_option').each((i, e) => {
                
                $(e).on('click', () => {
                    let parent = $(e).parent().parent().remove()
                })
            });
        }

        const chatbotButton = document.getElementById('chatbotButton');
        const chatbotModal = document.getElementById('chatbotModal');
        const closeButton = document.getElementById('closeButton');
        const sendButton = document.getElementById('sendButton');
        const chatWindow = document.getElementById('chatWindow');
        const userInput = document.getElementById('userInput');

        chatbotButton.addEventListener('click', function () {
            chatbotModal.style.display = 'block';
            let myuuid = crypto.randomUUID();
            sessionStorage.setItem("chatbot-conversation-id", myuuid);
            $('#chatWindow').children().not(':first').remove()

            $('.conversation').each((i, e) => {
                $(e).on('click', () => {
                    let btn_value = $(e).text();
                    appendMessage('user', btn_value);
                    conversationBtn(btn_value);
                })
            })
        });

        closeButton.addEventListener('click', function () {
            chatbotModal.style.display = 'none';
        });


        document.getElementById('sendButton').addEventListener('click', async function() {
            var userInput = document.getElementById('userInput').value;
            if (userInput.trim() !== '') {
                document.getElementById('userInput').value = '';
                appendMessage('user', userInput);

                let template = `

                    <div class="indicator">
                        <div class="chat-message bot ">
                            <div class="typing-indicator">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                        </div>
                    </div>
                `

                $('#chatWindow').append(template)

                const url = '/bots/ai/response'; // Replace with your API endpoint
                const data = { bot_id: '{{$bot->id}}', user_msg: userInput, '_token': '{{csrf_token()}}', 'chatbot_conversation_id': sessionStorage.getItem("chatbot-conversation-id"), }; // Replace with your data

                const result = await postData(url, data);

                $('.indicator').children().remove();
                
                appendMessage('bot', result.choices[0].message.content);

               
            }
        });

        async function conversationBtn(value){
            let template = `

            <div class="indicator">
                <div class="chat-message bot ">
                    <div class="typing-indicator">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
            `

            $('#chatWindow').append(template)

            const url = '/bots/ai/response'; // Replace with your API endpoint
            const data = { bot_id: '{{$bot->id}}', user_msg: value, '_token': '{{csrf_token()}}', 'chatbot_conversation_id': sessionStorage.getItem("chatbot-conversation-id"), };
            const result = await postData(url, data);

            console.log(result);
            

            $('.indicator').children().remove();
            appendMessage('bot', result.choices[0].message.content);

            // we can initiate sending email 
            const conversation_data = {bot_id: '{{$bot->id}}', 'chatbot_conversation_id': sessionStorage.getItem("chatbot-conversation-id"), '_token': '{{csrf_token()}}'}
            const email_url = '/bot/conversation/email';
            const email_result = await postData(email_url, conversation_data);
        }

        function appendMessage(sender, message) {
            var chatBox = document.getElementById('chatBox');
            var messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message ' + sender;
            messageDiv.textContent = message;
            chatWindow.appendChild(messageDiv);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
        
        async function postData(url = '', data = {}) {
            const response = await fetch(url, {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify(data) // body data type must match "Content-Type" header
            });
            
            return response.json(); // parses JSON response into native JavaScript objects
        }

    </script>
@endpush