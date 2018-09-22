$(function(){	

	/* Script Login */	

	$('#login').bind('submit', function(e){
		e.preventDefault();
		var dados = $(this).serialize();				

		$('#alert-login').hide();
		$('#btn-entrar').attr('disabled','disabled');
		$('#btn-entrar').html('Entrando...');		

		$.ajax({
			type:'POST',
			url:'http://localhost/projetos_local/projeto-feira-ideal/api/usuarios/login',
			data:{dados:dados},
			dataType:'json',
			success:function(data){				

				if(data){

					$('#login').each(function(){
						this.reset();
					});

					window.location.href = 'http://localhost/projetos_local/projeto-feira-ideal/site/home';
				
				}else{

					$('#alert-login').replaceWith('<div class="alert alert-warning text-center" id="alert-login"> <p>Usuário e/ou Senha Inválidos! <i class="fas fa-times"></i></p></div>');

					$('#alert-login').show();

					$('#btn-entrar').attr('disabled', false);
					$('#btn-entrar').html('Entrar <i class="fas fa-sign-in-alt"></i>');
				}				
			}
		});


	});
	

	/* Script Sistema */

	// Div do produto
	adicionaCamposProdutos();

	// Exibir ou não o botão de excluir
	botaoExcluirProduto();   


	//Selecionar Estabelecimento
	$('#estabelecimento').on('change', function(){
		var loja = $('select option:selected').val();
		$('#alert-select').hide();

		$.ajax({
			type:'GET',
			url:'http://localhost/projetos_local/projeto-feira-ideal/api/feira/selecionarLoja',
			data:{loja:loja},
			dataType:'json',
			success:function(data){
				//console.log(data);

				if(data){

					// Formatando o endereço
					var endereco = new Array(4);

					endereco[0] = data['logradouro'];					
					endereco[1] = data['numero'];
					endereco[2] = data['bairro'];
					endereco[3] = data['municipio'];
										
					endereco = endereco.join(', ');						

					$('#detalhes-loja').replaceWith('<div id="detalhes-loja" class="row loja"> <div class="col-md-6 col-md-offset-2 text-center"> <p>'+endereco+'</p> </div><div class="col-md-2"> <a href="#" data-toggle="modal" data-target="#mapa-modal"><p>Ver no Mapa <i class="fas fa-map-marker-alt"></i></p></a> </div></div>');															

					// Preenchendo os dados do modal do mapa
					if(data['nome_fantasia']){
						$('#nome-loja').html(data['nome_fantasia']);
					}else{
						$('#nome-loja').html(data['razao_social']);
					}
					

					data['latitude'] = parseFloat(data['latitude']);
					data['longitude'] = parseFloat(data['longitude']);

					initMap(data['latitude'], data['longitude']);
					
				}				
			}

		});
	});	


	// Ocultar painel de cálculo ao abrir mapa da loja
	$('#mapa-modal').on('shown.bs.modal', function (e) {

		$('.painel-calculo').hide();	

	});

	$('#mapa-modal').on('hidden.bs.modal', function (e) {

		$('.painel-calculo').show();

	});
	
	
});


/* Mapa das lojas */

function initMap(latitude, longitude) {	

  var map;
  var marker;

  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: latitude, lng: longitude},
    zoom: 17
  });

  marker = new google.maps.Marker({
      position: {lat: latitude, lng: longitude},
      map: map
  });
  
}


/* Menu Lateral */

function openNav() {	
	$('#bgbox').fadeIn('fast');
	$('#menu-content').show();
    $("#mySidenav").css({'width':'250px'});
}

function closeNav() {	
    $('#bgbox').fadeOut('fast');
    $('#menu-content').hide();
    $("#mySidenav").css({'width':'0px'});
}


/* Adicionar Novo Campo para Produto */

var totalProdutos = 1;
var countProduto;

// Verificar se o botão de excluir pode aparecer ou não
function botaoExcluirProduto(){

    if(totalProdutos > 1){
      $('.btn-excluir').hide();
    }else{
      $('.btn-excluir').show();
    }
}


// Remove uma Div de produtos
function excluirProduto(num){	

	if(totalProdutos > 1){
    	$('#produto-'+num).remove();
    	$('#detalhe-'+num).remove();
        totalProdutos--; 
    }
      
}

// Adiciona uma Div de produtos
function adicionaCamposProdutos(){	

    countProduto = totalProdutos; 
    totalProdutos++;

    $('#lista-produtos').append('<div class="row" id="produto-'+countProduto+'" style="margin-bottom: 20px"> <div class="col-md-9"> <div class="input-group"> <input type="text" class="form-control item_cod" id="input-'+countProduto+'" placeholder="Código de barras do produto"> <span class="input-group-btn"> <button class="btn btn-default" id="btn-pesquisar-'+countProduto+'" type="button" onclick="pesquisarProduto('+countProduto+')" "><i class="fas fa-search"></i> Pesquisar</button> </span> </div><p class="alert-input" id="alert-input-'+countProduto+'">Campo Obrigatório!</p></div><div class="col-md-3 btns-action"> <button onclick="adicionaCamposProdutos()" class="btn btn-success btn-circle" title="Adicionar outro produto"><i class="fas fa-plus"></i></button> <button onclick="excluirProduto('+countProduto+')" class="btn btn-danger btn-circle btn-excluir" title="Remover produto"><i class="fas fa-minus"></i></button> </div></div>'); 

}


/* Pesquisar produto em estabelecimento */

