<?php

class Veiculo {
    public $id;
    public $marca;
    public $modelo;
    public $ano;

    public function __construct($id, $marca, $modelo, $ano) {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
    }
}


class VeiculoDAO {
    private $conn;

    public function __construct() {
        $this->conn = new PDO('sqlite:veiculos.db');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->exec('CREATE TABLE IF NOT EXISTS veiculos (id INTEGER PRIMARY KEY AUTOINCREMENT, marca TEXT, modelo TEXT, ano INTEGER)');
    }

    public function getVeiculos() {
        $stmt = $this->conn->query('SELECT * FROM veiculos');
        $rows = $stmt->fetchAll();
        $veiculos = array();
        foreach ($rows as $row) {
            $veiculos[] = new Veiculo($row['id'], $row['marca'], $row['modelo'], $row['ano']);
        }
        return $veiculos;
    }

    public function getVeiculoById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM veiculos WHERE id = ?');
        $stmt->execute(array($id));
        $row = $stmt->fetch();
        if ($row) {
            return new Veiculo($row['id'], $row['marca'], $row['modelo'], $row['ano']);
        } else {
            return null;
        }
    }

    public function addVeiculo($veiculo) {
        $stmt = $this->conn->prepare('INSERT INTO veiculos (marca, modelo, ano) VALUES (?, ?, ?)');
        $stmt->execute(array($veiculo->marca, $veiculo->modelo, $veiculo->ano));
        $veiculo->id = $this->conn->lastInsertId();
    }

    public function updateVeiculo($veiculo) {
        $stmt = $this->conn->prepare('UPDATE veiculos SET marca = ?, modelo = ?, ano = ? WHERE id = ?');
        $stmt->execute(array($veiculo->marca, $veiculo->modelo, $veiculo->ano, $veiculo->id));
    }

    public function deleteVeiculo($id) {
        $stmt = $this->conn->prepare('DELETE FROM veiculos WHERE id = ?');
        $stmt->execute(array($id));
    }
}


class VeiculoController {
    private $dao;

    public function __construct() {
        $this->dao = new VeiculoDAO();
    }

    public function getVeiculos() {
        $veiculos = $this->dao->getVeiculos();
        return json_encode(array_map(function($veiculo) { return $veiculo->{"__stdClass"}; }, $veiculos));
    }

    public function getVeiculoById($id) {
        $veiculo = $this->dao->getVeiculoById($id);
        if ($veiculo) {
            return json_encode($veiculo->{"__stdClass"});
       
