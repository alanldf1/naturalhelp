/**
*
* Script com funções utilizadas
*
* @author Code Universe
*
**/


	var slick = function(){
		$(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      });
	}

	$(document).ready(function() {
		slick();
	});

