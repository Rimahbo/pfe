$('#register-user').click(function(){
    var nom=$('#nom').val();
    var prenom=$('#prenom').val();
    var email=$('#email').val();
    var password=$('#password').val();
    var password_confirm=$('#password-confirm').val();
    var passwordLength=password.length;
    var agreeTerms=$('#agreeTerms');

    if (nom !="" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(nom)){
        $('#nom').removeClass('is-invalid');
        $('#nom').addClass('is-valid');
        $('#error-register-nom').text("");
        if (prenom !="" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(prenom)){
            $('#prenom').removeClass('is-invalid');
            $('#prenom').addClass('is-valid');
            $('#error-register-prenom').text("");
            if (email !="" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                $('#error-register-email').text("");
                if(passwordLength >=8){
                    $('#password').removeClass('is-invalid');
                    $('#password').addClass('is-valid');
                    $('#error-register-password').text("");
                    if(password == password_confirm){
                        $('#password-confirm').removeClass('is-invalid');
                        $('#password-confirm').addClass('is-valid');
                        $('#error-register-password-confirm').text("");
                        if(agreeTerms.is(':checked')){
                            $('#agreeTerms').removeClass('is-invalid')
                            $('#error-register-agreeTerms').text(" ");

                            //alert('les donnees sont bien enregistres');

                            var res = emailExistjs(email);


                            (res != "exist") ? $('#form-register').submit()
                                             : ( $('#email').addClass('is-invalid'),
                                                $('#email').removeClass('is-valid'),
                                                $('#error-register-email').text("ton email est deja utilise!"));

                        }else{
                            $('#agreeTerms').addClass('is-invalid')
                            $('#error-register-agreeTerms').text("tu doit accepter nos termes et conditions!! ");
                        }
                    }else{
                        $('#password-confirm').addClass('is-invalid');
                        $('#password-confirm').removeClass('is-valid');
                        $('#error-register-password-confirm').text("ton mot de passe de confirmation doit etre identique que mot de passe !");
                    }
                }else{
                    $('#password').addClass('is-invalid');
                    $('#password').removeClass('is-valid');
                    $('#error-register-password').text("ton mot de passe doit avoir 8 caractere!");
                }
            }else{
                $('#email').addClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#error-register-email').text("ton email n'est pas valide!");
            }
        }else{
            $('#prenom').addClass('is-invalid');
            $('#prenom').removeClass('is-valid');
            $('#error-register-prenom').text("ton prenom n'est pas valide!");
        }
    }else{
        $('#nom').addClass('is-invalid');
        $('#nom').removeClass('is-valid');
        $('#error-register-nom').text("ton nom n'est pas valide!");
    }
});

$('#agreeTerms').change(function(){
    var agreeTerms=$('#agreeTerms');
    if(agreeTerms.is(':checked')){
        $('#agreeTerms').removeClass('is-invalid')
        $('#error-register-agreeTerms').text(" ");

    }else{
         $('#agreeTerms').addClass('is-invalid')
         $('#error-register-agreeTerms').text("tu doit accepter nos termes et conditions!! ");
    }
});
function emailExistjs(email){
    var url=$('#email').attr('url-emailExist');
    var token=$('#email').attr('token');
    var res="";
    $.ajax({
        type:'Post',
        url: url,
        data: {
            '_token':token,
            email:email
        },
        success:function(result){
            res =result.response;
        },
        async: false
    });
    return res;

}
