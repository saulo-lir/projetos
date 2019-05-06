<?php

$estados = [
    'AC'=>'Acre',
    'AL'=>'Alagoas',
    'AP'=>'Amapá',
    'AM'=>'Amazonas',
    'BA'=>'Bahia',
    'CE'=>'Ceará',
    'DF'=>'Distrito Federal',
    'ES'=>'Espírito Santo',
    'GO'=>'Goiás',
    'MA'=>'Maranhão',
    'MT'=>'Mato Grosso',
    'MS'=>'Mato Grosso do Sul',
    'MG'=>'Minas Gerais',
    'PA'=>'Pará',
    'PB'=>'Paraíba',
    'PR'=>'Paraná',
    'PE'=>'Pernambuco',
    'PI'=>'Piauí',
    'RJ'=>'Rio de Janeiro',
    'RN'=>'Rio Grande do Norte',
    'RS'=>'Rio Grande do Sul',
    'RO'=>'Rondônia',
    'RR'=>'Roraima',
    'SC'=>'Santa Catarina',
    'SE'=>'Sergipe',
    'SP'=>'São Paulo',
    'TO'=>'Tocantins'
];

/* Inserir dados no banco no padrão das migrations do framework Yii2 */

/* Inserir Estados */
$count = 1;
while ($nome_estado = current($estadosBrasileiros)) {
    
    $this->insert('{{%estado}}', [
        'id' => $count,
        'uf' => array_search($nome_estado, $estadosBrasileiros),
        'nome' => $nome_estado
    ]);

    $count++;
    next($estadosBrasileiros);
}