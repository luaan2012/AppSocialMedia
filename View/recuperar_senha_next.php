<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">       
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>        
        <script src="../js/recuperar.js"></script>
        <link rel="stylesheet" href="../css/index.css">
        <title>Recuperar senha</title>

        <style>
            .card{
                width: 550px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
            }
            form {
                padding: 20px;
            }
            .recuperasenha {
                margin-left: auto;
                margin-right: auto;
                width: 10%;
            }

        </style>
    </head>
    

    <body>

        <div class="container">
            <div class="card">
                <h5 class="card-header">Insira uma nova senha</h5>
                
                    <form>
                    
                        <div class="form-row">

                            <div class="col-md-5 mb-3">
                                    <label for="senha">Senha</label>
                                    <input name="senha" type="password" class="form-control" id="novasenha" maxlength="12" placeholder="password">
                                    <div class="invalid-feedback senha" style="display:hide;">
                                        Senhas não coincidem.
                                    </div>
                                    <div class="invalid-feedback tamanho" style="display:hide;" id="invalidCheck3">
                                        Digite uma senha com pelo menos 6 digitos!
                                    </div>
                            </div>  

                            <div class="col-md-5 mb-3">
                                <label for="confirm">Confirme a senha</label>
                                <input name="confirm" type="password" class="form-control" id="confirmnova" maxlength="12" placeholder="confirm">
                                <div class="invalid-feedback confirm" style="display:hide;">
                                    Senhas não coincidem.
                                </div>
                                <div class="invalid-feedback" style="display:hide;" id="recuperasenha" value="">
                                </div>
                            </div>
                                            
                        </div>
                        
                        <button id="recuperarnovasenha" class="btn btn-primary" type="button">Confirmar nova senha</button>
                    
                        <button type="button" class="btn btn-secondary" onclick="window.location.href= '../index.php'">Voltar</button>
                    
                    </form>
                </div>
                <img src="../icons/lod2.gif" class="recuperasenha" style="display:none">
            </div>   
        </div>   
    </body>
</html>