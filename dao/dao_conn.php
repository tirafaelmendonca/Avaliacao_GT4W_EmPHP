<?php
//Classe de Acesso a Base de Dados
class dao_conn{

	protected $servidor,$usuario,$senha,$bancodedados;
	//Dados do Servidor
	public function __construct(){
		$this->servidor="186.202.152.237";
		$this->usuario="gt4w_avaliacao";
		$this->senha="gt4w@avaliacao";
		$this->bancodedados="gt4w_avaliacao";
	}
	//Getters e Setters
	public function setServidor(){$this->servidor = $servidor;}
	public function getServidor(){return $this->servidor;} 
	
	public function setUsuario(){$this->usuario = $usuario;}
	public function getUsuario(){return $this->usuario;} 

	public function setSenha(){$this->senha = $senha;}
	public function getSenha(){return $this->senha;} 
	
	public function setBancodedados(){$this->bancodedados = $bancodedados;}
	public function getBancodedados(){return $this->bancodedados;}
	
	//Método que cria a conexão com o servidor
	public function conectadb (){mysql_connect($this->servidor,$this->usuario,$this->senha) or die(mysql_error());}
	//Método que seleciona o Banco que será utilizado
	public function selecionardb(){mysql_select_db($this->bancodedados) or die (mysql_error());}
	//Método que Fecha a conexão
	public function fechadb(){mysql_close();}

}
//Este trecho cria um objeto. Este Objeto cria a conexão e seliciona o banco a ser utilizado.
$objconn = new dao_conn();
$objconn->conectadb();
$objconn->selecionardb();

?>