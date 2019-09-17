<html>
    <body>
    
       <form method="POST" action="updateAluguel.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Data Aluguel:</label>
            <input type="date" name="dataalu"/>  <!--L2-->
            <br><br>

            <label>Inventário:</label>
            <input type="text" name="ive"/>  <!--L2-->
            <br><br>

            <label>Cliente Id:</label>
            <input type="text" name="cid"/>  <!--L2-->
            <br><br>

            <label>Data Devolução:</label>
            <input type="date" name="datadev"/>  <!--L2-->
            <br><br>

            <label>Funcionario ID</label>         <!--L3-->
            <input type="text" name="fid"/> <!--L4-->
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
            height:400px;
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
        $data_de_aluguel = $_POST['dataalu'];
        $inventario_id= $_POST['ive'];
        $cliente_id= $_POST['cid'];
        $data_de_devolucao= $_POST['datadev'];
        $funcionario_id= $_POST['fid'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($data_de_aluguel))
        {
            echo "Por favor digite a data de aluguel!"."<br>";
            $validacao = false;
        }

        if(empty($inventario_id))
        {
            echo "Por favor digite o snumero do inventário!"."<br>";
            $validacao = false;
        }

        if(empty($cliente_id))
        {
            echo "Por favor digite o código do cliente!"."<br>";
            $validacao = false;
        }

        if(empty($data_de_devolucao))
        {
        echo "Por favor informe a dtaa de devolução!"."<br>";
            $validacao = false;
        }

        if(empty($funcionario_id))
        {
            echo "Por favor digite o código do funcionário!"."<br>";
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
            $sql = "UPDATE aluguel set data_de_aluguel=?, inventario_id=?, cliente_id=?, data_de_devolucao=?, funcionario_id =? ,ultima_atualizacao=? WHERE aluguel_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($data_de_aluguel, $inventario_id, $cliente_id, $data_de_devolucao, $funcionario_id, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:450px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaAluguel.php'>Visualizar Tabela</a>";
        }

        else
        {
        $banco= DB::getInstance();
        $sql = "SELECT * FROM aluguel where alugue_id = ?";
        $q = $banco->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $data_de_aluguel = $data['data_de_aluguel'];
        $inventario_id= $data['inventario_id'];
        $cliente_id= $data['cliente_id'];
        $data_de_devolucao= $data['data_de_devolucao'];
        $funcionario_id= $data['funcionario_id'];
        $ultima_atualizacao= $data['ultima_atualizacao'];
        DB::disconnect();
    }
    }
?>

