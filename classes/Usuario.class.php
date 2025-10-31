<?php
class Usuario extends CRUD
{
    protected $table = "usuario";
    private $idUsuario;
    private $nome;
    private $telefone;
    private $email;
    private $senha;

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
        $this->nome = $nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function add()
    {
       $sql = "INSERT INTO $this->table (nome, telefone, email, senha) 
        VALUES (:nome, :telefone, :email, :senha)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
      $stmt->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
      $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
      $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
      $stmt->bindParam(":senha", $senhaHash, PDO::PARAM_STR);
         return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET nome = :nome, telefone = :telefone, email = :email, senha = :senha 
                WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
        $stmt->bindParam(":senha", $senhaHash, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

     public function login(){
        $sql = "SELECT * FROM {$this->table} where nome =:nome";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->execute();
        if($stmt->rowCount()>0){
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            if(password_verify($this->senha, $usuario->senha)){
                $_SESSION['user_id'] = $usuario->id_usuario;
                $_SESSION['nome'] = $usuario->nome;
                $_SESSION['email'] = $usuario->email;
                header("Location: dashboard.php");
            }
        }
        return "Usuário ou senha incorretos, tente novamente, mais tarde";
    }
}