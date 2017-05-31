@extends('layouts.app')

@section('content')

    <a href="{{ url('articles/create') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-trash"></i>記事作成
        </button>
    </a>

    @foreach($articles as $article)
    <article id="article_list">
        <h1><a href="{{ url('articles/show/'.$article->id) }}">{{ $article->title }}</a></h1>
        
        <ul class="post_info">
            <li class="blog_date" style="float:left">
                <span class="glyphicon glyphicon-calendar"></span>
                <time> : {!! date('Y/m/d', strtotime($article->created_at)); !!}</time>
            </li>
            
            <li class="blog_category" style="float:left">
                <span class="glyphicon glyphicon-file"></span>
                @foreach ($categories as $key => $value)
                    @if ($key === $article->category_id)
                        : {{ $value }}
                    @endif
                @endforeach
            </li>
        </ul>
        
        @foreach ($attachments as $attachment)
            @if ($attachment->foreign_key === $article->id)
                <a class="post_link" href="{{ url('articles/show/'.$article->id) }}">
                    <p><img src="{{ asset('storage/upload/' . $attachment->filename) }}" alt="upload" /></p>
                </a>
            @endif
        @endforeach
        
        <p class="transition">
            <a href="{{ url('articles/show/'.$article->id) }}">
                本文を読む
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </p>
        
        <div class="article_crud">
            <a href="{{ url('articles/edit/'.$article->id) }}">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-btn fa-trash"></i>編集
                </button>
            </a>

            <form action="{{ url('articles/delete/'.$article->id)}}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-btn fa-trash"></i>削除
                </button>
            </form>
        </div>
    </article>
    @endforeach
    <div class="paginate">
        {{ $articles->appends(Request::only('q'))->links() }}
    </div>
@endsection
