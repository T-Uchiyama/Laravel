@extends('layouts.app')

@section('content')
    <h1 class="heading_create">記事投稿</h1>
    {!! Form::open(['url' => '/articles/create', 'method' => 'post', 'files' => true]) !!}
    {{ csrf_field() }}
    <div class="form-group">
        <label>タイトル</label>
        {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control']) !!}
    </div>

    {{--成功時のメッセージ--}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="upload_template">
        <div class="form-group">
            {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
            {!! Form::file('file[]', array('multiple'=>true)) !!}
        </div>
    </div>

    <div class="form-group">
        <label>本文</label>
        {!! Form::textarea('body', null, ['required', 'class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
        <label>カテゴリ選択 : </label>
        {{ Form::select('category_id', $categories) }}
    </div>

    <div class="form-group">
        <label>タグ選択 : </label>
        @foreach ($tags as $key => $value)
            {!! Form::checkbox('tag_id[]', $key) !!}
            {!! Form::label('articleTag', $value) !!}
        @endforeach
    </div>

    <div class="form-group">
        <label>新規タグ作成 : </label>
        {!! Form::text('tagName', null, ['class' => 'form-control']) !!}
        <button type="button" class="btn btn-default" id="AddTag">タグの追加</button>
    </div>

    <div id="fileUploader">
        <div class="form-group">
            {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
            {!! Form::file('file[]', array('multiple'=>true)) !!}
        </div>
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-default" id="AddUploadColumn">アップロード欄を追加</button>
    </div>

    <button type="submit" class="btn btn-default">投稿</button>
    {!! Form::close() !!}
@endsection
