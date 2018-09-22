<?php
require 'produtos.php';

$count1 = count($produtos['estabelecimento']);
$count2 = count($produtos['produto']);
$total;
$resultado = [];


$ch = curl_init();

for($i=0;$i<$count1;$i++){   

    for($j=0;$j<$count2;$j++){

        curl_setopt_array($ch, [

            CURLOPT_URL => 'http://api.sefaz.al.gov.br/sfz_nfce_api/api/public/consultarPrecoProdutoEmEstabelecimento',

            CURLOPT_POST => true,

            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',        
                'AppToken: API_KEY'               
            ],

            CURLOPT_POSTFIELDS => json_encode([
                'cnpj' => $produtos['estabelecimento'][$i],
                'codigoBarras'=> $produtos['produto'][$j], 
                'quantidadeDeDias' => 3
            ]),

            CURLOPT_RETURNTRANSFER => true
            //CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        
        ]);

        $resultado['loja'.$i]['produto'.$j] = curl_exec($ch);
        $resultado['loja'.$i]['produto'.$j] = json_decode($resultado['loja'.$i]['produto'.$j]);

    }

}

//$resultado = json_encode($resultado);

curl_close($ch);


/*
echo '<br/><br/>';
print_r($resultado['loja0']['produto0']->codGetin); exit;

*/


echo "### STATUS ###";
echo "<br/><br/>";

echo "TOTAL DE ESTABELECIMENTOS: <strong>".$count1."</strong><br/>";
echo "TOTAL DE PRODUTOS: <strong>".$count2."</strong><br/>";

echo "<hr/>";

for($i=0;$i<$count1;$i++){ 

    $total = 0;

    echo "<br/>";  
    echo "<strong>".$nome_loja[$i]."</strong>";
    echo "<br/><br/>";

    for($j=0;$j<$count2;$j++){

        if($resultado['loja'.$i]['produto'.$j]){
                                
            $sql = $db->prepare("SELECT id FROM produtos WHERE cod_barras = :cod_barras AND cnpj_estabelecimento = :cnpj");
            $sql->bindValue(":cod_barras", $resultado['loja'.$i]['produto'.$j]->codGetin);
            $sql->bindValue(":cnpj", $resultado['loja'.$i]['produto'.$j]->numCNPJ);
            $sql->execute();

            if($sql->rowCount() > 0){ // Atualizar Registro

                $idProduto = $sql->fetch();

                $sql = $db->prepare("UPDATE produtos SET cnpj_estabelecimento = :cnpj, dscProduto = :nome, cod_barras = :cod_barras, valUltimaVenda = :valor, dthEmissaoUltimaVenda = :emissao, updated = NOW() WHERE id = :id");

                $sql->bindValue(":cnpj", $resultado['loja'.$i]['produto'.$j]->numCNPJ);
                $sql->bindValue(":nome", $resultado['loja'.$i]['produto'.$j]->dscProduto);
                $sql->bindValue(":cod_barras", $resultado['loja'.$i]['produto'.$j]->codGetin);
                $sql->bindValue(":valor", $resultado['loja'.$i]['produto'.$j]->valUltimaVenda);
                $sql->bindValue(":emissao", $resultado['loja'.$i]['produto'.$j]->dthEmissaoUltimaVenda);
                $sql->bindValue(":id", $idProduto[0]);
                $sql->execute();
                
                echo "PRODUTO <strong>".$resultado['loja'.$i]['produto'.$j]->dscProduto."</strong> <span style='color:#1E90FF'>ATUALIZADO COM SUCESSO!</span>";
                echo "<br/>";

                $total = $total+1;

            }else{ // Inserir novo registro

                $sql = $db->prepare("INSERT INTO produtos SET cnpj_estabelecimento = :cnpj, dscProduto = :nome, cod_barras = :cod_barras, valUltimaVenda = :valor, dthEmissaoUltimaVenda = :emissao, created = NOW()");

                $sql->bindValue(":cnpj", $resultado['loja'.$i]['produto'.$j]->numCNPJ);
                $sql->bindValue(":nome", $resultado['loja'.$i]['produto'.$j]->dscProduto);
                $sql->bindValue(":cod_barras", $resultado['loja'.$i]['produto'.$j]->codGetin);
                $sql->bindValue(":valor", $resultado['loja'.$i]['produto'.$j]->valUltimaVenda);
                $sql->bindValue(":emissao", $resultado['loja'.$i]['produto'.$j]->dthEmissaoUltimaVenda);
                $sql->execute();

                
                echo "PRODUTO <strong>".$resultado['loja'.$i]['produto'.$j]->dscProduto."</strong> <span style='color:#32CD32'>INSERIDO COM SUCESSO!</span>";
                echo "<br/>";

                $total = $total+1;

            }
        }        

    }

    echo "<br/>TOTAL DE PRODUTOS ATUALIZADOS: <strong>".$total."</strong><br/>";    

}
