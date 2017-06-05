<?php

namespace App\Http\Controllers;

use App\Article;
use App\Attachment;
use App\Category;
use App\Tag;
use App\ArticleTag;
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
        $articles = $this->article->paginate(10);
        $attachments = $this->createAttachmentList();
        $categories =  $this->createCategoryList();
        $tags = $this->createTagList();
        
        return view('articles.index', compact('articles', 'attachments', 'categories', 'tags'));
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
        $categories =  $this->createCategoryList();
        $tags = $article->tags()->get();
        
        return view('articles.show', compact('article', 'attachments', 'categories', 'tags'));
    }

    /**
     * 記事の投稿
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        $categories =  $this->createCategoryList();
        $tags = $this->createTagList();

        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * 記事の投稿
     * @param  Requset $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);
        
        $data = $request->all();
        $article = new Article();
        $article->fill($data);
        $article->save();
        $lastInsertId = $article->id;
        $article->tags()->sync(\Request::input('tag_id', []));
        
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
        $attachments = Attachment::where([
            ['model', 'Article'],
            ['foreign_key', $id],
        ])->get();
        $categories =  $this->createCategoryList();
        $tags = $this->createTagList();
        $checkedTags = $article->tags()->get();
        // チェック状態判別用にタグIDの番号のみの配列を生成
        foreach ($checkedTags as $key => $value) {
            $checkTagIdlist[] = $value->pivot->tag_id;
        }
        
        return view('articles.edit', compact('article', 'attachments', 'categories', 'tags', 'checkTagIdlist'));
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
        $article->tags()->sync(\Request::input('tag_id', []));
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
        
        // 記事の削除を実施する際に保存されていた写真も同時削除
        $attachments = Attachment::where([
            ['model', 'Article'],
            ['foreign_key', $id],
        ])->get();
        $article->attachments()->delete($attachments);

        return redirect()->to('articles');
    }
    
    /**
     * 画像の削除を実施
     */
    public function imageDelete()
    {
        $this->autoRender = false;
        
        $article =  $this->article->find(Input::get('id'));
        
        if ($article->attachments()
                    ->where([['model', 'Article'], ['foreign_key', Input::get('id')], ['filename', Input::get('filename')],])
                    ->delete()) {
                        return Response::json('削除に成功しました。');
        }
        exit;
    }
    
    /**
     * カテゴリ一覧を取得
     * @return App\Category
     */
    public function createCategoryList()
    {
        return Category::pluck('categoryName', 'id');
    }
    
    /**
     * タグ一覧を取得
     * @return App\Tag
     */
    public function createTagList()
    {
        return Tag::pluck('tagName', 'id');
    }
    
    /**
     * 画像一覧を取得
     * @return App\Attachment
     */
    public function createAttachmentList()
    {
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
        return $attachments = $uniqueArray;
        
    }
    
    /**
     * 検索文字を取得しクエリを用い検索結果の表示
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getQuerySearch()
    {    
        $query = Input::get('q');
        if ($query) {
            $articles = Article::where('title', 'LIKE', "%$query%")
                                ->orWhere('body', 'LIKE', "%$query%")
                                ->paginate(10);
        } else {
            $articles = Article::paginate(10);
        }
        $attachments = $this->createAttachmentList();
        $categories =  $this->createCategoryList();
        $tags = $this->createTagList();
        
        return view('articles.index', compact('articles', 'attachments', 'categories', 'tags'));
    }
    
    /**
     * 新規タグ作成
     */
    public function addTag()
    {
        $this->autoRender = false;
        
        $tagName =  array(
            'tagName' => Input::get('tagName')
        );
        $tag = new Tag();
        $tag->fill($tagName);

        if ($tag->save()) {
            return Response::json('タグの追加に成功しました。');
        }
        exit;
    }
}
