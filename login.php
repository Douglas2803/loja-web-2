<?php
session_start();
include('fachada.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
print_r("usuario: ".$usuario);
echo "<br>";
print_r("senha".$senha);
echo "<br>";

//$query = "select nome from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";
$query = "select nome from usuario where login like '{$usuario}' and senha ='{$senha}'";
print_r($query);

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);
print_r($row);

if($row == 1) { 
	$usuario_bd = mysqli_fetch_assoc($result);
    $_SESSION['nome'] = $usuario_bd['nome'];
    
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}