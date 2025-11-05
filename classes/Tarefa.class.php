<?php
require_once 'CRUD.class.php'; // ajuste o caminho conforme sua estrutura de pastas

class Tarefa extends CRUD
{
    // Nome da tabela
    protected string $table = "tarefas";

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
        $sql = "INSERT INTO {$this->table} (id_usuario, titulo, descricao, status)
                VALUES (:id_usuario, :titulo, :descricao, :status)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
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

    // --- BUSCAR tarefa por campo (genérico) ---
    public function search(string $campo, $valor): ?object
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$campo} = :valor LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
    }

    // --- LISTAR tarefas por usuário ---
    public function listByUser(int $id_usuario, ?string $filtro = null): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id_usuario";
        if ($filtro === 'concluidas') {
            $sql .= " AND status = 'concluida'";
        } elseif ($filtro === 'pendentes') {
            $sql .= " AND status = 'pendente'";
        }
        $sql .= " ORDER BY data_criacao DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
