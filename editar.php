<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Editar Veículo</title>
  </head>
  <body>
    <h1>Editar Veículo</h1>
    <form method="post" action="atualizar.php">
      <?php
        
        $conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

        
        if ($conn->connect_error) {
          die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
        }

       
        $sql = "SELECT * FROM veiculos WHERE
        $id = $_GET["id"];
        $sql .= "id = " . $id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        } else {
          echo "Veículo não encontrado.";
          exit();
        }
        $conn->close();
        
      ?>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" value="<?php echo $row["modelo"]; ?>"><br>

        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="<?php echo $row["marca"]; ?>"><br>

        <label for="ano">Ano:</label>
        <input type="number" name="ano" value="<?php echo $row["ano"]; ?>"><br>

        <label for="placa">Placa:</label>
        <input type="text" name="placa" value="<?php echo $row["placa"]; ?>"><br>

        <label for="cor">Cor:</label>
        <input type="text" name="cor" value="<?php echo $row["cor"]; ?>"><br>

        <input type="submit" value="Salvar">
          
      
    </form>

</body>
</html>
