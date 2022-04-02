<?php

    class Controller {
        private $nome;
        private $email;
        private $cep;
        private $localidade;
        private $uf;
        private $senha;
        private $idUsuarios;
        private $codigo;
        private $tweet;
        private $seguidores;
        private $publicacoes;
        private $id;
        private $data;
        private $idSeguidores;
        private $pesquisa;
        private $tweets;
        private $nome_pesquisa;
        private $id_pesquisa;
        private $idade;



        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

    }

?>