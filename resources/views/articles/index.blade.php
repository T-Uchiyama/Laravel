@extends('layouts.app')

@section('content')
    <h2 class="page-header">記事一覧</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>本文</th>
                    <th>作成日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{{ $article->title }}}</td>
                    <td>{{{ $article->body }}}</td>
                    <td>{{{ $article->created_at }}}</td>
                    <td>{{{ $article->updated_at }}}</td>
                    <td>
                        <form action="{{ url('articles/show/'.$article->id)}}" method="GET" class="form-horizontal">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-trash"></i>詳細
                            </button>
                        </form>

                        <form action="{{ url('articles/edit/'.$article->id)}}" method="GET" class="form-horizontal">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-trash"></i>編集
                            </button>
                        </form>

                        <form action="{{ url('articles/delete/'.$article->id)}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <a href="/articles/create">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-btn fa-trash"></i>記事作成
                </button>
            </a>
        </table>
@endsection
