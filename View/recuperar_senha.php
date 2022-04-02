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
            .center {
                margin-left: auto;
                margin-right: auto;
                width: 10%;
            }
            body {
                background: url("../icons/rec.jpg") no-repeat;
                background-position: center top;
                background-size: 100% 100%;      
            }

        </style>
    </head>
    

    <body id="conteudo">

    <div class="container">
        <div class="card">
            <h4>Recuperar senha</h4>
            
                <form>
                
                    <div class="form-row">
                                       
                        
                        <div class="col-md-8 mb-3">
                            <label for="email">Digite seu email</label>
                            <div class="input-group">
                                <input name="email" type="email" class="form-control" id="email" placeholder="e-mail" aria-describedby="inputGroupPrepend3">
                                <div class="invalid-feedback email" style="display:hide;">
                                    Por favor, digite um email valido.
                                </div>
                                <div class="invalid-feedback existe" style="display:hide;">
                                    Email não registrado.
                                </div>                                                              
                            </div>
                        </div>                       
                    </div>
                        
                        <button id="recuperar" class="btn btn-primary" type="button">Enviar email</button>
                    
                        <button type="button" class="btn btn-secondary" onclick="window.location.href= '../index.php'">Voltar</button>
                                    
                    </form>
                </div>
                <img src="../icons/lod2.gif" class="center" style="display:none">
            </div> 
        </div>
    </body>
</html>