@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    {!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true]) !!}
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
                        @if ($user->avatar_filename)
                            <p>
                                <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar" />
                            </p>
                        @endif

                        {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
                        {!! Form::file('file') !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('アップロード', ['class' => 'btn btn-default']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
