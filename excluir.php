<?php

$conn = mysqli_connect("localhost", "usuario", "senha", "veiculos_db");


if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}


if (isset($_GET["id"])) {
   
    $id = $_GET["id"];
    $sql = "SELECT * FROM veiculos WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<p class='erro'>Veículo não encontrado.</p>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir_veiculo"])) {
    
    $id = $_POST["id"];

    
    $sql = "DELETE FROM veiculos WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<p class='mensagem'>Veículo excluído com sucesso!</p>";
    } else {
        echo "<p class='erro'>Erro ao excluir veículo: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2>Excluir veículo</h2>

<?php if (isset($row)) { ?>
    <p>Você tem certeza que deseja excluir o veículo abaixo?</p>

    <ul>
        <li><strong>Modelo:</strong> <?php echo $row["modelo"]; ?></li>
        <li><strong>Marca:</strong> <?php echo $row["marca"]; ?></li>
        <li><strong>Ano:</strong> <?php echo $row["ano"]; ?></li>
        <li><strong>Placa:</strong> <?php echo $row["placa"]; ?></li>
        <li><strong>Cor:</strong> <?php echo $row["cor"]; ?></li>
    </ul>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

        <input type="submit" name="excluir_veiculo" value="Excluir">
        <a href="listar_veiculos.php">Cancelar</a>
    </form>
<?php } ?>
