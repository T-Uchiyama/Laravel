<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * @var Article
     */
    protected $article;

    /**
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * 記事の一覧
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $articles = $this->article->all();

        return view('articles.index', compact('articles'));
    }

    /**
     * 記事の詳細
     * @param  $id
     * @return \Illuminate\View\View
     */
    public function getShow($id)
    {
        $article = $this->article->find($id);

        return view('articles.show', compact('article'));
    }

    /**
     * 記事の投稿
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('articles.create');
    }

    /**
     * 記事の投稿
     * @param  Requset $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $data = $request->all();
        $this->article->fill($data);
        $this->article->save();

        return redirect()->to('articles');
    }

    public function getEdit()
    {

    }

    public function postEdit()
    {

    }

    public function postDelete()
    {

    }
}
