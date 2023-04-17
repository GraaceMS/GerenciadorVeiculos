<?php
require_once 'conexao.php';
require_once 'operacoes.php';


if (!isset($_GET['id'])) {
	header('Location: listagem.php');
	exit;
}


$id = $_GET['id'];


$operacoes = new Operacoes();
$veiculo = $operacoes->buscarPorId($id);


if (!$veiculo) {
	header('Location: listagem.php');
	exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$modelo = $_POST['modelo'];
	$marca = $_POST['marca'];
	$ano = $_POST['ano'];
	$placa = $_POST['placa'];
	$cor = $_POST['cor'];

	
	$operacoes->atualizar($id, $modelo, $marca, $ano, $placa, $cor);

	
	header('Location: listagem.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Veículo</title>
</head>
<body>
	<h1>Editar Veículo</h1>
	<form method="POST">
		<label>Modelo:</label><br>
		<input type="text" name="modelo" value="<?php echo $veiculo['modelo']; ?>"><br>

		<label>Marca:</label><br>
		<input type="text" name="marca" value="<?php echo $veiculo['marca']; ?>"><br>

		<label>Ano:</label><br>
		<input type="number" name="ano" value="<?php echo $veiculo['ano']; ?>"><br>

		<label>Placa:</label><br>
		<input type="text" name="placa" value="<?php echo $veiculo['placa']; ?>"><br>

		<label>Cor:</label><br>
		<input type="text" name="cor" value="<?php echo $veiculo['cor']; ?>"><br>

		<input type="submit" value="Atualizar">
	</form>
	<a href="listagem.php">Voltar para Listagem</a>
</body>
</html>
