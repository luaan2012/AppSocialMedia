<html>
  <head>
    <meta charset="utf-8" />
    <title>FaceLine</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/add38bb646.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">

    <style>
        small{
          margin-left: 10px;
          color: red;
        }
        body {
          background: url("./icons/fundou.jpg") no-repeat;
          background-position: center top;
          background-size: 100% 100%;      
        }

    </style>
  </head>

  <body>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              <h4>Login</h4>
            </div>
            <div class="card-body">
              <form method="post" action="Controller/Service.php?acao=login">
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name="senha"type="password" class="form-control" placeholder="Senha">
                </div>
                
                <?php
                if(isset($_GET['login']))
                { ?>
                  <small>Usuario ou senha invalidos.</small>
                <?php } ?>
                  
                <button class="btn btn-lg btn-info btn-block entrar mt-4" type="submit"><h6>Entrar</h6></button>
              </form>  
              <div>
              <button type="button" class="btn btn-primary btn-sm cadastrar" onclick="window.location.href='View/cadastrar_usuario.php'">Registrar</button>
              <button type="button" class="btn btn-secondary btn-sm ml-auto senha" onclick="window.location.href='View/recuperar_senha.php'">Recuperar senha</button>
              <div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>