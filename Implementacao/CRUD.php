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
