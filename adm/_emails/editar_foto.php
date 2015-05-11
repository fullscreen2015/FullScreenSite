<?

  session_start(); 

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("../_include/topo.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../_include/funcao_confirma.php"); 
    include("configuracoes.php"); 



    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = $_REQUEST['pagina'];
    }
    else
    {
      $pagina = "1";
    }


    session_register("session_codigo_registro");   
    $_SESSION['session_codigo_registro'] = $_REQUEST[$chave_primaria];


    barra("Menu Principal","../index.php",$sistema_plural,"index.php","Editar " . $sistema_singular,"editar_dados.php?pagina=" . $pagina . "&" . $chave_primaria . "=" . $_REQUEST[$chave_primaria],"Editando Fotos","");  
 
    echo '<br>';

    if(ISSET($_REQUEST['red']))
    {
      $redimensionamento_automatico = $_REQUEST['red'];
    }

    session_register("red");   
    $_SESSION['red'] = $redimensionamento_automatico;

    echo '<center>';

    if($redimensionamento_automatico==0)
    {
      echo '<a class=caminho href="editar_foto.php?pagina=' . $_REQUEST['pagina'] . '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria] . '&red=1">UTILIZAR SISTEMA DE FOTOS <b>COM</b> REDIMENSIONAMENTO automático</a>';
    }

    if($redimensionamento_automatico==1)
    {
      echo '<a class=caminho href="editar_foto.php?pagina=' . $_REQUEST['pagina'] . '&' . $chave_primaria . '=' . $_REQUEST[$chave_primaria] . '&red=0">UTILIZAR SISTEMA DE FOTOS <b>SEM</b> REDIMENSIONAMENTO automático</a>';
    }
    echo '</center>';
    echo '<br><br>';
?>

    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Incluindo Fotos Neste Registro</b></font>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>


    <form method=post enctype="multipart/form-data" action="upload.php">
      <table width="100%" cellspacing="0" cellpadding="15" border="0" bgcolor="aaaaaa">
        <tr valign="top">





