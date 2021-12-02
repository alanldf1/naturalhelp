/**
*
* Script com funções utilizadas
*
* @author Code Universe
*
**/

var contato = function(){

	$('#btn-enviar-contato').click(function(){

		var nome  = $('input[name="nome"]').val();
		var email = $('input[name="email"]').val();
		var tel   = $('input[name="telefone"]').val();
		var mensagem = $('input[name="Mensagem"]').val();

		if(nome == ""){
			alert('Digite seu nome');
			return false
		}

		if(email == ""){
			alert('Digite seu e-mail');
			return false
		}

		if(tel == ""){
			alert('Digite seu telefone');
			return false
		}

		if(mensagem == ""){
			alert('Digite sua mensagem');
			return false
		}

		$.ajax({
			type: 'post',
			dataType: 'json',
			url: 'mensagem',
			data: {
				nome: nome,
				email: email,
				tel: tel,
				mensagem: mensagem
			},
			success: function(response){

				if(response){
					alert('Mensagem enviada com sucesso. Pode levar algum tempo para analisarmos sua mensagem.');

					$('input').val('')


				}else{
					alert('Não foi possível enviar sua mensagem, tente mais tarde.');
				}

			}
		})

	});

}

$(document).ready(function() {
	contato();
});