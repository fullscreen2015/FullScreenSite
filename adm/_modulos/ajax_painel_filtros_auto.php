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
background-color: #FFFFFF;
position:absolute;
left:0px;
top:0px;
z-index:1;
}

</style>
<?


echo '<div id="busca" class="busca" style="float:left; width:362px; height:180px; overflow-y:auto;">';


//AQUI PARA CIMA

  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont1 = $cont_ . "1";
    $cont2 = $cont_ . "2";
    $cont5 = $cont_ . "5";
  
    if(($campos[$cont5]=="")||($campos[$cont5]=="unico")||($campos[$cont5]=="obrigatorio"))
    {  
     
//echo 'Campo = ' . $campos[$cont1] .'Por ' . $campos[$cont2];

    		//MELHORAR E ENXUGAR SQL
			$sql_auto = "SELECT * FROM ".$tabela." ";
			$sql_auto .= " WHERE ".$campos[$cont1]." like '".trim($_REQUEST["auto_busca"])."%' group by ".$campos[$cont1]."  order by ".$campos[$cont1]." ASC";
			$query_auto = mysql_query($sql_auto, $conexao);
			while($fetch_auto = mysql_fetch_array($query_auto)){


			echo  "<a  href='javascript:campo(\"".$fetch_auto[$campos[$cont1]]."\",\"".$campos[$cont1]."\");' >Por ".$campos[$cont2]."<b>&nbsp;&nbsp;".$fetch_auto[$campos[$cont1]]."</b></a><br>";

			}

//echo $sql_auto;
     
    }  
  }

 
echo '</div>';


?>



