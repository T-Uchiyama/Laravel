@extends('layouts.app')

@section('content')
    <h1 class="heading_edit">記事編集</h1>
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

    <div class="form-group">
        @if ($article->upload_filename)
                <img src="{{ asset('storage/upload/' . $article->upload_filename) }}" alt="upload" value="{{ $article->upload_filename }}"/>
        @endif
    </div>
  <button type="submit" class="btn btn-default">編集</button>
{!! Form::close() !!}
@endsection
