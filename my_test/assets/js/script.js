
$(function(){

var result;

// Script para o login
$('#login').bind('submit', function(e){
	e.preventDefault();

	var login = $('#username').val();
	var senha = $('#senha').val();	

	$('#btn-entrar').attr('disabled', 'disabled');
    $('#btn-entrar').val('Validando...');	

	$.ajax({
		type:'POST',
		url:'https://beta.saulo.bonom.com.br/webroot/my_test/site/login.php',
		data:{login:login,senha:senha},
		success:function(data){				
			result = JSON.parse(data);			

			if(result['response']['status']){

				window.location.href = 'https://beta.saulo.bonom.com.br/webroot/my_test/site/sistema.php';
				
			}else if(!result['senha']){
				
				$('#btn-entrar').attr('disabled', false);
				$('#btn-entrar').val('Entrar');

				$('#alert-senha').html('<p class="aviso-input">'+result['response']['mensagem']+'</p>');
				
			}else if(!result['login']){
				
				$('#btn-entrar').attr('disabled', false);
				$('#btn-entrar').val('Entrar');

				$('#alert-login').html('<p class="aviso-input">'+result['response']['mensagem']+'</p>');				
			
			}else if(result['response']['erro']){

				$('#btn-entrar').attr('disabled', false);
				$('#btn-entrar').val('Entrar');
				
				$('#alert-userpass').replaceWith('<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+result['response']['mensagem']+'</div>');				
			}

		}
	});


});

// Script para o cadastro de novo usuário
$('#cadastro').bind('submit', function(e){
	e.preventDefault();

	var nome = $('#nome').val();	
	var email = $('#email').val();
	var login = $('#login-cadastro').val();
	var senha = $('#senha-cadastro').val();	
	var forca = 0;

	/* Validação da senha */

	// Minimo de 6 caracteres
	if(senha.length >= 6){ 
		forca = 25;		
	}	

	// Letras maiúsculas
	var reg = new RegExp(/[A-Z]/);

	if(reg.test(senha)){
		forca += 25;
	}	

	// Letras minúsculas
	var reg = new RegExp(/[a-z]/);

	if(reg.test(senha)){
		forca += 25;
	}	

	// Números
	var reg = new RegExp(/[0-9]/i);
    if(reg.test(senha)){
        forca += 25;    
    }

    if(forca < 100){
    	$('#aviso-senha').replaceWith('<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <p>A senha deve conter no mínimo <strong>6 carateres</strong>, letras <strong>maiúsculas</strong>, <strong>minúsculas</strong> e <strong>números</strong> !</p></div>');    	
    
    /* Validação da senha */

    }else{

    	$('#btn-cadastrar').attr('disabled', 'disabled');
    	$('#btn-cadastrar').val('Salvando...');

    	// Enviar dados para o cadastro
    	$.ajax({
			type:'POST',
			url:'https://beta.saulo.bonom.com.br/webroot/my_test/site/cadastrar.php',
			data:{nome:nome,email:email,login:login,senha:senha},
			success:function(data){				
				result = JSON.parse(data);					

				if(result['response']['status']){

					$('#main-container').replaceWith('<div class="row" id="congratulations-container"><div class="col-md-12 text-center congratulations"><h2>'+result['response']['mensagem']+' <i class="fas fa-check"></i></h2><br/><h4>Confirme seu cadastro clicando no link que enviamos para seu email <i class="fas fa-exclamation-triangle"></i></h4><button class="btn btn-lg btn-info" id="btn-cadastrar-mais">Voltar à tela principal</button></div></div>');

					$('#btn-cadastrar-mais').bind('click', function(){

						window.location.href = window.location.href;

					});
				
				}else if(!result['nome']){
					$('#btn-cadastrar').attr('disabled', false);
    				$('#btn-cadastrar').val('Cadastrar');

					$('#aviso-nome').html('<p class="aviso-input">'+result['response']['mensagem']+'</p>');
				
				}else if(!result['email']){
					$('#btn-cadastrar').attr('disabled', false);
    				$('#btn-cadastrar').val('Cadastrar');
					
					$('#aviso-email').html('<p class="aviso-input">'+result['response']['mensagem']+'</p>');
				
				}else if(!result['login']){
					$('#btn-cadastrar').attr('disabled', false);
    				$('#btn-cadastrar').val('Cadastrar');
					
					$('#aviso-login').html('<p class="aviso-input">'+result['response']['mensagem']+'</p>');
				
				}else if(!result['senha']){
					$('#btn-cadastrar').attr('disabled', false);
    				$('#btn-cadastrar').val('Cadastrar');
					
					$('#aviso-senha').html('<p class="aviso-input">'+result['response']['mensagem']+'</p>');
				
				}else if($('#email').val() == result['response']['email']){
					$('#btn-cadastrar').attr('disabled', false);
    				$('#btn-cadastrar').val('Cadastrar');
					
					$('#aviso-email').html('<p class="aviso-input">Esse email já está cadastrado!</p>');
				
				}else if($('#login-cadastro').val() == result['response']['login']){
					$('#btn-cadastrar').attr('disabled', false);
    				$('#btn-cadastrar').val('Cadastrar');
					
					$('#aviso-login').html('<p class="aviso-input">Esse login já está cadastrado!</p>');
				
				}
				
			}
		});
    }		

});

});

