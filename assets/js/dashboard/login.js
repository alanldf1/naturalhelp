/**
*
* Script do login de admin
*
* @author Emprezaz
*
**/
(function($, URL, Helpers){

    // Verificando a senha
    var checkPasswordInDatabase = (username, password) => {

        var checkPassword;

        $.ajax({
            url: URL + '/checkPasswordAdm',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                username: username,
                password: password,
            },
            complete: function(response){

                checkPassword = response.responseJSON.result;

            }
        });

        return checkPassword;

    }

    // Verificando o nome de usuário
    var checkUsernameInDatabase = (username) => {

        var checkUser;

        $.ajax({
            url: URL + '/checkUsernameAdm',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                username: username,
            },
            complete: function(response){
                checkUser = response.responseJSON.result;
            }
        });

        return checkUser;

    }
    // Verificando o email do usuário
    var checkEmailInDatabase = (email) => {

        var checkUser;

        $.ajax({
            url: URL + '/checkEmailAdm',
            dataType: 'json',
            type: 'POST',
            async: false,
            data: {
                email: email,
            },
            complete: function(response){
                checkUser = response.responseJSON.result;
            }
        });

        return checkUser;

    }

    // Validação dos campos
    var validateFields = () => {

        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        if(username == ''){

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Preencha o nome de usuário',
            });
            return false;

        }

        if(password == ''){

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Preencha sua senha'
            });
            return false;

        }

        if(!checkUsernameInDatabase(username)){

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Usuário não cadastrado',
            });
            return false;

        }

        if(!checkPasswordInDatabase(username, password)){

            swal({
                type: 'error',
                title: 'Erro - Login',
                text: 'Senha incorreta',
            });
            return false;

        }

        return true;

    }

    // Função parar executar o login
    var login = () => {

        $('body').on('click', '.btn-login', function(){

            console.log('login');

            var username = $('input[name="username"]').val();
            
            if(validateFields()){

                $.ajax({
                    url: URL + '/saveLogin',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username,
                    },
                    complete: function(response){

                        if(response.responseJSON.result){

                            swal({
                                type: 'success',
                                title: 'Sucesso - Login',
                                text: 'Login feito com sucesso',
                            }).then(function(){
                                window.location.href = URL + '/dashboard';
                                return true;
                            });

                        } else{

                            swal({
                                type: 'error',
                                title: 'Erro - Login',
                                text: 'Algo deu errado, tente novamente mais tarde.'
                            }).then(function() {
                                window.location.reload();
                                return false;
                            });

                        }

                    }
                });

            }


        });

    }

    var recover = () => {
        
        $('body').on('click', '#recover-email', function(){
            Swal.fire({
                title: 'Digite seu email para enviar link de recuperação',
                html: '<input name="emailRecover" type="email" class="form-control">',
                showCancelButton: true,
                cancelButtonText: "Fechar",
                confirmButtonText: "Confirmar email",
            }).then(result => {

                var email = $('input[name="emailRecover"]').val();
                if(result.value){

                    if (checkEmailInDatabase(email)) {

                        $.ajax({
                            url: URL + "/admin/sendRecover",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {email : email},
                            complete: function(response){
        
                                if(response.responseJSON.result){
        
                                    swal({
                                        type: 'success',
                                        title: 'Recuperar de Senha',
                                        text: 'O link de recuperação foi enviado para o seu email.',
                                    }).then(function(){
                                        window.location.reload();
                                        return true;
                                    });
        
                                } else{
        
                                    swal({
                                        type: 'error',
                                        title: 'Erro - Login',
                                        text: 'Algo deu errado, tente novamente mais tarde.'
                                    }).then(function() {
                                        window.location.reload();
                                        return false;
                                    });
        
                                }
        
                            }
                        })
                       
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Recuperar de Senha',
                            text: 'O usuário não foi encontrado'
                        }).then(function() {
                            window.location.reload();
                            return false;
                        });
                    }
                }
            });

         
        })

    }

    //Validação de email para envio de link ao email do admnistrador
	$( document ).ready(function(){
        login();
        recover();
    });

})($, URL, Helpers);