<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Homepage\Entities\Slide;
use Modules\Homepage\Entities\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget'));
    }

    public function homepage()
    {
        $cats = ArticleCategory::all();
        $articles = Article::paginate(10);
        $sliders = Slide::all();
        $video = Video::inRandomOrder()->first() ?? null;
        return view('homepage.index', compact('cats', 'articles', 'sliders', 'video'));
    }

    public function kategori(ArticleCategory $articlecategory)
    {
        $cats = ArticleCategory::all();
        $articles = Article::paginate(10);
        $sliders = Slide::all();
        $video = Video::inRandomOrder()->first() ?? null;

        $title = $articlecategory->name;
        return view('homepage.kategori', compact('cats', 'articles', 'sliders', 'video', 'title'));
    }

    public function artikel(Article $article)
    {
        $cats = ArticleCategory::all();
        $articles = Article::paginate(10);
        $sliders = Slide::all();
        $video = Video::inRandomOrder()->first() ?? null;

        $title = $article->name;
        return view('homepage.artikel', compact('cats', 'articles', 'sliders', 'video', 'title', 'article'));
    }
}
