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
     * 削除ボタンを謳歌された際のアラート
     */
    $('.btn-danger').click(function() {
        if (!confirm('削除してもよろしいですか？')) {
            return false;
        }
    })
});
