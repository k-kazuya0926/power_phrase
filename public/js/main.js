$(function() {
    $('.custom-file-input').on('change', handleFileSelect);
    function handleFileSelect(evt) {
        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {

            var reader = new FileReader();

            reader.onload = (function(theFile) {
                return function(e) {
                    if (theFile.type.match('image.*')) {
                        var $html = ['<div class="d-inline-block mr-1 mt-1"><img class="img-thumbnail" src="', e.target.result,'" title="', escape(theFile.name), '" style="height:100px;" /><div class="small text-muted text-center">', escape(theFile.name),'</div></div>'].join('');// 画像では画像のプレビューとファイル名の表示
                    }

                    $('#preview').html($html);
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }

    //ファイルの取消
    $('.reset').click(function(){
        $('#preview').html('');
        $('.custom-file-input').val('');
    })
});