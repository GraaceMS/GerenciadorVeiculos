<?php
require_once 'conexao.php';
require_once 'operacoes.php';


$operacoes = new Operacoes();
$veiculos = $operacoes->buscarTodos();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listagem de Veículos</title>
</head>
<body>
	<h1>Listagem de Veículos</h1>
	<table>
		<thead>
			<tr>
				<th>Modelo</th>
				<th>Marca</th>
				<th>Ano</th>
				<th>Placa</th>
				<th>Cor</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($veiculos as $veiculo) : ?>
				<tr>
					<td><?= $veiculo['modelo'] ?></td>
					<td><?= $veiculo['marca'] ?></td>
					<td><?= $veiculo['ano'] ?></td>
					<td><?= $veiculo['placa'] ?></td>
					<td><?= $veiculo['cor'] ?></td>
					<td>
						<a href="editar.php?id=<?= $veiculo['id'] ?>">Editar</a>
						<a href="excluir.php?id=<?= $veiculo['id'] ?>" onclick="return confirm('Deseja realmente excluir este veículo?')">Excluir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<a href="adicionar.php">Adicionar Novo Veículo</a>
</body>
</html>
