<?php
  ob_start();
  
  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {
  
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_data.php"); 
    include("../../include/sistema_protecao.php"); 
    include("../_include/topo.php"); 
    include("../_include/funcao_selecao.php"); 
    include("../_include/funcao_confirma.php"); 
    include("../_include/funcao_importa_sfr.php"); 
  
    $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
  
    
    include("../_include/filtra_usuario.php");
  
  

    if(ISSET($_REQUEST['nome_campo_busca']))
    {
      $nome_campo_busca = anti_injection($_REQUEST['nome_campo_busca']);
    }
    else
    {
      $nome_campo_busca = "";
    }


    if((ISSET($_REQUEST['nome_campo_ordem']))&&($_REQUEST['nome_campo_ordem']!=""))
    {
      $nome_campo_ordem = anti_injection($_REQUEST['nome_campo_ordem']);
    }
    else
    {
      $nome_campo_ordem = $campo_ordenacao_padrao;
    }



    if(ISSET($_REQUEST['tipo_ordem']))
    {
      $tipo_ordem = anti_injection($_REQUEST['tipo_ordem']);
    }
    else
    { 
      $tipo_ordem = $ordem_padrao;
    }


    if(ISSET($_REQUEST['expressao_busca']))
    {
    $expressao_busca = anti_injection($_REQUEST['expressao_busca']);
    $expressao_busca = str_replace("|||"," ",$expressao_busca);

    }
    else
    {
      $expressao_busca = "";
    }


  
  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  } 
  
  ob_end_flush();

?>



<style>

.busca
{
  float:left; 
  width:400px; 

  background-color:#f6f6f6;
  border:1px solid #f6f6f6;
  position:absolute;
  left:0px;
  top:0px;
  z-index:1;
}

.div1
{
  font-size:12px;
  margin-left:0px;
  margin-bottom:2px;
  padding:4px;
}

.div1 a
{
  text-decoration: none;
  font-weight: bold;
  color:#333333;
  font-family:verdana;
  font-size:12px;
}

.div1 a:hover
{
  color:#666666;
}

.div_fechar
{
  width:392px;

  margin-top:0px;
  margin-bottom:0px;
  text-align:right;
  background-color:#ff9900;
  padding:4px;
}

.div_fechar a
{
  color:#000000;
  font-family:verdana;
}

.div_resultados
{
 width:400px;

 margin-left:0px;
 margin-bottom:0px; 
 overflow-y:auto;
 background-color: #f6f6f6;
}
 

</style>




<?

if($_REQUEST["campo_busca"]!="" && strlen($_REQUEST["campo_busca"]) >= $_REQUEST["quantidade_caracter"]){

echo '<div id="busca_'.$_REQUEST["nome_campo_codigo_primario"].'" class="busca">';

echo '<div class=div_fechar>';
echo '<b><a href="javascript:campo_none(\''.$_REQUEST["nome_campo_codigo_primario"].'\');"><img alt="Fechar" title="Fechar" src=../_imagens/excluir.png border=0></a>';
echo '</div>';

echo '<div class="div_resultados">';

      

     

      $campo_busca = $_REQUEST["campo_busca"];
      $nome_campo_codigo_primario = $_REQUEST["nome_campo_codigo_primario"];
      $descricao_campo = $_REQUEST["descricao_campo"];
      $nome_tabela = $_REQUEST["nome_tabela"];
      $nome_campo_codigo = $_REQUEST["nome_campo_codigo"];
      $nome_campo_descricao = $_REQUEST["nome_campo_descricao"];
      $sistema_exclusao = $_REQUEST["sistema_exclusao"];
      $cont = $_REQUEST["cont"];
      $quantidade_caracter = $_REQUEST["quantidade_caracter"];



        $sql = " SELECT ";


    //  Caso exista o sistema de exclusão por ativação, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        
        // a variavel conta_ativos foi criada para diferenciar o campo ativo quando
        // for o casa de existir mais de uma tabela no sql com o campo ativo
        // é necessário sempre colocar a tabela que vai servir como base para
        // definir qual ativo será utilizado na hora de mostrar a informação de Registro Excluído
        $conta_ativos = 0;

        foreach($tabelas AS $nome_da_tabela)
        {
          $conta_ativos++;
          $sql.= " " . trim($nome_da_tabela) . ".ativo AS ativo_" . $conta_ativos . ", ";
        }

      }
       else
      {
        $sql.= " ativo as ativo_1, ";
      }
    }







    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;




    // caso exista sistema de exclusão no módulo da chave estrangeira,
    // o select só irá mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção terá a expressão (REGISTRO EXCLUÍDO) ao lado do nome

    if($sistema_exclusao==1)
    {

      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND ( " ;
        $sql.= " ( ";

        $sql2="";
        foreach($tabelas AS $nome_da_tabela)
        {
          if($sql2!="")
          {
            $sql2.= " AND ";
          }
          $sql2.= trim($nome_da_tabela) . ".ativo=1 ";
        }
        $sql.= $sql2 ;
        $sql.= " )" ;

      }
       else
      {
        $sql.= " WHERE (ativo=1) ";
      }

      //$sql.= " OR (" . $nome_campo_codigo . "=" . $valor_atual . ")";

      
      if(substr_count($nome_tabela, 'WHERE'))
      {
        $sql.=" ) ";
      }

    }

