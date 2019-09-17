<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;

use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("endereco", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}

$banco= DB::getInstance();

$sql_query= "SELECT * FROM endereco";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA ENDEREÇO</h2>
        
        <a style='position:relative; left:200px;' href='createEndereco.php'>Novo Cadastro</a> 

        <tr> 
            <th> Endereço ID </th>
            <th> Endereço </th>
            <th> Endereço 2 </th>
            <th> Bairro </th>
            <th> Cidade ID </th>
            <th> CEP </th>
            <th> Telefone </th>
            <th> Ultima Atualização </th>
            <th  class='botao'> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['endereco_id']." </td>
            <td> ".$linha['endereco']." </td>
            <td>".$linha['endereco2']." </td>
            <td>".$linha['bairro']." </td>
            <td>".$linha['cidade_id']." </td>
            <td> ".$linha['cep']." </td>
            <td> ".$linha['telefone']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 

            
            <td> 
            
                <a href='updateEndereco.php?id={$linha["endereco_id"]}'>Editar</a>

                <form method='GET' action='tabelaEndereco.php?id={$linha["endereco_id"]}'>
                    <button type='submit' name='id' value='{$linha["endereco_id"]}'> Deletar </button>
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
            text-align:center; 
            color:grey;
            border:solid 1px;
        }

        table{
            border:solid 1px;
            position: relative;
            left:200px;
        }
    </style>
</html>