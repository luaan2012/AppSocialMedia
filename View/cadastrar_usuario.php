<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">       
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>        
        <script src="../js/cadastrar.js"></script>
        <link rel="stylesheet" href="../css/index.css">
        <title>Cadastro</title>

        <style>
            .card{
                width: 950px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
            }
            form {
                padding: 20px;
            }
            body {
                background: url("../icons/cadas.jpg") no-repeat;
                background-position: center top;
                background-size: 100% 100%;      
            }

        </style>
    </head>
    

    <body>

    <div class="container">
   
        <div class="card">
            <h4>Cadastrar</h4>
            
                <form>
                
                    <div class="form-row">
                    
                        <div class="col-md-4 mb-3">
                            <label for="nome"><h7>Primeiro nome</h7></label>
                            <input name="nome" type="text" class="form-control" id="nome" placeholder="First name" value="" require>
                            <div class="invalid-feedback nome" style="display:hide;">
                                Campo vazio!
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="validationServer02">Segundo Nome</label>
                            <input name="ultimo" type="text" class="form-control" id="ultimo" placeholder="Last name" value="" require>
                            <div class="invalid-feedback ultimo" style="display:hide;">
                                Campo vazio!
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="validationServerUsername">Email</label>
                            <div class="input-group">
                                <input name="email" type="email" class="form-control" id="email" placeholder="e-mail" aria-describedby="inputGroupPrepend3">
                                <div class="invalid-feedback email" style="display:hide;">
                                    Por favor, digite um email valido.
                                </div>
                                <div class="invalid-feedback existe" style="display:hide;">
                                    Email já existe.
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                                <label for="validationServer05">Cep</label>
                                <input name="cep" type="text" class="form-control" id="cep" maxlength="9" placeholder="Zip">
                                <div class="invalid-feedback cep" style="display:hide;">
                                    Por favor, digite um cep valido.
                                </div>
                        </div>  

                        <div class="col-md-6 mb-3">
                            <label for="validationServer03">Cidade</label>
                            <input name="localidade" type="text" class="form-control" id="localidade" placeholder="City" disabled>
                           
                        </div>
                
                        <div class="col-md-3 mb-3">
                            <label for="validationServer04">Estado</label>
                            <input name="uf" type="text" class="form-control" id="uf" placeholder="State" disabled >
                           
                        </div>
                                               
                    </div>

                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label for="idade">Idade</label>
                            <input name="idade" type="date" class="form-control" id="idade">
                            <div class="invalid-feedback idade" style="display:hide;">
                                Selecione uma data
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                                <label for="senha">Senha</label>
                                <input name="senha" type="password" class="form-control" id="senha" maxlength="12" placeholder="password">
                                <div class="invalid-feedback senha" style="display:hide;">
                                     Senhas não coincidem.
                                </div>
                                <div class="invalid-feedback tamanho" style="display:hide;" id="invalidCheck3">
                                    Digite uma senha com pelo menos 6 digitos!
                                </div>
                        </div>  

                        
                        <div class="col-md-4 mb-3">
                            <label for="confirm">Confirme a senha</label>
                            <input name="confirm" type="password" class="form-control" id="confirm" maxlength="12" placeholder="confirm">
                            <div class="invalid-feedback confirm" style="display:hide;">
                                Senhas não coincidem.
                            </div>
                        </div>

                        
                                           
                    </div>


                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input valid" type="checkbox" id="check"value="">
                            <label class="form-check-label" for="invalidCheck3" >
                                Eu aceito os termos e condições
                            </label>
                            <div class="invalid-feedback" style="display:none;" id="invalidCheck3">
                                Você só pode cadastrar quando aceitar os termos!
                            </div>
                            
                            <div class="invalid-feedback check" style="display:none;" id="geral">
                                Você só pode cadastrar quando aceitar os termos!
                            </div>
                        </div>
                    </div>
                    <button id="button" class="btn btn-primary" type="button">Registrar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href= '../index.php'">Voltar</button>
                </form>
            </div>
        </div>   
        </div>   
    </body>
</html>