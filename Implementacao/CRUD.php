class VeiculoDAO {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function listar() {
        $sql = "SELECT * FROM veiculos";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $veiculos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $veiculos[] = $row;
        }

        return $veiculos;
    }

    public function inserir($modelo, $marca, $ano, $placa, $cor) {
        $sql = "INSERT INTO veiculos (modelo, marca, ano, placa, cor) VALUES (:modelo, :marca, :ano, :placa, :cor)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':ano', $ano);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':cor', $cor);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizar($id, $modelo, $marca, $ano, $placa, $cor) {
        $sql = "UPDATE veiculos SET modelo = :modelo, marca = :marca, ano = :ano, placa = :placa, cor = :cor WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':ano', $ano);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':cor', $cor);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluir($id) {
        $sql = "DELETE FROM veiculos WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


conexão PDO como parâmetro para o construtor da classe: 

$conexao = new PDO("mysql:host=localhost;dbname=nome_do_banco", "usuario", "senha");
$dao = new VeiculoDAO($conexao);


Chamada dos métodos da classe para realizar as operações de CRUD no banco de dados:

$veiculos = $dao->listar();
foreach



$conexao = new PDO("mysql:host=localhost;dbname=nome_do_banco", "usuario", "senha");
$dao = new VeiculoDAO($conexao);

// Listar os veículos
$veiculos = $dao->listar();

// Exibir os veículos na tela
foreach ($veiculos as $veiculo) {
    echo "ID: " . $veiculo['id'] . "<br>";
    echo "Modelo: " . $veiculo['modelo'] . "<br>";
    echo "Marca: " . $veiculo['marca'] . "<br>";
    echo "Ano: " . $veiculo['ano'] . "<br>";
    echo "Placa: " . $veiculo['placa'] . "<br>";
    echo "Cor: " . $veiculo['cor'] . "<br><br>";
}
$conexao = new PDO("mysql:host=localhost;dbname=nome_do_banco", "usuario", "senha");
$dao = new VeiculoDAO($conexao);

// Inserir um veículo
$modelo = "Gol";
$marca = "Volkswagen";
$ano = "2010";
$placa = "ABC1234";
$cor = "Preto";
$resultado = $dao->inserir($modelo, $marca, $ano, $placa, $cor);

if ($resultado) {
    echo "Veículo inserido com sucesso!";
} else {
    echo "Erro ao inserir o veículo.";
}
$conexao = new PDO("mysql:host=localhost;dbname=nome_do_banco", "usuario", "senha");
$dao = new VeiculoDAO($conexao);

// Atualizar um veículo
$id = 1; // ID do veículo a ser atualizado
$modelo = "Civic";
$marca = "Honda";
$ano = "2015";
$placa = "DEF5678";
$cor = "Prata";
$resultado = $dao->atualizar($id, $modelo, $marca, $ano, $placa, $cor);

if ($resultado) {
    echo "Veículo atualizado com sucesso!";
} else {
    echo "Erro ao atualizar o veículo.";
}
$conexao = new PDO("mysql:host=localhost;dbname=nome_do_banco", "usuario", "senha");
$dao = new VeiculoDAO($conexao);

// Excluir um veículo
$id = 1; // ID do veículo a ser excluído
$resultado = $dao->excluir($id);

if ($resultado) {
    echo "Veículo excluído com sucesso!";
} else {
    echo "Erro ao excluir o veículo.";
}

