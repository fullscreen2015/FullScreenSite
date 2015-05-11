<?
  ob_start();
  session_start(); 
  
  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {











  include("../_include/usuarios_acesso.php");

  $codigo_modulo = $_REQUEST['codigo_modulo'];
  $permissao = 3;

  if(verifica_usuario2($codigo_modulo, $permissao))
  {


    include("../_include/topo.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../_include/funcao_form.php"); 
    include("../_include/funcao_form_relacionado.php"); 
    include("../../include/sistema_zeros.php");

    include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 



    barra("Menu Principal","../index.php","Painel","../_modulos/painel.php?codigo_modulo=".zerosaesquerda($codigo_modulo,6).".php","Envio de Fotos em Lote (Formulário)","","","");  


    echo '<form action="formulario.php"  enctype="multipart/form-data" name="frmCadastro" id="frmCadastro" method="post" onsubmit="return validar(';
    echo "'frmCadastro');";
    echo '">';

    echo "<input type=hidden name=s value='".$codigo_modulo."'>";
    echo "
    <input type=hidden name='codigo_modulo' value='".$codigo_modulo."'>";

    echo '<table cellspacing="0" cellpadding="0" width="780">';
    echo '<tr>';
    echo '<td width="730" bgcolor="#dddddd" align="center">';


    // CAMPOS NORMAIS ##################################################


    for($cont=1;$cont<=$numero_campos;$cont++)
    {
      $cont_ = (10 + $cont);
      $cont1 = $cont_ . "1";
      $cont2 = $cont_ . "2";
      $cont3 = $cont_ . "3";
      $cont4 = $cont_ . "4";
      $cont5 = $cont_ . "5";
      $cont6 = $cont_ . "6";
      $cont7 = $cont_ . "7";
      $cont8 = $cont_ . "8";
      $cont9 = $cont_ . "9";
      $cont10 = $cont_ . "10";
      $cont11 = $cont_ . "11";
      $cont12 = $cont_ . "12";
      $cont13 = $cont_ . "13";
      $cont14 = $cont_ . "14";
      $cont15 = $cont_ . "15";


       $help14 = "";
      if(ISSET($campos[$cont14]))
      {
        $help14 = $campos[$cont14];
      }

      if($campos[$cont3]=="varchar")
      {
        echo "<br>";
        input2($campos[$cont2],$campos[$cont1],$campos[$cont4],$tabela,$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="senha")
      {
        echo "<br>";
        input_senha($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
      }
 
      if($campos[$cont3]=="inteiro")        
      {
        echo "<br>";
        input_inteiro($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="moeda")        
      {
        echo "<br>";
        input_moeda($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="real")        
      {
        echo "<br>";
        input_real($campos[$cont2],$campos[$cont1],$campos[$cont4],$campos[$cont10],$help14);  
      }

      if($campos[$cont3]=="logico")
      {
        echo "<br>";
        check($campos[$cont2],$campos[$cont1],$help14);  
      }

      if(($campos[$cont3]=="blob")||($campos[$cont3]=="blob_html"))
      {
        echo "<br><br>";
        textarea($campos[$cont2],$campos[$cont1],$campos[$cont4],$help14);  
      }

      if($campos[$cont3]=="hora_now")      
      {
        echo "<br>";
        hora_now($campos[$cont2],$campos[$cont1],$help14);  
      }

      if($campos[$cont3]=="hora")      
      {
        echo "<br>";
        hora($campos[$cont2],$campos[$cont1],$help14);  
      }

      if(($campos[$cont3]=="data_date")||($campos[$cont3]=="data_int"))
      {
        echo "<br>";
        data($campos[$cont2],$campos[$cont1],$help14);  
      }

      if(($campos[$cont3]=="data_date_now")||($campos[$cont3]=="data_int_now"))
      {
        echo "<br>";
        data_now($campos[$cont2],$campos[$cont1],$help14);  
      }
	
      if($campos[$cont3]=="data_hora")      
      {
        data_hora_inserir($campos[$cont2],$campos[$cont1],$help14);  
      }
	

	if($campos[$cont3]=="chave_estrangeira")      
      {

        $sistema_exclusao = 0;
        if($campos[$cont4]=="0")
        {
          $sistema_exclusao = 1;
        }

        echo "<br><br>";
        select2($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$campos[$cont10],$help14);
      }



	if($campos[$cont3]=="chave_estrangeira_recursiva")      
      {

        $sistema_exclusao = 0;
        if($campos[$cont4]=="0")
        {
          $sistema_exclusao = 1;
        }

        echo "<br><br>";
        select_recursivo($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$campos[$cont1],$sistema_exclusao,$campos[$cont10],$help14);
      }




      if($campos[$cont3]=="chave_associativa")
      {
        echo "<br><br>";
        select_multi2($campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7],$sistema_exclusao,$help14);
      }

    }


    // FIM CAMPOS NORMAIS ##################################################













    echo '<br />';
    echo '<br />';
    echo '<br />';
    echo '<input class="submit" type="submit" value="Enviar Dados">';
    echo '<br>&nbsp;';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
    echo '</table>';

    echo '</form>';


    echo '</body>';
    echo '</html>';


  }
  else
  {
    header("Location: " . $_SERVER['HTTP_REFERER']);  
  }








  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }
  ob_end_flush();
?>