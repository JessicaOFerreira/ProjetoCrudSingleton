<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;

use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("cliente", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}
 


$banco= DB::getInstance();

$sql_query= "SELECT * FROM cliente ORDER BY cliente_id DESC";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA CLIENTE</h2>
        
        <a href='createCliente.php?acao=novo'>Novo Cadastro</a> 

        <tr> 
            <th> ID </th>
            <th> Loja ID </th>
            <th> Name </th>
            <th> Ultimo Nome </th>
            <th> Email </th>
            <th> Endereço ID </th>
            <th> Ativação </th>
            <th> Data Criação </th>
            <th> Ultima Atualização </th>
            <th  class='botao'> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['cliente_id']." </td>
            <td> ".$linha['loja_id']." </td>
            <td>".$linha['primeiro_nome']." </td>
            <td>".$linha['ultimo_nome']." </td>
            <td>".$linha['email']." </td>
            <td> ".$linha['endereco_id']." </td>
            <td> ".$linha['ativo']." </td>
            <td> ".$linha['data_criacao']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 

            
            <td> 
               
                <a href='updateCliente.php?id={$linha["cliente_id"]}'>Editar</a>
                
                <form method='GET' action='tabelaCliente.php?id={$linha["cliente_id"]}'>
                    <button type='submit' name='id' value='{$linha["cliente_id"]}'> Deletar </button>
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
            height:40px;
            text-align:center;
            border-bottom:solid 1px;
        }

        h2{
            text-align:center; 
            color:grey;
        }

        table{
            border:solid 1px;
        }
    </style>
</html>