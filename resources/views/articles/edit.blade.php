@extends('layouts.app')

@section('content')
    <h2 class="page-header">記事編集</h2>
    {!! Form::open(['action' => ['ArticlesController@postEdit', $article->id]]) !!}
    {{ csrf_field() }}
    <div class="form-group">
        <label>タイトル</label>
        {!! Form::input('text', 'title', $article->title, ['required', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>本文</label>
        {!! Form::textarea('body', $article->body, ['required', 'class' => 'form-control']) !!}
    </div>
  <button type="submit" class="btn btn-default">編集</button>
{!! Form::close() !!}
@endsection
