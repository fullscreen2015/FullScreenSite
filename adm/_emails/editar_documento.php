<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {


    include("../_include/topo.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../_include/funcao_confirma.php"); 
    include("configuracoes.php"); 

    session_register("session_codigo_registro");   
    $_SESSION['session_codigo_registro'] = $_REQUEST[$chave_primaria];

    $rs_dados = mysql_query("SELECT * FROM " . $tabela . " where " . $chave_primaria . "=" . $_REQUEST[$chave_primaria], $conexao);
    $linha = mysql_fetch_array($rs_dados);

    barra("Menu Principal","../index.php",$sistema_plural,"index.php","Editar " . $sistema_singular,"editar_dados.php?pagina=" . $_REQUEST['pagina'] . "&" . $chave_primaria . "=" . $_REQUEST[$chave_primaria],"Editando Documento","");  ?>


 
  <br>



    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Incluindo Documento Neste Registro</b></font>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>


    <form method=post enctype="multipart/form-data" action="upload_documento.php">
      <table width="100%" cellspacing="0" cellpadding="5" border="0" bgcolor="aaaaaa">
        <tr valign="top">

            <td width="40%" bgcolor="dddddd" align="center">
              <br>
              <font class=preto_8>
                <b>Indique aqui o arquivo (documento) a ser enviado ...</b><br><br>
                O arquivo deve seguir as seguintes especificações:<br><br>
                <b>Tamanho Máximo:</b> <? echo $tamanho_maximo_arquivo; ?> bytes <br>

                <br>

              <input class=input type="file" name="doc_upload" size="18"></font></td>





        </tr>
        <tr valign="top">
          <td colspan="2" bgcolor="dddddd" align="center">
            <input class=submit type="submit" value="   >>  Enviar Arquivos <<  "><br>&nbsp;</td>
        </tr>

      </table>
    </form>





    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Excluindo Arquivo Deste Registro (Clique no arquivo para excluir)</b></font>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>
    <br>




<?

    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_documentos);  
        

    $nome_arquivo = "../../" . $pasta_documentos . "/" . $codigo_registro . "_" . $linha[$nome_campo_documentos] ;

        if (file_exists($nome_arquivo))
        {  ?>

          &nbsp;<a  class=caminho onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar este arquivo?\n\n****************************')" alt="clique para excluir" href="excluir_documento.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>&nome_arquivo=<? echo $linha[$nome_campo_documentos]; ?>&pagina=<? echo $_REQUEST['pagina']; ?>">
            - <? echo $linha[$nome_campo_documentos]; ?></a>

<?      }  ?>




      </tr>
    </table>


  </body>
</html>




<?  }
    else
    {
      header("Location: php_login.php");  
    }

?>