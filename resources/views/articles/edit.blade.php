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
        <label>カテゴリ選択 : </label>
        {{ Form::select('category_id', $categories, $article->category_id) }}
    </div>
    
    <div class="form-group">
        <label>タグ選択 : </label>
        @foreach ($tags as $key => $value)
                @if (!empty($checkTagIdlist) && in_array($key, $checkTagIdlist))
                    {!! Form::checkbox('tag_id[]', $key, true) !!}
                    {!! Form::label('articleTag', $value) !!}
                @else
                    {!! Form::checkbox('tag_id[]', $key) !!}
                    {!! Form::label('articleTag', $value) !!}
                @endif
        @endforeach
    </div>
    
    @if ($attachments)
        @foreach ($attachments as $attachment)
            <div class="form-group">
                <img src="{{ asset('storage/upload/' . $attachment->filename) }}" alt="upload" value="{{ $attachment->filename }}"/>
                <button type="button" class="btn btn-primary" id="imageDelete">画像削除</button>
            </div>
        @endforeach
    @endif
  <button type="submit" class="btn btn-default">編集</button>
{!! Form::close() !!}
@endsection
