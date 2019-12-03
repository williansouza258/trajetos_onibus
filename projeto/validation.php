<?php
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];
// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
$con = mysqli_connect("127.0.0.1:3306", "root", "") or die
 ("Sem conexão com o servidor");
$select = mysqli_select_db($con,"test") or die("Sem acesso ao DB, Entre em
contato com o Administrador");

$row=null;
$result = mysqli_query( $con,"SELECT * FROM usuario
WHERE name = '$login' AND senha = '$senha'");

if( mysqli_num_rows($result) > 0)
{
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
header('location:site.php');
}
else
{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  header('location:index.php');
  }
?>
