<?php

// Consultar Preço de um Produto em um Estabelecimento


$ch = curl_init();

curl_setopt_array($ch, [

    CURLOPT_URL => 'http://api.sefaz.al.gov.br/sfz_nfce_api/api/public/consultarPrecoProdutoEmEstabelecimento',

    CURLOPT_POST => true,

    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',        
        'AppToken: API_KEY'               
    ],

    CURLOPT_POSTFIELDS => json_encode([
        'cnpj' => '08032172000159', // CNPJ do RODA VIVA
        'codigoBarras'=> '7891024161913', 
        'quantidadeDeDias' => 3
    ]),

    CURLOPT_RETURNTRANSFER => true
    //CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
    
]);

$resultado = curl_exec($ch);
curl_close($ch);

echo $resultado;
