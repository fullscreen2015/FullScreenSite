<?php

  ob_start();
  session_start();

  if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
  {

    include("../_include/topo.php"); 
    include("../../include/sistema_data.php"); 
    include("../../include/sistema_zeros.php"); 
    include("../../include/sistema_conexao.php"); 
    include("../../include/sistema_protecao.php"); 
    include("../_include/funcao_confirma.php"); 


	$codigo_modulo = (int)anti_injection($_REQUEST['codigo_modulo']);
	include("../_configuracoes/" . zerosaesquerda($codigo_modulo,6) . ".php"); 
	

    if(ISSET($_REQUEST['pagina']))
    {
      $pagina = $_REQUEST['pagina'];
    }
    else
    {
      $pagina = "1";
    }


    // session_register("session_codigo_registro");   
    $_SESSION['session_codigo_registro'] = $_REQUEST[$chave_primaria];


    barra("Menu Principal","../index.php",$sistema_plural,"../_modulos/painel.php?codigo_modulo=" . $codigo_modulo,"Editar " . $sistema_singular,"editar_dados.php?codigo_modulo=" . $codigo_modulo . "&pagina=" . $pagina . "&" . $chave_primaria . "=" . $_REQUEST[$chave_primaria],"Editando Fotos","");  ?>


 
  <br>



    <font class=caminho>&nbsp;&nbsp;&nbsp; <b>>>> Gerenciando fotos do registro:</b>



    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height=32 bgcolor="#cccccc">


<?
    // EXIBINDO DADOS DO REGISTRO 





    $sql = " SELECT * FROM " . $tabela . " WHERE " . $chave_primaria . "=" . $_REQUEST[$chave_primaria];
    $rs_dados = mysql_query($sql,$conexao);
    $linha = mysql_fetch_array($rs_dados);



   // ################## Trecho de c�digo copiado do painel ##################



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
                  
                  if($campos[$cont8]==1) 
                  {
                    switch ($campos[$cont3]) 
                    {

                      case "blob":

                        $valor = $linha[$campos[$cont1]];
                        $valor = str_replace("<br>", " / ", $valor);
                        $valor = ltrim($valor);

                        if(strlen($valor)>80)
                        {
                          $valor = substr($valor,0,80) . " ...";
                        }

                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $valor; 
                        break;


                      case "data_int":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatai($linha[$campos[$cont1]]); 
                        break;


                      case "data_int_now":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatai($linha[$campos[$cont1]]); 
                        break;


                      case "data_date":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdata($linha[$campos[$cont1]]); 
                        break;

                      case "data_hora":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwdatahorai($linha[$campos[$cont1]]); 
                        break;


                      case "hora_now":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwhorai($linha[$campos[$cont1]]); 
                        break;


                      case "hora":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . fwhorai($linha[$campos[$cont1]]); 
                        break;


                      case "moeda":
                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . number_format($linha[$campos[$cont1]],2,',','.'); 
                        break;


                      case "logico":
                        if($linha[$campos[$cont1]])
                        {
                          echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> Sim"; 
                        }
                        else
                        {
                          echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> Não"; 
                        }
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

                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $valores_para_mostrar; 

                        break;
					
	

                      default:

                        echo "&nbsp;&nbsp;&nbsp;<b>" . $campos[$cont2] . ":</b> " . $linha[$campos[$cont1]];
						
                        break;

                    }

                 }

                }  
				

      // ################ FIM DO TRECHO COPIADO DO PAINEL ############################





  echo '</font>';

  echo "&nbsp;&nbsp;&nbsp;<a href='editar_dados.php?codigo_modulo=" . $codigo_modulo . "&pagina=" . $pagina . "&" . $chave_primaria . "=" . $_REQUEST[$chave_primaria] . "'>[EDITAR]</a>";

  echo '</td></tr></table>';


      // FIM DO TRECHO DE EXIBIC�O DE DADOS DO PRODUTO
















    if(($redimensionamento_automatico==1)||($redimensionamento_automatico==2))
    {  
      $rabicho = "";

      if(ISSET($_REQUEST['pagina']))
      {
        $rabicho.= "pagina=" . $_REQUEST['pagina'];
      }
      if(ISSET($_REQUEST['codigo_foto']))
      {
        $rabicho.= "&codigo_foto="  . $_REQUEST['codigo_foto'] ;
      }

      if(ISSET($_REQUEST[$chave_primaria]))
      {
        $rabicho.= "&" . $chave_primaria . "="  . $_REQUEST[$chave_primaria] ;
      }

      $modo = "com";

      if(ISSET($_REQUEST['modo']))
      {
        $modo = $_REQUEST['modo'];
      }

      echo '<br><center>';
      echo '<table width="100%" border="0" cellspacing="0" cellpadding="5"><tr>';
      echo '<td bgcolor="ffffee" align=right><img src=../_imagens/info.png></td>';
      echo '<td bgcolor="ffffee">';

      if($modo=="com")
      {
        echo '<a class=caminho href="editar_foto.php?codigo_modulo=' . $codigo_modulo . '&modo=sem&' . $rabicho . '">* Voc� tamb�m pode enviar as fotos já no tamanho final, pela opção "ENVIO <b>SEM</b> REDIMENSIONAMENTO automático". <b>Clique aqui</b>!</a>';
      }
      else
      {
        echo '<a class=caminho href="editar_foto.php?codigo_modulo=' . $codigo_modulo . '&modo=com&' . $rabicho . '">* Voc� tamb�m pode enviar as fotos em qualquer tamanho , pela opção "ENVIO <b>COM</b> REDIMENSIONAMENTO automático". <b>Clique aqui</b>!</a>';
      }

      echo '</td></tr></table>';
      echo '</center>';

    }
    else
    {
      $modo = "sem";
    }




