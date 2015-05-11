<?
  ob_start();
  session_start();

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../../include/sistema_conexao.php");

    include("../../include/sistema_zeros.php");
    include("../../include/sistema_protecao.php");
	
	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
	include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 


    include("../_include/topo.php");
	
    barra("Menu Principal","../index.php","Editar " . $sistema_singular , "editar_dados.php?codigo_modulo=" . $codigo_modulo . "&" . $chave_primaria . "=" . $_SESSION['session_codigo_registro'] , "Enviando Arquivo","javascript:history.back();","","");  ?>



  <br>

      <table cellspacing="0" cellpadding="0" width="780">
          <tr>
            <td width="430" bgcolor="cccccc">
              <font class="caminho">
              <b>
                Resultado do envio:<br><br>

<?
                if(ISSET($_REQUEST['acertos']))
                {
                  echo "Acertos:<br>" . $_REQUEST['acertos'] . "<br><br>";
                }

                if(ISSET($_REQUEST['erros']))
                {
                  echo "Erros:<br>" . $_REQUEST['erros'] . "<br><br>";
                }
?>

              </b></td>
          </tr>
      </table>


  </body>
</html>





<?  }
    else
    {
      header("Location: ../_sistema/php_manutencao_login.php");
    }
  
  ob_end_flush();

?>