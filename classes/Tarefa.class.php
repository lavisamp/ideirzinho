<?php
require_once 'CRUD.class.php'; // ajuste o caminho conforme sua estrutura de pastas

class Tarefa extends CRUD
{
    // Nome da tabela
    protected $table = "tarefa";

    // Propriedades
    private ?int $id_tarefa = null;
    private ?int $id_usuario = null;
    private string $titulo;
    private ?string $descricao = null;
    private string $status = 'pendente';

    // --- GETTERS e SETTERS ---
    public function getIdTarefa(): ?int
    {
        return $this->id_tarefa;
    }

    public function setIdUsuario(?int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = trim($titulo);
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = trim($descricao ?? '');
    }

    public function setStatus(string $status): void
    {
        $this->status = in_array($status, ['pendente', 'concluida']) ? $status : 'pendente';
    }

    // --- INSERIR tarefa ---
    public function add(): bool
    {
        $sql = "INSERT INTO {$this->table} (id_tarefa, titulo, descricao, status)
                VALUES (:id_tarefa, :titulo, :descricao, :status)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id_tarefa', $this->id_tarefa, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // --- ATUALIZAR tarefa ---
    public function update(string $campo, int $id): bool
    {
        $sql = "UPDATE {$this->table}
                   SET titulo = :titulo,
                       descricao = :descricao,
                       status = :status
                 WHERE {$campo} = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // --- DELETAR tarefa ---
    public function delete(string $campo, int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE {$campo} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listAll(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY data_criacao DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // LISTAR POR STATUS
    public function listByStatus(string $status): array {
        $sql = "SELECT * FROM {$this->table} WHERE status = :status ORDER BY data_criacao DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}