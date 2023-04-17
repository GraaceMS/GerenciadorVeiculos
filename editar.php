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
