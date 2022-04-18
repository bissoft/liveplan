<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $faqs = Faq::all();
        return view('admin.faqs.view_faq',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin.faqs.add_faq');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $faq = new Faq();
            $faq->title = $data['title'];
            $faq->desc= $data['desc'];
            $faq->heading = $data['heading'];
            $faq->string1 = $data['string1'];
            $faq->string2 = $data['string2'];
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
                   $faq->image1 = $file_name;
               }
            }
           
            $faq->save();
            return redirect('/faq/view')->with('flash_message_success','faq added Successfully');
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
        $faq = Faq::where('id',$id)->first();
        return view('admin.faqs.edit_faq',compact('faq'));
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
        Faq::where('id',$id)->update(['title'=>$data['title'],'desc'=>$data['desc'],'image1'=>$file_name1
        ,'string1'=>$data['string1'],'heading'=>$data['heading'],'string2'=>$data['string2'],]);
            return redirect('/faq/view')->with('flash_message_success','Faq Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Faq::where('id',$id)->delete();
        return redirect('/faq/view')->with('flash_message_error','Faq Deleted ');

    }
}
