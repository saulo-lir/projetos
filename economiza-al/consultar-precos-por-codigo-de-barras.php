<?php 

// Consultar Preço de um Produto pelo seu Código de Barras

$ch = curl_init();

curl_setopt_array($ch, [

    CURLOPT_URL => 'http://api.sefaz.al.gov.br/sfz_nfce_api/api/public/consultarPrecosPorCodigoDeBarras',

    CURLOPT_POST => true,

    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',        
        'AppToken: API_KEY'               
    ],

    CURLOPT_POSTFIELDS => json_encode([
        'codigoDeBarras' => '7791293032368',
        'dias' => 3,
        'latitude' => -9.6432331,
        'longitude' => -35.7190686,
        'raio' => 15
    ]),

    CURLOPT_RETURNTRANSFER => true
    //CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
    
]);

$resultado = curl_exec($ch);
curl_close($ch);

echo $resultado;