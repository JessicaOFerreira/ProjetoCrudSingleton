<html>
    <body>
    
       <form method="POST" action="updateLoja.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Gerente ID:</label>
            <input type="name" name="gid"/>  <!--L2-->
            <br><br>

            <label>Endereço ID:</label>
            <input type="name" name="endid"/>  <!--L2-->
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

    if (!empty($_GET['id'])){
		$id = $_REQUEST['id'];
    }

    if(!empty($_POST)){
        
        $id=$_POST['id'];
    
        $gerente_id = $_POST['gid'];
        $endereco_id= $_POST['endid'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($gerente_id))
        {
            echo "Por favor digite o id do gerente!"."<br>";
            $validacao = false;
        }

        if(empty($endereco_id))
        {
            echo "Por favor digite o id de endereço!"."<br>";
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
            $sql = "UPDATE loja set gerente_id=?, endereco_id=?, ultima_atualizacao=? WHERE loja_id=?";
            $q = $banco->prepare($sql);
            $q->execute(array($gerente_id, $endereco_id, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:520px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:540px; font-size:16px;text-align:center;' href='tabelaLoja.php'>Visualizar Tabela</a>";
        }
    }
?>

