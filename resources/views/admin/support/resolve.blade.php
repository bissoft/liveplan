@extends('layouts.admin')
@section('style')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap");

    .container {
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }


    .contact-info {
        display: flex;
        align-items: center;
        padding: 1rem;
        background-color: #e6e6e6;
    }

    .contact-info .avatar {
        width: 75px;
        height: 75px;
    }

    .contact-info .avatar img {
        width: 100%;
        height: 100%;
        border-radius: 9999px;
    }

    .contact-info .user-info {
        margin-left: 1rem;
        color: #333333;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .input-area {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 1.5rem 2rem;
    }

    .input-area input[type=text] {
        padding: 0.6rem 0.4rem;
        outline: none;
        border-radius: 7px;
        border: 1px solid #d8d8d8;
        width: 100%;
        font-family: "Open Sans", sans-serif;
        font-size: 1rem;
    }

    .input-area button {
        outline: none;
        border: none;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        margin-left: 0.4rem;
        border: 1px solid #d8d8d8;
        cursor: pointer;
    }

    .input-area button:hover {
        background-color: #e6e6e6;
    }

    .input-area .fa-paper-plane {
        color: #00c3ff;
    }

    .chat-box {
        width: 100%;
        height: 100%;
        padding: 0.2rem 1rem;
        display: flex;
        flex-direction: column-reverse;
        overflow-y: auto;
    }

    .message {
        padding: 0.3rem 1rem;
        margin: 0.5rem 0;
        border-radius: 7px;
        width: fit-content;
    }

    .message .timestamp {
        color: #646464;
        font-size: 0.6rem;
    }

    .message.primary {
        text-align: right;
        background-color: #d8d8d8;
        margin-left: auto;
    }

    .message.secondary {
        text-align: left;
        background-color: #98FB98;
        margin-right: auto;
    }

    /* Media Queries */
    @media only screen and (max-width: 600px) {
        .contact-info .avatar {
            width: 35px;
            height: 35px;
        }
    }
</style>
@endsection
@section('content')
<div class="main-content">
    <div class="container">
        <div class="card-body bg-white">
            <h3>{{$issue->issue}}</h3>
        </div>

        <div class="chat-box" id="chat-box">

        </div>
        <div class="input-area">
            <input type="text" id="comment">
            <button onclick="return send_comment()"><i class="fas fa-paper-plane"></i></button>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
 function send_comment(){
    if(document.getElementById('comment').value == '')
    return false;
     $.ajax({
        url : '{{route('admin.comment.send')}}',
        data : {'comment': document.getElementById('comment').value, 'issue_id' : '{{$issue->id}}'},
        method : 'GET'
     }).then(function(data){
         fetch_messages();
         document.getElementById('comment').value = '';
     });
 }
 function fetch_messages(){
    $.ajax({
        url : '{{route('admin.comment.fetch')}}',
        data : {'issue_id' : '{{$issue->id}}'},
        method : 'GET'
     }).then(function(data){
        document.getElementById('chat-box').innerHTML = data;
     });
 }
 document.getElementById('comment').addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    send_comment();
  }
});
     fetch_messages();
</script>
@endsection