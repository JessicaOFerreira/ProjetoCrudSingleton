<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;

use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("ator", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}

$banco= DB::getInstance();

$sql_query= "SELECT * FROM ator";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA ATORES </h2>
        
        <a style='position:relative; left:300px;' href='createAtor.php'>Novo Cadastro</a> 

        <tr> 
            <th> Ator ID </th>
            <th> Primeiro Nome </th>
            <th> Ultimo Nome </th>
            <th> Ultima Atualização </th>
            <th  class='botao'> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['ator_id']." </td>
            <td>".$linha['primeiro_nome']." </td>
            <td>".$linha['ultimo_nome']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 
            <td> 
                
                <a href='updateAtor.php?id={$linha["ator_id"]}'>Editar</a>

                <form method='GET' action='tabelaAtor.php?id={$linha["ator_id"]}'>
                    <button type='submit' name='id' value='{$linha["ator_id"]}'> Deletar </button>
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
            left:300px;
            border:solid 1px;

        }
    </style>
</html>