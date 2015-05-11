<?php
ob_start();
session_start();


if(ISSET($_SESSION['fw_codigo_usuario']))
{

  include("../../include/sistema_conexao.php"); 
  include("../_include/usuarios_acesso.php");
  include("../../include/sistema_protecao.php"); 
  include("../../include/sistema_zeros.php"); 
  include("../../include/sistema_data.php"); 

  
    
  
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
  $codigo_modulo6 = zerosaesquerda($codigo_modulo,6);
  $permissao = 1;

  if(verifica_usuario2($codigo_modulo, $permissao))
  {
  

  function retira_quebra_linha($variavel){
    
    $variavel = trim($variavel);
    $variavel = str_replace(";", ".", $variavel);
    $variavel = str_replace("\r", "", $variavel);
    $variavel = str_replace("\n", "", $variavel);
    $variavel = str_replace("\r\n", "", $variavel);
    $variavel = str_replace("\t", "", $variavel);
    //$variavel = str_replace(" ", "", $variavel);
    $variavel = preg_replace("/(<br.*?>)/i","", $variavel);

return $variavel;
}

$campos_selecionados = $_REQUEST["campos_selecionados"]; //ESTA VARIAVEL RECEBE UM ARRAY COM A ORDEM DOS CAMPOS SELECIONADOS

  $sql = urldecode($_REQUEST['sql']);
  $sql = str_replace("\'", "'", $sql);
  $sql = strtolower($sql);
  $sql = str_replace("update", "erro", $sql);
  $sql = str_replace("alter table", "erro", $sql);
  $sql = str_replace("insert", "erro", $sql);
  $sql = str_replace("delete", "erro", $sql);
  $sql = str_replace("drop table", "erro", $sql);
  $sql = str_replace("show tables", "erro", $sql);



$data = "";

  $rs_dados = mysql_query($sql, $conexao);

  


          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $cont_ = (10 + $cont);
            $cont2 = $cont_ . "2";
            $cont9 = $cont_ . "9";

            //VERIFICA SE $cont1 ESTÁ CONTIDO NA ARRAY RECEBIDA COM OS CAMPOS SELECIONADO

          if(in_array($cont, $campos_selecionados))
            {
              //echo $campos[$cont2].";";
              $data .= retira_quebra_linha($campos[$cont2]).";";
            }

              
          }  



          $data .= "\r\n"; 



                $i = 0 ;

                
                

        while ($linha = mysql_fetch_array($rs_dados))
        { 
          $i++;

                for($cont=1;$cont<=$numero_campos;$cont++)
                {
                  $cont_ = (10 + $cont);
                  $cont1 = $cont_ . "1";
                  $cont2 = $cont_ . "2";
                  $cont3 = $cont_ . "3";
                  $cont5 = $cont_ . "5";
                  $cont6 = $cont_ . "6";
                  $cont7 = $cont_ . "7";
                  $cont8 = $cont_ . "8";
                  $cont9 = $cont_ . "9";
                  if(in_array($cont, $campos_selecionados))
                  {
                    
                   

                    switch ($campos[$cont3]) 
                    {
                      case "data_int_now":
                        //echo fwdatai($linha[$campos[$cont1]]).";"; 
                        $data .= retira_quebra_linha(fwdatai($linha[$campos[$cont1]])).";";
                        break;
                      case "data_int":
                       // echo fwdatai($linha[$campos[$cont1]]).";"; 
                        $data .= retira_quebra_linha(fwdatai($linha[$campos[$cont1]])).";";
                        break;
                      case "data_date":
                       // echo fwdata($linha[$campos[$cont1]]).";"; 
                        $data .= retira_quebra_linha(fwdata($linha[$campos[$cont1]])).";";
                        break;
                      case "chave_estrangeira":

                        $sql_ce = "SELECT "  . $campos[$cont7] . " FROM " . $campos[$cont6];

                        if(substr_count($sql_ce, 'WHERE'))
                        {
                          $sql_ce.= " AND ";
                        }
                        else
                        {
                          $sql_ce.= " WHERE ";
                        }

                        $sql_ce.=  $campos[$cont5] . "=" . $linha[$campos[$cont1]];
                        $rs_ce = mysql_query($sql_ce, $conexao);
                        $linha_ce = mysql_fetch_array($rs_ce);



                          $campos_para_mostrar = explode(",",$campos[$cont7]);

              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {
                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }
          
                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_ce["$nome_do_campo_para_mostrar"];
              }


                        //echo $valores_para_mostrar;
                        $data .= retira_quebra_linha($valores_para_mostrar).";";//ARRAY LINHA RESULTADO
                       // echo $linha_ce[$campos[$cont7]]."|"; 
                        break;
                      default:
                       // echo $linha[$campos[$cont1]].";"; 
                        $data .= retira_quebra_linha($linha[$campos[$cont1]]).";";//ARRAY LINHA RESULTADO
                    }
                    
                
                 }

                }  

$data .= "\r\n"; 
                   

    }  

//===================================================================
//$dadosCampo[] = $dados;

// $table = $_REQUEST["table"]; // tabela que vai ser feita a sql
// $file = $_REQUEST["table"]; //nome do arquivo

$table = $tabela;
$file = $table;

$filename = $file."_".date("Y_m_d",time());
 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=Exibicao_".$filename.".csv");
 
print $data;
 
exit;



}
  
  else
  {
    if(ISSET($_SERVER['HTTP_REFERER']))
    {
      $url = $_SERVER['HTTP_REFERER'];
    }
    else
    {
      $url = "../";
    }
    header("Location: " . $url);  

  }

}
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");
  }
  
  ob_end_flush();


?>