function pesquisarProduto(idProduto){		

	var loja = $('select option:selected').val();
	var produto = $('#input-'+idProduto).val();	

	// Expressão regular para só aceitar números
	var regexp = new RegExp(/[^\d]+/g); 
	var check = regexp.test(produto);	
		
	if(loja == 'ESCOLHA UM ESTABELECIMENTO:' || !loja){
		$('#estabelecimento').focus();
		$('#alert-select').show();
	
	}else if(!produto){
		$('#alert-input-'+idProduto).show();

	}else if(produto.length < 8 || produto.length > 14 || check == true){

		$('#alert-input-'+idProduto).replaceWith('<p class="alert-input" id="alert-input-'+idProduto+'">Informe um código de barras válido!</p>');

		$('#alert-input-'+idProduto).show();	

	}else{
		$('#alert-select').hide();
		$('#alert-input-'+idProduto).hide();

		$('#btn-pesquisar-'+idProduto).attr('disabled', 'disabled');
		$('#btn-pesquisar-'+idProduto).html('Pesquisando...');

		$.ajax({
			type:'GET',
			url:'http://localhost/projetos_local/projeto-feira-ideal/api/feira/selecionarProduto',
			data:{loja:loja, produto:produto},
			dataType:'json',
			success:function(data){
				//console.log(data);

				if(data){					

					$('#detalhes-produtos').find('#descricao').append('<tr id="detalhe-'+countProduto+'" class="detalhe-'+countProduto+'"><td class="td-quant"><input id="spinner-'+countProduto+'" value="1"></td><td class="td-nome">'+data['dscProduto']+'</td><td class="td-data">'+data['dthEmissaoUltimaVenda']+'</td><td class="td-preco">R$ <span class="produto-valor" id="preco-'+countProduto+'">'+data['valUltimaVenda'].toFixed(2).replace(".",",")+'</span></td></tr>');

					var id = '#preco-'+countProduto; // Salvando o id atual do preço

					var precoProduto = parseFloat($('#preco-'+countProduto).text().replace(",",".")); // Salvando preço atual do produto

					// Componente spinner do input quantidade nos detalhes do produto
				    $( "#spinner-"+countProduto ).spinner({
				      spin: function( event, ui ) {
				        if ( ui.value < 1 ) {
				          $( this ).spinner( "value", 1 );
				          return false;
				        
				        }else{		        	

				        // Calcular novo valor do produto conforme a quantidade
				        	var quantidade = ui.value; 		        	
				        	var total = quantidade * precoProduto;

				        	$(id).html(total.toFixed(2).replace(".",","));
				        } 

				      }
				    });			    	
					
				}else{

					$('#detalhes-produtos').find('#descricao').append('<tr class="warning search-fail" id="detalhe-'+countProduto+'"> <td colspan="4"> PRODUTO NÃO ENCONTRADO <i class="far fa-frown"></i> </td></tr>');
				}

							
				$('#btn-pesquisar-'+idProduto).attr('disabled', false);
				$('#btn-pesquisar-'+idProduto).html('<i class="fas fa-search"></i> Pesquisar');
			}
		});

	}	
	
}

function calcularFeira(){

	$('#btn-calcular').attr('disabled', 'disabled');
	$('#btn-calcular').html('Calculando... <i style="margin-left:10px" class="fas fa-calculator"></i>');

	var total = 0;	

	$('.produto-valor').each(function(){

		total += parseFloat($(this).text().replace(",","."));

	});

	total = total.toFixed(2).replace(".",",");	

	$('#valor-total').html(total);

	$('#btn-calcular').attr('disabled', false);
	$('#btn-calcular').html('Calcular Feira <i style="margin-left:10px" class="fas fa-calculator"></i>');
	
}

function salvarFeira(idUser){
	var cnpj = $('select option:selected').val();
	var nomeFeira;
	var cod_barras = [];
	var quantidade = [];
	var descricao = [];
	var ultRegistro = [];
	var preco = [];

	if(cnpj == 'ESCOLHA UM ESTABELECIMENTO:' || !cnpj){
		$('#estabelecimento').focus();
		$('#alert-select').show();

	}else{

		// Abrir modal para inserir nome da feira

		$( "#dialog-confirm" ).dialog({
		  show: { effect: "scale", duration: 150 },
		  hide: { effect: "scale", duration: 150 },
		  position: { my: "top", at: "top+20%", of: window },
	      resizable: false,
	      height: 200,
	      width: 500,
	      modal: true,
	      buttons: [
		      {
		        text:"Salvar",
		        icon: "ui-icon-check",
		        click: function() {

		        	// Selecionando os itens da feira
		        	nomeFeira = $('#nome-feira').val();

					$('.item_cod').each(function(){
						cod_barras.push($(this).val());
					});

					$('.ui-spinner-input').each(function(){
						quantidade.push(parseInt($(this).val()));
					});

					$('.td-nome').each(function(){
						descricao.push($(this).text());
					});

					$('.td-data').each(function(){
						ultRegistro.push($(this).text());
					});

					$('.produto-valor').each(function(){
						preco.push(parseFloat($(this).text().replace(",",".")));
					});
				

					$.ajax({
						type:'POST',
						url:'http://localhost/projetos_local/projeto-feira-ideal/api/feira/salvarFeira/',
						data:{id_user:idUser,
							  cnpj:cnpj,
							  nome_feira:nomeFeira,
							  cod_barras:cod_barras,
							  quantidade:quantidade,
							  descricao:descricao,
							  ult_registro:ultRegistro,
							  preco:preco},
						dataType:'json',
						success:function(data){
							console.log(data);

							$('#nome-feira').val('');
							$( "#dialog-confirm" ).dialog( "close" );

							$.notify("Feira Salva com Sucesso!", {
								className: 'success'
							});
						}
					});							          
		        }
		      },
		      {
		        text:"Cancelar",
		        icon: "ui-icon-close",
		        click: function() {
		          $( this ).dialog( "close" );
		        }
		      }
	      ]
	    });				

	}

}
