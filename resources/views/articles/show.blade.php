@extends('layouts.app')

@section('content')
    <h1 class="heading_show">{{{ $article->title }}}</h1>

    <p class="text_info">
        <small class="text_info_created">
            <span class="glyphicon glyphicon-calendar"></span>
            {{ $article->created_at }}
        </small>
    </p>

    <p class="text_main">{{ $article->body }}</p>
    
    <div class="form-group">
        @if ($article->upload_filename)
                <img src="{{ asset('storage/upload/' . $article->upload_filename) }}" alt="upload" />
        @endif
    </div>
@endsection
