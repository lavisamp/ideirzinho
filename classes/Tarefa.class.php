<?php
// Inclui a classe-pai CRUD, necessária para Tarefa
require_once 'CRUD.class.php'; // ajuste o caminho conforme sua estrutura de pastas
class Tarefa extends CRUD
{
    // Nome da tabela no banco
    protected string $table = "tarefas";

    // Propriedades da tarefa
    private int $id;
    private int $user_id;
    private string $titulo;
    private ?string $descricao = null;
    private string $status;

    // --- Getters e Setters ---
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    // --- Adicionar tarefa ---
    public function add(): bool
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

    // --- Atualizar tarefa ---
    public function update(string $campo, int $id): bool
    {
        $sql = "UPDATE {$this->table}
                SET titulo = :titulo, descricao = :descricao, status = :status
                WHERE {$campo} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // --- Listar tarefas por usuário ---
    public function listByUser(int $user_id, ?string $filter = null): array
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

    // --- Buscar tarefa por ID ---
    public function searchById(int $id): ?object
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
    }
}
