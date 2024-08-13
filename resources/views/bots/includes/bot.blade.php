<style>

.chatbot-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    width: 50px;
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

</style>


<div class="chatbot-button" id="chatbotButton">
    💬
</div>

<div class="chatbot-modal" id="chatbotModal">
    <div class="chatbot-header">
        <h2>Chatbot</h2>
        <span class="close-button" id="closeButton">&times;</span>
    </div>
    <div class="chatbot-content">
        <div class="chat-window" id="chatWindow">
            {{-- @if ($welcome_node)
            <div class="chat-message bot msg-style">
                <p>{{$welcome_node->message}}</p>
                @foreach ($welcome_node_options as $option)
                    @if ($option->option_type == 1)
                        @if ($option->type == 2)
                        <a href="{{$option->value}}" class="btn btn-success">{{$option->display_value}}</a>
                        @endif
                    @endif
                @endforeach
            </div>
            @endif
            
            <div id="other-chats">
                
            </div> --}}
        </div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="Type a message...">
            <button id="sendButton">Send</button>
        </div>
    </div>
</div>


<script>
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
            const messageElement = document.createElement('div');
            messageElement.textContent = `${sender}: ${message}`;
            chatWindow.appendChild(messageElement);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    });

</script>