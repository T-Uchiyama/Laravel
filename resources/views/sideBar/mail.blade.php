
<div id="mail">
    <legend class="form_info">Mail Form</legend>
    
    <lavel>名前(必須)</lavel>
    {{ Form::open(['method' => 'POST', 'route' => 'mail']) }}
    {{ Form::input('text', 'sender', null, ['id' => 'mail_name', 'class' => 'mail_class']) }}
    
    <label>メール本文(必須)</label>
    {{ Form::textarea('mailBody', null, ['id' => 'mail_contents', 'class' => 'mail_class']) }}

    {{ Form::submit('送信', ['id' => 'send_Button', 'class' => 'btn btn-success']) }}
    {{ Form::close() }}
</div>
