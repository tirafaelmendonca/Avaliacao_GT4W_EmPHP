<?php
//Classe de Modelo
class m_pessoa{
	protected $cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes;
	
	//Método construtor
	public function __construct($cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes){
		$this->cod_pes = $cod_pes;
		$this->nome_pes = $nome_pes;
		$this->cpf_pes = $cpf_pes;
		$this->data_pes = $data_pes;
		$this->peso_pes = $peso_pes;
		$this->uf_pes = $uf_pes;
	}
	//Getters e Setters
	public function setCod_pes(){$this->cod_pes = $cod_pes;}
	public function getCod_pes(){return $this->cod_pes;} 
	
	public function setNome_pes(){$this->nome_pes = $nome_pes;}
	public function getNome_pes(){return $this->nome_pes;} 
	
	public function setCpf_pes(){$this->cpf_pes = $cpf_pes;}
	public function getCpf_pes(){return $this->cpf_pes;} 

	public function setData_pes(){$this->data_pes = $data_pes;}
	public function getData_pes(){return $this->data_pes;} 
	
	public function setPeso_pes(){$this->peso_pes = $peso_pes;}
	public function getPeso_pes(){return $this->peso_pes;}
	
	public function setUf_pes(){$this->uf_pes = $uf_pes;}
	public function getUf_pes(){return $this->uf_pes;}
}
?>