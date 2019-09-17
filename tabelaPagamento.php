<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;

use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("pagamento", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}

$banco= DB::getInstance();

$sql_query= "SELECT * FROM pagamento";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA DE PAGAMENTOS </h2>
        
        <a href='createPagamento.php'>Novo Cadastro</a> 

        <tr> 
            <th> Pagamento ID </th>
            <th> Cliente ID </th>
            <th> Funcionario ID </th>
            <th>Aluguel ID </th>
            <th> Valor </th>
            <th> Data de Pagamento </th>
            <th> Ultima Atualização </th>
            <th  class='botao'> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['pagamento_id']." </td>
            <td>".$linha['cliente_id']." </td>
            <td>".$linha['funcionario_id']." </td>
            <td>".$linha['aluguel_id']." </td>
            <td>".$linha['valor']." </td>
            <td>".$linha['data_de_pagamento']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 
            <td> 
                
                <a href='updatePagamento.php?id={$linha["pagamento_id"]}'>Editar</a>
                    
                <form method='GET' action='tabelaPagamento.php?id={$linha["pagamento_id"]}'>
                    <button type='submit' name='id' value='{$linha["pagamento_id"]}'> Deletar </button>
                <form>
            </td>
        </tr>
        ";
    }

    echo "
        </tbody>
    </table>
    ";
}
?>

<!DOCTYPE html>
<html>
    <style>

a:link, a:visited, a:active {
	    color:blue;
        font-size:18px;
	}   
         button{
            width:100px;
             position:relative;
            margin-top:3px;
            background-color:rgb(255,100,100);
         }
        th{
            height:30px;
            text-align:center;
            border:solid 1px;
            color:grey;
        }

        td{
            width:70px;
            height:30px;
            text-align:center;
            border-bottom:solid 1px;
        }

        h2{
            position:relative;
            
            text-align:center; 
            color:grey;
        }
        table{
            position:relative;
            left:350px;
            border:solid 1px;
        }
    </style>
</html>