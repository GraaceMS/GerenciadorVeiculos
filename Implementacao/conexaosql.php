class Conexao {
    private $host = "localhost";
    private $db_name = "nome_do_banco";
    private $username = "usuario";
    private $password = "senha";
    private $conn;

    public function conectar() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $this->conn;
    }

    public function fecharConexao() {
        $this->conn = null;
    }
}


$conexao = new Conexao();
$db = $conexao->conectar();

if ($db) {
    echo "Conexão estabelecida com sucesso!";
    // Fazer operações no banco de dados...
    
    $conexao->fecharConexao();
} else {
    echo "Não foi possível estabelecer a conexão.";
}
