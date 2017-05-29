$(function()
{
    /**
     * AjaxでPOST通信するためのCSRFトークンの取得
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });


    /**
     * 削除ボタンを押下された際のアラート
     */
    $('.btn-danger').click(function() 
    {
        if (!confirm('削除してもよろしいですか？')) {
            return false;
        }
    });
    
    /**
     * アップロード欄を追加を押下した際に画像アップロード欄を追加
     */
    $('#content_wrapper').on('click', '#AddUploadColumn', function() 
    {
        var template = $('.upload_template').html();
        $('#fileUploader').append(template);
    });
    
    /**
     * 画像削除ボタンを押下されたら画像削除関数を走らせ画像削除
     */
    $('#content_wrapper').on('click', '#imageDelete', function(e) 
    {
        if (!confirm('削除してもよろしいですか？')) {
            return false;
        }
        
        var articleId;
        var fileName = $(this).parent('.form-group').find('img').attr('value');
        var siteUrl = window.location.href;
        urlArray = siteUrl.split('/');
        for (var i = 0; i < urlArray.length; i++) {
            if (urlArray[i].match(/^\d+$/)) {
                articleId = urlArray[i];
            }
        }
        
        $.ajax({
            url: '/articles/imageDelete',
            type: 'POST',
            dataType: 'json',
            data: {id: articleId, filename: fileName}
        })
        .done(function() {
            // 写真とボタンの状態をhiddenに
            $(e.target).parent('.form-group').find('img').remove();
            $(e.target).parent('.form-group').find('button').remove();
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
});
