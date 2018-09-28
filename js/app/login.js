
    function login(){
        if(sring_is_empty($('#email').val())){
            alert('The email is required');
            $('#email').focus();
        }
        else if(sring_is_empty($('#password').val())){
            alert('The password is required');
            $('#password').focus();
        }
        else{
           var data = $('#login').serialize();
           data += '&action=login';
           console.log(data);
            $.post("/admin/controllers/users/users_controller.php", data,
            function (data){
                var result = data;
                console.log(result);
                if (result == "true") {
                    parent.location="main.php";
                }
                else {
                    alert("El Usuaio o la contraseña es incorrecta.");
                }
            });
        }
            
    }    

    $(document).on('keyup', '.state-error', function(e) {
        $(this).removeClass('state-error');
        $(this).find('em').remove();
    });


    $(document).on('keypress', function(e) {
        if ( e.which == 13) {
            e.preventDefault();
            //$('#btn-login').trigger( "click" );
            login();
        }
    });
    
    function sring_is_empty(str) {
        str = str.trim();
        if(str == null)
            return true;
        else if(str.length === 0)
            return true;
        else if(str.length > 0 )
            return false;
    }