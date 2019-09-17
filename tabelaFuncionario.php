<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;

use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("funcionario", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}


$banco= DB::getInstance();

$sql_query= "SELECT * FROM funcionario";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA FUNCIONARIO</h2>
        
        <a href='createFuncionario.php'>Novo Cadastro</a> 

        <tr> 
            <th> Funcionario ID </th>
            <th> Primeiro Nome </th>
            <th> Ultimo Nome </th>
            <th> Endereço ID </th>
            <th> Foto </th>
            <th> Email </th>
            <th> Loja ID </th>
            <th> Ativação </th>
            <th> Usuário </th>
            <th> Senha </th>
            <th> Ultima Atualização </th>
            <th  class='botao'> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['funcionario_id']." </td>
            <td>".$linha['primeiro_nome']." </td>
            <td>".$linha['ultimo_nome']." </td>
            <td> ".$linha['endereco_id']." </td>
            <td> ".$linha['foto']." </td>
            <td>".$linha['email']." </td>
            <td> ".$linha['loja_id']." </td>
            <td> ".$linha['ativo']." </td>
            <td> ".$linha['usuario']." </td>
            <td> ".$linha['senha']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 
        
            <td> 
            
                <a href='updateFuncionario.php?id={$linha["funcionario_id"]}'>Editar</a> 
                
                <form method='GET' action='tabelaFuncionario.php?id={$linha["funcionario_id"]}'>
                    <button type='submit' name='id' value='{$linha["funcionario_id"]}'> Deletar </button>
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
        table{
            border:solid 1px;
        }
    </style>
</html>