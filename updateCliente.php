<html>
    <body>
    
       <form method="post" action="updateCliente.php"> 

            <h3>Formulário de Atualização</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Loja Id:</label>
            <input type="text" name="lid"/>  <!--L2-->
            <br><br>

            <label>Nome:</label>
            <input type="name" name="nome"/>  <!--L2-->
            <br><br>

            <label>Ultimo Nome:</label>
            <input type="name" name="unome"/>  <!--L2-->
            <br><br>

            <label>E-mail:</label>
            <input type="email" name="email"/>  <!--L2-->
            <br><br>

            <label>Endereço ID:</label>
            <input type="Text" name="endid"/>  <!--L2-->
            <br><br>

            <label>Ativação</label>         <!--L3-->
            <input type="text" name="ativ"/> <!--L4-->
            <br><br>

            <label>Data Criacao:</label>
            <input type="date" name="datac"/>  <!--L2-->
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

        $loja_id = $_POST['lid'];
        $primeiro_nome = $_POST['nome'];
        $ultimo_nome = $_POST['unome'];
        $email = $_POST['email'];
        $endereco_id = $_POST['endid'];
        $ativo = $_POST['ativ'];
        $data_criacao=$_POST['datac'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($loja_id ))
        {
            echo "Por favor digite o seu id de loja!"."<br>";
            $validacao = false;
        }

        if(empty($primeiro_nome))
        {
            echo "Por favor digite o seu nome!"."<br>";
            $validacao = false;
        }

        if(empty($ultimo_nome))
        {
            echo "Por favor digite o seu ultimo nome!"."<br>";
            $validacao = false;
        }

        if(empty($email))
        {
            echo "Por favor digite o seu email!"."<br>";
            $validacao = false;
        }

        if(empty($endereco_id))
        {
            echo "Por favor digite o seu id de endereco!"."<br>";
            $validacao = false;
        }

        if(empty($ativo))
        {
            echo "Por favor digite o seu numero de ativo!"."<br>";
            $validacao = false;
        }

        if(empty($data_criacao))
        {
            echo "Por favor digite a data de criaçõa de cadastro!"."<br>";
            $validacao = false;
        }

        if(empty($ultima_atualizacao))
        {
            echo "Por favor digite a ultima data de atualização!"."<br>";
            $validacao = false;
        }


        if($validacao){
            
            $banco= DB::getInstance();
            $sql = "UPDATE cliente set loja_id = ?, primeiro_nome = ?, ultimo_nome = ?, email = ?,
             endereco_id = ?, ativo = ?, data_criacao = ?, ultima_atualizacao = ? WHERE cliente_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($loja_id, $primeiro_nome, $ultimo_nome, $email, $endereco_id, $ativo, $data_criacao, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:500px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:530px; font-size:16px;text-align:center;' href='tabelaCliente.php'>Visualizar Tabela</a>";
        }
        else
            {
            $banco= DB::getInstance();
            $sql = "SELECT * FROM cliente where cliente_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);

            $loja_id = $data['loja_id'];
            $primeiro_nome = $data['primeiro_nome'];
            $ultimo_nome = $data['ultimo_nome'];
            $email = $data['email'];
            $endereco_id = $data['endereco_id'];
            $ativo = $data['ativo'];
            $data_criacao=$data['data_criacao'];
            $ultima_atualizacao=$data['ultima_atualizacao'];
            DB::disconnect();
        }
    }
?>