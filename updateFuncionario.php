    <html>
    <body>
    
       <form method="POST" action="updateFuncionario.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Primeiro Nome:</label>
            <input type="name" name="nome"/>  <!--L2-->
            <br><br>

            <label>Ultimo Nome:</label>
            <input type="name" name="unome"/>  <!--L2-->
            <br><br>

            <label>Endereço ID:</label>
            <input type="Text" name="endid"/>  <!--L2-->
            <br><br>

            <label>Foto:</label>
            <input type="Text" name="foto"/>  <!--L2-->
            <br><br>

            <label>E-mail:</label>
            <input type="email" name="email"/>  <!--L2-->
            <br><br>

            <label>Loja Id:</label>
            <input type="text" name="lid"/>  <!--L2-->
            <br><br>

            <label>Ativação</label>         <!--L3-->
            <input type="text" name="ativ"/> <!--L4-->
            <br><br>

            <label>Usuario:</label>
            <input type="text" name="usu"/>  <!--L2-->
            <br><br>

            <label>Senha:</label>
            <input type="password" name="senha"/>  <!--L2-->
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
        $primeiro_nome = $_POST['nome'];
        $ultimo_nome = $_POST['unome'];
        $endereco_id = $_POST['endid'];
        $foto=$_POST['foto'];
        $email = $_POST['email'];
        $loja_id = $_POST['lid'];
        $ativo = $_POST['ativ'];
        $usuario = $_POST['usu'];
        $senha = $_POST['senha'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;

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

         if(empty($endereco_id))
        {
            echo "Por favor digite o seu id de endereco!"."<br>";
            $validacao = false;
        }

        if(empty($email))
        {
            echo "Por favor digite o seu email!"."<br>";
            $validacao = false;
        }

        if(empty($loja_id ))
        {
            echo "Por favor digite o seu id de loja!"."<br>";
            $validacao = false;
        }

        if(empty($ativo))
        {
            echo "Por favor digite o seu numero de ativo!"."<br>";
            $validacao = false;
        }

        if(empty($usuario))
        {
            echo "Por favor digite usuário!"."<br>";
            $validacao = false;
        }

        if(empty($senha))
        {
            echo "Por favor digite a senha!"."<br>";
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
            $sql = "UPDATE funcionario set primeiro_nome=?, ultimo_nome=?, endereco_id=?, foto=?, email=?, loja_id=?, ativo=?, usuario=?, senha=?, ultima_atualizacao=? WHERE funcionario_id = ?";
            $q = $banco->prepare($sql);
            $q->execute(array($primeiro_nome, $ultimo_nome, $endereco_id, $foto, $email, $loja_id, $ativo, $usuario, $senha, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:550px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaFuncionario.php'>Visualizar Tabela</a>";
        }
    }
?>

