<?php
class Tarefa extends CRUD
{
    protected $table = "tarefas";

    private $id;
    private $user_id;
    private $titulo;
    private $descricao;
    private $status;

    // getters / setters
    public function setUserId($user_id){ $this->user_id = $user_id; }
    public function setTitulo($titulo){ $this->titulo = $titulo; }
    public function setDescricao($descricao){ $this->descricao = $descricao; }
    public function setStatus($status){ $this->status = $status; }
    public function getId(){ return $this->id; }

    public function add()
    {
        $sql = "INSERT INTO {$this->table} (user_id, titulo, descricao, status) 
                VALUES (:user_id, :titulo, :descricao, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update(string $campo, int $id)
    {
        $sql = "UPDATE {$this->table} SET titulo = :titulo, descricao = :descricao, status = :status WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // listar tarefas por usuário
    public function listByUser(int $user_id, $filter = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id";
        if ($filter === 'concluidas') {
            $sql .= " AND status = 'concluida'";
        } elseif ($filter === 'pendentes') {
            $sql .= " AND status = 'pendente'";
        }
        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // buscar tarefa por ID (sobrescreve search para aceitar tabela atual)
    public function searchById(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
    }
}
