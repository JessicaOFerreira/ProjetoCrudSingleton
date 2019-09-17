<?php


require __DIR__.'/App/autoload.php';


use DB\Conexao as DB;

use App\Delete\Excluir;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $apagar= new Excluir("filme", $_GET["id"]);
    $table= $apagar->excluir();
    echo $apagar;
}

$banco= DB::getInstance();

$sql_query= "SELECT * FROM filme";

$q=$banco->prepare($sql_query);


if($q->execute()){ 
    echo "
 <table>
   <thead>
        <h2>TABELA DE FILMES</h2>
        
        <a href='createFilme.php'>Novo Cadastro</a> 

        <tr> 
            <th>Filme ID </th>
            <th> Titulo </th>
            <th> Descrição 2 </th>
            <th> Ano de Lançamento </th>
            <th> Idioma </th>
            <th> Idioma Original </th>
            <th> Duração da Locação</th>
            <th> Preço da Locação</th>
            <th> Duração do Filme</th>
            <th> Custo de Substituição</th>
            <th> Classificação</th>
            <th> Recursos Especiais</th>
            <th> Ultima Atualização </th>
            <th  class='botao'> Ações </th>
        </tr>
    </thead>

    <tbody>  
";

    while($linha= $q->fetch(PDO::FETCH_ASSOC)){ //criar formulario em volta dos botoes e no botao de novo
        echo "
        <tr> 
            <td> ".$linha['filme_id']." </td>
            <td> ".$linha['titulo']." </td>
            <td>".$linha['descricao']." </td>
            <td>".$linha['ano_de_lancamento']." </td>
            <td>".$linha['idioma_id']." </td>
            <td> ".$linha['idioma_original_id']." </td>
            <td> ".$linha['duracao_da_locacao']." </td>
            <td> ".$linha['preco_da_locacao']." </td>
            <td> ".$linha['duracao_do_filme']." </td>
            <td> ".$linha['custo_de_substituicao']." </td>
            <td> ".$linha['classificacao']." </td>
            <td> ".$linha['recursos_especiais']." </td>
            <td> ".$linha['ultima_atualizacao']." </td> 

            
            <td> 
            
                <a href='updateFilme.php?id={$linha["filme_id"]}'>Editar</a>

                <form method='GET' action='tabelaFilme.php?id={$linha["filme_id"]}'>
                    <button type='submit' name='id' value='{$linha["filme_id"]}'> Deletar </button>
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