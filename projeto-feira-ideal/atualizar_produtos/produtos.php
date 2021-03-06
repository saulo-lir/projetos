<?php 
require 'config.php';

// 1) Selecionar todos os estabelecimentos

$array = [];
$cnpjs = [];
$nome_loja = [];

$sql = $db->query("SELECT cnpj, razao_social, nome_fantasia FROM estabelecimentos WHERE ativo = 1");

if($sql->rowCount() > 0){
	$array = $sql->fetchAll();
}

foreach($array as $loja){
	$cnpjs[] = $loja['cnpj'];
	$nome_loja[] = ($loja['nome_fantasia'])?''.$loja['nome_fantasia'].'':''.$loja['razao_social'].'';
}


//print_r($nome_loja); exit;


// CNPJ e código de barras de todas as lojas e produtos usados no sistema
$produtos = [
	
	'estabelecimento' => $cnpjs,

	'produto' => [
		0 => '7893000079311', 1 => '7896481130267', 2 => '7896481130137', 3 => '7891091012026', 4 => '7896005021095', 5 => '7896012300916', 6 => '7891080400063', 7 => '7897261800011', 8 => '7896005276464', 9 => '7896099001027', 10 => '7896016411014', 11 => '7898902735167', 12 => '17896481140027', 13 => '7896099000334', 14 => '7893000436725', 15 => '7893000069367', 16 => '7891080803673', 17 => '7891024034880', 18 => '7891024132128', 19 => '7891024170335', 20 => '7891024161913', 21 => '7896098900253', 22 => '7891022101003', 23 => '7894650014295', 24 => '7891150055605', 25 => '7896224813082', 26 => '7791293032368', 27 => '7896005012222', 28 => '7791293032467', 29 => '7896213000462', 30 => '7896104998540', 31 => '7891010503024', 32 => '7891150052437', 33 => '7897664169524', 34 => '7891150044104', 35 => '7891700080354', 36 => '7899567219610', 37 => '7896013100966', 38 => '7898286190316', 39 => '7896607100174', 40 => '7891737707774', 41 => '7896221600012', 42 => '7891022859812', 43 => '7898301961082', 44 => '7896013103585', 45 => '7898088761462', 46 => '7898031170457', 47 => '7891149201006', 48 => '7896110100319', 49 => '7898394701305', 50 => '7702018880409', 51 => '7897395020101', 52 => '7702018072392', 53 => '7897146402064', 54 => '7894900018394', 55 => '7896945402169'
	]
];

//print_r($produtos); exit;