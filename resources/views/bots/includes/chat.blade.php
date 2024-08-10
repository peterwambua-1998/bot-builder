<style>
    .chat-container {
        width: 800px;
      margin: 50px auto;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .chat-header {
      background-color: #007bff;
      color: white;
      padding: 10px;
      border-bottom: 1px solid #ddd;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }
    .chat-body {
      height: 400px;
      overflow-y: scroll;
      padding: 10px;
      background-color: #f8f9fa;
    }
    .chat-message {
      margin-bottom: 15px;
      border: 1px solid black;
      border-radius: 5px;
      width: max-content;
      padding: 2px 4px 2px 4px;
    }
    .chat-message.bot {
      width: 100%;
      text-align: left;
        
    }
    .chat-message.user {
      width: 100%;
      text-align: right;
    }
    .chat-footer {
      padding: 10px;
      border-top: 1px solid #ddd;
    }

    .msg-style {
      animation: slideInLeft 600ms ease 0s 1 normal both;
    }

    @keyframes slideInLeft {
        0% {
            transform: translateY(-100px);
        }

        
        100% {
            transform: translateY(0px);
        }
    }
    .typing-indicator {
    display: flex;
    align-items: center;
    font-size: 24px;
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

<div class="modal fade" id="m-chat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="background-color: transparent; border:none">
            <div class="chat-container">
                <div class="chat-header">
                  Chatbot
                </div>
                <div class="chat-body" id="chat-body">
                    @if ($welcome_node->message)
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
                     
                    </div>
                </div>
                <div class="chat-footer">
                  <div class="input-group">
                    <input type="text" class="form-control" id="userInput" placeholder="Type a message">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button" id="sendButton">Send</button>
                    </div>
                  </div>
                </div>
          </div>
      </div>
    </div>
</div>