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
                width: 450px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
            }
            form {
                padding: 20px;
            }
            .centercodigo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 10%;
            }
            body {
                background: url("../icons/rec.jpg") no-repeat;
                background-position: center top;
                background-size: 100% 100%;      
            }
            .card{
                margin-top: 180px;
            }

        </style>
    </head>
    

    <body>

        <div class="card">
            <h4 class="card-header">Insira o codigo enviado no seu email</h4>
            
                <form>
                
                    <div class="form-row">

                        <div class="col-md-7 mb-3">
                            <label for="code">Codigo</label>
                            <input name="code" type="text" class="form-control" id="code" maxlength="12" placeholder="code">
                            <a href="#"><small>Não recebeu? clique aqui pra reenviar!</small></a>
                            <div class="invalid-feedback codigo" style="display:hide;">
                                Codigo está errado.
                            </div>
                            <div class="invalid-feedback codigo" style="display:hide;" id="armazena" value="">
                            </div>
                        </div>                        
                                           
                    </div>
                    
                    <button id="verificar" class="btn btn-primary" type="button">Verificar</button>
                   
                    <button type="button" class="btn btn-secondary" onclick="window.location.href= '../index.php'">Voltar</button>
                
                </form>
            </div>
            <img src="../icons/lod2.gif" class="centercodigo" style="display:none">
        </div>      
    </body>
</html>