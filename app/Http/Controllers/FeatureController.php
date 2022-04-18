<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
class FeatureController extends Controller
{
    public function create()
    {
        return view('admin.features.add_feature');
    }
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $feature = new Feature();
            $feature->icon = $data['icon'];
            $feature->name = $data['feature_name'];
            $feature->description = $data['feature_desc'];
            if($request->hasFile('icon'))
            {
               $img_temp = $request->file('icon');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->icon->move(public_path('uploads/features'), $file_name);
                //    $img_path = 'uploads/banners/'.$file_name;
                //    Image::make($img_temp)->resize(500,500)->save($img_path);
                   $feature->icon = $file_name;
               }
            }
            $feature->save();
            return redirect('/feature/view')->with('flash_message_success','Service added Successfully');
        }
    }
    public function view()
    {
        $features = Feature::all();
        return view('admin.features.view_feature',compact('features'));
    }
    public function edit($id)
    {
        
        $features = Feature::where('id',$id)->first();
        return view('admin.features.edit_feature',compact('features'));
    }
    public function update(Request $request , $id)
    {
        
        $data = $request->all();
        if($request->hasFile('icon'))
            {
               $img_temp = $request->file('icon');
               
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name1 = rand(111,999).".".$extension;
                   $request->icon->move(public_path('uploads/features'), $file_name1);
               }
            }else{
                $file_name1 = $data['current_image1'];
            }
        Feature::where('id',$id)->update(['icon'=>$file_name1,'name'=>$data['feature_name'],'description'=>$data['feature_desc']]);
            return redirect('/feature/view')->with('flash_message_success','Feature Updated Successfully!!');
    }
    public function delete($id)
    {
        Feature::where('id',$id)->delete();
        return redirect('/feature/view')->with('flash_message_error','Feature Deleted ');

    }
    public function add()
    {
       
        return view('admin.features.edit_feature');
        
    }
}
