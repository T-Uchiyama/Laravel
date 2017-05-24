@extends('layouts.app')

@section('content')
    <h2 class="page-header">記事詳細</h2>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th>タイトル</th>
                <td>{{{ $article->title }}}</td>
            </tr>

            <tr>
                <th>本文</th>
                <td>{{{ $article->body }}}</td>
            </tr>

            <tr>
                <th>作成日時</th>
                <td>{{{ $article->created_at }}}</td>
            </tr>

            <tr>
                <th>更新日時</th>
                <td>{{{ $article->updated_at }}}</td>
            </tr>
        </tbody>
    </table>

    <div class="form-group">
        @if ($article->upload_filename)
                <img src="{{ asset('storage/upload/' . $article->upload_filename) }}" alt="upload" />
        @endif
    </div>
@endsection