<?

        if($redimensionamento_automatico==1)
        {  ?>


          <td bgcolor="dddddd" align="center">
            <br>
            <font class=preto_8>
              
              <b>Indique aqui o arquivo da foto que deseja enviar ...</b><br><br>
              A foto ampliada deve seguir as seguintes especifica��es:<br><br>
              <b>Formato:</b> <? echo $tipo_arquivo_ampliado; ?><br>
              <b>Tamanho M�ximo:</b> <? echo $tamanho_maximo_foto; ?> bytes<br>


              <br>

            <input type="hidden" name="MAX_FILE_SIZE" value="<? echo $tamanho_maximo_foto; ?>" />
            <input class=input type="file" name="foto_upload" size="18"></font></td>
<?      } 
        else
        {








           

          if(($tipo_sistema_fotos==6)||($tipo_sistema_fotos==7))
          {  ?>

            <td bgcolor="dddddd" align="center">
              <br>
              <font class=preto_8>
                <b>Indique aqui o arquivo (foto) da foto ampliada ...</b><br><br>
                A foto ampliada deve seguir as seguintes especifica��es:<br><br>
                <b>Formato:</b> <? echo $tipo_arquivo_ampliado; ?><br>
                <b>Tamanho M�ximo:</b> <? echo $tamanho_maximo_amp; ?> bytes <br>

<?              if($largura_maxima_amp!=0)
                {  ?>
                  <b>Largura M�xima:</b> <? echo $largura_maxima_amp; ?> pixels <br>
<?              }  ?>

<?              if($largura_minima_amp!=0)
                {  ?>
                  <b>Largura M�nima:</b> <? echo $largura_minima_amp; ?> pixels <br>
<?              }  ?>

<?              if($altura_maxima_amp!=0)
                {  ?>
                  <b>Altura M�xima:</b> <? echo $altura_maxima_amp; ?> pixels <br>
<?              }  ?>

<?              if($altura_minima_amp!=0)
                {  ?>
                  <b>Altura M�nima:</b> <? echo $altura_minima_amp; ?> pixels <br>
<?              }  ?>

<?              if($altura_amp!=0)
                {  ?>
                  <b>Altura da Amplia��o:</b> <? echo $altura_amp; ?> pixels <br>
<?              }  ?>

<?              if($largura_amp!=0)
                {  ?>
                  <b>Largura da Amplia��o:</b> <? echo $largura_amp; ?> pixels <br>
<?              }  ?>

                <br>

              <input class=input type="file" name="amp_upload" size="18"></font></td>
<?        }  ?>







<?        if(($tipo_sistema_fotos==3)||($tipo_sistema_fotos==5)||($tipo_sistema_fotos==6)||($tipo_sistema_fotos==7))
          {  ?>

            <td bgcolor="dddddd" align="center">
              <br>
              <font class=preto_8>
                <b>Indique aqui o arquivo (foto) da foto grande ...</b><br><br>
                A foto grande deve seguir as seguintes especifica��es:<br><br>
                <b>Formato:</b> <? echo $tipo_arquivo_grande; ?><br>
                <b>Tamanho M�ximo:</b> <? echo $tamanho_maximo_foto; ?> bytes <br>

<?              if($largura_maxima_foto!=0)
                {  ?>
                  <b>Largura M�xima:</b> <? echo $largura_maxima_foto; ?> pixels <br>
<?              }  ?>

<?              if($largura_minima_foto!=0)
                {  ?>
                  <b>Largura M�nima:</b> <? echo $largura_minima_foto; ?> pixels <br>
<?              }  ?>

<?              if($altura_maxima_foto!=0)
                {  ?>
                  <b>Altura M�xima:</b> <? echo $altura_maxima_foto; ?> pixels <br>
<?              }  ?>

<?              if($altura_minima_foto!=0)
                {  ?>
                  <b>Altura M�nima:</b> <? echo $altura_minima_foto; ?> pixels <br>
<?              }  ?>

<?              if($altura_foto!=0)
                {  ?>
                  <b>Altura da Foto:</b> <? echo $altura_foto; ?> pixels <br>
<?              }  ?>

<?              if($largura_foto!=0)
                {  ?>
                  <b>Largura da Foto:</b> <? echo $largura_foto; ?> pixels <br>
<?              }  ?>

                <br>

              <input class=input type="file" name="foto_upload" size="18"></font></td>
<?        }  ?>







            <td bgcolor="dddddd" align="center">
              <br>
              <font class=preto_8>
                <b>Indique aqui o arquivo (foto) da foto pequena ...</b><br><br>
                A foto pequena deve seguir as seguintes especifica��es:<br><br>
                <b>Formato:</b> <? echo $tipo_arquivo_pequeno; ?><br>
                <b>Tamanho M�ximo:</b> <? echo $tamanho_maximo_thumbs; ?> bytes<br>

<?              if($largura_maxima_thumbs!=0)
                {  ?>
                  <b>Largura M�xima:</b> <? echo $largura_maxima_thumbs; ?> pixels <br>
<?              }  ?>

<?              if($largura_minima_thumbs!=0)
                {  ?>
                  <b>Largura M�nima:</b> <? echo $largura_minima_thumbs; ?> pixels <br>
<?              }  ?>

<?              if($altura_maxima_thumbs!=0)
                {  ?>
                  <b>Altura M�xima:</b> <? echo $altura_maxima_thumbs; ?> pixels <br>
<?              }  ?>

<?              if($altura_minima_thumbs!=0)
                {  ?>
                  <b>Altura M�nima:</b> <? echo $altura_minima_thumbs; ?> pixels <br>
<?              }  ?>

<?              if($altura_thumbs!=0)
                {  ?>
                  <b>Altura da Foto:</b> <? echo $altura_thumbs; ?> pixels <br>
<?              }  ?>

<?              if($largura_thumbs!=0)
                {  ?>
                  <b>Largura da Foto:</b> <? echo $largura_thumbs; ?> pixels <br>
<?              }  ?>

              <br>
              <input class=input type="file" name="thumbs_upload" size="18"></font></td>

<?      }  ?>




        </tr>
        <tr valign="top">
          <td colspan="3" bgcolor="dddddd" align="center">
            <input class=submit type="submit" value="   >>  Enviar Arquivos <<  "><br>&nbsp;</td>
        </tr>

      </table>
    </form>





    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Excluindo Fotos Deste Registro (só clique na foto se desejar exclu�-la!)</b></font>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="1" bgcolor="000066"><img src="nada.gif" width="1" height="1"></td></tr></table>
    <br>




