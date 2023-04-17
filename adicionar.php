<?php

$conn = mysqli_connect("localhost", "usuario", "senha", "veiculos_db");


if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["adicionar_veiculo"])) {
    
    $modelo = $_POST["modelo"];
    $marca = $_POST["marca"];
    $ano = $_POST["ano"];
    $placa = $_POST["placa"];
    $cor = $_POST["cor"];

    
    $sql = "INSERT INTO veiculos (modelo, marca, ano, placa, cor) VALUES ('$modelo', '$marca', '$ano', '$placa', '$cor')";
    if (mysqli_query($conn, $sql)) {
        echo "<p class='mensagem'>Veículo adicionado com sucesso!</p>";
    } else {
        echo "<p class='erro'>Erro ao adicionar veículo: " . mysqli_error($conn) . "</p>";
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="modelo">Modelo:</label>
    <input type="text" name="modelo" required>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" required>

    <label for="ano">Ano:</label>
    <input type="number" name="ano" min="1900" max="<?php echo date("Y"); ?>" required>

    <label for="placa">Placa:</label>
    <input type="text" name="placa" pattern="[A-Z]{3}-\d{4}" required>

    <label for="cor">Cor:</label>
    <input type="text" name="cor" required>

    <input type="submit" name="adicionar_veiculo" value="Adicionar">
</form>
