<html>
    <body>
    
       <form method="POST" action="createIdioma.php"> 

            <h3>Formulário de Cadastro</h3>

            <label>Nome:</label>
            <input type="name" name="nome"/>  <!--L2-->
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

    if(!empty($_POST)){
    
        $nome= $_POST['nome'];
        $ultima_atualizacaoa= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($nome))
        {
            echo "Por favor digite o seu nome!"."<br>";
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
            $sql = "INSERT INTO idioma (nome, ultima_atualizacao) VALUES(?,?)";
            $q = $banco->prepare($sql);
            $q->execute(array($nome, $ultima_atualizacaoa));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:450px;'>Cadastro Realizado com Sucesso</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaIdioma.php'>Visualizar Tabela</a>";
        }
    }
?>

