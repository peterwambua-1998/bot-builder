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

@if($ai_node_options)
<div class="chatbot-button" id="chatbotButton">
    💬 Test Bot
</div>
@endif

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


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatbotButton = document.getElementById('chatbotButton');
        const chatbotModal = document.getElementById('chatbotModal');
        const closeButton = document.getElementById('closeButton');
        const sendButton = document.getElementById('sendButton');
        const chatWindow = document.getElementById('chatWindow');
        const userInput = document.getElementById('userInput');

        chatbotButton.addEventListener('click', function () {
            chatbotModal.style.display = 'block';
        });

        closeButton.addEventListener('click', function () {
            chatbotModal.style.display = 'none';
        });

        sendButton.addEventListener('click', function () {
            const userMessage = userInput.value.trim();
            if (userMessage) {
                addMessage('User', userMessage);
                userInput.value = '';
                // Simulate bot response
                setTimeout(() => addMessage('Bot', 'This is a bot response.'), 1000);
            }
        });

        function addMessage(sender, message) {
            let messageElement = document.createElement('div');
            messageElement.textContent = `${sender}: ${message}`;
            console.log(chatWindow);
            
            chatWindow.appendChild(messageElement);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    });

</script> --}}