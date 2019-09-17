<html>
    <body>
    
       <form method="POST" action="createPagamento.php"> 

            <h3>Formulário de Cadastro</h3>

            <label>Cliente ID:</label>
            <input type="name" name="cid"/>  <!--L2-->
            <br><br>

            <label>Funcionario ID:</label>
            <input type="name" name="fid"/>  <!--L2-->
            <br><br>

            <label>Aluguel ID:</label>
            <input type="name" name="aid"/>  <!--L2-->
            <br><br>

            <label>Valor:</label>
            <input type="name" name="val"/>  <!--L2-->
            <br><br>

            <label>Data de Pagamento</label>
            <input type="date" name="datap"/>  <!--L2-->
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
    
        $cliente_id= $_POST['cid'];
        $funcionario_id= $_POST['fid'];
        $aluguel_id= $_POST['aid'];
        $valor= $_POST['val'];
        $data_de_pagamento= $_POST['datap'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty($cliente_id))
        {
            echo "Por favor digite o id do cliente!"."<br>";
            $validacao = false;
        }

        if(empty($funcionario_id))
        {
            echo "Por favor digite o id do funcionário!"."<br>";
            $validacao = false;
        }

        if(empty($aluguel_id))
        {
            echo "Por favor digite o id do aluguel!"."<br>";
            $validacao = false;
        }

        if(empty($valor))
        {
            echo "Por favor digite o valor!"."<br>";
        }   

        if(empty($data_de_pagamento))
        {
            echo "Por favor digite a data de pagamento!"."<br>";
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
            $sql = "INSERT INTO pagamento (cliente_id, funcionario_id, aluguel_id, valor, data_de_pagamento, ultima_atualizacao) VALUES(?,?,?,?,?,?)";
            $q = $banco->prepare($sql);
            $q->execute(array($cliente_id, $funcionario_id, $aluguel_id, $valor, $data_de_pagamento, $ultima_atualizacao));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:450px;'>Cadastro Realizado com Sucesso</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaPagamento.php'>Visualizar Tabela</a>";
        }
    }
?>

