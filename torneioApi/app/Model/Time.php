<?php

namespace App\Model;

use \JsonSerializable;
class Time implements JsonSerializable
{
    private ?int $id;
    private ?string $nome;
    private ?string $origem;

	public function __construct() {
		$this->id = 0;
		$this->nome = null;
		$this->origem = null;
	}

	public function jsonSerialize(): array
	{
		return array(
			"id"=>$this->id,
			"nome"=>$this->nome,
			"origem"=>$this->origem
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

	public function getOrigem() : ?string {
		return $this->origem;
	}

	public function setOrigem(?string $value) {
		$this->origem = $value;
	}
}
?>