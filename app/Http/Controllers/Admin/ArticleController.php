<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('article_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $article = Article::orderBy('created_at','DESC')->get();
        return view('admin/article.index',compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('article_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin/article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate(
            [
                'heading' => 'required',
                'auth_name' => 'required',
                'auth_profession' => 'required',
                'auth_image' => 'required|max:10248',
                'image' => 'required|max:10248',
                'description' => 'required'
                
            ]
        );
        
        $article = new Article;
        if ($request->hasfile('auth_image')) {
            $file = $request->file('auth_image');
            $upload = 'Images';
            $filename = time() . $file->getClientOriginalName();
            $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
            $article->auth_image =  $upload . $filename;
        }
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $upload = 'Images';
            $filename = time() . $file->getClientOriginalName();
            $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
            $article->image =  $upload . $filename;
        }
        $article->heading = $request->heading;
        $article->auth_name = $request->auth_name;
        $article->auth_profession = $request->auth_profession;
        $article->description = $request->description;
        $article->save();
        return redirect('admin/article')->with('success','Article has created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $article = Article::find($id);
        return view('admin/article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate(
            [
                'heading' => 'required',
                'auth_name' => 'required',
                'auth_profession' => 'required',
                'description' => 'required'
                
            ]
        );
        $article = Article::find($id);
        if ($request->hasfile('auth_image')) {
            $file = $request->file('auth_image');
            $upload = 'Images';
            $filename = time() . $file->getClientOriginalName();
            $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
            $article->auth_image =  $upload . $filename;
        }
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $upload = 'Images';
            $filename = time() . $file->getClientOriginalName();
            $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
            $article->image =  $upload . $filename;
        }
        $article->heading = $request->heading;
        $article->auth_name = $request->auth_name;
        $article->auth_profession = $request->auth_profession;
        $article->description = $request->description;
        $article->update();
        return redirect('admin/article')->with('success','Article has updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $article = Article::find($request->id);
        $article->delete();
        return response(['message' => 'Article delete successfully']);
    }
}
