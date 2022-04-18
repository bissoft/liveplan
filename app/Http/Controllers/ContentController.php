<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentPoint;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create()
    {
        return view('admin.contents.add_content');
    }
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $content = new Content();
            $content->title = $data['title'];
            $content->head = $data['head'];
            $content->description = $data['content_desc'];
            if($request->hasFile('image'))
            {
               $img_temp = $request->file('image');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->image->move(public_path('uploads/banners'), $file_name);
                //    $img_path = 'uploads/banners/'.$file_name;
                //    Image::make($img_temp)->resize(500,500)->save($img_path);
                   $content->image = $file_name;
               }
            }
            $content->save();
            return redirect('/content/view')->with('flash_message_success','Service added Successfully');
        }
    }
    public function view()
    {
        $contents = Content::all();
        return view('admin.contents.view_content',compact('contents'));
    }
    public function edit($id)
    {
        $content = Content::where('id',$id)->first();
        return view('admin.contents.edit_content',compact('content'));
    }
    public function update(Request $request , $id)
    {
        $data = $request->all();
        if($request->hasFile('image'))
            {
               $img_temp = $request->file('image');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->image->move(public_path('uploads/banners'), $file_name);
               }
            }else{
                $file_name = $data['current_image'];
            }
        Content::where('id',$id)->update(['title'=>$data['title'],'head'=>$data['head'],'description'=>$data['content_desc'],'image'=>$file_name]);
            return redirect('/content/view')->with('flash_message_success','Content Updated Successfully!!');
    }
    public function delete($id)
    {
        Content::where('id',$id)->delete();
        return redirect('/content/view')->with('flash_message_error','Content Deleted!!');
    }
    
     public function ContentPoints($id)
    {
        $content = Content::with('contentpoints')->where('id',$id)->first();
        return view('admin.contents.add_points',compact('content'));
    }
    public function addContentPoints(Request $request , $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            foreach($data['points'] as $key => $val)
            {
                if(!empty($val))
                {
                   $skuCount = ContentPoint::where('point',$val)->count();
                    if($skuCount > 0)
                    {
                        return redirect()->back()->with('flash_message_error','Product SKU is Already Exist!!');
                    }
                    $point = new ContentPoint();
                    $point->content_id = $id;
                    $point->point = $val;
                    $point->save();
                }

            }
            return redirect('content/points/'.$id)->with('flash_message_success','Content Points are Stored Successfully!!');
        }
    }
         public function editPoints(Request $request,$id)
     {
        if($request->isMethod('post'))
        {
           $data =  $request->all();
           foreach($data['attr'] as $key=>$attr)
           {
            ContentPoint::where(['id'=>$data['attr'][$key]])->update(['point'=>$data['points'][$key]]);
            return redirect()->back()->with('flash_message_success','Content points are Updated!!');
           }
        }
     }
     public function deletePoints($id)
     {
         ContentPoint::where('id',$id)->delete();
         return redirect()->back()->with('flash_message_error','Content points are Deleted!!');
     }
}
