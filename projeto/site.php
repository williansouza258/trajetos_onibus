<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
        <div class="container">

<div div align="center">

        <img src="https://st3.depositphotos.com/1504872/12727/v/950/depositphotos_127275128-stock-illustration-cartoon-yellow-bus.jpg" alt="some text" width=300 height=150>
        <h2><span class="badge badge-secondary">Trajetos de Ônibus</span></h2>
</div>

            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-secondary">Adicionar</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- <th scope="col">id</th> -->
                            <th scope="col">Sigla</th>
                            <th scope="col">Rota</th>
                            <th scope="col">Partida/Destino</th>
                            <th scope="col">Trajeto Completo</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM trajetos ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
                            echo '<td>'. $row['sigla'] . '</td>';
                            echo '<td>'. $row['rota'] . '</td>';
                            echo '<td>'. $row['partida_destino'] . '</td>';
                            echo '<td>'. $row['trajeto_completo'] . '</td>';

                            echo '<td width=250>';
                            echo '<a class="btn btn-secondary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-secondary" href="update.php?id='.$row['id'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-secondary" href="delete.php?id='.$row['id'].'">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
