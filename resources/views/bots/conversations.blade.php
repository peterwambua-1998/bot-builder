@extends('layouts.app')
@push('plugin-styles')
    <style>
      body, html {
          overflow-x: hidden;
      }

      .drawer {
        /* height: 100%; */
        width: 30vw;
        position: absolute;
        background: #f1f5f9;
        top: 60px;
        right: 0;
        bottom: 0px;
        border: 1px solid rgba(0, 0, 0, 0.192);
        display: none;
        animation: slideInRight 1s ease-in 0s 1 normal both;
      }

      .inner-drawer {
        height: 90%;
        overflow-x: auto;
        background: #fff;
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

      @keyframes slideInRight {
        0% {
          transform: translateX(40vw);
        }

        
        100% {
          transform: translateX(0px);
        }
      }
    </style>
@endpush
@section('content')

<nav class="page-breadcrumb" style="display:flex">
    <ol class="breadcrumb" style="width: 85%">
      <li class="breadcrumb-item"><a href="#">Bots</a></li>
      <li class="breadcrumb-item active" aria-current="page">Conversations</li>
    </ol>
</nav>

@include('error-display')

<div class="row" >
    <div class="col-md-12 grid-margin stretch-card " >
      <div class="card">
        <div class="card-body">
            <h6 class="card-title">Material Requisition Table</h6>
            <p class="text-muted mb-3"></p> 
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTableExample">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Bot</th>
                          <th>conversation id</th>
                          <th>DateTime</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $num = 1 ?>
                      @foreach ($bots as $bot)
                          <?php
                            $conversations = \App\Models\Conversation::where('bot_id', '=', $bot->id)->get();
                          ?>
                          @foreach ($conversations as $conversation)
                          <?php
                            $conversations = \App\Models\Conversation::where('bot_id', '=', $bot->id)->get();
                          ?>
                          <tr>
                            <td>{{$num}} <?php $num++ ?></td>
                            <td>{{$bot->name}}</td>
                            <td>{{$conversation->conversation_id}}</td>
                            <td>{{$conversation->created_at}}</td>
                            <td class="show" data-id="chat-{{$conversation->id}}">show</td>
                          </tr>
                          @endforeach
                      @endforeach
                      
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>

@foreach ($bots as $bot)
<?php
  $conversations = \App\Models\Conversation::where('bot_id', '=', $bot->id)->get();
?>
@foreach ($conversations as $conversation)

<div class="drawer px-4 py-2" id="chat-{{$conversation->id}}">
  <div class="mb-2" style="display: flex; justify-content: end;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle close-drawer"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
  </div>
  <?php
    $chats = \App\Models\ConversationChat::where('conversation_id', '=', $conversation->id)->get();
  ?>
  <div class="inner-drawer p-2">
    @foreach ($chats as $chat)
      @if ($chat->bot_msg)
        <div class="chat-message bot msg-style">{{$chat->bot_msg}}</div>
      @else
        <div class="chat-message user msg-style">{{$chat->user_msg}}</div>
      @endif
    @endforeach
  </div>
</div>
@endforeach
@endforeach


@endsection

@push('custom-scripts')
    <script defer>
        $(document).ready( function () {
          $('.show').each((i, e) => {
            $(e).on('click', () => {
              let id = $(e).data('id');
              console.log(id);
              

              $(`#${id}`).css('display','block')
            });
          })

          $('.close-drawer').each((i, e) => {
            $(e).on('click', () => {
              $(e).parent().parent().css('display', 'none')
            })
          })
        })
    </script>
@endpush
