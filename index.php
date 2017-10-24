<!DOCTYPE html>
<html lang="en">
   <!-- Adicionando as classes de Conexão\Modelo\Controle e criando o Objeto Pessoa-->
   <?php
      require ("dao/dao_conn.php");
      require ("model/m_pessoa.php");
      require ("controller/c_pessoa.php");
      $c_objpes = new c_pessoa();	
      ?>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>GT4W - Em PHP</title>
      <!-- Adicionando arquivos CSS-->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/gt4w.css" rel="stylesheet">
      <!-- Adicionando arquivos Javascript BootStrap e Jquery-->
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/jquery.mask.js"></script>
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="gt4w">
            <!--Topo da tela-->
            <img src="img/gt4w.png"  alt="Gt4W" width='200' height='80'> 
            <br>
            <label id="label">Avaliação Técnica 20/10/2017</label>
            <br>
            <label id="label">Cadastro de Pessoas</label>
            <br>
            <!--link para cadastro de novas Pessoas-->
            <a href="v_cadastro_novo.php" title="Novo pedido" ><img src="img/novo.png" height="32" width="32"></a>
            <!--Nesta área é recebido um parametro por GET.
               Se ele for setado é apresentado uma Mensagem conforme o parametro msg que vem por GET.
               Aqui também é feita a limpeza dos cookies utilizados no cadastro
               -->
            <?php
               if(isset($_GET['ret'])){
               ?>
            <script>
               window.setTimeout(function() {
               $(".alert").fadeTo(500, 0).slideUp(500, function(){
               	$(this).remove(); 
               });
               }, 4000);
            </script>
            <?php
               If(isset($_GET['msg'])){
               if($_GET['msg'] =='1'){
               ?>
            <div id='msg' disabled class="alert alert-success">Cadastro realizado com sucesso!</div>
            <?php	
               }else if ($_GET['msg']=='2'){
               ?>
            <div id='msg' disabled class="alert alert-warning">Cadastro Deletado com sucesso!</div>
            <?php	
               }else if ($_GET['msg']=='3'){
               ?>
            <div id='msg' disabled class="alert alert-info">Cadastro Alterado com sucesso!</div>
            <?php	
               }	
               }
               setcookie("nome_pes",null);
               setcookie("cpf_pes",null);
               setcookie("data_pes",null);
               setcookie("peso_pes",null);
               setcookie("uf_pes",null);	
               }
               ?>
            <!--Nesta área é criada um tabela com os dados das pessoas já cadastradas. Note que esta tabela não aparece em dispositivos pequenos.-->
            <table style='width:100%;' border="1" bordercolor="#D3D3D3" class="table hidden-xs">
               <tr>
                  <td>Cod.</td>
                  <td>Nome</td>
                  <td>CPF</td>
                  <td>Data Nasc</td>
                  <td>Peso</td>
                  <td>Estado</td>
                  <td colspan='2' align='center'>Opções</td>
               </tr>
               <?php
                  //Este variável recebe uma lista de objetos do tipo Pessoa 
                           $lista = $c_objpes->lista_pessoa();
                           //Esta variável recebe a contagem de quantos objetos tem dentro da lista
                  $count = count($lista);
                  //Este laço percorre enquanto a variável $i for menor que a contagem de obejtos. Percorrendo assim todas as posições da lista
                           for ($i = 0; $i < $count; $i++)
                           {
                  //As variáveis a seguir recebem os dados oriundos do objeto
                            $cod_pes = $lista[$i]->getCod_pes();
                            $nome_pes = $lista[$i]->getNome_pes();
                            $cpf_pes = $lista[$i]->getCpf_pes();
                  //O valor do cpf é gravado na base de dados sem os pontos. Portanto nesta área ele recebe os pontos e traço para a melhor visualização
                            $a = substr($cpf_pes, 0, 3);
                            $b = substr($cpf_pes, 3, 3);
                            $c = substr($cpf_pes, 6, 3);
                            $d = substr($cpf_pes, 9, 2);
                            $cpf_pes = $a.".".$b.'.'.$c.'-'.$d;
                  //A data é gravada na base com o formato Americano e nesta área é feita a conversão para melhor visualização
                            $data_pes = $lista[$i]->getData_pes();
                            list($ano,$mes,$dia) = explode("-", $data_pes);
                            $data_pes = $dia."/".$mes."/".$ano;
                  //O peso é gravado na base sem ponto ou virgulas. Portanto nesta área é feito a ajuste para melhor visualização
                            $peso_pes = $lista[$i]->getPeso_pes();
                            $peso_pes = $peso_pes / 1000;
                            $peso_pes = number_format($peso_pes, 3, ',', '.').' Kg';
                  //A variavel recebe os dados oriundos do objeto
                            $uf_pes = $lista[$i]->getUf_pes();
                            //Nesta área é gerada a linha que irá apresentar os dados deste objeto(Pessoa).
                  //Note que a celula que abriga o nome do estado tem um id com valor igual ao códgo da Pessoa.
                  //Este código é utilizado para encontrar qual é o estado da Pessoa cadastrada 
                  //Os links para Editar e Excluir tambem são inseridos nesta área
                  echo"
                           <tr>
                            <td>$cod_pes</td>
                            <td>$nome_pes</td>
                            <td>$cpf_pes</td>
                            <td>$data_pes</td>
                            <td>$peso_pes</td>
                            <td id='$cod_pes'></td>
                            <td><a href='v_cadastro_edita.php?cod_pes=$cod_pes'><img src='img/editar.png' height='32' width='32'></a></td>
                            <td><a href='#' data-href='v_cadastro_confirma_exclui.php?cod_pes=$cod_pes' data-toggle='modal' data-target='#confirm-delete'><img src='img/excluir.png' height='32' width='32'></a></td>
                           </tr>
                           ";
                           ?>
               <!--Nesta área é feita a consulta ao Webservice do geonames para que seja utilizado os dados de Estado-->
               <script type="text/javascript" >
                  $.ajax({
                  	url:"http://www.geonames.org/childrenJSON?geonameId=3469034",
                  	dataType:"json",
                  	type:"get",
                  	cache:false,
                  	success: function(data){
                  		//Este laço percorre por toda a extensão do objeto json obtido no webservice
                  $(data.geonames).each(function(index,value){
                  			//Nesta área é testado se (adminCode1) que é a identificação de cada estado no WS for igual os estado cadastrado
                            //ele coloca o valor referênte ao nome do Estado (toponymName) no elemento html que possui o id igual ao código da pessoa
                  if(value.adminCode1==<?=$uf_pes?>){
                  			$(<?php $id = "'#".$cod_pes."'";echo $id;?>).html(value.toponymName);
                  			}
                  		});
                  	}
                  });
               </script>
               <?php
                  }
                  ?>
            </table>
            <!--Nesta área é criada a tabela que será apresentada nos dispositivos de tela pequena-->
            <table style='width:100%;' border="1" bordercolor="#D3D3D3"  class="table visible-xs">
               <tr>
                  <td style='width:70%'>Nome</td>
                  <td style='width:30%' align='center' colspan='2'>Opções</td>
               </tr>
               <?php
                  //Este laço percorre enquanto a variável $i for menor que a contagem (feita mais acima) de obejtos. Percorrendo assim todas as posições da lista	
                               for ($x = 0; $x < $count; $x++)
                               {
                    //As variáveis a seguir recebem os dados oriundos do objeto
                                $cod_pes = $lista[$x]->getCod_pes();
                                $nome_pes = $lista[$x]->getNome_pes();
                                $cpf_pes = $lista[$x]->getCpf_pes();
                                $data_pes = $lista[$x]->getData_pes();
                                $peso_pes = $lista[$x]->getPeso_pes();
                                $uf_pes = $lista[$x]->getUf_pes();			  
                               //Nesta área é gerada a linha que irá apresentar os dados deste objeto(Pessoa).
                   echo "
                               <tr>
                                <td>$nome_pes</td>
                                <td><a href='v_cadastro_edita.php?cod_pes=$cod_pes'><img src='img/editar.png' height='32' width='32'></a></td>
                                <td><a href='#' data-href='v_cadastro_confirma_exclui.php?cod_pes=$cod_pes' data-toggle='modal' data-target='#confirm-delete'><img src='img/excluir.png' height='32' width='32'></a></td>
                               </tr>";
                               }
                               ?>
            </table>
            <!--Nesta área é criada a janela Modal que pergunta se realmente deseja excluir o cadastro de uma Pessoa
               Esta Modal é chamada pelo link que envia para a página de exclusão-->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Deseja excluir esta Pesssoa?</h4>
                     </div>
                     <div class="modal-footer">
                        <a class="btn btn-danger btn-ok">Delete</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     </div>
                  </div>
               </div>
            </div>
            <!--Script que chama a Modal e acrescenta o caminho do link a ela-->
            <script>
               $('#confirm-delete').on('show.bs.modal', function(e) {
                   $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                   
                   $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
               });
            </script>
         </div>
      </div>
   </body>
</html>
