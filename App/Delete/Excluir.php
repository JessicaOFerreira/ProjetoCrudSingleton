<?php

    namespace App\Delete;

    use DB\Conexao as DB;

    class Excluir{
        private $tabela;
        private $id;
        private $banco;

        public function __construct($nomet, $idele){
            $this->tabela=$nomet;
            $this->id=$idele;
            $this->banco=DB::getInstance();
        }

        public function excluir(){
            $pdo=$this->banco;
            $sql="SET FOREIGN_KEY_CHECKS=0;";
            $sql.="DELETE FROM {$this->tabela} WHERE {$this->tabela}_id = {$this->id};";
            $sql.="SET FOREIGN_KEY_CHECKS= 1;";
            $consulta= $pdo->prepare($sql);
            $resultado= $consulta->execute();

            if($resultado){
                return "Registo Excluido"."<br>";
            }
            return "Erro ao excluir"."<br>";
        }

        public function __toString(){
            return $this->excluir();
        }
    }


?>
