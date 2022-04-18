<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Chat;
use App\Models\Admin\Message;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index($id = null){
        $user_id = auth()->user()->id;
        $groups = DB::select('select chat_id from chat_group_members where user_id='.$user_id);
        $chats = Chat::with(['user1', 'user2'])
        ->where('user1_id', $user_id)
        ->orWhere('user2_id', $user_id);
        $gr = array();
        foreach($groups as $g){
            $chats->orWhere('id',$g->chat_id);
        }
        $chats = $chats->get();
        Message::where('receiver_id', $user_id)
            ->update(['read' => 1]);
        
        if ($id) {
            $chat_id = $id;
        } elseif ($chats->count()) {
            $chat_id = $chats->first()->id;
        } else {
            $chat_id = null;
        }
        
        $messages = $chat_id ? Message::where('chat_id', $chat_id)->get() : [];
        $chat_open = Chat::find($chat_id);
        
        //$role =auth()->user()->is_admin; 
        $role="customer";
        // auth()->user()->hasRole('Admin');
        //dd($role);
        return view('admin.chats.index', compact('chats', 'messages', 'chat_open'));
    }
    public function refreshMsgs($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->get();
        $response = view('admin.chats.messages', compact('messages'))->render();
        return $response;
    }
    public function sendMsg(Request $request)
    {
        $chat = Chat::findOrFail($request->chat_id);
        $receiver_id = $chat->user1_id == auth()->user()->id ? $chat->user2_id : $chat->user1_id;
        
        Message::create([
            'text' => $request->msg,
            'chat_id' => $chat->id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiver_id
        ]);
    }
    public function fetch(){
        $result = "<ul>";
        foreach(\App\User::where('name','like','%'.$_REQUEST['str'].'%')->limit(5)->get() as $user){
                $result.='<span><li>'.$user->name.'<button class="btn btn-info" onclick="'."return add($user->id,'$user->first_name".` `.$user->last_name."'".')">ADD</botton>'.'</li></span>';
        }
        $result .= "<ul>";
        return $result;
    }
    public function createGroup(){
        if(!isset($_REQUEST['list'])) return 'error';
        $uid = auth()->user()->id;
        array_push($_REQUEST['list'],$uid);
        $lists = array_unique($_REQUEST['list']);
        if(count($lists)>2){
            $chat = new Chat;
            $chat->type='group';
            $chat->group_name = $_REQUEST['groupname'];
            $chat->save();
        foreach($lists as $member){
            DB::insert("INSERT INTO `chat_group_members` (`id`, `chat_id`, `user_id`) VALUES (NULL, '$chat->id', '$member')");
        }
        DB::insert("INSERT INTO `chat_group_members` (`id`, `chat_id`, `user_id`) VALUES (NULL, '$chat->id', '$uid')");
        return 'ok';
        }
        return 'Not enough participants';
    }
}
