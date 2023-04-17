<?php
require_once 'conexao.php';
require_once 'operacoes.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$modelo = $_POST['modelo'];
	$marca = $_POST['marca'];
	$ano = $_POST['ano'];
	$placa = $_POST['placa'];
	$cor = $_POST['cor'];

	
	$operacoes = new Operacoes();
	$operacoes->inserir($modelo, $marca, $ano, $placa, $cor);

	
	header('Location: listagem.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Adicionar Veículo</title>
</head>
<body>
	<h1>Adicionar Veículo</h1>
	<form method="POST">
		<label>Modelo:</label><br>
		<input type="text" name="modelo"><br>

		<label>Marca:</label><br>
		<input type="text" name="marca"><br>

		<label>Ano:</label><br>
		<input type="number" name="ano"><br>

		<label>Placa:</label><br>
		<input type="text" name="placa"><br>

		<label>Cor:</label><br>
		<input type="text" name="cor"><br>

		<input type="submit" value="Salvar">
	</form>
	<a href="listagem.php">Voltar para Listagem</a>
</body>
</html>
