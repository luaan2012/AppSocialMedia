<?php

    class Model {
        private $controller;
        private $conexao;

        public function __construct(Controller $controller, Conexao $conexao){
            $this->controller = $controller;
            $this->conexao = $conexao->conectar();

        }       

        public function gravarUsuario(){
            $query = 'insert into fl_login(nome,email,cep,localidade,uf,idade,senha,id_usuarios)values(?,?,?,?,?,?,?,?); insert into fl_tweets(estado) values(?)';
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,$this->controller->nome);
            $smtm->bindValue(2,$this->controller->email);
            $smtm->bindValue(3,$this->controller->cep);
            $smtm->bindValue(4,$this->controller->localidade);
            $smtm->bindValue(5,$this->controller->uf);
            $smtm->bindValue(6,$this->controller->idade);
            $smtm->bindValue(7,md5($this->controller->senha));
            if($this->verificarId()){
                $verificar = $this->verificarId();
                if($verificar->id_usuarios == $this->controller->idUsuarios){
                    $smtm->bindValue(8,uniqid(rand(), true));
                    $smtm->execute();
                }
                if($verificar->email == $this->controller->email){
                    return 'existe';
                }
            }
            else{
                $smtm->bindValue(8,$this->controller->idUsuarios);
                $smtm->bindValue(9,$this->controller->localidade);                
                $smtm->execute();
            }
            $sucesso = 1;
            return $sucesso;

        }
     
        public function verificarId(){
            $query = "select id_usuarios, email from fl_login where id_usuarios = ? or email = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,$this->controller->idUsuarios);
            $smtm->bindValue(2,$this->controller->email);
            $smtm->execute();
            $retorno = $smtm->fetch(PDO::FETCH_OBJ);
            return $retorno;
        }

        public function recuperaId(){
            $query = "select id_usuarios from fl_login where email = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,$this->controller->email);
            $smtm->execute();
            $retorno = $smtm->fetch(PDO::FETCH_OBJ);
            return $retorno;
        }

        public function gravarCodigo(){
           
            $query = "select id_usuarios from fl_login where email = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,$this->controller->email);
            $smtm->execute();
            $retorno = $smtm->fetch(PDO::FETCH_OBJ);
                      
            $this->controller->__set('idUsuarios', $retorno->id_usuarios);

            $this->inserirId();

        }

        public function inserirId(){
                   
            $query = "insert into fl_codigo(codigo, id_usuarios)values(?,?)";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,$this->controller->codigo);
            $smtm->bindValue(2, $this->controller->idUsuarios);
            $smtm->execute();         

        }
        

        public function recuperarCodigo(){
            
            
            $query = "select codigo from fl_codigo where id_usuarios = ? ORDER by id desc;";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,$this->controller->idUsuarios);
            $smtm->execute();
            $retorno = $smtm->fetch(PDO::FETCH_OBJ);
            return $retorno;
        }
        

        public function verificarUsuario(){
            if($this->verificarId()){
                return 1;
            }
            return 0;
        }

        public function mudarSenha(){
            
            $query = "update fl_login set senha = ? where id_usuarios = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1,md5($this->controller->senha));
            $smtm->bindValue(2,$this->controller->idUsuarios);
            $smtm->execute();

            return 'sucesso';
        }

        public function auth(){
            $query = "select * from fl_login where email = ? and senha = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1, $this->controller->email);
            $smtm->bindValue(2, md5($this->controller->senha));
            $smtm->execute();
            $retorno = $smtm->fetch(PDO::FETCH_OBJ);

            return $retorno;
        }

        public function tweetar()
        {
            $query = "insert into fl_tweets(id_usuario, tweet, nome) values (?, ?, ?)";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1, $this->controller->idUsuarios);
            $smtm->bindValue(2, $this->controller->tweet);
            $smtm->bindValue(3, $this->controller->nome);
            $smtm->execute();

            return $smtm;
        }

        public function recuperarTwiteers()
        {
            $query = "
                    select 
                        t.id, 
                        t.id_usuario, 
                        t.nome, 
                        t.tweet, 
                        DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') as data
                    from 
                        fl_tweets as t
                    where 
                        t.id_usuario = :id_usuario
                        or t.id_usuario in (select id_usuario_seguindo from fl_seguidores where id_usuario = :id_usuario)
                    order by
                        t.data desc
                    ";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(':id_usuario', $this->controller->idUsuarios);
            $smtm->execute();
            $retorno = $smtm->fetchAll(PDO::FETCH_OBJ);

            return $retorno;
        }

        public function excluirTwiteers()
        {
            $query = "delete from fl_tweets where id = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1, $this->controller->id);
            $smtm->execute();

            return $smtm;
        }

        public function pegarTwiteers()
        {
            $query = "select count(tweet) as tweet from fl_tweets where id_usuario = ?";
            $smtm = $this->conexao->prepare($query);
            $smtm->bindValue(1, $this->controller->idUsuarios);
            $smtm->execute();
            $retorno = $smtm->fetchAll(PDO::FETCH_OBJ);

            return $retorno;
        }

        public function procurarUsuario()
        {
            if($this->controller->pesquisa != '')
            {
                $porc = $this->controller->pesquisa.'%';
            }
            else{
                $porc = '' ;
            }

            $query = "select distinct id_usuario, nome, count(tweet) as tweet from fl_tweets where nome like ? group by nome;";
            $smtm = $this->conexao->prepare($query);
            
            $smtm->bindValue(1, $porc);
            $smtm->execute();
            $retorno = $smtm->fetchAll(PDO::FETCH_OBJ);    

            return $retorno;
        }

        public function procurarUsuarioAux()
        {
            $query = "select id_usuario, id_usuario_seguindo from fl_seguidores;";

            $smtm = $this->conexao->prepare($query);
            $smtm->execute();
            $retorno = $smtm->fetchAll(PDO::FETCH_OBJ);    

            return $retorno;
        }

        public function procurarUsuarioAuxArray()
        {
            $query = "select id_usuario, id_usuario_seguindo from fl_seguidores;";

            $smtm = $this->conexao->prepare($query);
            $smtm->execute();
            $retorno = $smtm->fetchAll(PDO::FETCH_ASSOC);    

            return $retorno;
        }

        public function procurarPessoas()
        {
            $query = "select id_usuarios, nome, localidade, idade from fl_login order by nome;";
            $smtm = $this->conexao->prepare($query);
            $smtm->execute();
            $retorno = $smtm->fetchAll(PDO::FETCH_OBJ);    

            return $retorno;
        }

        public function seguirUsuario() {
            $query = "insert into fl_seguidores(id_usuario, id_usuario_seguindo)values(:id_usuario, :id_usuario_seguindo)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->controller->__get('idUsuarios'));
            $stmt->bindValue(':id_usuario_seguindo', $this->controller->__get('idSeguidores'));
            $stmt->execute();
    
            return true;
        }
    
        public function deixarSeguirUsuario() {
            $query = "delete from fl_seguidores where id_usuario = :id_usuario and id_usuario_seguindo = :id_usuario_seguindo";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->controller->__get('idUsuarios'));
            $stmt->bindValue(':id_usuario_seguindo', $this->controller->__get('idSeguidores'));
            $stmt->execute();
    
            return true;
        }





    }

?>

