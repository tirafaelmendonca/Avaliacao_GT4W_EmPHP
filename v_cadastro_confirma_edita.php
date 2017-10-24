<?php
//Adicionando as classes de Conexão\Modelo\Controle e criando o Objeto Pessoa
require ("dao/dao_conn.php");
require ("model/m_pessoa.php");
require ("controller/c_pessoa.php");
$c_objpes = new c_pessoa();

//Criação de variáveis
$cod_pes ="";
$nome_pes ="";
$cpf_pes = "";
$data_pes = "";
$peso_pes = "";
$uf_pes = "";
$validacao = 0;

//Checa se o a varival que veio pelo Post foi setada
if(isset($_POST['cod_pes'])){
	//Variável recebe o Post
	$cod_pes = $_POST['cod_pes'];
}
//Checa se o a varival que veio pelo Post foi setada
if(isset($_POST['nome_pes'])){
	//Variável recebe o Post
	$nome_pes = $_POST['nome_pes'];
}
//Checa se o a varival que veio pelo Post foi setada
if(isset($_POST['data_pes'])){
	//É feito a conversão de Data para o padrão Americano
	$data = $_POST['data_pes'];
	list($dia,$mes,$ano) = explode("/", $data);
	//Tratamento de datas validas
	if(($dia >29) && $mes==02){
		$validacao = 1;
		echo "<script>window.location.href = 'v_cadastro_edita.php?ret=1&msg=2&cod_pes=$cod_pes';</script>";
	}else if($dia >31 && ($mes==01 ||$mes==03 ||$mes==05 ||$mes==07 ||$mes==08 ||$mes==10 ||$mes==12)){
		$validacao = 1;
		echo "<script>window.location.href = 'v_cadastro_edita.php?ret=1&msg=3&cod_pes=$cod_pes';</script>";
	}else if($dia >30 && ($mes==04 ||$mes==06 ||$mes==09 ||$mes==11)){
		$validacao = 1;
		echo "<script>window.location.href = 'v_cadastro_edita.php?ret=1&msg=4&cod_pes=$cod_pes';</script>";
	}else if($mes>12){
		$validacao = 1;
		echo "<script>window.location.href = 'v_cadastro_edita.php?ret=1&msg=5&cod_pes=$cod_pes';</script>";
	}
	$data_pes = $ano."-".$mes."-".$dia;
}
//Checa se o a varival que veio pelo Post foi setada
if(isset($_POST['peso_pes'])){
	//É retirado os pontos para gravar na base
	$peso_pes = $_POST['peso_pes'];
	$peso_pes = str_replace(",",".",$peso_pes);
	$peso_pes = $peso_pes * 1000;
}
//Checa se o a varival que veio pelo Post foi setada
if(isset($_POST['uf_pes'])){
	//Variável recebe o Post
	$uf_pes = $_POST['uf_pes'];
}
//Checa se o a varival que veio pelo Post foi setada
if(isset($_POST['cpf_pes'])){
	//É retirado os pontos e traço para gravar na base
	$cpf_pes = $_POST['cpf_pes'];
	$caracteres = array(".", "-");
	$cpf_pes = str_replace($caracteres, "", $cpf_pes);
	//Esta variável recebe o retorno da checagem se este cpf já está cadastrado
	$retorno = $c_objpes->checa_cpf_pessoa_outra($cod_pes,$cpf_pes);
	//Se ele já foi cadastrado é direcionado para a pagina de cadastro com a mensagem referente ao CPF que já foi cadastrado
	if($retorno != 0){
	$validacao = 1;
	echo "<script>window.location.href = 'v_cadastro_edita.php?ret=1&msg=1&cod_pes=$cod_pes';</script>";
	}
}
if($validacao == 0){
//Nesta área é criado um objeto com os dados que serão alterados na base
$m_objpes = new m_pessoa($cod_pes,$nome_pes,$cpf_pes,$data_pes,$peso_pes,$uf_pes);
//O obejto é alterado na base
$c_objpes->altera_pessoa($m_objpes);
//Após a alteração é direcionado para a pagina inicial com a mensagem de Cadastro alterado com sucesso
echo "<script>window.location.href = 'index.php?ret=1&msg=3';</script>";
}else{
echo "<script>window.location.href = 'v_cadastro_edita.php?ret=1&msg=6&cod_pes=$cod_pes'';</script>";	
}
?>

