<?php
namespace App\Model;

use \JsonSerializable;

 

class Jogador implements JsonSerializable {
    private ?int $id;
    private ?string $nome;
	private ?string $genero;
    private ?string $data_nascimento;
    private ?string $nacionalidade;
    private ?string $posicao;
    private ?Time $time;
    private ?Esporte $esporte;

	public function __construct() {
        $this->id = 0;
		$this->nome = null;
		$this->genero = null;
		$this->data_nascimento = null;
		$this->nacionalidade = null;
		$this->posicao = null;
        $this->time = null;
		$this->esporte =null;            
    }

	public function jsonSerialize(): array
	{
		return array(
			"id"=>$this->id,
			"nome"=>$this->nome,
			"genero"=>$this->genero,
			"data_nascimento"=>$this->data_nascimento,
			"nacionalidade"=>$this->nacionalidade,
			"posicao"=>$this->posicao,
			"time_id"=>$this->time,
			"esporte_id"=>$this->esporte	
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

	public function getGenero() : ?string {
		return $this->genero;
	}

	public function setGenero(?string $value) {
		$this->genero = $value;
	}

	public function getData_nascimento() : ?string {
		return $this->data_nascimento;
	}

	public function setData_nascimento(?string $value) {
		$this->data_nascimento = $value;
	}

	public function getNacionalidade() : ?string {
		return $this->nacionalidade;
	}

	public function setNacionalidade(?string $value) {
		$this->nacionalidade = $value;
	}

	public function getPosicao() : ?string {
		return $this->posicao;
	}

	public function setPosicao(?string $value) {
		$this->posicao = $value;
	}

	public function getTime() : ?Time {
		return $this->time;
	}

	public function setTime(?Time $value) {
		$this->time = $value;
	}

	public function getEsporte() : ?Esporte {
		return $this->esporte;
	}

	public function setEsporte(?Esporte $value) {
		$this->esporte = $value;
	}
}
?>