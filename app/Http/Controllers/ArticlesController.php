<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;
use Illuminate\Support\Facades\Input;

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
    public function show($id)
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
        if ($request->file('file')->isValid([])) {
            $filename = $request->file->store('public/upload');
        } else {
            $filename = '';
        }

        $data = $request->all();
        $data = array_merge($data, array('upload_filename' => basename($filename)));
        $this->article->fill($data);
        $this->article->save();

        return redirect()->to('articles');
    }

    /**
     * 記事の編集
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getEdit($id)
    {
        $article = $this->article->find($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * 記事の編集
     * @param  Request $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, $id)
    {
        $article = $this->article->find($id);
        $data = $request->all();
        $article->fill($data);
        $article->save();

        return redirect()->to('articles');
    }

    /**
     * 記事の削除
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id)
    {
        $article = $this->article->find($id);
        $article->delete();

        return redirect()->to('articles');
    }
}
