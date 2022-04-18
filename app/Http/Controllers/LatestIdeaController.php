<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LatestIdea;
class LatestIdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function view()
    {
        $latestideas = LatestIdea::all();
        return view('admin.latestideas.view_latestidea',compact('latestideas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('create');
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $latestidea = new LatestIdea();
            $latestidea->title = $data['title'];
            $latestidea->desc = $data['desc'];
            $latestidea->string1 = $data['string1'];
            $latestidea->string2 = $data['string2'];
            if($request->hasFile('image1'))
            {
               $img_temp = $request->file('image1');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->image1->move(public_path('uploads/banners'), $file_name);
                //    $img_path = 'uploads/banners/'.$file_name;
                //    Image::make($img_temp)->resize(500,500)->save($img_path);
               
                $latestidea->image1 = $file_name;
                // dd($latestidea);
               }
            }
           
            $latestidea->save();
            // dd($latestidea);
            
            return redirect('/latestidea/view')->with('flash_message_success','latestidea added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $latestidea = LatestIdea::where('id',$id)->first();
        return view('admin.latestideas.edit_latestidea',compact('latestidea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $data = $request->all();
        if($request->hasFile('image1'))
            {
               $img_temp = $request->file('image1');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name1 = rand(111,999).".".$extension;
                   $request->image1->move(public_path('uploads/banners'), $file_name1);
               }
            }else{
                $file_name1 = $data['current_image1'];
            }
            LatestIdea::where('id',$id)->update(['title'=>$data['title'],'desc'=>$data['desc'],'image1'=>$file_name1
        ,'string1'=>$data['string1'],'string2'=>$data['string2']]);
            return redirect('/latestidea/view')->with('flash_message_success','latestidea Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
       
        return view('admin.latestideas.add_latestidea');
        
    }
    public function delete($id)
    {
        LatestIdea::where('id',$id)->delete();
        return redirect('/latestidea/view')->with('flash_message_error','latestidea Deleted ');

    }
}
