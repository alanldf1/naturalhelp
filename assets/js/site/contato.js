/**
*
* Script com funções utilizadas
*
* @author Code Universe
*
**/

var tipoCadastro = null;

var cadastro = function(){

	$('#btn-cadastro').click(function(){

		var nome  = $('input[name="Nome"]').val();
		var email = $('input[name="Email"]').val();
		var tel   = $('input[name="Telefone"]').val();
		var CPFRG = $('input[name="CPF-RG"]').val();

		if(nome == ""){
			alert('Digite seu nome');
			return false
		}

		if(email == ""){
			alert('Digite seu e-mail');
			return false
		}

		if(tel == ""){
			alert('Digite seu tel');
			return false
		}

		if(CPFRG == ""){
			alert('Digite seu CPF ou RG');
			return false
		}

		$.ajax({
			type: 'post',
			dataType: 'json',
			url: 'cadastro',
			data: {
				nome: nome,
				email: email,
				tel: tel,
				doc: CPFRG,
				tipo: tipoCadastro
			},
			success: function(response){

				if(response){

					alert('Cadastro realizado com sucesso');

					$('.modal input').val('')

					$('#exampleModal').modal('hide')


				}else{
					alert('Não foi possível realizar seu cadastro');
				}

			}
		})

	});

}

$(document).ready(function() {
	cadastro();
});