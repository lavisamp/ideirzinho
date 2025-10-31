<?php
class Login extends CRUD
{
    protected $table = "usuario";
    private $id;
    private $Usuario;
    private $Senha;

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    public function getSenha()
    {
        return $this->Senha;
    }

    public function setSenha($Senha)
    {
        $this->Senha = $Senha;
    }


    public function add()
    {

        $sql = "INSERT INTO $this->table (id, Usuario, Senha) 
                VALUES (:id, :Usuario, :Senha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);
        $stmt->bindParam(":Usuario", $this->Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":Senha", $this->Senha, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update(string $campo, int $Valor)
    {
        $sql = "UPDATE $this->table SET Usuario = :Usuario, Senha = :Senha WHERE $campo = :Valor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":Usuario", $this->Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":Senha", $this->Senha, PDO::PARAM_STR);
        $stmt->bindParam(":Valor", $Valor, PDO::PARAM_INT);
        return $stmt->execute();
    }
  public function buscarUsuario($usuario){
$sql = "SELECT * FROM CadastroDeUsuario WHERE usuario = :usuario";
$stmt = $this->db->prepare($sql);
$stmt->bindValue(':usuario', $usuario);
$stmt->execute();
return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
}
}