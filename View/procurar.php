<?php
  require "../Controller/procura.php";
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>FaceLine</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/add38bb646.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>        
    <link rel="stylesheet" href="../css/style.css">
	<script src="../js/seguir.js"></script>

  </head>

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

<?php 
if(empty($retorno))
{ ?>
	<div class="card notfound" style="width: 18rem;">
		<img class="card-img-top notfoundbody" src="../icons/notfound.png" alt="Card image cap">
		<div class="card-body notfoundbody">
			<h5 class="card-title notfoundtitle">Usuário não encontrado!</h5>
			<a href="home.php" class="btn btn-primary linkvolt">Voltar para o inicio</a>
		</div>
	</div>
<?php } else {
	foreach ($retorno as $key => $value) { 
		if($value->id_usuario != $_SESSION['id'])
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
									<span class="perfilPainelItem">Tweets</span><br />
									<span class="perfilPainelItemValor">&nbsp
										<?=$value->tweet?>
									</span>
								</div>

								<div class="col">
									<span class="perfilPainelItem">Seguindo</span><br />
									<span class="perfilPainelItemValor">&nbsp
									<?php
									$count = 0;
									$idd = 0;
									foreach ($retorno2 as $key2 => $value2) {										
										if($value->id_usuario == $retorno2[$key2]->id_usuario && $value->id_usuario != $retorno2[$key2]->id_usuario_seguindo)
										
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
									$count2 = 0;
									$idd2 = 0;
									foreach ($retorno2 as $key3 => $value3) {										
										if($value->id_usuario == $retorno2[$key3]->id_usuario && $value->id_usuario != $retorno2[$key3]->id_usuario_seguindo)
										{
											$count2++;											
										}
									}
									if($count2 == 0){
										echo '0';
									}else{
										echo $count2;
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
									<div class="card-body areaperfis">
										<div class="row">
											<button class="btn btn-success seguir" value="<?= $value->id_usuario?>" id="<?= $key?>" onclick=seguir("<?= $value->id_usuario?>","<?= $key?>")>Seguir</button>

										<div class="col-md-6">
											<button class="btn btn-success deixarseguir" value="<?= $value->id_usuario?>" id="<?= $key?>d" onclick=deixarSeguir("<?= $value->id_usuario?>","<?= $key?>")>Deixar de seguir</a>
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