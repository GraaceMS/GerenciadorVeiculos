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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_veiculo"])) {
   
    $id = $_POST["id"];
    $modelo = $_POST["modelo"];
    $marca = $_POST["marca"];
    $ano = $_POST["ano"];
    $placa = $_POST["placa"];
    $cor = $_POST["cor"];

    
    $sql = "UPDATE veiculos SET modelo='$modelo', marca='$marca', ano='$ano', placa='$placa', cor='$cor' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<p class='mensagem'>Veículo atualizado com sucesso!</p>";
    } else {
        echo "<p class='erro'>Erro ao atualizar veículo: " . mysqli_error($conn) . "</p>";
    }
}


if (isset($_GET["excluir_id"])) {
    $id = $_GET["excluir_id"];
    
    $sql = "DELETE FROM veiculos WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<p class='mensagem'>Veículo excluído com sucesso!</p>";
    } else {
        echo "<p class='erro'>Erro ao excluir veículo: " . mysqli_error($conn) . "</p>";
    }
}


$sql = "SELECT * FROM veiculos";
$resultado = mysqli_query($conn, $sql);


echo "<table>";
echo "<tr><th>ID</th><th>Modelo</th><th>Marca</th><th>Ano</th><th>Placa</th><th>Cor</th><th>Ações</th></tr>";
while ($linha = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $linha["id"] . "</td>";
    echo "<td>" . $linha["modelo"] . "</td>";
    echo "<td>" . $linha["marca"] . "</td>";
    echo "<td>" . $linha["ano"] . "</td>";
    echo "<td>" . $linha["placa"] . "</td>";
    echo "<td>" . $linha["cor"] . "</td>";
    echo "<td><a href='editar.php?id=" . $linha["id"] . "'>Editar</a> | <a href='?excluir_id=" . $linha["id"] . "' onclick='return confirm(\"Tem certeza que deseja excluir este veículo?\")'>Excluir</a></td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($conn);

?>
