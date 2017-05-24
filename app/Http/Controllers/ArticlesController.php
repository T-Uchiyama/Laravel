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

    public function getIndex()
    {

    }

    public function getShow()
    {

    }

    public function getCreate()
    {

    }

    public function postCreate()
    {

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