<?
    $codigo_registro = $_REQUEST[$chave_primaria];
    $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

    if($tipo_sistema_fotos==1)
    {

      for($i=1;$i<=1000;$i++)
      {

        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos);  

        $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


        if (file_exists($nome_arquivo))
        {  ?>

          <a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>&indice_foto=<? echo $i; ?>&red=<? echo $redimensionamento_automatico; ?>">
            <img border=0 src="<? echo $nome_arquivo; ?>"&nbsp;&nbsp;></a>

<?      }  
      }  
    }  

    if($tipo_sistema_fotos==2)
    {
      for($i=1;$i<=1000;$i++)
      {
        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos);  

        $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/" . $codigo_registro . "/thumbs/" . $m . "." . $tipo_arquivo_pequeno;
        if (file_exists($nome_arquivo))
        {  ?>

          <a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_evento=<? echo $codigo_evento;?>&indice_foto=<? echo $i; ?>&red=<? echo $redimensionamento_automatico; ?>">
            <img border=0 src="<? echo $nome_arquivo; ?>"&nbsp;&nbsp;></a>

<?      }  
      }  
    }  






    if($tipo_sistema_fotos==3)
    {

      $nome_thumbs = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $nome_foto = "../../imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_pequeno;


      if (file_exists($nome_thumbs))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&red=<? echo $redimensionamento_automatico; ?>">
          <img border=0 src="<? echo $nome_thumbs; ?>"></a>

<?   
      }  
      if (file_exists($nome_foto))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&red=<? echo $redimensionamento_automatico; ?>">
          <img border=0 src="<? echo $nome_foto; ?>"></a>

<?   
      }  
    }  









    if($tipo_sistema_fotos==4)
    {

      $nome_thumbs = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_thumbs))
      {  ?>

        <a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&red=<? echo $redimensionamento_automatico; ?>">
          <img border=0 src="<? echo $nome_thumbs; ?>"&nbsp;&nbsp;></a>

<?   
      }  
    }  ?>






<?
    if($tipo_sistema_fotos==5)
    {

      for($i=1;$i<=1000;$i++)
      {

        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos);  


        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

        $nome_arquivo = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


        if (file_exists($nome_arquivo))
        {  ?>

          <a onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&indice_foto=<? echo $i; ?>&red=<? echo $redimensionamento_automatico; ?>">
            <img border=0 src="<? echo $nome_arquivo; ?>"&nbsp;&nbsp;></a>

<?      }  
      }  
    }  














    if($tipo_sistema_fotos==6)
    {

      $nome_thumbs = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $nome_foto = "../../imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $nome_amp = "../../imagens/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "." . $tipo_arquivo_pequeno;


      if (file_exists($nome_thumbs))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&red=<? echo $redimensionamento_automatico; ?>">
          <img border=0 src="<? echo $nome_thumbs; ?>"></a>

<?   
      }  
      if (file_exists($nome_foto))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&red=<? echo $redimensionamento_automatico; ?>">
          <img border=0 src="<? echo $nome_foto; ?>"></a>

<?   
      }  
      if (file_exists($nome_amp))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&red=<? echo $redimensionamento_automatico; ?>">
          <img border=0 src="<? echo $nome_amp; ?>"></a>

<?   
      }  
    }  

?>




<?
    if($tipo_sistema_fotos==7)
    {

      for($i=1000;$i>0;$i--)
      {

        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos);  


        $codigo_registro = zerosaesquerda($codigo_registro,$numero_algarismos_codigo);  

        $nome_thumb = "../../imagens/" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;
        $nome_foto = "../../imagens/" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;
        $nome_amp = "../../imagens/" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;

        if ((file_exists($nome_thumb))||(file_exists($nome_foto))||(file_exists($nome_amp)))
        {  
?>
          <div style="width: 100%; padding: 10px">
          <div style="align: center; width: 100%; background-color: #cccccc; padding: 10px">
          <div class=preto_8 style="align: center; width: 100%; background-color: #eeeeee; padding: 10px">
            <center>
              <b>Foto <? echo $i; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a class=preto_8 onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&indice_foto=<? echo $i; ?>&red=<? echo $redimensionamento_automatico; ?>">[Clique aqui para excluir o thumbs, a foto e a amplia��o]</a>
            </center>
          </div>

<?
          if (file_exists($nome_thumb))
          {  ?>

            <br><br><img border=0 src="<? echo $nome_thumb; ?>">

<?        }  

          if (file_exists($nome_foto))
          {  ?>

            <br><br><img border=0 src="<? echo $nome_foto; ?>">

<?        }  

          if (file_exists($nome_amp))
          {  ?>

            <br><br><img border=0 src="<? echo $nome_amp; ?>">

<?        }  ?>

          </div>
          </div>

<?
        }  
      }  
    }  

?>





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