<?php

require 'Controller.php';
require 'Model.php';
require '../Model/Conexao.php';
require 'enviar_email.php';

$acao = (isset($_POST['acao'])) ? $_POST['acao'] : $_GET['acao'];

if($acao == 'cadastrar'){
        
    $controller = new Controller;
    $controller->__set('nome',$_POST['nome']);
    $controller->__set('email',$_POST['email']);
    $controller->__set('cep',$_POST['cep']);
    $controller->__set('localidade',$_POST['localidade']);
    $controller->__set('uf',$_POST['uf']);
    $controller->__set('senha',$_POST['senha']);
    $controller->__set('idade',$_POST['idade']);
    $controller->__set('idUsuarios',uniqid(rand(), true)); 
    
    $conexao = new Conexao;
    
    $model = new Model($controller , $conexao);
    print_r($model->gravarUsuario());

}elseif($acao == 'recuperar'){
    
    $random = substr(md5(time()), 0, 6);
    $codigo = mb_strtoupper($random);

    $controller = new Controller;
    $controller->__set('email',$_POST['email']);
    
    $conexao = new Conexao;
    
    $model = new Model($controller , $conexao);
    $id = $model->recuperaId();
    print_r(json_encode($id));
    $verificar = $model->verificarUsuario();
    if($verificar  == 1) {
    
        $mensagem = new Mensagem();
        $mensagem->__set('para', $_POST['email']);
        $mensagem->__set('assunto', 'Recuperar senha');
        $mensagem->__set('mensagem', 'Seu codigo para recuperar: '.$codigo);
        $mensagem->enviarEmail();
        // print_r($mensagem->status['codigo_status']);
        if($mensagem->status['codigo_status'] == 1){
            $controller->__set('codigo', $codigo);
            $model->gravarCodigo();
        }else {
            0;
        }
    
    }else {
        return 0;
    }
   
}elseif($acao == 'verificar'){
    
    $controller = new Controller;
    $controller->__set('idUsuarios', $_GET['id']);
    $conexao = new Conexao;
    
    $model = new Model($controller , $conexao);
    $iduser = $model->recuperarCodigo();
    if($iduser->codigo == $_GET['code']){
        $sucesso = 'aceito';
        print_r(json_encode($sucesso));
    }else{
        $sucesso = 'negado';
        print_r(json_encode($sucesso));
    }

}elseif($acao == 'mudarsenha'){
    
    $controller = new Controller;
    $controller->__set('idUsuarios', $_POST['id']);
    $controller->__set('senha', $_POST['senha']);
    $conexao = new Conexao;
    
    $model = new Model($controller , $conexao);
    $sucesso = $model->mudarSenha();

    print_r(json_encode($sucesso));

}elseif(isset($_SERVER["REQUEST_URI"]) && $url = substr($_SERVER["REQUEST_URI"],41) == 'login'){
    $controller = new Controller;
    $controller->__set('email', $_POST['email']);
    $controller->__set('senha', $_POST['senha']);

    $conexao = new Conexao;
    
    $model = new Model($controller , $conexao);
    $sucesso = $model->auth();

    if(isset($sucesso->id_usuarios)){
        
        session_start();

        $_SESSION['id'] = $sucesso->id_usuarios;
        $_SESSION['nome'] = $sucesso->nome;


        header('Location: Auth.php');
    }else{
        header('Location: ../index.php?login=error');
    }
}

?>