@extends('layouts.app')

@section('content')
    <h1 class="heading_show">{{{ $article->title }}}</h1>

    <p class="text_info">
        <small class="text_info_created">
            <span class="glyphicon glyphicon-calendar"></span>
            :  {{ $article->created_at }}
        </small>
        
        <small class="text_info_category">
            <span class="glyphicon glyphicon-file"></span>
            @foreach ($categories as $key => $value)
                @if ($key === $article->category_id)
                    : {{ $value }}
                @endif
            @endforeach
        </small>
        
        <small class="text_info_tag">
            <span class="glyphicon glyphicon-tags"></span> : 
            @foreach ($tags as $tag)
                {{ $tag->tagName }}
                @if (!$loop->last)
                    ,
                @endif    
            @endforeach
        </small>
    </p>

    <p class="text_main">{!! nl2br($article->body) !!}</p>

    <div class="form-group">
        @if ($attachments)
            @foreach ($attachments as $attachment)
                <img src="{{ asset('storage/upload/' . $attachment->filename) }}" alt="upload" />
            @endforeach
        @endif
    </div>
    
    <hr />
    <h3>コメント一覧</h3>
    @foreach($article->comments as $single_comment)
        <h4>{{ $single_comment->commenter }}</h4>
        <p>{{ $single_comment->comment }}</p><br />
    @endforeach
    
    <hr />
    <h3>コメントを投稿する</h3>
    {{-- 投稿完了時にフラッシュメッセージを表示 --}}
    @if(Session::has('message'))
    	<div class="bg-info">
    		<p>{{ Session::get('message') }}</p>
    	</div>
    @endif
    
    {{-- エラーメッセージの表示 --}}
    @foreach($errors->all() as $message)
    	<p class="bg-danger">{{ $message }}</p>
    @endforeach
    
    {{ Form::open(['route' => 'comment.store'], array('class' => 'form')) }}

    	<div class="form-group">
    		<label for="commenter" class="">名前</label>
    		<div class="">
    			{{ Form::text('commenter', null, array('class' => '')) }}
    		</div>
    	</div>

    	<div class="form-group">
    		<label for="comment" class="">コメント</label>
    		<div class="">
    			{{ Form::textarea('comment', null, array('class' => '')) }}
    		</div>
    	</div>

    	{{ Form::hidden('article_id', $article->id) }}

    	<div class="form-group">
    		<button type="submit" class="btn btn-primary">投稿する</button>
    	</div>

    {{ Form::close() }}
@endsection
