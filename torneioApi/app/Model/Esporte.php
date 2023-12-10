<?php
namespace App\Model;

use \JsonSerializable;
class Esporte implements JsonSerializable{
    private ?int $id;
    private ?string $nome;
    private ?string $descricao;
    private ?string $tipo;

	public function __construct() {
		$this->id = 0;
		$this->nome = null;
		$this->descricao = null;
		$this->tipo = null;

	}

	public function jsonSerialize(): array
    {
        return array(
                "id"=>$this->id,
                "nome"=>$this->nome,
                "descricao"=>$this->descricao,
                "tipo"=>$this->tipo
                );
    }

	public function getId() : ?int {
		return $this->id;
	}

	public function setId(?int $value) {
		$this->id = $value;
	}

	public function getNome() : ?string {
		return $this->nome;
	}

	public function setNome(?string $value) {
		$this->nome = $value;
	}

	public function getDescricao() : ?string {
		return $this->descricao;
	}

	public function setDescricao(?string $value) {
		$this->descricao = $value;
	}

	public function getTipo() : ?string {
		return $this->tipo;
	}

	public function setTipo(?string $value) {
		$this->tipo = $value;
	}
}
?>