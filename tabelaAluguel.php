<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;
use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("aluguel", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}

$banco= DB::getInstance();

$sql_query= "SELECT * FROM aluguel";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA ALUGUEL</h2>
        
        <a href='createAluguel.php'>Novo Cadastro</a> 

        <tr> 
            <th> Aluguel ID </th>
            <th> Data Aluguel </th>
            <th> Inventario </th>
            <th> Cliente ID </th>
            <th> Data Devolução </th>
            <th> Funcionário ID </th>
            <th> Ultima Atualização </th>
            <th> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['aluguel_id']." </td>
            <td> ".$linha['data_de_aluguel']." </td>
            <td>".$linha['inventario_id']." </td>
            <td>".$linha['cliente_id']." </td>
            <td>".$linha['data_de_devolucao']." </td>
            <td> ".$linha['funcionario_id']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 
            <td> 
            
                <a href='updateAluguel.php?id={$linha["aluguel_id"]}'>Editar</a>

                <form method='GET' action='tabelaAluguel.php?id={$linha["aluguel_id"]}'>
                    <button type='submit' name='id' value='{$linha["aluguel_id"]}'> Deletar </button>
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
        }
    </style>
</html>