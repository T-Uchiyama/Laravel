@extends('layouts.app')

@section('content')
    <h2 class="page-header">記事投稿</h2>
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

    <div class="form-group">
        <label>本文</label>
        {!! Form::textarea('body', null, ['required', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
        {!! Form::file('file') !!}
    </div>
    <button type="submit" class="btn btn-default">投稿</button>
    {!! Form::close() !!}
@endsection
