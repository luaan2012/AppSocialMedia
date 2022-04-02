<?php

require 'AppController.php';

$retorno = $model->procurarPessoas();
$retorno2 = $model->procurarUsuarioAux();

    function getIdade($idade){
        
        $data = $idade;

        // separando yyyy, mm, ddd
        list($ano, $mes, $dia) = explode('-', $data);
    
        // data atual
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    
        // cálculo
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        return "$idade Anos";
    }
     



?>
