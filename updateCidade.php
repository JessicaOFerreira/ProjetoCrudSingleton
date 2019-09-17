<html>
    <body>
    
       <form method="POST" action="updateCidade.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">


            <label>Cidade:</label>
            <input type="name" name="cidade"/>  <!--L2-->
            <br><br>

            <label>Pais ID:</label>
            <input type="name" name="pid"/>  <!--L2-->
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
        $cidade = $_POST['cidade'];
        $pais_id = $_POST['pid'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($cidade))
        {
            echo "Por favor digite o nome da cidade!"."<br>";
            $validacao = false;
        }

        if(empty($pais_id))
        {
            echo "Por favor digite id do pais!"."<br>";
            $validacao = false;
        }

        if(empty($ultima_atualizacao))
        {
            echo "Por favor digite a ultima data de atualização!"."<br>";
            $validacao = false;
        }

        if($validacao)
        {
            $banco= DB::getInstance();
            $sql = "UPDATE cidade set cidade=?, pais_id=?, ultima_atualizacao=? WHERE cidade_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($cidade, $pais_id, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:450px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaCidade.php'>Visualizar Tabela</a>";
        }
    }
?>

