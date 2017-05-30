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
    </p>

    <p class="text_main">{!! nl2br($article->body) !!}</p>

    <div class="form-group">
        @if ($attachments)
            @foreach ($attachments as $attachment)
                <img src="{{ asset('storage/upload/' . $attachment->filename) }}" alt="upload" />
            @endforeach
        @endif
    </div>
@endsection
