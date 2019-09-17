    <html>
    <body>
    
       <form method="POST" action="updateEndereco.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Endereço</label>
            <input type="text" name="ende"/>  <!--L2-->
            <br><br>

            <label>Endereço 2:</label>
            <input type="name" name="ende2"/>  <!--L2-->
            <br><br>

            <label>Bairro:</label>
            <input type="name" name="bairro"/>  <!--L2-->
            <br><br>

            <label>Cidade ID:</label>
            <input type="email" name="cid"/>  <!--L2-->
            <br><br>

            <label>CEP:</label>
            <input type="Text" name="cep"/>  <!--L2-->
            <br><br>

            <label>Telefone:</label>         <!--L3-->
            <input type="Text" name="tel"/> <!--L4-->
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
            height:450px;
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
        $endereco = $_POST['ende'];
        $endereco2 = $_POST['ende2'];
        $bairro = $_POST['bairro'];
        $cidade_id = $_POST['cid'];
        $cep = $_POST['cep'];
        $telefone = $_POST['tel'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($endereco))
        {
            echo "Por favor digite o seu endereço!"."<br>";
            $validacao = false;
        }

        if(empty($bairro))
        {
            echo "Por favor digite o seu bairro!"."<br>";
            $validacao = false;
        }

        if(empty($cidade_id))
        {
            echo "Por favor digite o id de sua cidade!"."<br>";
            $validacao = false;
        }

        if(empty($cep))
        {
            echo "Por favor digite o cep!"."<br>";
            $validacao = false;
        }

        if(empty($telefone))
        {
            echo "Por favor digite o seu telefone!"."<br>";
            $validacao = false;
        }

        if(empty($ultima_atualizacao))
        {
            echo "Por favor digite a ultima data de atualização!";
            $validacao = false;
        }

        if($validacao)
        {
            $banco= DB::getInstance();
            $sql = "UPDATE endereco set endereco=?, endereco2=?, bairro=?, cidade_id=?, cep=?, telefone=?, ultima_atualizacao=?) WHERE endereco_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($endereco, $endereco2, $bairro, $cidade_id, $cep, $telefone, $ultima_atualizacao));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:500px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaEndereco.php'>Visualizar Tabela</a>";
        }
    }
?>

