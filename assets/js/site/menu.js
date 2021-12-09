/**
*
* Script com funções utilizadas
*
* @author Alan de Souza
*
**/

(function($, URL, Helpers){

	var openMenu = function(){
        $('body').on('click', '#menu',function () {
            $('#menuCollapse').removeClass('hidden');
        })
        $('body').on('click', '#close-menu',function () {
            $('#menuCollapse').addClass('hidden');
        })

	}
	$(document).ready(function() {

        openMenu();

	});

})($, URL, Helpers);