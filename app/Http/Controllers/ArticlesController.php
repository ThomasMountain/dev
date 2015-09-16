<?php

namespace App\Http\Controllers;

use App\Article;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('auth', ['only' => 'create']); //This would run only on the create function of this route
//        $this->middleware('auth', ['except' => 'index']); //This would run only on the create function of this route
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

       // return Auth::user()->email;
//        $articles = Article::latest('published_at')->get();
//        $articles = Article::latest('published_at')->where('published_at','<=', Carbon::now() )->get();
        $articles = Article::latest('published_at')->published()->get();
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findorfail($id);

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    /**
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());

        Auth::user()->articles()->save($article);

        Article::create($request->all()); //user_id => Auth::id

        return redirect('articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * @param $id
     * @param ArticleRequest|Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, ArticleRequest $request)
    {
        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect('articles');
    }
}