?>




    <form method=post enctype="multipart/form-data" action="upload.php">
      <input type="hidden" name="modo" value="<? echo $modo; ?>">

<?php 
		echo '<input type="hidden" name="codigo_modulo" value="' . $codigo_modulo . '">'; 
?>
	  
      <table width="100%" cellspacing="0" cellpadding="15" border="0" bgcolor="aaaaaa">
        <tr valign="top">





<?

        if($modo=="com")
        {  ?>


          <td bgcolor="dddddd" align="center">

            <br>
            <font class=caminho>
              <div style="float:center; height:32px; width:200px;">
                <div style="float:left; margin-right:10px;"><img src=../_imagens/foto.gif></div>
                <div style="float:left; width:170px;">
                  <b>Indique aqui o arquivo da foto que deseja enviar ...</b>
                </div>
              </div>

              <br><br>
              A foto ampliada deve seguir as seguintes especifica��es:<br><br>
              <b>Formato:</b> JPG, PNG ou GIF<br>
              <b>Tamanho M�ximo:</b> <? echo number_format($tamanho_maximo_imagem, 0, ',', '.'); ?> bytes<br>

<?
              if($redimensionamento_automatico==2)
              {
                if($largura_minima!=0)
                {  
                  echo '<b>Largura M�nima:</b> ' . $largura_minima . ' pixels <br>';
                }  
                if($altura_minima!=0)
                {  
                  echo '<b>Altura M�nima:</b> ' . $altura_minima . ' pixels <br>';
                } 

                 if($largura_maxima!=0)
                {  
                  echo '<b>Largura M�xima:</b> ' . $largura_maxima . ' pixels <br>';
                }  
                if($altura_maxima!=0)
                {  
                  echo '<b>Altura M�xima:</b> ' . $altura_maxima . ' pixels <br>';
                } 



              }
?>

              <br>

            <input type="hidden" name="MAX_FILE_SIZE" value="<? echo $tamanho_maximo_imagem; ?>" />
            <input class=input type="file" name="foto_upload" size="18"></font></td>
<?      } 
        else
        {








           

          if(($tipo_sistema_fotos==6)||($tipo_sistema_fotos==7))
          {  ?>

            <td bgcolor="dddddd" align="center">
              <br>
              <font class=preto_8>
                <div style="float:center; height:32px; width:200px;">
                  <div style="float:left; margin-right:10px;"><img src=../_imagens/foto.gif></div>
                  <div style="float:left; width:170px;">
                    <b>Indique aqui o arquivo da foto ampliada ...</b>
                  </div>
                </div>

                <br><br>
                A foto ampliada deve seguir as seguintes especifica��es:<br><br>
                <b>Formato:</b> <? echo $tipo_arquivo_ampliado; ?><br>
                <b>Tamanho M�ximo:</b> <? echo number_format($tamanho_maximo_amp, 0, ',', '.'); ?> bytes <br>

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
                <div style="float:center; height:32px; width:200px;">
                  <div style="float:left; margin-right:10px;"><img src=../_imagens/foto.gif></div>
                  <div style="float:left; width:170px;">
                    <b>Indique aqui o arquivo da foto grande ...</b>
                  </div>
                </div>

                <br><br>
                A foto grande deve seguir as seguintes especifica��es:<br><br>
                <b>Formato:</b> <? echo $tipo_arquivo_grande; ?><br>
                <b>Tamanho M�ximo:</b> <? echo number_format($tamanho_maximo_foto, 0, ',', '.'); ?> bytes <br>

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
                <div style="float:center; height:32px; width:200px;">
                  <div style="float:left; margin-right:10px;"><img src=../_imagens/foto.gif></div>
                  <div style="float:left; width:170px;">
                    <b>Indique aqui o arquivo da foto pequena ...</b>
                  </div>
                </div>

                <br><br>


                A foto pequena deve seguir as seguintes especifica��es:<br><br>
                <b>Formato:</b> <? echo $tipo_arquivo_pequeno; ?><br>
                <b>Tamanho M�ximo:</b> <? echo number_format($tamanho_maximo_thumbs, 0, ',', '.'); ?> bytes<br>

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

        $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


        if (file_exists($nome_arquivo))
        {  ?>

          <a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&indice_foto=<? echo $i; ?>">
            <img border=0 src="<? echo $nome_arquivo; ?>?<?php echo rand(0,9999); ?>"&nbsp;&nbsp;></a>

<?      }  
      }  
    }  

    if($tipo_sistema_fotos==2)
    {
      for($i=1;$i<=1000;$i++)
      {
        $m = $i;
        $m = zerosaesquerda($m,$numero_algarismos);  

        $nome_arquivo = "../../" . $nome_sistema_fotos . "/" . $codigo_registro . "/thumbs/" . $m . "." . $tipo_arquivo_pequeno;
        if (file_exists($nome_arquivo))
        {  ?>

          <a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria]; ?>&indice_foto=<? echo $i; ?>">
            <img border=0 src="<? echo $nome_arquivo; ?>?<?php echo rand(0,9999); ?>"&nbsp;&nbsp;></a>

<?      }  
      }  
    }  






    if($tipo_sistema_fotos==3)
    {

      $nome_thumbs = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $nome_foto = "../../" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;


      if (file_exists($nome_thumbs))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>">
          <img border=0 src="<? echo $nome_thumbs; ?>?<?php echo rand(0,9999); ?>"></a>

<?   
      }  
      if (file_exists($nome_foto))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>">
          <img border=0 src="<? echo $nome_foto; ?>?<?php echo rand(0,9999); ?>"></a>

