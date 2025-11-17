<?php
class Usuario extends CRUD
{
    protected $table = "usuario";

    private $idUsuario;
    private $nome;
    private $telefone;
    private $email;
    private $senha;

    // ==== GETTERS E SETTERS ====

    public function getID()
    {
        return $this->idUsuario;
    }

    public function setID($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = trim($nome);
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = trim($telefone);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    // ================================================================
    // =========================== ADD ================================
    // ================================================================

    public function add()
    {
        $sql = "INSERT INTO {$this->table} (nome, telefone, email, senha)
                VALUES (:nome, :telefone, :email, :senha)";

        $stmt = $this->db->prepare($sql);

        $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $senhaHash);

        return $stmt->execute();
    }

    // ================================================================
    // ========================== UPDATE ==============================
    // ================================================================

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE {$this->table}
                SET nome = :nome,
                    telefone = :telefone,
                    email = :email,
                    senha = :senha
                WHERE {$campo} = :id";

        $stmt = $this->db->prepare($sql);

        $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $senhaHash);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // ================================================================
    // =========================== LOGIN ==============================
    // ================================================================

    public function login()
    {
        $sql = "SELECT * FROM {$this->table} WHERE nome = :nome LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->execute();

        // Se não encontrou o usuário
        if ($stmt->rowCount() === 0) {
            return "Usuário ou senha incorretos.";
        }

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

        // Verifica a senha
        if (!password_verify($this->senha, $usuario->senha)) {
            return "Usuário ou senha incorretos.";
        }

        // Inicia sessão caso não exista
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Guarda as informações do usuário na sessão
        $_SESSION['user_id'] = $usuario->id_usuario;
        $_SESSION['nome'] = $usuario->nome;
        $_SESSION['email'] = $usuario->email;

        // Redireciona para o Dashboard
        header("Location: dashboard.php");
        exit;
    }
}
