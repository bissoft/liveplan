<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use App\Models\Admin\Support\Comment;
use App\Models\Admin\Support\Issue;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    //
    public function index(){
        return view('admin.support.index');
    }
    public function resolve($id){
        $issue = Issue::find($id);
        if($issue){
            return view('admin.support.resolve', ['issue' =>$issue]);
        }
        return redirect()->back();
    }
    public function sendComment(Request $request){
        Comment::create([
            'body' => $request->comment,
            'issue_id' => $request->issue_id,
            'user_id' => auth()->user()->id
        ]);
    }
    public function fetchComments(Request $request){
        $issue = Issue::find($request->issue_id);
        $user = auth()->user();
        if($issue){
            $body = '';
            foreach ($issue->comments as $comment)
            {
            $class = $comment->user_id == $user->id ? 'primary' : 'secondary'; 
            $body = "<div class='message $class'>$comment->body<div class='timestamp'>$comment->created_at</div></div>".$body;
        }
        return $body;
        }
        return '';
    }
}
