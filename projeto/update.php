<?php

	require 'banco.php';

	$id = null;
	if ( !empty($_GET['id']))
            {
		$id = $_REQUEST['id'];
            }

	if ( null==$id )
            {
		header("Location: site.php");
            }

	if ( !empty($_POST))
            {

		$siglaErro = null;
		$rotaErro = null;
		$partida_destinoErro = null;
                $trajeto_completoErro = null;

		$sigla = $_POST['sigla'];
		$rota = $_POST['rota'];
		$partida_destino = $_POST['partida_destino'];
                $trajeto_completo = $_POST['trajeto_completo'];

		 //Validação
		 $validacao = true;

		if (empty($sigla))
                {
                    $siglaErro = 'Por favor digite a Sigla!';
                    $validacao = false;
                }

		if (empty($rota))
                {
                    $rotaErro = 'Por favor digite a Rota!';
                    $validacao = false;
		}


		if (empty($partida_destino))
                {
                    $partida_destinoErro = 'Por favor digite o endereço de partida/destino!';
                    $validacao = false;
		}

                if (empty($trajeto_completo))
                {
                    $trajeto_completoErro = 'Por favor digite o trajeto completo separado por,!';
                    $validacao = false;
		}


		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE trajetos  set sigla = ?, rota = ?, partida_destino = ?, trajeto_completo = ? WHERE id = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($sigla,$rota,$partida_destino,$trajeto_completo,$id));
                    Banco::desconectar();
                    header("Location: site.php");
		}
	}
        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM trajetos where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$sigla = $data['sigla'];
                $rota = $data['rota'];
                $partida_destino = $data['partida_destino'];
		$trajeto_completo = $data['trajeto_completo'];
		Banco::desconectar();
	}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
				<title>Atualizar Trajeto</title>
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Trajeto </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($siglaErro)?'error':'';?>">
                        <label class="control-label">sigla</label>
                        <div class="controls">
                            <input name="sigla" class="form-control" size="50" type="text" placeholder="sigla" value="<?php echo !empty($sigla)?$sigla:'';?>">
                            <?php if (!empty($siglaErro)): ?>
                                <span class="help-inline"><?php echo $siglaErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($rotaErro)?'error':'';?>">
                        <label class="control-label">rota</label>
                        <div class="controls">
                            <input name="rota" class="form-control" size="80" type="text" placeholder="rota" value="<?php echo !empty($rota)?$rota:'';?>">
                            <?php if (!empty($rotaErro)): ?>
                                <span class="help-inline"><?php echo $rotaErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($partida_destinoErro)?'error':'';?>">
                        <label class="control-label">partida_destino</label>
                        <div class="controls">
                            <input name="partida_destino" class="form-control" size="30" type="text" placeholder="partida_destino" value="<?php echo !empty($partida_destino)?$partida_destino:'';?>">
                            <?php if (!empty($partida_destinoErro)): ?>
                                <span class="help-inline"><?php echo $partida_destinoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($trajeto_completo)?'error':'';?>">
                        <label class="control-label">trajeto_completo</label>
                        <div class="controls">
                            <input name="trajeto_completo" class="form-control" size="40" type="text" placeholder="trajeto_completo" value="<?php echo !empty($trajeto_completo)?$trajeto_completo:'';?>">
                            <?php if (!empty($trajeto_completoErro)): ?>
                                <span class="help-inline"><?php echo $trajeto_completoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-secondary">Atualizar</button>
                        <a href="site.php" type="btn" class="btn btn-secondary">Voltar</a>
                    </div>
                </form>
							</div>
						</div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

    </html>
