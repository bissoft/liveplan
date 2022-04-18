<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Feature;
use App\Models\Content;
use App\Models\Banner;
use App\About;
use App\Article;
use App\LatestIdea;
use App\GetInTouch;
use App\Choose;
use App\Faq;
use App\Package;
use App\Project;
use App\Price;
use App\Review;
use App\Team;
use App\Testimonial;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('client.home');
    }
    public function home()
    {
        $service = Service::all();
        $monthly = Package::where('type',0)->get();
        $yearly = Package::where('type',1)->get();
        $team = Team::all();
        $review = Review::where('status',0)->get();
        $article = Article::all();
        return view('welcome',compact('service','monthly','yearly','team','review','article'));
    }
    public function redirect()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.home')->with('status', session('status'));
        }

        return redirect()->route('client.home')->with('status', session('status'));
    }
}
