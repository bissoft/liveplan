<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use App\Models\Admin\Support\Issue;
use Illuminate\Http\Request;

class AskController extends Controller
{
    public function index(){
        return view('admin.support.ask');
    }
    public function ask(Request $request){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'issue' => 'required'
        ]);
        $issue = Issue::create([
            'user_id' => auth()->user()->id,
            'category' => $request->category,
            'issue' => $request->issue,
            'name' => $request->name
        ]);
        return redirect()->back()->with(['success' => 'Your Query/Issue has been submitted. Your Ticket Number is '.$issue->id.'.']);
    }
}