$campos_para_mostrar = explode(",",$nome_campo_descricao);

  
if(preg_match("/codigo_/",$campos_para_mostrar[0])){

  if(preg_match("/WHERE/", $sql)) {
    $sql .= " AND ".$campos_para_mostrar[1]." LIKE '%".$campo_busca."%' ";
  }else{
    $sql .= " WHERE ".$campos_para_mostrar[1]." LIKE '%".$campo_busca."%' ";
  }

}else{

 if(preg_match("/WHERE/", $sql)) {
    $sql .= " AND ".$campos_para_mostrar[0]." LIKE '%".$campo_busca."%' ";
  }else{
    $sql .= " WHERE ".$campos_para_mostrar[0]." LIKE '%".$campo_busca."%' ";
  }

}

    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $campos_para_mostrar[0];


//echo $sql;

    $rs_itens = mysql_query($sql, $conexao);


    $rows_itens = mysql_num_rows($rs_itens);

    if($rows_itens<=0)
    {
      echo  "<div class='div1'>nenhum registro encontrado</div>";
    }
    else
    {


            
            $cor_linha = 0;
          
            while ($linha_itens = mysql_fetch_array($rs_itens))
            {  

              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {

                // no caso do nome do campo para mostrar for algo como nome_da_tabela.nome_do_campo
                if(strpos($nome_do_campo_para_mostrar, "."))
                {
                  $ncmp = explode(".",$nome_do_campo_para_mostrar);
                  $ncmp = $ncmp[1];
                  $nome_do_campo_para_mostrar = $ncmp;
                }

                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }



              //  Caso exista o sistema de exclusão por ativação, mostramos a expressão "REGISTRO EXCLUÍDO ao lado da descrição"

              if($sistema_exclusao==1)
              {

                if($linha_itens['ativo_1']==0)
                {
                  $valores_para_mostrar.= " (REGISTRO EXCLUÍDO)";
                }
              }


              //echo $linha_itens[$nome_campo_codigo]."@";
         
              //echo "::".$valores_para_mostrar."<br>";
              if($cor_linha % 2){
                  $style_cor = "#e6e6e6;";
              }else{
                   $style_cor = "#f6f6f6;";
              }

              echo  "<div class='div1' style='background-color:".$style_cor."'><a href='javascript:campo(\"".$linha_itens[$nome_campo_codigo]."\",\"".$nome_campo_codigo_primario."\",\"".$valores_para_mostrar."\");' >".$valores_para_mostrar."</a></div>";


            $cor_linha++;}  


            

    //  echo  "<a class='caminho' href='javascript:campo(\"".$fetch_auto2[$_REQUEST["campo_preencher"]]."\",\"".$fetch_auto2[$campo_busca2]."\",\"".$_REQUEST["campo_preencher"]."\",\"".$_REQUEST["descricao"]."\");'   >&nbsp;&nbsp;<b>".$fetch_auto2[$campo_busca2]."</b>&nbsp;&nbsp;</a><br>";



          }
    
 

 echo '</div>';
echo '</div>';

}
?>



