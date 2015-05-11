<?
  ob_start();
  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {
    header("Location: php_manutencao.php");  
  }

  else
  {

    include("../_include/topo.php"); 


    $login = "";

    if(isset($_COOKIE["fw_login"]))
    {
      $login = $_COOKIE["fw_login"];
    }


    barra("Sistema de Administração - Login","","","","","","","");
    ob_end_flush();
?>


    <form method="post" action="php_manutencao_verifica_senha.php">

      <br><br>
      <center><img src=../_imagens/logo-empresa-grande.png></center>
      <br><br>

      <table border="0" cellspacing="1" cellpadding="4" bgcolor="#000000" width="300" align=center>
        <tr>
          <td width="300" bgcolor="#ffffff" align=center>


      <table border="0" cellspacing="0" cellpadding="4" bgcolor="#dddddd" width="100%" align=center>

        <tr valign="middle">
          <td align="right" width=80>
            <font face="arial" size="2" color="#333333"><b>Login: </b></font></td>
          <td >
            <input type="text" name="login" size="18" value="<? echo $login; ?>">
          </td>
          <td width="50">&nbsp;</td>
        </tr>

        <tr>
          <td align="right">
            <font face="arial" size="2" color="#333333"><b>Senha: </b></font></td>
          <td>
            <input type="password" name="senha"  size="18"> 
          </td>
          <td>
            <input type="submit" value="ok">
          </td>
        </tr>
        
		<tr>
          <td align="center" colspan="3">
           		<a href="../_include/esqueci_senha.php" class="links_7">
                	Esqueci minha senha
                </a>
          </td>
        </tr>
        
      </table>
</td></tr></table>

    </form>

      <br><br>
      <table border="0" cellspacing="0" cellpadding="0" align=center>
        <tr>
          <td align=center>
            <a href="php_suporte.php"><img src=../_imagens/friweb.png border=0></a></td></tr></table>



  </body>
</html>







<?  }  ?>