<?   
      }  
    }  









    if($tipo_sistema_fotos==4)
    {

      $nome_thumbs = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;

      if (file_exists($nome_thumbs))
      {  ?>

        <a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>">
          <img border=0 src="<? echo $nome_thumbs; ?>?<?php echo rand(0,9999); ?>"&nbsp;&nbsp;></a>

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

        $nome_arquivo = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;


        if (file_exists($nome_arquivo))
        {  ?>

          <a onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>&indice_foto=<? echo $i; ?>">
            <img border=0 src="<? echo $nome_arquivo; ?>?<?php echo rand(0,9999); ?>"&nbsp;&nbsp;></a>

<?      }  
      }  
    }  














    if($tipo_sistema_fotos==6)
    {

      $nome_thumbs = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "." . $tipo_arquivo_pequeno;
      $nome_foto = "../../" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "." . $tipo_arquivo_grande;
      $nome_amp = "../../" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "." . $tipo_arquivo_ampliado;

      if (file_exists($nome_thumbs))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>">
          <img border=0 src="<? echo $nome_thumbs; ?>?<?php echo rand(0,9999); ?>"></a>

<?   
      }  
      if (file_exists($nome_foto))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>">
          <img border=0 src="<? echo $nome_foto; ?>?<?php echo rand(0,9999); ?>"></a>

<?   
      }  
      if (file_exists($nome_amp))
      {  ?>

        <br><a  onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>">
          <img border=0 src="<? echo $nome_amp; ?>?<?php echo rand(0,9999); ?>"></a>

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

        $nome_thumb = "../../" . $nome_sistema_fotos . "/thumbs/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_pequeno;
        $nome_foto = "../../" . $nome_sistema_fotos . "/fotos/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_grande;
        $nome_amp = "../../" . $nome_sistema_fotos . "/amp/" . $codigo_registro . "_" . $m . "." . $tipo_arquivo_ampliado;

        if ((file_exists($nome_thumb))||(file_exists($nome_foto))||(file_exists($nome_amp)))
        {  
?>
          <div style="width: 100%; padding: 10px">
          <div style="align: center; width: 100%; background-color: #cccccc; padding: 10px">
          <div class=preto_8 style="align: center; width: 100%; background-color: #eeeeee; padding: 10px">
            <center>
              <b>Foto <? echo $i; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a class=preto_8 onclick="return confirmLink(this, '\n****************************\n\nTem certeza que deseja\napagar esta foto?\n\n****************************')" alt="clique na foto para excluir" href="excluir_foto.php?codigo_modulo=<? echo $codigo_modulo; ?>&<? echo $chave_primaria; ?>=<? echo $_REQUEST[$chave_primaria];?>&indice_foto=<? echo $i; ?>">[Clique aqui para excluir o thumbs, a foto e a amplia��o]</a>
            </center>
          </div>

<?
          if (file_exists($nome_thumb))
          {  ?>

            <br><br><img border=0 src="<? echo $nome_thumb; ?>?<?php echo rand(0,9999); ?>">

<?        }  

          if (file_exists($nome_foto))
          {  ?>

            <br><br><img border=0 src="<? echo $nome_foto; ?>?<?php echo rand(0,9999); ?>">

<?        }  

          if (file_exists($nome_amp))
          {  ?>

            <br><br><img border=0 src="<? echo $nome_amp; ?>?<?php echo rand(0,9999); ?>">

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




<?

  }
  else
  {
    header("Location: ../_sistema/php_manutencao_login.php");  
  }
  ob_end_flush();
?>