<?php

  include("../_include/topo.php"); 
	session_start();
	session_destroy();  


  barra("Sistema de Administração - Recuperação senha","../index.php","","","","","","");  

  $login = "";

  if(isset($_COOKIE["fw_login"]))
  {
    $login = $_COOKIE["fw_login"];
  }

?>

    <form method="post" action="enviar_senha.php">

      <br><br>
      <table border="0" cellspacing="1" cellpadding="4" bgcolor="#000000" width="300" align=center>
        <tr>
          <td width="300" bgcolor="#ffffff" align=center>


      <table border="0" cellspacing="0" cellpadding="4" bgcolor="#dddddd" width="100%" align=center>

        <tr valign="middle">
          <td align="center" colspan="2">
            <font face="arial" size="2" color="#000000"><b>Digite seu email: </b></font>
          </td>
          <td align="left">
            <input type="text" name="email" value="<? echo $login; ?>" size="18">
          </td>
          <td align="left">
         	<input type="submit" value="ok">
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

