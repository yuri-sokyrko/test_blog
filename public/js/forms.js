$(document).ready(function() {
    $('form').submit(function(e) {
        var json;
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            action: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cahe: false,
            processData: false,
            success: function(result) {
                json = jQuery.parseJSON(result);
                if(json.url) {
                    window.location.href = '/' + json.url;
                } else {
                    alert(json.status + ' - ' + json.message);
                }
            },
        });
    });
});