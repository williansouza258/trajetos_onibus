<?php
    require 'banco.php';
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_REQUEST['id'];
    }

    if(null==$id)
    {
        header("Location: site.php");
    }
    else
    {
       $pdo = Banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM trajetos where id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       Banco::desconectar();
    }
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Informações do Trajeto</title>
    </head>

    <body>
        <div class="container">
            <div class="span10 offset1">
                  <div class="card">
    								<div class="card-header">
                    <h3 class="well">Informações do Trajeto</h3>
                </div>
                <div class="container">
                <div class="form-horizontal">

                  <div class="control-group">
                      <label class="control-label"><b>Sigla</b></label>
                      <div class="controls">
                          <label class="carousel-inner">
                              <?php echo $data['sigla'];?>
                          </label>
                      </div>
                  </div>

                    <div class="control-group">
                        <label class="control-label"><b>Rota</b></label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['rota'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><b>Partida/Destino</b></label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['partida_destino'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><b>Trajeto Completo</b></label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['trajeto_completo'];?>
                            </label>
                        </div>
                    </div>



                    <br/>
                    <div class="form-actions">
                        <a href="site.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
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
