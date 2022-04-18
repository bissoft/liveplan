@extends('layouts.admin')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
.athlete-chat .user-tabs{
   max-height: 70vh;
   min-height: 70vh;
   overflow: auto;
   }
   .athlete-chat .user-tabs .user{
   padding: 10px;
   border-bottom: 1px solid gainsboro;
   cursor: pointer;
   padding: 10px;
   }
   .athlete-chat .user-tabs .active , .athlete-chat .user-tabs .user:hover{
   background-color: #ffdfca;
   }
   .athlete-chat .user-tabs .media img{
   width: 40px;
   height: 40px;
   border-radius: 100%;
   }
   .athlete-chat .user-tabs .media h5{
   font-size: 14px;
   font-weight: 600;
   color: black;
   }
   .athlete-chat .user-tabs .media p{
   font-size: 13px;
   display: -webkit-box;
   -webkit-line-clamp: 1;
   -webkit-box-orient: vertical;
   overflow: hidden;
   text-overflow: ellipsis;
   }
   .athlete-chat  .chat-person .online-badge
   {
   width: 10px;
   height: 10px;
   background: #1aca1a;
   border-radius: 100%;
   margin: 10px;
   }
   .athlete-chat  .chat-person  .top-bar{
   background-color: white;
   border-bottom: 1px solid #d1d1d1;
   }
   .athlete-chat .messages{
   min-height: 70vh;
   max-height: 70vh;
   overflow: auto;
   padding: 20px;
   }
   .athlete-chat .messages .media{
   margin-bottom: 20px;
   }
   .athlete-chat .messages .media img{
   width: 40px;
   height: 40px;
   border-radius: 100%;
   }
   .athlete-chat .messages .media h5{
   font-size: 14px;
   font-weight: 600;
   color: black;
   }
   .athlete-chat .messages .media p{
   font-size: 13px;
   line-height: 20px;
   margin-top: 7px;
   }
   .athlete-chat  .message-type textarea{
       resize: none;
   
   }
   .athlete-chat .about-chat-person {
   padding: 10px;
   }
   .athlete-chat .about-chat-person img{
       width: 80px;
       height: 80px;
       border-radius: 100%;
       margin: 20px auto 20px auto;
   }
    #display {
        background: lightgray;
        margin-top: 2px;
        margin-bottom: 2px;
    }

    #display ul {
        padding: 0;
        margin-top: 6px;
    }

    #display li {
        padding-top: 5px;
        padding-bottom: 5px;
        background: #393938;
        color: white;
        margin-top: 2px;
        margin-bottom: 2px;
        display: flex;
        justify-content: space-between;
    }

    .tags-input-wrapper {
        background: transparent;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .tags-input-wrapper input {
        border: none;
        background: transparent;
        outline: none;
        width: 140px;
        margin-left: 8px;
    }

    .tags-input-wrapper .tag {
        display: inline-block;
        background-color: #fa0e7e;
        color: white;
        border-radius: 40px;
        padding: 0px 3px 0px 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        box-shadow: 0 5px 15px -2px rgba(250, 14, 126, .7)
    }

    .tags-input-wrapper .tag a {
        margin: 0 7px 3px;
        display: inline-block;
        cursor: pointer;
    }
    small{
        color:gray;
        font-size: 12px;
    }
    .media img {
        height: 40px;
        width: 40px;
    }
</style>
@endsection


@section('content')
<div class="content">
    <div class="container-fluid">
        <button class="btn btn-primary mb-2 py-2" id="cg">Create Group</button>
        <section class="athlete-chat padding-bottom-70px">
            <div class="container-fluid ">
                <div class="row  border mx-md-0 no-gutters">
                    <div class="col-12 col-md-3 px-md-0" style="border-right: 1px solid #c5c4c4;">
                        <div class="search row no-gutters border mx-md-0">
                            <input type="text" name="" class="col-9 border-0 pl-3" style="min-height: 59px;" placeholder="Search…">
                            <button class="btn border bg-white border-0 col-3" style=" border-radius: 0;"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="user-tabs">
                            @if($chats->count())
                            @foreach($chats as $chat)
                            @if($chat->user1 && $chat->user2)
                            <div class="user @if($chat_open->id == $chat->id) active @endif" data-chat_id="{{ $chat->id }}">
                                <div class="media">
                                    <img class="mr-3" src="{{ ($chat->user1_id == auth()->user()->id ? $chat->user2->image : $chat->user1->image) ?? '/dash-assets/images/team2.jpg' }}" alt=" image">
                                    @php $last_msg = $chat->last_msg ?? null @endphp
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mt-0">{{ $chat->user1_id == auth()->user()->id ? $chat->user2->name : $chat->user1->name }}</h5>
                                            <small>{{ $last_msg ? $last_msg->created_at : '' }}</small>
                                        </div>
                                        <p>{{ $last_msg ? $last_msg->text : '' }}</p>
                                    </div>
                                </div>
                            </div>
                            @elseif($chat->type == 'group')
                            <div class="user @if($chat_open->id == $chat->id) active @endif" data-chat_id="{{ $chat->id }}">
                                <div class="media">
                                    <img class="mr-3" src="{{url('/storage/c.png')}}" alt=" image">
                                    @php $last_msg = $chat->last_msg ?? null @endphp
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mt-0">{{ $chat->group_name }}</h5>
                                            <small>{{ $last_msg ? $last_msg->created_at : '' }}</small>
                                        </div>
                                        <p>{{ $last_msg ? $last_msg->text : '' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <p class="text-center">No chats found</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-9 ">
                        @if($chats->count() && $chat_open->user1 && $chat_open->user2)
                        @php
                        $chat_user = $chat_open->user1_id == auth()->user()->id ? $chat_open->user2 : $chat_open->user1;
                        @endphp
                        <div class="chat-person" data-id="{{ $chat_user->id }}">
                            <div class="top-bar ">
                                <div class="d-flex align-items-center">
                                    <span class="online-badge"></span>
                                    <h5 class="font-weight-bold text-dark mt-1">{{ $chat_user->name }}</h5>
                                </div>
                                <p class="pl-4 mb-0">online</p>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-12 ">
                                    <div class="messages">
                                        @include('admin.chats.messages', ['messages' => $messages])
                                    </div>
                                    <div class="message-type">
                                        <div class="media sent-msg d-none">
                                            <img class="mr-3" src="{{ auth()->user()->image ?? '/dash-assets/images/team1.jpg' }}" alt=" image">
                                            <div class="media-body">
                                                <h5 class="mt-0">{{ auth()->user()->name   }} <small>{{ \Carbon\Carbon::now() }}</small></h5>
                                                <p class="content"></p>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-group  m-0">
                                                <textarea class="form-control msg"style="
    border-radius: 5px;
" data-chat_id="{{ $chat_open->id }}" id="exampleFormControlTextarea1" rows="4" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-between ">
                                                {{--@if(!auth()->user()->is_admin) <button class="btn btn-outline-dark my-3 px-4 create-offer" data-toggle="modal" data-target="#exampleModalCenter">Create Offer</button> @endif--}}
                                                <button class="btn btn-primary my-3 px-4 send-msg" style="
    border-radius: 5px;
">Send</button>
                                            </div>
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Create Offer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger errors d-none">Please fill out all required fields</div>
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="requirements" rows="5" placeholder="Describe Your Offer"></textarea>
                                                            </div>
                                                            <h6 class="text-dark">Define the terms of your offer and what it includes.</h6>
                                                            <div class="row mt-3">
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Revisions </label>
                                                                        <input type="number" class="form-control" id="revisions-input" aria-describedby="emailHelp" placeholder="1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1"> Delivery </label>
                                                                        <input type="number" class="form-control" id="delivery-input" aria-describedby="emailHelp" placeholder="Days">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Price </label>
                                                                        <input type="number" class="form-control" id="hours-input" aria-describedby="emailHelp" placeholder="$">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary send-offer">Send</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4" style="border-left: 1px solid #c5c4c4;">
                                    <div class="about-chat-person">
                                        <h5 class="text-dark font-weight-bold">About</h5>
                                        <div class=" text-center">
                                            <img src="{{ @$chat_user->image ?? '/dash-assets/images/team2.jpg' }}" width="">
                                            <h6 class="font-weight-bold">{{ @$chat_user->name}}</h6>
                                            <hr>
                                            @if($chat_user->is_admin)
                                            @php
                                            $rating = number_format(App\Models\Request::where('athlete_id', $chat_user->id)
                                            ->where('status', 'completed')
                                            ->avg('rating'), 1);
                                            @endphp
                                            <div class="d-flex justify-content-between">
                                                <h6 class="font-weight-bold text-dark mb-3">Reiews</h6>
                                                <p><i class="fa fa-star text-warning mr-2"></i>{{ $rating }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="font-weight-bold text-dark">Sport</h6>
                                                <p>{{ @(\App\Models\Sport::find($chat_user->sport))->name }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="font-weight-bold text-dark">University </h6>
                                                <p>{{ @(\App\Models\University::find($chat_user->university))->name }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="font-weight-bold text-dark">State</h6>
                                                <p>{{ @(\App\Models\State::find($chat_user->state))->name }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="font-weight-bold text-dark">Bio</h6>
                                                <p>{{ @$chat_user->details->headline }}</p>
                                            </div>
                                            @else
                                            <div class="d-flex justify-content-between">
                                                <h6 class="font-weight-bold text-dark mb-3">Reiews</h6>
                                                <p><i class="fa fa-star text-warning mr-2"></i>5</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="font-weight-bold text-dark">Interested In</h6>
                                                <p>{{ @$chat_user->interested }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="font-weight-bold text-dark">Bio</h6>
                                                <p>{{ @$chat_user->additional }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($chats->count() && $chat->type == 'group')
                        <div class="chat-person" data-id="">
                            <div class="top-bar ">
                                <div class="d-flex align-items-center">
                                    <span class="online-badge"></span>
                                    <h5 class="font-weight-bold text-dark mt-1">{{ $chat_open->group_name }}</h5>
                                </div>
                                <p class="pl-4 mb-0">online</p>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-12 col-md-12">
                                    <div class="messages">
                                        @include('admin.chats.messages', ['messages' => $messages])
                                    </div>
                                    <div class="message-type">
                                        <div class="media sent-msg d-none">
                                            <img class="mr-3" src="{{ auth()->user()->image ?? '/dash-assets/images/team1.jpg' }}" alt=" image">
                                            <div class="media-body">
                                                <h5 class="mt-0">{{ auth()->user()->name   }} <small>{{ \Carbon\Carbon::now() }}</small></h5>
                                                <p class="content"></p>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-group  m-0">
                                                <textarea class="form-control msg"style="
    border-radius: 5px;
" data-chat_id="{{ $chat_open->id }}" id="exampleFormControlTextarea1" rows="4" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-between ">
                                                {{--@if(!auth()->user()->is_admin) <button class="btn btn-outline-dark my-3 px-4 create-offer" data-toggle="modal" data-target="#exampleModalCenter">Create Offer</button> @endif--}}
                                                <button class="btn btn-primary my-2 ml-2 px-4 send-msg"style="
    border-radius: 5px;
" >Send</button>
                                            </div>
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Create Offer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger errors d-none">Please fill out all required fields</div>
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="requirements" rows="5" placeholder="Describe Your Offer"></textarea>
                                                            </div>
                                                            <h6 class="text-dark">Define the terms of your offer and what it includes.</h6>
                                                            <div class="row mt-3">
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Revisions </label>
                                                                        <input type="number" class="form-control" id="revisions-input" aria-describedby="emailHelp" placeholder="1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1"> Delivery </label>
                                                                        <input type="number" class="form-control" id="delivery-input" aria-describedby="emailHelp" placeholder="Days">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Price </label>
                                                                        <input type="number" class="form-control" id="hours-input" aria-describedby="emailHelp" placeholder="$">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary send-offer">Send</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <h3 class="text-center">No chats found</h3>
                        @endif
                    </div>
                </div>
            </div>

        </section>
    </div>
    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Group</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="$('#modal').modal('hide')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label>Group Name</label>
                        <input id="groupname" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label>Add Users</label>
                        <input type="text" class="form-control" placeholder="Search User" style="width: 100%;" size="30" onkeyup="showResult(this.value)">
                        <div id="display"></div>
                        <input id="tag-input1" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="return make_group()">Create Group</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modal').modal('hide')">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end employer-details -->
@endsection

@section('scripts')


<script>
    $(document).ready(function() {

        $('.create-offer').on('click', function(e) {
            e.preventDefault();

            $('#exampleModalCenter').modal('show');
        });

        $('.send-offer').on('click', function(e) {
            e.preventDefault();

            if (!$('#requirements').val()) {
                $('.errors').removeClass('d-none');
            } else {
                window.location.href = '/send-request/' + $('.chat-person').data('id') + '?requirements=' + $('#requirements').val() + '&price=' + $('#hours-input').val() + '&revisions=' + $('#revisions-input').val() + '&delivery=' + $('#delivery-input').val() + '&chat_id=' + $('.msg').data('chat_id');
            }
        });

        $('.send-msg').on('click', function(e) {
            e.preventDefault();

            let msg = $('.sent-msg');
            let text = $('.msg').val();
            let chat_id = $('.msg').data('chat_id');

            msg.find('.content').text(text);
            msg.removeClass('d-none');
            msg.addClass('d-flex');

            $('.messages').append(msg);
            $('.msg').val('');
            $('.no-msgs').hide();

            $.ajax({
                url: '/admin/messages/send/msg',
                data: {
                    msg: text,
                    chat_id: chat_id
                },
                success: function(res) {

                }
            });
        });

        let myVar = setInterval(refreshMsgs, 5000);

        function refreshMsgs() {
            $.ajax({
                url: '/admin/messages/refresh-msgs/' + $('.user.active').data('chat_id'),
                success: function(res) {
                    $('.messages').html(res);
                }
            });
        }

        $('.user').on('click', function(e) {
            e.preventDefault();

            // $('.user').removeClass('active');
            // $(this).addClass('active');
            // $('.msg').data('chat_id', $(this).data('chat_id'));
            window.location.href = '/admin/messages/' + $(this).data('chat_id');
        });

        // $('.user.active').trigger('click');
        $('#cg').click(function() {
            $('#modal').modal('show');
        })
    });
</script>
<script>
    function showResult(v) {
        $.ajax({
            url: "{{URL::to('/')}}" + '/admin/messages/fetch/msgs?str=' + v,
            method: "GET"
        }).then(function(data) {
            $('#display').html(data);
        });
    }
</script>
<script>
    (function() {

        "use strict"


        // Plugin Constructor
        var TagsInput = function(opts) {
            this.options = Object.assign(TagsInput.defaults, opts);
            this.init();
        }

        // Initialize the plugin
        TagsInput.prototype.init = function(opts) {
            this.options = opts ? Object.assign(this.options, opts) : this.options;

            if (this.initialized)
                this.destroy();

            if (!(this.orignal_input = document.getElementById(this.options.selector))) {
                console.error("tags-input couldn't find an element with the specified ID");
                return this;
            }

            this.arr = [];
            this.wrapper = document.createElement('div');
            init(this);
            initEvents(this);

            this.initialized = true;
            return this;
        }

        // Add Tags
        TagsInput.prototype.addTag = function(string) {

            if (this.anyErrors(string))
                return;

            this.arr.push(string);
            var tagInput = this;

            var tag = document.createElement('span');
            tag.className = this.options.tagClass;
            tag.innerText = string;

            var closeIcon = document.createElement('a');
            closeIcon.innerHTML = '&times;';

            // delete the tag when icon is clicked
            closeIcon.addEventListener('click', function(e) {
                e.preventDefault();
                var tag = this.parentNode;

                for (var i = 0; i < tagInput.wrapper.childNodes.length; i++) {
                    if (tagInput.wrapper.childNodes[i] == tag)
                        tagInput.deleteTag(tag, i);
                }
            })


            tag.appendChild(closeIcon);
            this.wrapper.insertBefore(tag, this.input);
            this.orignal_input.value = this.arr.join(',');

            return this;
        }

        // Delete Tags
        TagsInput.prototype.deleteTag = function(tag, i) {
            tag.remove();
            this.arr.splice(i, 1);
            this.orignal_input.value = this.arr.join(',');
            return this;
        }

        // Make sure input string have no error with the plugin
        TagsInput.prototype.anyErrors = function(string) {
            if (this.options.max != null && this.arr.length >= this.options.max) {
                console.log('max tags limit reached');
                return true;
            }

            if (!this.options.duplicate && this.arr.indexOf(string) != -1) {
                console.log('duplicate found " ' + string + ' " ')
                return true;
            }

            return false;
        }

        // Add tags programmatically 
        TagsInput.prototype.addData = function(array) {
            var plugin = this;

            array.forEach(function(string) {
                plugin.addTag(string);
            })
            return this;
        }

        // Get the Input String
        TagsInput.prototype.getInputString = function() {
            return this.arr.join(',');
        }


        // destroy the plugin
        TagsInput.prototype.destroy = function() {
            this.orignal_input.removeAttribute('hidden');

            delete this.orignal_input;
            var self = this;

            Object.keys(this).forEach(function(key) {
                if (self[key] instanceof HTMLElement)
                    self[key].remove();

                if (key != 'options')
                    delete self[key];
            });

            this.initialized = false;
        }

        // Private function to initialize the tag input plugin
        function init(tags) {
            //tags.wrapper.append(tags.input);
            tags.wrapper.classList.add(tags.options.wrapperClass);
            tags.orignal_input.setAttribute('hidden', 'true');
            tags.orignal_input.parentNode.insertBefore(tags.wrapper, tags.orignal_input);
        }

        // initialize the Events
        function initEvents(tags) {
            tags.wrapper.addEventListener('click', function() {
                tags.input.focus();
            });
        }


        // Set All the Default Values
        TagsInput.defaults = {
            selector: '',
            wrapperClass: 'tags-input-wrapper',
            tagClass: 'tag',
            max: null,
            duplicate: false
        }

        window.TagsInput = TagsInput;

    })();

    var tagInput1 = new TagsInput({
        selector: 'tag-input1',
        duplicate: false,
        max: 256
    });
</script>
<script>
    var list = [];

    function add(id, name) {
        tagInput1.addData([name]);
        list.push(id);
        const unique = arr => [...new Set(arr)];
        list = unique(list);
        console.log(list);
    }

    function make_group() {
        if (list.length == 0) {
            alert('Please Add some members');
            return false;
        }
        if($('#groupname').val() == ''){
            alert('Group Name is required');
        }
        $.ajax({
            url: '{{URL::to('admin/messages/new/group')}}',
            data: {
                'list': list,
                'groupname':$('#groupname').val()
            }
        }).then(function(data) {
            if(data == 'ok')
            location.reload();
            else
            alert(data)
        })
        return true;
    }
</script>

@endsection