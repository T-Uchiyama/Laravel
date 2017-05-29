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
});
