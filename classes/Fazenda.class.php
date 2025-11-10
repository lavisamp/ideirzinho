<?php
class Fazenda extends CRUD
{
    protected $table = "fazenda";

    private $id_fazenda;
    private $nome_fazenda;
    private $localizacao;
    private $proprietario;
    private $tamanho_hectares;
    private $data_registro;
    private $apresentacao;
    private $producao_principal;

    // GETTERS E SETTERS
    public function getIdFazenda() { return $this->id_fazenda; }
    public function setIdFazenda($id_fazenda) { $this->id_fazenda = $id_fazenda; }

    public function getNomeFazenda() { return $this->nome_fazenda; }
    public function setNomeFazenda($nome_fazenda) { $this->nome_fazenda = $nome_fazenda; }

    public function getLocalizacao() { return $this->localizacao; }
    public function setLocalizacao($localizacao) { $this->localizacao = $localizacao; }

    public function getProprietario() { return $this->proprietario; }
    public function setProprietario($proprietario) { $this->proprietario = $proprietario; }

    public function getTamanhoHectares() { return $this->tamanho_hectares; }
    public function setTamanhoHectares($tamanho_hectares) { $this->tamanho_hectares = $tamanho_hectares; }

    public function getDataRegistro() { return $this->data_registro; }
    public function setDataRegistro($data_registro) { $this->data_registro = $data_registro; }

    public function getApresentacao() { return $this->apresentacao; }
    public function setApresentacao($apresentacao) { $this->apresentacao = $apresentacao; }

    public function getProducaoPrincipal() { return $this->producao_principal; }
    public function setProducaoPrincipal($producao_principal) { $this->producao_principal = $producao_principal; }

    // MÉTODO ADD
    public function add()
    {
        $sql = "INSERT INTO $this->table (nome_fazenda, localizacao, proprietario, tamanho_hectares, data_registro, apresentacao, producao_principal)
                VALUES (:nome_fazenda, :localizacao, :proprietario, :tamanho_hectares, :data_registro, :apresentacao, :producao_principal)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nome_fazenda', $this->nome_fazenda);
        $stmt->bindParam(':localizacao', $this->localizacao);
        $stmt->bindParam(':proprietario', $this->proprietario);
        $stmt->bindParam(':tamanho_hectares', $this->tamanho_hectares);
        $stmt->bindParam(':data_registro', $this->data_registro);
        $stmt->bindParam(':apresentacao', $this->apresentacao);
        $stmt->bindParam(':producao_principal', $this->producao_principal);

        return $stmt->execute();
    }

    // MÉTODO UPDATE
    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table 
                SET nome_fazenda = :nome_fazenda, localizacao = :localizacao, proprietario = :proprietario,
                    tamanho_hectares = :tamanho_hectares, data_registro = :data_registro,
                    apresentacao = :apresentacao, producao_principal = :producao_principal
                WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nome_fazenda', $this->nome_fazenda);
        $stmt->bindParam(':localizacao', $this->localizacao);
        $stmt->bindParam(':proprietario', $this->proprietario);
        $stmt->bindParam(':tamanho_hectares', $this->tamanho_hectares);
        $stmt->bindParam(':data_registro', $this->data_registro);
        $stmt->bindParam(':apresentacao', $this->apresentacao);
        $stmt->bindParam(':producao_principal', $this->producao_principal);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
