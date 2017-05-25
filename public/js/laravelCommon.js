$(function()
{
    /**
     * 削除ボタンを謳歌された際のアラート
     */
    $('.btn-danger').click(function() {
        if (!confirm('削除してもよろしいですか？')) {
            return false;
        }
    })
});
