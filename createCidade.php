<html>
    <body>
    
       <form method="POST" action="createCidade.php"> 

            <h3>Formulário de Cadastro</h3>

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

    if(!empty($_POST)){
    
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
            $sql = "INSERT INTO cidade (cidade, pais_id, ultima_atualizacao) VALUES(?,?,?)";
            $q = $banco->prepare($sql);
            $q->execute(array($cidade, $pais_id, $ultima_atualizacao));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:450px;'>Cadastro Realizado com Sucesso</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaCidade.php'>Visualizar Tabela</a>";
        }
    }
?>

