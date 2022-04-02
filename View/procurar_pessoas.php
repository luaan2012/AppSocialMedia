<?php
  require "../Controller/quemseguir.php";

?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>FaceLine</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/add38bb646.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>        
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


<?php foreach ($retorno as $key => $value) { 
	
	if($value->id_usuarios != $_SESSION['id'])
	{ ?>
	
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
								<?= $value->nome?>
								</span>
								<hr>
							</div>
						</div>

						<div class="row mb-2">

							<div class="col">
								<span class="perfilPainelItem">Pais</span><br />
								<span class="editprocurar">
									Brasil
								</span>
							</div>

							<div class="col">
								<span class="perfilPainelItem">Idade</span><br />
								<span class="editprocurar">                             
                                <?= getIdade($value->idade)?>									
								</span>
							</div>

							<div class="col">
								<span class="perfilPainelItem">Seguidores</span><br />
								<span class="editprocurar">&nbsp
								<?php
									$count = 0;
									$idd = 0;
									foreach ($retorno2 as $key1 => $value1) {										
										if($value->id_usuarios == $retorno2[$key1]->id_usuario && $value->id_usuarios != $retorno2[$key1]->id_usuario_seguindo)	
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

						</div>

					</div>
				</div>

			</div>

			<div class="col-md-6">
				
					<div class="row mb-2">
						<div class="col">
							<div class="card areaperfis">
								<div class="card-body">
								<div class="row">
									<button class="btn btn-success seguir" value="<?= $value->id_usuarios?>" id="<?= $key?>" onclick=seguir("<?= $value->id_usuarios?>","<?= $key?>")>Seguir</button>

									<div class="col-md-6">
									<button class="btn btn-success deixarseguir" value="<?= $value->id_usuarios?>" id="<?= $key?>" value="<?= $value->id_usuarios?>" onclick=deixarSeguir("<?= $value->id_usuarios?>","<?= $key?>")>Deixar de seguir</a>
									</div>
												
									</div>

								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php } ?>

</body>
</html>

<script>

$(document).ready(function() {

let obj = "<?php print_r($_SESSION['id']); ?>"		

$.ajax({
		type: 'POST',
		url: '../Controller/procura.php?acao=verificarSeguidores',
		data: obj,
		success: data => {
			console.log($("#"+'0').val())
			let dados = JSON.parse(data)
			$.each(dados, function( chave, valor) {
				for (let index = 0; index < chave; index++) {						
					if(dados[chave].id_usuario == obj){
						if(dados[chave].id_usuario_seguindo == $('#'+index).val()){
							$('#'+index).html('Seguindo')
							$('#'+index+'d').html('Deixar de seguir')

						}
					}
					
				}
				
	
			});
		},
		error: e => {console.log('erro ao cadastrar' + e)}
})



});

function seguir(id, key){
	let obj = {
	
		meuId : "<?php print_r($_SESSION['id']); ?>",
		seguidorId : id
	}

	$.ajax({
		type: 'POST',
		url: '../Controller/procura.php?acao=seguir',
		data: obj,
		success: data => {
			
			$('.seguir').html('Seguindo')
			$('#'+key).attr("disabled", true);

		},
		error: e => {console.log('erro ao cadastrar' + e)}
	})
}

function deixarSeguir(id){
	let obj = {
	
		meuId : "<?php print_r($_SESSION['id']); ?>",
		seguidorId : id
	}

	$.ajax({
		type: 'POST',
		url: '../Controller/procura.php?acao=deixarseguir',
		data: obj,
		success: data => {
			$('.seguir').html('Seguir')
			// $(".seguir").attr("disabled", false);
		},
		error: e => {console.log('erro ao cadastrar' + e)}
	})
}

</script>