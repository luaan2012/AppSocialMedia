<?php

require 'AppController.php';

$controller->__set('pesquisa', $_GET['acao']);
$controller->__set('idUsuario', $_SESSION['id']);
$controller->__set('idUsuario', $_SESSION['id']);


$retorno = $model->procurarUsuario();
$retorno2 = $model->procurarUsuarioAux();
$retorno3 = $model->procurarUsuarioAuxArray();


if(isset($_GET))
{
    if($_GET['acao'] == 'seguir')
    {
        $controller->__set('idUsuarios', $_POST['meuId']);
        $controller->__set('idSeguidores', $_POST['seguidorId']);

        $model->seguirUsuario();

    }elseif($_GET['acao'] == 'deixarseguir')
    {
        $controller->__set('idUsuarios', $_POST['meuId']);
        $controller->__set('idSeguidores', $_POST['seguidorId']);

        $model->deixarSeguirUsuario();

    }
    elseif($_GET['acao'] == 'verificarSeguidores')
    {      
        print_r(json_encode($model->procurarUsuarioAux())) ;
    }
}

?>
