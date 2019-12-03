<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Trajeto</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar nova linha </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($rotaErro)?'error ' : '';?>">
                    <label class="control-label">Rota</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="rota" type="text" placeholder="rota" required="" value="<?php echo !empty($rota)?$rota: '';?>">
                        <?php if(!empty($rotaErro)): ?>
                            <span class="help-inline"><?php echo $rotaErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($partida_destinoErro)?'error ': '';?>">
                    <label class="control-label">Partida/Destino</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="partida_destino" type="text" placeholder="partida_destino" required="" value="<?php echo !empty($partida_destino)?$partida_destino: '';?>">
                        <?php if(!empty($partida_destinoErro)): ?>
                            <span class="help-inline"><?php echo $partida_destinoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($trajeto_completoErro)?'error ': '';?>">
                    <label class="control-label">Trajeto Completo</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="trajeto_completo" type="text" placeholder="trajeto_completo" required="" value="<?php echo !empty($trajeto_completo)?$trajeto_completo: '';?>">
                        <?php if(!empty($trajeto_completoErro)): ?>
                            <span class="help-inline"><?php echo $telefoneErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($siglaErro)?'error ': '';?>">
                    <label class="control-label">Sigla</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="sigla" type="text" placeholder="sigla" required="" value="<?php echo !empty($sigla)?$sigla: '';?>">
                        <?php if(!empty($siglaErro)): ?>
                            <span class="help-inline"><?php echo $siglaErro;?></span>
                            <?php endif;?>
                    </div>
                </div>


                </div>
                <div class="form-actions">
                    <br/>

                    <!-- <button type="submit" class="btn btn-success">Adicionar</button> -->
                    <button type="submit" class="btn btn-secondary">Adicionar</button>
                    <a href="site.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
            </form>
          </div>
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

<?php
    require 'banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $rotaErro = null;
        $partida_destinoErro = null;
        $trajeto_completoErro = null;
        $siglaErro = null;


        $rota = $_POST['rota'];
        $partida_destino = $_POST['partida_destino'];
        $trajeto_completo = $_POST['trajeto_completo'];
        $sigla = $_POST['sigla'];


        //Validaçao dos campos:
        $validacao = true;
        if(empty($rota))
        {
            $rotaErro = 'Por favor digite o nome da rota!';
            $validacao = false;
        }

        if(empty($partida_destino))
        {
            $partida_destinoErro = 'Por favor digite o local de partida/ destino!';
            $validacao = false;
        }

        if(empty($trajeto_completo))
        {
            $trajeto_completoErro = 'Por favor digite todas as ruas do trajeto separadas por /';
            $validacao = false;
        }

        if(empty($sigla))
        {
            $siglaErro = 'Por favor digite a sigla da rota!';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO trajetos (rota, partida_destino, trajeto_completo, sigla) VALUES(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($rota,$partida_destino,$trajeto_completo,$sigla));
            Banco::desconectar();
            header("Location: site.php");
        }
    }
?>
