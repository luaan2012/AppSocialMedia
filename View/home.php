<?php
  
  require "../Controller/AppController.php";
?>


<html>
  <head>
    <meta charset="utf-8" />
    <title>FaceLine</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/add38bb646.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">

  </head>

  <body>

  <nav class="navbar navbar-expand-lg menu">
    <img class="ml-4" src="../icons/teste.png" width="30px" height="30px"></img>
   
      <a class="menuItem" href="home.php">Inicio</a>

      <a class="menuItem" href="./procurar_pessoas">Quem seguir</a>

      <a class="menuItem" href="../Controller/Sair.php">Sair</a>
   
    <div class="testando">
      <form class="d-flex" method="post" action="../Controller/AppController.php?&acao=procurar" >
            <input name="procurar" class="form-control me-2" type="search" placeholder="" aria-label="Search">
            <button class="btn btn-outline-secondary buscar" type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
      </form>
    </div>
    


  </nav>

    <div class="container mt-5">
      <div class="row pt-2">        
       <div class="col-md-3">

          <div class="perfil">
            <div class="perfilTopo">

            </div>

            <div class="perfilPainel">
              
              <div class="row mt-2 mb-2">
                <div class="col mb-2">
                  <span class="perfilPainelNome">
                  <?= $controller->nome ?>
                  </span>
                  <hr>
                </div>
              </div>

              <div class="row mb-2">

                <div class="col">
                  <span class="perfilPainelItem">Tweets</span><br />
                  <span class="perfilPainelItemValor">&nbsp<?= $qtd[0]->tweet ?> </span>
                </div>

                <div class="col">
                  <span class="perfilPainelItem">Seguindo</span><br />
                  <span class="perfilPainelItemValor">&nbsp
                  <?php
                    $count = 0;
                    $idd = 0;
                    foreach ($retorno as $key => $value) {										
                      if($_SESSION['id'] == $retorno[$key]->id_usuario && $_SESSION['id'] != $retorno[$key]->id_usuario_seguindo)
                      {
                        $count++;
                      }
                    }
									if($count == 0){
										echo '0';
									}else{
										echo $count;
									}
									
									?>
                  </span>
                </div>

                <div class="col">
                  <span class="perfilPainelItem">Seguidores</span><br />
                  <span class="perfilPainelItemValor">&nbsp
                  <?php
                    $count1 = 0;
                    $idd1 = 0;
                    foreach ($retorno as $key1 => $value1) {										
                      if($_SESSION['id'] == $retorno[$key1]->id_usuario_seguindo && $_SESSION['id'] != $retorno[$key1]->id_usuario)
                      {
                        $count1++;
                      }
                    }
									if($count1 == 0){
										echo '0';
									}else{
										echo $count1;
									}
									
									?>
                  </span>
                </div>

              </div>

            </div>
          </div>

        </div>
        
        <div class="col-md-6">
          <div class="row mb-2">
            <div class="col tweetBox">
              <form method="post" action="../Controller/AppController.php?acao=tweet">
                <textarea name="tweet" class="form-control" id="text-box" rows="3" maxlength="140"></textarea>
                
                <div class="col mt-2 d-flex justify-content-end">
                  <button class="btn btn-primary">Publicar</button>
                </div>

              </form>
            </div>
          </div>

          <?php foreach ($twitters as $key => $value) { ?>
            <div class="row tweet">
              <div class="col">
                <p><strong class="letter"><?= $value->nome ?></strong> <span class="text text-muted">- <?= $value->data ?></span></p>
                <p class="letter">
                  <?= $value->tweet ?>
                </p>

                <br />
                <form method="post" action=<?= "../Controller/AppController.php?acao=excluir&id={$value->id}"?>>
                  <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger"><small>Apagar</small></button>
                  </div>
                </form>
              </div>
            </div>
            <?php } ?>



        </div>


        <div class="col-md-3">
          <div class="quemSeguir">
            <span class="quemSeguirTitulo">Quem seguir</span><br />
            <hr />
            <a href="../Controller/AppController.php?acao=quemseguir" class="quemSeguirTxt">Procurar pessoas</a>
          </div>
        </div>

      </div>
      </div>

</body>
</html>