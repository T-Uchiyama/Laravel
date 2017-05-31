
<div class="search">
    <legend class="form_info">Search Form</legend>
    
    {{ Form::open(['method' => 'GET', 'route' => 'articles.search'] ) }}
    {{ Form::input('search', 'q', null, ['class' => 'searchInput', 'placeholder' => 'キーワードを入力してください。']) }}
    {{ Form::submit('検索', ['class' => 'btn btn-success', 'id' => 'search_Button']) }}
    {{ Form::close() }}
</div>
    