<?php

  ob_start();
  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {



  include("../_include/topo_impressao.php"); 
  include("../../include/sistema_conexao.php"); 
  include("../../include/sistema_data.php"); 

  include("../../include/sistema_protecao.php"); 
  include("../../include/sistema_zeros.php"); 
	
  $codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
  include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
  

  $sql = urldecode($_REQUEST['sql']);
  $sql = str_replace("\'", "'", $sql);

  $sql = strtolower($sql);
  $sql = str_replace("update", "erro", $sql);
  $sql = str_replace("alter table", "erro", $sql);
  $sql = str_replace("insert", "erro", $sql);
  $sql = str_replace("delete", "erro", $sql);
  $sql = str_replace("drop table", "erro", $sql);
  $sql = str_replace("show tables", "erro", $sql);



  $rs_dados = mysql_query($sql, $conexao);



  function cor_fundo($i)
  {
    if ($i % 2) {
        return "#eeeeee";
    } else {
        return "#ffffff";
    }
  }

  function cor_letra($i)
  {
    if ($i % 2) {
        return "#000000";
    } else {
        return "#999999";
    }
  }


?>

      <br><br>

      <table cellspacing="0" cellpadding="0" width="90%" align=center>
        <tr>
          <td class=borda_preta>




      <table cellspacing="1" cellpadding="2" width="100%" align=center>
        <tr>
<?php
          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $cont_ = (10 + $cont);
            $cont2 = $cont_ . "2";
            $cont9 = $cont_ . "9";
            if($campos[$cont9]==1) 
            {
              echo "<td align=center bgcolor=dddddd><b><font class=caminho>" . $campos[$cont2] . "</font></b></td>";
            }

          }  ?>

        </tr>



<?php      $i = 0 ;
        while ($linha = mysql_fetch_array($rs_dados))
        { 
          $i++;
?>

          <tr>
              

<?php
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

                  
                  if($campos[$cont9]==1) 
                  {

                    echo "<td bgcolor=". cor_fundo($i)."><font class=caminho><font color=".cor_letra($i).">";
                    switch ($campos[$cont3]) 
                    {
                      case "data_int_now":
                        echo fwdatai($linha[$campos[$cont1]]); 
                        break;
                      case "data_int":
                        echo fwdatai($linha[$campos[$cont1]]); 
                        break;
                      case "data_date":
                        echo fwdata($linha[$campos[$cont1]]); 
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

                        $teste = explode(",", $campos[$cont7]);//NOVO 

                       
                        $sql_ce.=  $campos[$cont5] . "=" . $linha[$campos[$cont1]];
                        $rs_ce = mysql_query($sql_ce, $conexao);
                        $linha_ce = mysql_fetch_array($rs_ce);

                        //NOVO
                        for($p=0; $p<count($teste); $p++){
                          
                          if($p!=0){
                          echo " | ";
                          }

                          echo $linha_ce[$teste[$p]];
                          

                        }
                        //NOVO

                       //echo $linha_ce[$campos[$cont7]]; // ANTIGO
                       
                                            
                        break;
                      default:
                        echo $linha[$campos[$cont1]]; 
                    }

                    echo "</font></td>";

                 }

                }  ?>

          </tr>
<?php      }  ?>

      </table>

</td>
</tr>
</table>


  </body>
</html>





<?php

  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");
  }
  
  ob_end_flush();

?>

<script>

window.print();

</script>