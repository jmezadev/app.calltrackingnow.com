    var equal_p = false;

    console.log('yes3');
    function create_user(){
        $('#btn-register').prop('disabled', true);
        var fields = ['#txt-first-name', '#txt-last-name', '#txt-email', '#txt-phone', '#txt-password', '#txt-c-password'];
        for (var i = 0; i < fields.length; i++) {
            if(sring_is_empty($(fields[i]).val()) && $(fields[i]).parent().find('em').length == 0){
                $(fields[i]).parent().append('<em class="invalid">This field is required</em>');
                $(fields[i]).parent().addClass("state-error");
            }
        }
            
        if (!$("#create-user-form").find(".state-error").length && equal_p) {
            console.log('listo');
            var data = $('#create-user-form').serialize();
            data += '&action=add_user';
            console.log(data);
            $.post("/admin/controllers/users/users_controller.php", data,
            function (data){
                var result = data;
                console.log(result);
                console.log(result.code);
                if(result.code == 1){
                    $('#div-alert-success').show("slow");
                    $("#create-user-form")[0].reset();
                    setTimeout(function(){
                        $('#div-alert-success').hide("slow");
                    }, 8000);
                }
                else{
                    $('#p-error-message').text("An error occurred please try again");
                    $('#div-alert-error').show("slow");
                    setTimeout(function(){
                        $('#div-alert-error').hide("slow");
                    }, 8000);   
                }
            });
        }
        $('#btn-register').prop('disabled', false);
        
    }


    $(document).on('change', '.pass', function(e) {
        if (!sring_is_empty($('#txt-c-password').val()) && !sring_is_empty($('#txt-password').val()) && $('#txt-password').val() == $('#txt-c-password').val()) {
            $('.pass').parent().removeClass('state-error');
            $('.pass').parent().find('em').remove();
            equal_p = true;
        }
        else{
            if ($('#txt-password').parent().find('em').length == 0) {   
                $('#txt-password').parent().append('<em class="invalid">Las contraseñas deben coincidir.</em>');
                $('#txt-password').parent().addClass("state-error");
            }
            if ($('#txt-c-password').parent().find('em').length == 0) {
                $('#txt-c-password').parent().append('<em class="invalid">Las contraseñas deben coincidir.</em>');
                $('#txt-c-password').parent().addClass("state-error");
            }
            equal_p = false;
        }
    });

    $(document).on('keyup', '.state-error', function(e) {
        $(this).removeClass('state-error');
        $(this).find('em').remove();
    });

    function clear_form(){
        $("#create-user-form")[0].reset();
    }

    
    
    function sring_is_empty(str) {
        str = str.trim();
        if(str == null)
            return true;
        else if(str.length === 0)
            return true;
        else if(str.length > 0 )
            return false;
    }


    function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
    }