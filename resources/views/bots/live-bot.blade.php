
    <style>
        .chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            width: 150px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .chatbot-modal {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            max-height: 400px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            z-index: 1000;
        }
        
        .chatbot-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .close-button {
            cursor: pointer;
            font-size: 18px;
        }
        
        .chatbot-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .chat-window {
            flex-grow: 1;
            height: 250px; /* Set a fixed height for the message area */
            padding: 10px;
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
        }
        
        .chat-input {
            display: flex;
            padding: 10px;
        }
        
        .chat-input input {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .chat-input button {
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .chat-message {
            margin-bottom: 15px;
            max-width: fit-content;
            padding: 10px;
            border-radius: 10px;
            position: relative;
        }
        
        .chat-message.bot {
            background-color: #e9ecef;
            text-align: left;
            align-self: flex-start;
        }
        
        .chat-message.user {
            background-color: #007bff;
            color: white;
            text-align: right;
            align-self: flex-end;
            margin-left: auto;
        }
        
        .dot {
              width: 8px;
              height: 8px;
              margin: 0 2px;
              background-color: #333;
              border-radius: 50%;
              display: inline-block;
              animation: bounce 1.2s infinite ease-in-out;
          }
        
          .dot:nth-child(1) {
              animation-delay: 0s;
          }
        
          .dot:nth-child(2) {
              animation-delay: 0.2s;
          }
        
          .dot:nth-child(3) {
              animation-delay: 0.4s;
          }
        
          @keyframes bounce {
              0%, 80%, 100% {
                  transform: scale(0);
              }
              40% {
                  transform: scale(1);
              }
          }
        
    </style>

    <div class="chatbot-button" id="chatbotButton">
        💬 
    </div>
    
    <div class="chatbot-modal" id="chatbotModal">
        <div class="chatbot-header">
            <h4>Chatbot</h4>
            <span class="close-button" id="closeButton">&times;</span>
        </div>
        <div class="chatbot-content">
            <div class="chat-window" id="chatWindow">
                @if ($welcome_node)
                <div class="chat-message bot msg-style">
                    <p>{{$welcome_node->message}}</p>
                    @foreach ($welcome_node_options as $option)
                        @if ($option->option_type == 1)
                            @if ($option->type == 2)
                            <a href="{{$option->value}}" class="btn btn-outline-success btn-sm mt-2">{{$option->display_value}}</a>
                            @endif
    
                            @if ($option->type == 1)
                            <button class="btn btn-outline-success btn-sm mt-2 conversation">{{$option->value}}</button>
                            @endif
                        @endif
                    @endforeach
                </div>
                @endif
                
                <div id="other-chats">
                    
                </div>
                
            </div>
            <div class="chat-input">
                <input type="text" id="userInput" placeholder="Type a message...">
                <button id="sendButton">Send</button>
            </div>
        </div>
    </div>
    
    <script
    src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
    crossorigin="anonymous"></script>
    <script>
        const chatbotButton = document.getElementById('chatbotButton');
        const chatbotModal = document.getElementById('chatbotModal');
        const closeButton = document.getElementById('closeButton');
        const sendButton = document.getElementById('sendButton');
        const chatWindow = document.getElementById('chatWindow');
        const userInput = document.getElementById('userInput');

        chatbotButton.addEventListener('click', function () {
            chatbotModal.style.display = 'block';
            if (sessionStorage.getItem("chatbot-conversation-id") == null || sessionStorage.getItem("chatbot-conversation-id") == undefined) {
                let myuuid = crypto.randomUUID();
                sessionStorage.setItem("chatbot-conversation-id", myuuid);
                $('#chatWindow').children().not(':first').remove()
            }

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

                const url = 'http://127.0.0.1:8000/bots/ai/response'; // Replace with your API endpoint
                const data = { bot_id: '{{$bot->id}}', user_msg: userInput, '_token': '{{csrf_token()}}', 'chatbot_conversation_id': sessionStorage.getItem("chatbot-conversation-id"), }; // Replace with your data

                const result = await postData(url, data);

                $('.indicator').children().remove();

                console.log(result);
                
                appendMessage('bot', result.choices[0].message.content);
                console.log(sessionStorage.getItem("chatbot-conversation-id"));
                
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



    
    
    
    
    