@if($messages->count())
    @foreach($messages as $message)
        @include('admin.chats.message', ['message' => $message])
    @endforeach
@else
    <p class="text-center no-msgs">No messages found</p>
@endif