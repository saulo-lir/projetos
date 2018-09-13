$(function(){

/* Fixar Menu */
var menu = $('.menu');

$(window).scroll(function(){

	if($(this).scrollTop() > 470){
		menu.addClass('menu-fixo');

	}else{
		menu.removeClass('menu-fixo');
	}

});

/* Mudar background do menu ao passar o mouse */
$('.menu').find('li').mouseover(function(){
	$(this).css({'background-color':'#FFF','color':'#CD0000'});
});

$('.menu').find('li').mouseout(function(){
	$(this).css({'background-color':'#CD0000','color':'#FFF'});
});

/* Scroll suave da página ao clicar no menu */

$('.scroll').bind('click', function(e){
	e.preventDefault();
	$('html, body').animate({scrollTop:$(this.hash).offset().top}, 800);
});

/* Enviar mensagem pelo whatsapp */
$('#btn-whats').bind('click', function(){
	var newWindow = window.open("", "_blank");	

	$.ajax({
		type:'POST',
		url:'http://localhost/samu-informatica/site/contato/whatsapp',
		data:{},
		success:function(data){
			
			newWindow.location.href = data;
		}
	});

});

/* Formulário de contato */

$('#cell_whats').mask('(00) 00000-0000');

$('#form-contato').bind('submit', function(e){
	e.preventDefault();

	var email = $('#email').val();
	var numero = $('#cell_whats').val();
	var mensagem = $('#mensagem').val().trim();	

	$('.aviso').hide();
	$('#btn-enviar').attr('disabled', 'disabled');
	$('#btn-enviar').html('Enviando...');

	$.ajax({
		type:'POST',
		url:'http://localhost/samu-informatica/site/contato/mensagem',
		data:{email:email, numero:numero, mensagem:mensagem},
		dataType:'json',
		success:function(data){			
			console.log(data);

			if(data['enviado']){

				$('#form-contato').each(function(){
                  this.reset();
	            });

	            $('#btn-enviar').attr('disabled', false);
				$('#btn-enviar').html('Enviar Mensagem <i class="fas fa-paper-plane"></i>');

				$('#aviso-envio').replaceWith('<div class="alert alert-success alert-dismissible aviso" role="alert" id="aviso-envio"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <p>'+data['enviado']+' <i class="fas fa-check"></i></p></div>');

				$('#aviso-envio').show();

			}else if(data['email']){
				$('#aviso-email').html(data['email']);
				$('#btn-enviar').attr('disabled', false);
				$('#btn-enviar').html('Enviar Mensagem <i class="fas fa-paper-plane"></i>');
				$('#aviso-email').show();
			
			}else if(data['mensagem']){
				$('#aviso-mensagem').html(data['mensagem']);
				$('#btn-enviar').attr('disabled', false);
				$('#btn-enviar').html('Enviar Mensagem <i class="fas fa-paper-plane"></i>');
				$('#aviso-mensagem').show();
			}
		}
	});
	
});
	

});


/* Scroll com animação nos elementos */

// 1) Identificar quando o usuário utiliza o scroll
// 2) Calcular a distância entre o topo da página e o scroll
// 3) Calcular a distância entre o topo da página e o elemento que deseja animar
// 4) Comparar as duas distâncias anteriores
// 5) Adicionar uma classe com css animation ou transition ao elemento animado


(function(){ // Função encapsulada para não dar conflito com outras no escopo global

	var target = $('.anime'),
	animationClass = 'anime-start';
	//offset = $(window).height() * 3/4;

	function animeScroll(){
		var documentTop = $(document).scrollTop();	

		target.each(function(){
			var itemTop = $(this).offset().top;

			if(documentTop > itemTop - 400){
				$(this).addClass(animationClass);
			
			}
			/*else{
				$(this).removeClass(animationClass);	
			}*/
		});
	}

	animeScroll();
	
	$(document).scroll(function(){
		animeScroll();			
	});
	
})();
