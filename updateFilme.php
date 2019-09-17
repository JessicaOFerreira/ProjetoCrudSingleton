    <html>
    <body>
    
       <form method="POST" action="updateFilme.php"> 

            <h3>Formulário de Cadastro</h3>

            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

            <label>Titulo</label>
            <input type="text" name="tit"/>  <!--L2-->
            <br><br>

            <label>Descrição:</label>
            <input type="name" name="desc"/>  <!--L2-->
            <br><br>

            <label>Ano de Lançamento:</label>
            <input type="name" name="anol"/>  <!--L2-->
            <br><br>

            <label>Idioma:</label>
            <input type="email" name="idio"/>  <!--L2-->
            <br><br>

            <label>Idioma Original:</label>
            <input type="Text" name="idioori"/>  <!--L2-->
            <br><br>

            <label>Duração da Locação:</label>         <!--L3-->
            <input type="time" name="duracao"/> <!--L4-->
            <br><br>

            <label>Preço da Locação:</label>         <!--L3-->
            <input type="text" name="preco"/> <!--L4-->
            <br><br>

            <label>Duração do Filme:</label>         <!--L3-->
            <input type="time" name="durafil"/> <!--L4-->
            <br><br>

            <label>Custo de Substituição:</label>         <!--L3-->
            <input type="text" name="custo"/> <!--L4-->
            <br><br>

            <label>Classificação:</label>         <!--L3-->
            <input type="text" name="classi"/> <!--L4-->
            <br><br>

            <label>Recuros Especias:</label>         <!--L3-->
            <input type="text-area" name="rec"/> <!--L4-->
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
            height:600px;
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
        $titulo = $_POST['tit'];
        $descricao = $_POST['desc'];
        $ano_de_lancamento = $_POST['anol'];
        $idioma_id= $_POST['idio'];
        $idioma_original_id = $_POST['idioori'];
        $duracao_da_locacao = $_POST['duracao'];
        $preco_da_locacao = $_POST['preco'];
        $duracao_do_filme = $_POST['durafil'];
        $custo_de_substituicao = $_POST['custo'];
        $classificacao = $_POST['classi'];
        $recursos_especiais = $_POST['rec'];
        $ultima_atualizacao= $_POST['dataa'];

        //Validaçao dos campos:
        $validacao = true;
        
        if(empty( $titulo))
        {
            echo "Por favor digite o Titulo"."<br>";
            $validacao = false;
        }

        if(empty($descricao))
        {
            echo "Por favor digite a descrição!"."<br>";
            $validacao = false;
        }

        if(empty($ano_de_lancamento))
        {
            echo "Por favor digite o ano de lançamento!"."<br>";
            $validacao = false;
        }

        if(empty($idioma_id))
        {
            echo "Por favor digite o idioma!"."<br>";
            $validacao = false;
        }

        if(empty($idioma_original_id ))
        {
            echo "Por favor digite o idioma original!"."<br>";
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
            $sql = "UPDATE filme set titulo=?, descricao=?, ano_de_lancamento=?, idioma_id=?, idioma_original_id=?, duracao_da_locacao=?, preco_da_locacao=?, duracao_do_filme=?, custo_de_substituicao=?, classificacao=?, recursos_especiais=?, ultima_atualizacao=? WHERE filme_id=?";
            $q = $banco->prepare($sql);
            $q->execute(array($titulo, $descricao, $ano_de_lancamento, $idioma_id, $idioma_original_id, $duracao_da_locacao, $preco_da_locacao, $duracao_do_filme, $custo_de_substituicao, $classificacao, $recursos_especiais, $ultima_atualizacao, $id));
            DB::disconnect();

            echo "<h3 style='color:green;position: relative;left:550px;'>Cadastro Atualizado</h3>";
            echo "<a style='color:grey;position: relative;left:520px; font-size:16px;text-align:center;' href='tabelaFilme.php'>Visualizar Tabela</a>";
        }
    }
?>

