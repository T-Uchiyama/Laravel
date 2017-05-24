@extends('layouts.app')

@section('content')
    <h2 class="page-header">記事投稿</h2>
    {!! Form::open() !!}
    {{ csrf_field() }}
    <div class="form-group">
        <label>タイトル</label>
        {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>本文</label>
        {!! Form::textarea('body', null, ['required', 'class' => 'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-default">投稿</button>
    {!! Form::close() !!}
@endsection
