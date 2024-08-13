<style>
  .chat-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
        }

        .chat-modal .modal-dialog {
            margin: 0;
            position: fixed;
            bottom: 0;
            right: 0;
            width: 100%;
            max-width: 400px;
        }

        .chat-container {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .chat-box {
            height: 400px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .chat-message {
            margin-bottom: 15px;
        }

        .chat-message.bot {
            text-align: left;
            color: #495057;
        }

        .chat-message.user {
            text-align: right;
            color: #007bff;
        }

        .chat-input {
            margin-top: 20px;
        }
    /* .chat-container {
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
      padding: 2px 4px 2px 4px;
    }
    .chat-message.bot {
      width: 50%;
      text-align: left;
      white-space: normal;
        
    }
    .chat-message.user {
      width: 50%;
      text-align: right;
      white-space: normal;
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
  } */
</style>

<button type="button" class="chat-button" data-bs-toggle="modal" data-bs-target="#chatModal">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
      <path d="M2 2c-1.5 0-3 1-3 3v6c0 2 1 3 3 3h6c2 0 3-1 3-3v-3h3v3c0 2-1 3-3 3H9.586l-.707.707A1 1 0 0 1 8.5 16h-3a1 1 0 0 1-.707-.293l-3-3A1 1 0 0 1 2 12V9h1v3a1 1 0 0 0 1 1h3.586l.707-.707a1 1 0 0 1 .707-.293H12c.265 0 .52-.105.707-.293l3-3a1 1 0 0 0 .293-.707V5c0-2-1-3-3-3H2zm3 5h7a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2z"/>
  </svg>
</button>

{{-- <div class="modal fade" id="m-chat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="background-color: transparent; border:none">
            <div class="chat-container">
                <div class="chat-header">
                  Chatbot
                </div>
                <div class="chat-body" id="chat-body">
                    @if ($welcome_node)
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
</div> --}}


<div class="modal fade chat-modal" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content chat-container">
          <div class="modal-header">
              <h5 class="modal-title" id="chatModalLabel">Chatbot</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="chat-box" id="chat-body">
                @if ($welcome_node)
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
              <div class="chat-input input-group">
                  <input type="text" class="form-control" id="userInput" placeholder="Type your message...">
                  <div class="input-group-append">
                      <button class="btn btn-primary" type="button" id="sendButton">Send</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>