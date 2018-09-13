
/* Script para página de perfil */

$(function(){	

	// Carregar dados do perfil
	$.ajax({
		type:'GET',
		url:'https://beta.saulo.bonom.com.br/webroot/my_test/site/list-user.php',
		data:{},		
    	success:function(data){	    		
    		var result = JSON.parse(data);    		    		

    		// Foto de perfil
    		if(result['foto']['nome_foto']){    			
    			$('#perfil-avatar').attr('src', 'https://beta.saulo.bonom.com.br/webroot/my_test/assets/perfil/'+result['foto']['nome_foto']);
    		
    		}else{    			
    			$('#perfil-avatar').attr('src', 'https://beta.saulo.bonom.com.br/webroot/my_test/assets/img/user.svg');
    		}

    		// Dados de perfil
    		if(result['perfil']['usuario'].length > 0){
    			$('#info-perfil').replaceWith('<div id="info-perfil"> <h4>'+result['perfil']['usuario']+'</h4> <h4>Email: '+result['perfil']['email']+'</h4> <h4>Login: '+result['perfil']['login']+'</h4> <br/>');    		
    		}
    		
    	}
	});	

	// Atualizar dados pessoais do perfil
	$('#form-update').bind('submit', function(e){
		e.preventDefault();

		var senha = $('#senha-update').val();	
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
	    	$('#alert-update').replaceWith('<div class="alert alert-danger alert-dismissible" role="alert" id="alert-update"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <p>A senha deve conter no mínimo <strong>6 carateres</strong>, letras <strong>maiúsculas</strong>, <strong>minúsculas</strong> e <strong>números</strong>! <i class="far fa-times-circle"></i></p></div>');    	
	    
	    /* Validação da senha */

	    }else{

	    	$.ajax({
				type:'POST',
				url:'https://beta.saulo.bonom.com.br/webroot/my_test/site/update-perfil.php',
				data:{senha:senha},		
		    	success:function(data){
		    		var result = JSON.parse(data);

		    		if(result){
		    			
		    			$('#form-update').each(function(){
		                  this.reset();
			            });

				    	$('#alert-update').replaceWith('<div class="alert alert-success alert-dismissible" role="alert" id="alert-update"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <p>Senha atualizada com sucesso! <i class="fas fa-check"></i></p></div>');
		    		}		    				    		
			    	
		    	} 

		    });
	    	 	    	
	    }
		
	});

});


// Atualizar foto de perfil

function uploadFoto(){	

	$('#btn-submit').trigger('click');

}

function atualizarFoto(){

	$('#form-foto').bind('submit', function(e){
		e.preventDefault();		

		$.ajax({
			type:'POST',
			url:'https://beta.saulo.bonom.com.br/webroot/my_test/site/update-perfil.php',
			data: new FormData(this),
			cache:false,
			processData: false,
	    	contentType: false,
	    	success:function(data){	    		
	    		nomeFoto = JSON.parse(data);				

	    		$('#perfil-avatar').attr('src', 'https://beta.saulo.bonom.com.br/webroot/my_test/assets/perfil/'+nomeFoto);
	    	}

		});
	});
	
}