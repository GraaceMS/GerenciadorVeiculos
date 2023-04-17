<?php
// Inclua a classe de conexão e operações com o banco de dados
require_once 'db.php';

// Verifique se o ID do veículo a ser excluído foi passado por parâmetro
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: list.php');
  exit;
}

// Obtém o ID do veículo a ser excluído
$id = $_GET['id'];

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Confirma a exclusão do veículo
  if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    $db = new DB();
    $db->delete($id);
  }

  // Redireciona para a página de listagem de veículos
  header('Location: list.php');
  exit;
}

// Obtém as informações do veículo a ser excluído
$db = new DB();
$vehicle = $db->get($id);

// Verifica se o veículo existe
if (!$vehicle) {
  header('Location: list.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Excluir Veículo</title>
</head>
<body>
  <h1>Excluir Veículo</h1>
  <p>Tem certeza que deseja excluir o veículo abaixo?</p>
  <p>Modelo: <?php echo $vehicle['model']; ?></p>
  <p>Marca: <?php echo $vehicle['brand']; ?></p>
  <p>Ano: <?php echo $vehicle['year']; ?></p>
  <p>Placa: <?php echo $vehicle['license_plate']; ?></p>
  <p>Cor: <?php echo $vehicle['color']; ?></p>
  <form method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="radio" name="confirm" value="yes" required> Sim<br>
    <input type="radio" name="confirm" value="no"> Não<br>
    <br>
    <button type="submit">Excluir</button>
    <a href="list.php">Cancelar</a>
  </form>
</body>
</html>
