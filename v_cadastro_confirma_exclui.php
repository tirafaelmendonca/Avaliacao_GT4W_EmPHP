<?php
//Adicionando as classes de Conexão\Modelo\Controle e criando o Objeto Pessoa
require ("dao/dao_conn.php");
require ("model/m_pessoa.php");
require ("controller/c_pessoa.php");
$c_objpes = new c_pessoa();

//variável recebe o parametro com o código da pessoa que vai ser excluida
$cod_pes = $_GET['cod_pes'];
//Se este parametro estiver setado é feita a exclusão do cadastrdo da Pessoa
if(isset($cod_pes)){
//O cadastro é excluido da base
$c_objpes->deleta_pessoa($cod_pes);
//Após a exclusão é direcionado para a pagina inicial com a mensagem de Cadastro excluido com sucesso
echo "<script>window.location.href = 'index.php?ret=1&msg=2';</script>";
}
?>
