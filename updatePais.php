<html>
    <body>
    
       <form method="POST" action="updatePais.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Pais:</label>
            <input type="name" name="pais"/>  <!--L2-->
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
            height:200px;
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
    
        $pais= $_POST['pais'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($pais))
        {
            echo "Por favor digite o nome do pais!"."<br>";
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
            $sql = "UPDATE pais set pais=?, ultima_atualizacao=? WHERE pais_id=?";
            $q = $banco->prepare($sql);
            $q->execute(array($pais, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:480px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaPais.php'>Visualizar Tabela</a>";
        }
    }
?>

