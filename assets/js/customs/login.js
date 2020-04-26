$(document).ready(function(){
    $("#login-form").submit(function(e){
        $('.save').prop('disabled', true);
        e.preventDefault();
        var obj = $(this), action = obj.attr('name'), redirect_url = obj.data('redirect'), form_table = obj.data('form-table');
        $.ajax({
            type: "POST",
            url: base_url+'welcome/login/',
            data: obj.serialize()+"&form="+form_table,
            cache: true,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('.save').prop('disabled', false);
                } else {
                    toastr.success(JSON.result);
                    $('.save').prop('disabled', false);
                   // window.location = redirect_url;
                }
            }
        });
    });
});