<?php
class Animal extends CRUD
{
    protected $table = "animal";

    private $id_animal;
    private $nome_animal;
    private $especie;
    private $idade;
    private $peso;
    private $id_fazenda;

    // GETTERS E SETTERS
    public function getIdAnimal() { return $this->id_animal; }
    public function setIdAnimal($id_animal) { $this->id_animal = $id_animal; }

    public function getNomeAnimal() { return $this->nome_animal; }
    public function setNomeAnimal($nome_animal) { $this->nome_animal = $nome_animal; }

    public function getEspecie() { return $this->especie; }
    public function setEspecie($especie) { $this->especie = $especie; }

    public function getIdade() { return $this->idade; }
    public function setIdade($idade) { $this->idade = $idade; }

    public function getPeso() { return $this->peso; }
    public function setPeso($peso) { $this->peso = $peso; }

    public function getIdFazenda() { return $this->id_fazenda; }
    public function setIdFazenda($id_fazenda) { $this->id_fazenda = $id_fazenda; }

    // MÉTODO ADD
    public function add()
    {
        $sql = "INSERT INTO $this->table (nome_animal, especie, idade, peso, id_fazenda)
                VALUES (:nome_animal, :especie, :idade, :peso, :id_fazenda)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nome_animal', $this->nome_animal);
        $stmt->bindParam(':especie', $this->especie);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':id_fazenda', $this->id_fazenda, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // MÉTODO UPDATE
    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table 
                SET nome_animal = :nome_animal, especie = :especie, idade = :idade, peso = :peso, id_fazenda = :id_fazenda
                WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nome_animal', $this->nome_animal);
        $stmt->bindParam(':especie', $this->especie);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':id_fazenda', $this->id_fazenda, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // LISTAGEM COM NOME DA FAZENDA
    public function allComFazenda()
    {
        $sql = "SELECT a.*, f.nome_fazenda 
                FROM animal a 
                INNER JOIN fazenda f ON a.id_fazenda = f.id_fazenda
                ORDER BY a.nome_animal";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
