<?php

require 'Controller.php';
require 'Model.php';
require '../Model/Conexao.php';
require 'enviar_email.php';

// $acao = (isset($_POST['acao'])) ? $_POST['acao'] : $_GET['acao'];

session_start();

$controller = new Controller;
$controller->__set('nome', $_SESSION['nome']);
$controller->__set('idUsuarios', $_SESSION['id']);
$conexao = new Conexao; 
$model = new Model($controller , $conexao);
$twitters = $model->recuperarTwiteers();
$qtd = $model->pegarTwiteers();
$retorno = $model->procurarUsuarioAux();


if(!empty($_GET)){
    if($_GET['acao'] == 'tweet')
    {
        $controller->__set('tweet', $_POST['tweet']);
        
        $model->tweetar();
        header('Location: ../View/home.php');
    }elseif($_GET['acao'] == 'excluir')
    {
        $controller->__set('id', $_GET['id']);
        $model->excluirTwiteers();
        header('Location: ../View/home.php');

    }elseif($_GET['acao'] == 'procurar')
    {
        header("Location: ../View/procurar.php?acao={$_POST['procurar']}");
    }elseif($_GET['acao'] == 'quemseguir')
    {
        header("Location: ../View/procurar_pessoas.php");
    }
    

}

?>