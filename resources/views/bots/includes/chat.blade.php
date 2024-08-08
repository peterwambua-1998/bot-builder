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
    }
    .chat-message.bot {
      text-align: left;
      border: 1px solid black;
      border-radius: 5px;
      width: max-content;
      padding: 2px 4px 2px 4px;
        
    }
    .chat-message.user {
      text-align: right;
    }
    .chat-footer {
      padding: 10px;
      border-top: 1px solid #ddd;
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
                    <div class="chat-message">
                        <p class="chat-message bot">peter</p>
                    </div>
                </div>
                <div class="chat-footer">
                  <div class="input-group">
                    <input type="text" class="form-control" id="user-input" placeholder="Type a message">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button" id="send-btn">Send</button>
                    </div>
                  </div>
                </div>
              </div>
      </div>
    </div>
  </div>