<?php 
//Classe de Controle 
class c_pessoa{
	
	//Método que lista os dados da Pessoa selecionada
	public function lista_pessoa_sel($cod_pes){
	$sql="select * FROM pessoa where cod_pes=$cod_pes";
	$query = mysql_query($sql);
	list($cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes) = mysql_fetch_array($query);	
	$m_objpes = new m_pessoa($cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes);
	return $m_objpes;
	}
	//Método que lista todas as Pessoas cadastradas
	public function lista_pessoa(){
	$sql="select * FROM pessoa order by cod_pes desc";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	$lista = array();
	for($i=0;$i<$count;$i++){
	list($cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes) = mysql_fetch_array($query);	
	$m_objpes = new m_pessoa($cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes);
    $lista[$i]=$m_objpes;
	}
	return $lista;
	}
	//Método que checa se o cpf já existe
	public function checa_cpf_pessoa($cpf_pes){
	$sql="select count(cpf_pes) FROM pessoa where cpf_pes=$cpf_pes";
	$query = mysql_query($sql);
	list($cpf_pes) = mysql_fetch_array($query);		
	return $cpf_pes;
	}
	//Método que checa se o cpf já existe em outra pessoa
	public function checa_cpf_pessoa_outra($cod_pes,$cpf_pes){
	$sql="select count(cpf_pes) FROM pessoa where cpf_pes=$cpf_pes and cod_pes != $cod_pes";
	$query = mysql_query($sql);
	list($cpf_pes) = mysql_fetch_array($query);		
	return $cpf_pes;
	}	
	//Método que insere a cadastro de uma Pessoa
	public function insere_pessoa($m_objpes){
		$nome_pes = $m_objpes->getNome_pes();
		$cpf_pes = $m_objpes->getCpf_pes();
		$data_pes = $m_objpes->getData_pes();
		$peso_pes = $m_objpes->getPeso_pes();
		$uf_pes = $m_objpes->getUf_pes();
		
		$sql="insert into pessoa (nome_pes,cpf_pes,data_pes,peso_pes,uf_pes) values('$nome_pes','$cpf_pes','$data_pes','$peso_pes','$uf_pes')";
		$query = @mysql_query ($sql) or die ("Erro ao Inserir os dados no banco ".mysql_error()); 	
		return $query;
	}
	//Método que altera os dados do cadastro de uma Pessoa
	public function altera_pessoa($m_objpes){
		$cod_pes = $m_objpes->getCod_pes();
		$nome_pes = $m_objpes->getNome_pes();
		$cpf_pes = $m_objpes->getCpf_pes();
		$data_pes = $m_objpes->getData_pes();
		$peso_pes = $m_objpes->getPeso_pes();
		$uf_pes = $m_objpes->getUf_pes();
		
		$sql="update pessoa set nome_pes='$nome_pes',cpf_pes='$cpf_pes',data_pes='$data_pes',peso_pes='$peso_pes',uf_pes='$uf_pes' where cod_pes= $cod_pes";
		$query = @mysql_query ($sql) or die ("Erro ao Atualizar os dados no banco ".mysql_error()); 	
		return $query;
	}
	//Método que deleta o cadastro de uma Pessoa
	public function deleta_pessoa($cod_pes){
		$sql="delete from pessoa where cod_pes=$cod_pes";
		$query = @mysql_query ($sql) or die ("Erro ao deletar os dados no banco ".mysql_error()); 	
		return $query;
	}
}
?>