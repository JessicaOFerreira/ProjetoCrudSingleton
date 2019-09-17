<html>
    <body>
    
       <form method="POST" action="updateAtor.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">


            <label>Primeiro Nome:</label>
            <input type="name" name="nome"/>  <!--L2-->
            <br><br>

            <label>Ultimo Nome:</label>
            <input type="name" name="unome"/>  <!--L2-->
            <br><br>

            <label>Ultima Atualização</label>
            <input type="date" name="dataa"/>  <!--L2-->
            <br><br>

            <input type="submit" value="Cadastrar"/>
       </form>
    </body>

    <style>
        form{
            border:solid 1px;
            width:400px;
            height:300px;
            border-radius:10px;
            text-align:center;
            position: relative;
            left:380px;
            
        }
    </style>
    </html>

<?php

    require __DIR__.'/App/autoload.php';

    use DB\Conexao as DB;


    $id = null;
    
	if (!empty($_GET['id'])){
		$id = $_REQUEST['id'];
    }

    if(!empty($_POST)){
        $id=$_POST['id'];
        $primeiro_nomea = $_POST['nome'];
        $ultimo_nomea = $_POST['unome'];
        $ultima_atualizacaoa= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($primeiro_nomea))
        {
            echo "Por favor digite o seu nome!"."<br>";
            $validacao = false;
        }

        if(empty($ultimo_nomea))
        {
            echo "Por favor digite o seu ultimo nome!"."<br>";
            $validacao = false;
        }

        if(empty($ultima_atualizacaoa))
        {
            echo "Por favor digite a ultima data de atualização!"."<br>";
            $validacao = false;
        }

        if($validacao)
        {
            $banco= DB::getInstance();
            $sql = "UPDATE ator set primeiro_nome=?, ultimo_nome=?, ultima_atualizacao=? WHERE ator_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($primeiro_nomea, $ultimo_nomea, $ultima_atualizacaoa, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:450px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaAtor.php'>Visualizar Tabela</a>";
        }


    }
?>

