$(function(){

	var viewPort = $(window).width();


	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};


	if (isMobile.any()) {
		$(".btn-llamar").append('<a href="tel:+541137231963"><button class="icon-telefono espacio btn-gracias">LLAMANOS!</button></a>');
	}

	if( viewPort <= 480) {
		
		recalcular();
	}
	if( viewPort >= 480 && viewPort <= 768) {
		recalcular();
	}
	if (viewPort > 770 && viewPort <= 1400){
		$(".container--formulario").animate({right:"7em"}, 1600);
		$(".container--formulario").animate({right:"5em"}, 800);
		recalculando();

	}
	if (viewPort > 1400) {
		$(".container--formulario").animate({right:"4em"}, 1600);
		$(".container--formulario").animate({right:"1.5em"}, 800);
		recalculando();
	}
	var formTop = $("#formValid").offset().top;

	$("#btn").on("click", function(){
		$("body,html").animate({scrollTop: formTop}, 1000 , "easeInOutExpo" );
	});

	$(window).on("scroll", function(){
		var pantalla = $(window).scrollTop();
		var objetoTop = $(".container--pasos").offset().top;
		if (pantalla > objetoTop) {
			$(".cabecera").css({height:"60px"} );
			$(".logo").css({height:"70px"} );
			$(".paratop").css({fontSize : "1.2em"} );
		}
		if (pantalla < objetoTop) {
			$(".cabecera").css({height:"80px"} );
			$(".logo").css({height:"90px"} );
			$(".paratop").css({fontSize : "1.6em"} );
		}
		if ( pantalla >= 1200 ){

				$(".imagen1").css({left:"0"} );
				$(".imagen2").css({left:"0"} );
				$(".imagen3").css({top:"0.2em"} );
			} 
	})
	
	function recalcular () {
		var viewport_width = window.innerWidth;
		var viewport_height = window.innerHeight;
		$('.container--img').height((viewport_height)) ;
		$(window).resize(function() {
	  		var viewport_width = window.innerWidth;
	  		var viewport_height = window.innerHeight;
			$('.container--img').height((viewport_height));
		});
	}

	function recalculando () {
		var viewport_width = window.innerWidth;
		var viewport_height = window.innerHeight / 1.15;
		$('.container--img').height((viewport_height)) ;
		$(window).resize(function() {
	  		var viewport_width = window.innerWidth;
	  		var viewport_height = window.innerHeight / 1.15;
			$('.container--img').height((viewport_height));
		});
	}
});
