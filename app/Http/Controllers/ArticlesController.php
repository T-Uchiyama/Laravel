<?php

namespace App\Http\Controllers;

use App\Article;
use App\Attachment;
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
        $attachments = Attachment::where('model', 'Article')->get();
        
        /* サムネイルに表示するのは一件のため複数登録されたものはここでは削除 */
        $tmp = [];
        $uniqueArray = [];
        foreach ($attachments as $attachment) {
           if (!in_array($attachment['foreign_key'], $tmp)) {
              $tmp[] = $attachment['foreign_key'];
              $uniqueArray[] = $attachment;
           }
        }
        $attachments = $uniqueArray;
        
        return view('articles.index', compact('articles', 'attachments'));
    }

    /**
     * 記事の詳細
     * @param  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $article = $this->article->find($id);
        $attachments = Attachment::where([
            ['model', 'Article'],
            ['foreign_key', $id],
        ])->get();
        
        return view('articles.show', compact('article', 'attachments'));
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
        $article = new Article();
        $article->fill($data);
        $article->save();
        $lastInsertId = $article->id;
        
        if ($request->file('file')) {
            $article = Article::find($lastInsertId);
            foreach ($request->file('file') as $file) {
                $filename = $file->store('public/upload');
                $attachmentData = array(
                    'model' => 'Article',
                    'filename' => basename($filename),
                );
                $article->attachments()->create($attachmentData);
            }
        }
        
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
