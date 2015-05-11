<?

  include("funcao_form_select.php");







  function edit($descricao_campo,$nome_campo,$tam)
  {  
    global $linha;  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="text" maxlength="<? echo $tam; ?>" class="input" value="<? echo $linha[$nome_campo]; ?>" name="<? echo $nome_campo; ?>"></td>
      </tr>
    </table>

<? 

  }






  function edit2($descricao_campo,$nome_campo,$tam,$tabela,$validacao)
  {  

    global $linha;
    global $sistema_exclusao;

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle"> ';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ': &nbsp;</b></font></td>';
    echo '<td width="50%">';

    echo '<div style="float:left;">';


    if($validacao=="")
    { 
      $valor_alt = "no_required";
    }
    else
    {
      $valor_alt = $descricao_campo;

      if($validacao=="email")
      {
        $valor_alt = "email";
      }
    }




    echo '<input type="text" maxlength="' . $tam . '" class="input" id="'. $nome_campo . '" alt="' . $valor_alt . '" value="' . $linha[$nome_campo] . '" name="'. $nome_campo . '">';
    echo '</div>';

    if($validacao=="unico")
    { 
?>

      <script type="text/javascript">

      $(document).ready(function()
      {
        $("#<? echo $nome_campo; ?>").blur(function(event) 
        {
          $("#validacao_<? echo $nome_campo; ?>").load('../../_include/ajax_validacao_unico.php?valor_inicial=<? echo $linha[$nome_campo]; ?>&exclusao=<? echo $sistema_exclusao; ?>&campo=<? echo $nome_campo; ?>&tabela=<? echo $tabela; ?>&r=' + Math.floor(Math.random()*100000),'valor=' + $('input#<? echo $nome_campo; ?>').val());	
        });
      });

      </script>
<?

      echo '<div style="float:left; margin-left:20px;" id=validacao_' . $nome_campo . '>';
      echo '<input id="' . $nome_campo . '_validacao" type=hidden name="' . $nome_campo . '_validacao" value="x">';
      echo '</div>';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>
';

  }













  // fun��o criada para adicionar o par�metro "help"
  function edit3($descricao_campo,$nome_campo,$tam,$tabela,$validacao,$help)
  {  

    global $linha;
    global $sistema_exclusao;

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle"> ';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ':</b></font>';

    if($help!="")
    {
      echo " <img src='../../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

    echo '&nbsp;';
    echo '</td>';
    echo '<td width="50%">';

    echo '<div style="float:left;">';


    if($validacao=="")
    { 
      $valor_alt = "no_required";
    }
    else
    {
      $valor_alt = $descricao_campo;

      if($validacao=="email")
      {
        $valor_alt = "email";
      }
    }





    echo '<input type="text" maxlength="' . $tam . '" class="input" id="'. $nome_campo . '" alt="' . $valor_alt . '" value="' . $linha[$nome_campo] . '" name="'. $nome_campo . '">';
    echo '</div>';




    if($validacao=="unico")
    { 
?>

      <script type="text/javascript">

      $(document).ready(function()
      {
        $("#<? echo $nome_campo; ?>").blur(function(event) 
        {
          $("#validacao_<? echo $nome_campo; ?>").load('../../_include/ajax_validacao_unico.php?valor_inicial=<? echo $linha[$nome_campo]; ?>&exclusao=<? echo $sistema_exclusao; ?>&campo=<? echo $nome_campo; ?>&tabela=<? echo $tabela; ?>&r=' + Math.floor(Math.random()*100000),'valor=' + $('input#<? echo $nome_campo; ?>').val()); 
        });
      });

      </script>
<?

      echo '<div style="float:left; margin-left:20px;" id=validacao_' . $nome_campo . '>';
      echo '<input id="' . $nome_campo . '_validacao" type=hidden name="' . $nome_campo . '_validacao" value="x">';
      echo '</div>';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>
';

  }










  function edit_moeda($descricao_campo,$nome_campo,$tam,$validacao)
  {  
    global $linha;  

    if($validacao=="")
    { 
      $tag_alt = "no_required";
    }
    else
    {
      $tag_alt = $descricao_campo;
    }


?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="<? echo $tag_alt; ?>" type="text" maxlength="<? echo $tam; ?>" class="input" value="<? echo number_format($linha[$nome_campo],2,',','.'); ?>" name="<? echo $nome_campo; ?>"  onkeypress="return mascara(this,'num_virgula',event);"></td>
      </tr>
    </table>

<? 

  }






  function edit_real($descricao_campo,$nome_campo,$tam)
  {  
    global $linha;  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="text" maxlength="<? echo $tam; ?>" class="input" value="<? echo number_format($linha[$nome_campo],3,',','.'); ?>" name="<? echo $nome_campo; ?>"  onkeypress="return mascara(this,'num_virgula',event);"></td>
      </tr>
    </table>

<? 

  }



  function edit_inteiro($descricao_campo,$nome_campo,$tam,$validacao)
  {  
    global $linha;  

    if($validacao=="")
    { 
      $tag_alt = "no_required";
    }
    else
    {
      $tag_alt = $descricao_campo;
    }

?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="<? echo $tag_alt; ?>" type="text" maxlength="<? echo $tam; ?>" class="input" value="<? echo $linha[$nome_campo]; ?>" name="<? echo $nome_campo; ?>"  onkeypress="return mascara(this,'num_virgula',event);"></td>
      </tr>
    </table>

<? 

  }






  function edit_senha($descricao_campo,$nome_campo,$tam)
  {  
    global $linha;  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="password" maxlength="<? echo $tam; ?>" class="input" value="<? echo $linha[$nome_campo]; ?>" name="<? echo $nome_campo; ?>"></td>
      </tr>
    </table>

    <br>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b>Confirmação de <? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="password" maxlength="<? echo $tam; ?>" class="input" value="<? echo $linha[$nome_campo]; ?>"  name="<? echo $nome_campo; ?>_c" onblur="javascript: return valida_senha();"></td>      </tr>
    </table>

<script language="javascript">
  function valida_senha()
  {


    if (formulario.<? echo $nome_campo; ?>.value != formulario.<? echo $nome_campo; ?>_c.value)
    {
      alert("A senha não est� igual a confirmação de senha!");
      formulario.<? echo $nome_campo; ?>_c.value='';
      formulario.<? echo $nome_campo; ?>.value='';
      formulario.<? echo $nome_campo; ?>.focus();
      return false;
    }

  }
</script>


<? 

  }



  function edit_senha_md5($cont,$descricao_campo,$nome_campo,$tam)
  {  
    echo '<div id="' . $nome_campo . '">';

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="50%" align="right">';

    echo '<a class=caminho href="';
    echo "javascript:alterar_senha_mostrar_input('" . $cont . "','" . $descricao_campo . "','" . $nome_campo . "','" . $tam . "');";
    echo '"><b>Alterar Senha:</b></a>';

    echo '&nbsp;</td>';
    echo '<td width="50%" align="left">';

    echo '<a class=caminho href="';
    echo "javascript:alterar_senha_mostrar_input('" . $cont . "','" . $descricao_campo . "','" . $nome_campo . "','" . $tam . "');";
    echo '">Clique se deseja alterar a senha</a>';


    echo '</td></tr></table>';

    echo "</div>";
  }



  function input($descricao_campo,$nome_campo,$tam)
  {  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="text" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>"></td>
      </tr>
    </table>

<? 

  }




  function input2($descricao_campo,$nome_campo,$tam,$tabela,$validacao)
  {  
    global $sistema_exclusao;
 
    if($validacao=="")
    { 
      $tag_alt = "no_required";
    }
    else
    {
      $tag_alt = $descricao_campo;

      if($validacao=="email")
      {
        $tag_alt = "email";
      }
    }

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle"> ';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ': &nbsp;</b></font></td>';
    echo '<td width="50%">';

    echo '<div style="float:left;">';

    echo '<input type="text" maxlength="' . $tam . '" alt="' . $tag_alt . '" class="input" id="'. $nome_campo . '" name="'. $nome_campo . '">';
    echo '</div>';

    if($validacao=="unico")
    { 
?>

      <script type="text/javascript">

      $(document).ready(function()
      {
        $("#<? echo $nome_campo; ?>").blur(function(event) 
        {
          $("#validacao_<? echo $nome_campo; ?>").load('../../_include/ajax_validacao_unico.php?campo=<? echo $nome_campo; ?>&tabela=<? echo $tabela; ?>&exclusao=<? echo $sistema_exclusao; ?>&r=' + Math.floor(Math.random()*100000),'valor=' + $('input#<? echo $nome_campo; ?>').val());	
        });
      });

      </script>
<?

      echo '<div style="float:left; margin-left:20px;" id=validacao_' . $nome_campo . '>';
      echo '<input id="' . $nome_campo . '_validacao" type=hidden name="' . $nome_campo . '_validacao" value="x">';
      echo '</div>';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>
';

  }









  function input3($descricao_campo,$nome_campo,$tam,$tabela,$validacao,$help)
  {  
    global $sistema_exclusao;
 
    if($validacao=="")
    { 
      $tag_alt = "no_required";
    }
    else
    {
      $tag_alt = $descricao_campo;

      if($validacao=="email")
      {
        $tag_alt = "email";
      }
    }

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle"> ';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ': </b></font>';

    if($help!="")
    {
      echo " <img src='../../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

    echo '&nbsp;</td>';
    echo '<td width="50%">';

    echo '<div style="float:left;">';

    echo '<input type="text" maxlength="' . $tam . '" alt="' . $tag_alt . '" class="input" id="'. $nome_campo . '" name="'. $nome_campo . '">';
    echo '</div>';

    if($validacao=="unico")
    { 
?>

      <script type="text/javascript">

      $(document).ready(function()
      {
        $("#<? echo $nome_campo; ?>").blur(function(event) 
        {
          $("#validacao_<? echo $nome_campo; ?>").load('../../_include/ajax_validacao_unico.php?campo=<? echo $nome_campo; ?>&tabela=<? echo $tabela; ?>&exclusao=<? echo $sistema_exclusao; ?>&r=' + Math.floor(Math.random()*100000),'valor=' + $('input#<? echo $nome_campo; ?>').val()); 
        });
      });

      </script>
<?

      echo '<div style="float:left; margin-left:20px;" id=validacao_' . $nome_campo . '>';
      echo '<input id="' . $nome_campo . '_validacao" type=hidden name="' . $nome_campo . '_validacao" value="x">';
      echo '</div>';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>
';

  }










  function input_senha($descricao_campo,$nome_campo,$tam)
  {  ?>


    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="password" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>"></td>
      </tr>
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b>Confirmação de <? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="password" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>_c" onblur="javascript: return valida_senha();"></td>      </tr>
    </table>

<script language="javascript">
  function valida_senha()
  {


    if (formulario.<? echo $nome_campo; ?>.value != formulario.<? echo $nome_campo; ?>_c.value)
    {
      alert("A senha não est� igual a confirmação de senha!");
      formulario.<? echo $nome_campo; ?>_c.value='';
      formulario.<? echo $nome_campo; ?>.value='';
      formulario.<? echo $nome_campo; ?>.focus();
      return false;
    }

  }
</script>


<? 

  }

function input_senha_md5($descricao_campo,$nome_campo,$tam)
  {  ?>


    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%" align=left>
          <input alt="no_required" type="password" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>"></td>
      </tr>
    </table>
    <br>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b>Confirmação de <? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%" align=left>
          <input alt="no_required" type="password" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>_c" onblur="javascript: return valida_senha();"></td>      </tr>
    </table>

<script language="javascript">
  function valida_senha()
  {


    if (frmCadastro.<? echo $nome_campo; ?>.value != frmCadastro.<? echo $nome_campo; ?>_c.value)
    {
      alert("A senha não est� igual a confirmação de senha!");
      frmCadastro.<? echo $nome_campo; ?>_c.value='';
      frmCadastro.<? echo $nome_campo; ?>.value='';
      frmCadastro.<? echo $nome_campo; ?>.focus();
      return false;
    }

  }
</script>


<? 

  }











  function input_moeda($descricao_campo,$nome_campo,$tam,$validacao)
  {  

    if($validacao=="")
    { 
      $tag_alt = "no_required";
    }
    else
    {
      $tag_alt = $descricao_campo;
    }

?>



    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="<? echo $tag_alt; ?>" type="text" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>" onkeypress="return mascara(this,'num_virgula',event);"></td>
      </tr>
    </table>

<? 

  }





  function input_real($descricao_campo,$nome_campo,$tam)
  {  ?>



    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="no_required" type="text" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>" onkeypress="return mascara(this,'num_virgula',event);"></td>
      </tr>
    </table>

<? 

  }








  function input_inteiro($descricao_campo,$nome_campo,$tam,$validacao)
  {

    if($validacao=="")
    { 
      $tag_alt = "no_required";
    }
    else
    {
      $tag_alt = $descricao_campo;
    }

  ?>



    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <input alt="<? echo $tag_alt; ?>" type="text" maxlength="<? echo $tam; ?>" class="input" name="<? echo $nome_campo; ?>" onkeypress="return mascara(this,'num_virgula',event);"></td>
      </tr>
    </table>

<? 

  }




  include_once("../../_editor/fckeditor/fckeditor.php") ;

  if ( !function_exists('htmlspecialchars_decode') )
  {
    function htmlspecialchars_decode($text)
    {
      return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
  }


  function editor($descricao_campo,$nome_campo,$tam)
  { 

    echo '
    <table border="0" cellspacing="0" cellpadding="0" width="90%" align=center>
      <tr valign="middle"> 
        <td>';

    echo '<font class="preto_8"><b>' . $descricao_campo . ': &nbsp;</b></font><br><br>';


    $oFCKeditor = new FCKeditor($nome_campo) ;
    $oFCKeditor->BasePath = '../../_editor/fckeditor/' ;

    $oFCKeditor->ToolbarSet	= 'Friweb1' ;
    $oFCKeditor->Width	= '500' ;
    $oFCKeditor->Height	= '500' ;

    $oFCKeditor->Value = '' ;
    $oFCKeditor->Create() ;

    echo '
        </td>
      </tr>
    </table>';



  }



  function editor_edit($descricao_campo,$nome_campo,$tam)
  {
    global $linha;  

    echo '
    <table border="0" cellspacing="0" cellpadding="0" width="90%" align=center>
      <tr valign="middle"> 
        <td>';

    echo '<font class="preto_8"><b>' . $descricao_campo . ': &nbsp;</b></font><br><br>';

    $oFCKeditor = new FCKeditor($nome_campo) ;
    $oFCKeditor->BasePath = '../../_editor/fckeditor/' ;
    $oFCKeditor->Value = htmlspecialchars_decode($linha[$nome_campo]) ;

    $oFCKeditor->ToolbarSet	= 'Friweb1' ;
    $oFCKeditor->Height	= '500' ;

    $oFCKeditor->Create() ;

    echo '
        </td>
      </tr>
    </table>';

  }



  function textarea($descricao_campo,$nome_campo,$tam)
  {  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="100%" align="center">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
      </tr>
      <tr valign="middle"> 
        <td width="100%" align="center">
          <textarea alt="no_required" title="no_required" cols="80" rows="10" class="input" name="<? echo $nome_campo; ?>"></textarea></td>
      </tr>
    </table>

<? 

  }




  // a vers�o 2 desta fun��o foi criada para adicionar o par�metro "help"
  function textarea2($descricao_campo,$nome_campo,$tam,$help)
  {  

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="100%" align="center">';
    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ': &nbsp;</b></font>';
    if($help!="")
    {
      echo "<img src='../../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }
    echo '</td>';
    echo '</tr>';
    echo '<tr valign="middle">';
    echo '<td width="100%" align="center">';
    echo '<textarea alt="no_required" title="no_required" cols="80" rows="10" class="input" name="' . $nome_campo . '"></textarea></td>';
    echo '</tr>';
    echo '</table>';

  }





  function textarea_edit($descricao_campo,$nome_campo,$tam)
  {  
    global $linha;  
    $texto = str_replace("<br>", "\n", $linha[$nome_campo]);
    $texto = str_replace("&nbsp;", " ", $texto);

    ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="100%" align="center">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b>*</font></td>
      </tr>
      <tr valign="middle"> 
        <td width="100%" align="center">
          <textarea alt="no_required" title="no_required" cols="80" rows="10" class="input" id="<? echo $nome_campo; ?>" name="<? echo $nome_campo; ?>"><? echo $texto; ?></textarea></td>
      </tr>
    </table>


<? 

  }
  



  // a vers�o 2 desta fun��o foi criada para adicionar o par�metro "help"
  function textarea_edit2($descricao_campo,$nome_campo,$tam,$help)
  {  
    global $linha;  
    $texto = str_replace("<br>", "\n", $linha[$nome_campo]);
    $texto = str_replace("&nbsp;", " ", $texto);

    ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="100%" align="center">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font>
          <?php
            if($help!="")
            {
              echo "<img src='../../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
            }
          ?>
        </td>
      </tr>
      <tr valign="middle"> 
        <td width="100%" align="center">
          <textarea alt="no_required" title="no_required" cols="80" rows="10" class="input" id="<? echo $nome_campo; ?>" name="<? echo $nome_campo; ?>"><? echo $texto; ?></textarea></td>
      </tr>
    </table>


<? 

  }
  






  function check($descricao_campo,$nome_campo)
  {
    global $linha;   ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="80%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="20%">
          <input type="checkbox" name="<? echo $nome_campo; ?>" <? if ($linha[$nome_campo]==1) { echo " checked "; } ?>></td>
      </tr>
    </table>

<? 

  }
  


  function check2($descricao_campo,$nome_campo,$help)
  {
    global $linha;   

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="80%" align="right">';
    echo '<font class="preto_8"><b>';
    echo $descricao_campo;
    echo ':</b></font>';

    if($help!="")
    {
      echo " <img src='../../_imagens/info.png' width='16' alt='" . $help . "' title='" . $help . "'>";
    }

    echo ' &nbsp;';
    echo '</td>';
    echo '<td width="20%">';
    echo '<input type="checkbox" name="' . $nome_campo . '"';

    if ($linha[$nome_campo]==1) 
    {
      echo " checked "; 
    }

    echo '></td>';
    echo '</tr></table>';

  }








  function radio($descricao_campo,$nome_campo)
  {
    global $linha;   ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr align="right"> 
        <td width="50%">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%" align="left">
          <input type="radio" name="<? echo $nome_campo; ?>" value="1" <?php if($linha[$nome_campo]==1){?>checked="CHECKED"<? }?>/> &nbsp; <label><font class="preto_8">a)Otimiza��o</font></label>
          <input type="radio" name="<? echo $nome_campo; ?>" value="0" <?php if($linha[$nome_campo]==0){?>checked="CHECKED"<? }?> /> &nbsp;<label><font class="preto_8">b)Layout</label></font></td>
      </tr>
    </table>

<? 

  }









  function data($descricao_campo,$nome_campo)
  {  

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>' . $descricao_campo . ': &nbsp;</b></font></td>';
    echo '
    ';
    echo '<td width="50%">';
    echo '<font class="preto_8">';
    
    echo '<select class="select" alt="' . $descricao_campo . ' - Dia" name="' . $nome_campo . '_dia">';

    for($dia=1;$dia<=31;$dia++)
    {
      echo "<option value=" . $dia . ">".$dia."</option>";
    }
    echo '</select>';
    echo ' / ';
    echo '
    ';
    
    echo '<select class="select" alt="' . $descricao_campo . ' - M�s" name="' . $nome_campo . '_mes">';

    for($mes=1;$mes<=12;$mes++)
    {
      echo "<option value=" . $mes . ">".$mes."</option>";
    }
    echo '</select>';
    echo ' / ';
    echo '
    ';

    echo '<select class="select" alt="' . $descricao_campo . ' - Ano" name="' . $nome_campo . '_ano">';

    for($ano=date("Y")+1;$ano>=1900;$ano--)
    {
      echo "<option value=" . $ano . ">".$ano."</option>";
    }
    echo '</select></font></td>';
    echo '</tr>';
    echo '</table>';

  }




  function data2($descricao_campo,$nome_campo,$validacao)
  {  

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>' . $descricao_campo . ': &nbsp;</b></font></td>';
    echo '
    ';
    echo '<td width="50%">';
    echo '<font class="preto_8">';
    
    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo ;
    }
    else
    {
      $tag_title="no_required";
    }


    echo '<select class="select" alt="' . $descricao_campo .' - Dia" title="' . $tag_title . '" name="' . $nome_campo . '_dia">';
    echo '<option value="">-</option>';
    for($dia=1;$dia<=31;$dia++)
    {
      echo "<option value=" . $dia . ">".$dia."</option>
      ";
    }
    echo '</select>';
    echo ' / ';
    echo '
    ';
    
    echo '<select class="select" alt="' . $descricao_campo . ' - M�s" title="' . $tag_title . '" name="' . $nome_campo . '_mes">';
    echo '<option value="">-</option>';
    for($mes=1;$mes<=12;$mes++)
    {
      echo "<option value=" . $mes . ">".$mes."</option>
      ";
    }
    echo '</select>';
    echo ' / ';
    echo '
    ';

    echo '<select class="select" alt="' . $descricao_campo . ' - Ano"  title="' . $tag_title . '" name="' . $nome_campo . '_ano">';
    echo '<option value="">-</option>';
    for($ano=date("Y")+1;$ano>=1900;$ano--)
    {
      echo "<option value=" . $ano . ">".$ano."</option>
      ";
    }
    echo '</select></font></td>';
    echo '</tr>';
    echo '</table>';

  }








  function data_now($descricao_campo,$nome_campo)
  {

    global $linha; 

    

    $valor_ano = date("Y");

    $valor_mes = date("m");

    $valor_dia = date("d");



    ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <font class="preto_8">
          <select class="select" alt="<? echo $descricao_campo; ?> - Dia" name="<? echo $nome_campo; ?>_dia">
            <? for($dia=1;$dia<=31;$dia++)
               {
                 if ($valor_dia==$dia) 
                 {
                   echo "<option value=" . $dia . " selected>".$dia."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $dia . ">".$dia."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - M�s" name="<? echo $nome_campo; ?>_mes">
            <? for($mes=1;$mes<=12;$mes++)
               {
                 if ($valor_mes==$mes) 
                 {
                   echo "<option value=" . $mes . " selected>".$mes."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $mes . ">".$mes."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - Ano" name="<? echo $nome_campo; ?>_ano">
            <? for($ano=date("Y")+2;$ano>=1900;$ano--)
               {
                 if ($valor_ano==$ano) 
                 {
                   echo "<option value=" . $ano . " selected>".$ano."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $ano . ">".$ano."</option>";
                 }
               }  ?>
          </select></font></td>
      </tr>
    </table>

<? 

  }

 function data_hora_inserir($descricao_campo,$nome_campo)
  {

    global $linha; 

    

    $valor_ano = date("Y");

    $valor_mes = date("m");

    $valor_dia = date("d");

    $valor_hora = date("G");

    $valor_min = date("i");

    $valor_seg = date("s");

    ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="float:left;margin-top:20px;" >
      <tr valign="middle"> 
        <td width="40%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="60%">
          <font class="preto_8">
          <select class="select" alt="<? echo $descricao_campo; ?> - Dia" name="<? echo $nome_campo; ?>_dia">
            <? for($dia=1;$dia<=31;$dia++)
               {
				 if ($valor_dia == $dia)
                 {
                   echo "<option value=" . $dia . " selected>".$dia."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $dia . ">".$dia."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - M�s" name="<? echo $nome_campo; ?>_mes">
            <? for($mes=1;$mes<=12;$mes++)
               {
                 if ($valor_mes == $mes)
                 {
                   echo "<option value=" . $mes . " selected>".$mes."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $mes . ">".$mes."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - Ano" name="<? echo $nome_campo; ?>_ano">
            <? for($ano=date("Y");$ano<=date("Y")+10;$ano++)
               {
                 if ($valor_ano == $ano)
                 {
                   echo "<option value=" . $ano . " selected>".$ano."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $ano . ">".$ano."</option>";
                 }
               }  ?>
          </select>
          
          <!-- horas -->
          
          <select class="select" alt="<? echo $descricao_campo; ?> - Hora" name="<? echo $nome_campo; ?>_hora">
            <? for($hora=0;$hora<=23;$hora++)
               {
                 if ($valor_hora == $hora) 
                 {
                   echo "<option value=" . $hora . " selected>".$hora."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $hora . ">".$hora."</option>";
                 }
               }  ?>
          </select>
          :
          <select class="select" alt="<? echo $descricao_campo; ?> - Minuto" name="<? echo $nome_campo; ?>_min">
            <? for($min=0;$min<=59;$min++)
               {
                 if($valor_min == $min)
                 {
                   echo "<option value=" . $min . " selected>".$min."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $min . ">".$min."</option>";
                 }
               }  ?>
          </select>
          :
          <select class="select" alt="<? echo $descricao_campo; ?> - Segundo" name="<? echo $nome_campo; ?>_seg">
            <? for($seg=0;$seg<=59;$seg++)
               {
                 if ($valor_seg == $seg)
                 {
                   echo "<option value=" . $seg . " selected>".$seg."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $seg . ">".$seg."</option>";
                 }
               }  ?>
          </select>
          <!-- hora -->
          
          
          
          </font>
          </td>
      </tr>
    </table>

<? 

  }

 function data_hora_editar($descricao_campo,$nome_campo)
  {

    global $linha; 

    

    $valor_ano = date("Y");

    $valor_mes = date("m");

    $valor_dia = date("d");

    $valor_hora = date("G");

    $valor_min = date("i");

    $valor_seg = date("s");

    ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="float:left;margin-top:20px;" >
      <tr valign="middle"> 
        <td width="40%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="60%">
          <font class="preto_8">
          <select class="select" alt="<? echo $descricao_campo; ?> - Dia" name="<? echo $nome_campo; ?>_dia">
            <? for($dia=1;$dia<=31;$dia++)
               {
				 if (data_hora_func($linha[$nome_campo],"dia") == $dia)
                 {
                   echo "<option value=" . $dia . " selected>".$dia."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $dia . ">".$dia."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - M�s" name="<? echo $nome_campo; ?>_mes">
            <? for($mes=1;$mes<=12;$mes++)
               {
                 if (data_hora_func($linha[$nome_campo],"mes") == $mes)
                 {
                   echo "<option value=" . $mes . " selected>".$mes."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $mes . ">".$mes."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - Ano" name="<? echo $nome_campo; ?>_ano">
            <? for($ano=date("Y");$ano<=date("Y")+10;$ano++)
               {
                 if (data_hora_func($linha[$nome_campo],"ano") == $ano)
                 {
                   echo "<option value=" . $ano . " selected>".$ano."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $ano . ">".$ano."</option>";
                 }
               }  ?>
          </select>
          
          <!-- horas -->
          
          <select class="select" alt="<? echo $descricao_campo; ?> - Hora" name="<? echo $nome_campo; ?>_hora">
            <? for($hora=0;$hora<=23;$hora++)
               {
                 if (data_hora_func($linha[$nome_campo],"hora") == $hora) 
                 {
                   echo "<option value=" . $hora . " selected>".$hora."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $hora . ">".$hora."</option>";
                 }
               }  ?>
          </select>
          :
          <select class="select" alt="<? echo $descricao_campo; ?> - Minuto" name="<? echo $nome_campo; ?>_min">
            <? for($min=0;$min<=59;$min++)
               {
                 if(data_hora_func($linha[$nome_campo],"min") == $min)
                 {
                   echo "<option value=" . $min . " selected>".$min."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $min . ">".$min."</option>";
                 }
               }  ?>
          </select>
          :
          <select class="select" alt="<? echo $descricao_campo; ?> - Segundo" name="<? echo $nome_campo; ?>_seg">
            <? for($seg=0;$seg<=59;$seg++)
               {
                 if (data_hora_func($linha[$nome_campo],"seg") == $seg)
                 {
                   echo "<option value=" . $seg . " selected>".$seg."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $seg . ">".$seg."</option>";
                 }
               }  ?>
          </select>
          <!-- hora -->
          
          
          
          </font>
          </td>
      </tr>
    </table>

<? 

  }





  function hora($descricao_campo,$nome_campo)
  {  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <font class="preto_8">
            <input size=2 class="select" name="<? echo $nome_campo; ?>_hora" maxlength=2>
            :
            <input size=2 class="select" name="<? echo $nome_campo; ?>_minuto" maxlength=2>
            :
            <input size=2 class="select" name="<? echo $nome_campo; ?>_segundo" maxlength=2>
          </font></td>
      </tr>
    </table>

<? 

  }


















  function hora_edit($descricao_campo,$nome_campo)
  {  

    global $linha;

    $hora_total = $linha[$nome_campo]; 

    $horas = substr ( $hora_total, 0, 2 );
    $minutos = substr ( $hora_total, 2,2 );
    $segundos = substr ( $hora_total, 4,2 );

?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <font class="preto_8">
            <input size=2 class="select" name="<? echo $nome_campo; ?>_hora" maxlength=2 value="<? echo $horas; ?>">
            :
            <input size=2 class="select" name="<? echo $nome_campo; ?>_minuto" maxlength=2 value="<? echo $minutos; ?>">
            :
            <input size=2 class="select" name="<? echo $nome_campo; ?>_segundo" maxlength=2 value="<? echo $segundos; ?>">
          </font></td>
      </tr>
    </table>

<? 

  }









  function hora_now($descricao_campo,$nome_campo)
  {  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <font class="preto_8">
            <input size=2 class="select" name="<? echo $nome_campo; ?>_hora" maxlength=2 value="<? echo date("H"); ?>">
            :
            <input size=2 class="select" name="<? echo $nome_campo; ?>_minuto" maxlength=2 value="<? echo date("i"); ?>">
            :
            <input size=2 class="select" name="<? echo $nome_campo; ?>_segundo" maxlength=2 value="<? echo date("s"); ?>">
          </font></td>
      </tr>
    </table>

<? 

  }









  function data_date_edit($descricao_campo,$nome_campo)
  {

    global $linha;  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr valign="middle"> 
        <td width="50%" align="right">
          <font class="preto_8"><b><? echo $descricao_campo; ?>: &nbsp;</b></font></td>
        <td width="50%">
          <font class="preto_8">
          <select class="select" alt="<? echo $descricao_campo; ?> - Dia" name="<? echo $nome_campo; ?>_dia">
            <? for($dia=1;$dia<=31;$dia++)
               {
                 if (fwdia($linha[$nome_campo])==$dia) 
                 {
                   echo "<option value=" . $dia . " selected>".$dia."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $dia . ">".$dia."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - M�s" name="<? echo $nome_campo; ?>_mes">
            <? for($mes=1;$mes<=12;$mes++)
               {
                 if (fwmes($linha[$nome_campo])==$mes) 
                 {
                   echo "<option value=" . $mes . " selected>".$mes."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $mes . ">".$mes."</option>";
                 }
               }  ?>
          </select>
          /
          <select class="select" alt="<? echo $descricao_campo; ?> - Ano" name="<? echo $nome_campo; ?>_ano">
            <? for($ano=date("Y")+2;$ano>=1900;$ano--)
               {
                 if (fwano($linha[$nome_campo])==$ano) 
                 {
                   echo "<option value=" . $ano . " selected>".$ano."</option>";
                 }
                 else
                 {
                   echo "<option value=" . $ano . ">".$ano."</option>";
                 }
               }  ?>
          </select></font></td>
      </tr>
    </table>

<? 

  }












  function data_int_edit($descricao_campo,$nome_campo)
  {

    global $linha; 

    

    $valor_ano = $linha[$nome_campo];
    $valor_ano = substr($valor_ano,0,4);
    $valor_ano = zerosaesquerda($valor_ano,4);  


    $valor_mes = $linha[$nome_campo];
    $valor_mes = substr($valor_mes,4,2);
    $valor_mes = zerosaesquerda($valor_mes,2);  


    $valor_dia = $linha[$nome_campo];
    $valor_dia = substr($valor_dia,-2);
    $valor_dia = zerosaesquerda($valor_dia,2);  



    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>'. $descricao_campo . ': &nbsp;</b></font></td>';
    echo '<td width="50%">';
    echo '<font class="preto_8">';
    echo '<select class="select" alt="' . $descricao_campo . ' - Dia" name="' . $nome_campo . '_dia">';
    for($dia=1;$dia<=31;$dia++)
    {
      if ($valor_dia==$dia) 
      {
        echo "<option value=" . $dia . " selected>".$dia."</option>";
      }
      else
      {
        echo "<option value=" . $dia . ">".$dia."</option>";
      }
    }

    echo '</select>';
    echo '
    ';
    echo ' / ';

    echo '<select class="select" alt="' . $descricao_campo . ' - M�s" name="' . $nome_campo . '_mes">';
    for($mes=1;$mes<=12;$mes++)
    {
      if ($valor_mes==$mes) 
      {
        echo "<option value=" . $mes . " selected>".$mes."</option>";
      }
      else
      {
        echo "<option value=" . $mes . ">".$mes."</option>";
      }
    }
    echo '</select>';
    echo '
    ';
    echo ' / ';

    echo '<select class="select" alt="' . $descricao_campo . ' - Ano" name="' . $nome_campo . '_ano">';
    for($ano=date("Y")+2;$ano>=1900;$ano--)
    {
      if ($valor_ano==$ano) 
      {
        echo "<option value=" . $ano . " selected>".$ano."</option>";
      }
      else
      {
        echo "<option value=" . $ano . ">".$ano."</option>";
      }
    }

    echo '</select></font></td>';
    echo '</tr>';
    echo '</table>';

  }















  function data_int_edit2($descricao_campo,$nome_campo,$validacao)
  {

    global $linha; 

    

    $valor_ano = $linha[$nome_campo];
    $valor_ano = substr($valor_ano,0,4);
    $valor_ano = zerosaesquerda($valor_ano,4);  


    $valor_mes = $linha[$nome_campo];
    $valor_mes = substr($valor_mes,4,2);
    $valor_mes = zerosaesquerda($valor_mes,2);  


    $valor_dia = $linha[$nome_campo];
    $valor_dia = substr($valor_dia,-2);
    $valor_dia = zerosaesquerda($valor_dia,2);  

    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo ;
    }
    else
    {
      $tag_title="no_required";
    }




    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">';
    echo '<tr valign="middle">';
    echo '<td width="50%" align="right">';
    echo '<font class="preto_8"><b>'. $descricao_campo . ': &nbsp;</b></font></td>';
    echo '<td width="50%">';
    echo '<font class="preto_8">';
    echo '<select class="select" alt="' . $descricao_campo . ' - Dia" title="' . $tag_title . '" name="' . $nome_campo . '_dia">';
    echo '<option value="">-</option>';
    for($dia=1;$dia<=31;$dia++)
    {
      if ($valor_dia==$dia) 
      {
        echo "<option value=" . $dia . " selected>".$dia."</option>";
      }
      else
      {
        echo "<option value=" . $dia . ">".$dia."</option>";
      }
      echo '
      ';
    }

    echo '</select>';
    echo '
    ';
    echo ' / ';

    echo '<select class="select" alt="' . $descricao_campo . ' - M�s" title="' . $tag_title . '" name="' . $nome_campo . '_mes">';
    echo '<option value="">-</option>';
    for($mes=1;$mes<=12;$mes++)
    {
      if ($valor_mes==$mes) 
      {
        echo "<option value=" . $mes . " selected>".$mes."</option>";
      }
      else
      {
        echo "<option value=" . $mes . ">".$mes."</option>";
      }
      echo '
      ';
    }
    echo '</select>';
    echo '
    ';
    echo ' / ';

    echo '<select class="select" alt="' . $descricao_campo . ' - Ano" title="' . $tag_title . '" name="' . $nome_campo . '_ano">';
    echo '<option value="">-</option>';
    for($ano=date("Y")+2;$ano>=1900;$ano--)
    {
      if ($valor_ano==$ano) 
      {
        echo "<option value=" . $ano . " selected>".$ano."</option>";
      }
      else
      {
        echo "<option value=" . $ano . ">".$ano."</option>";
      }
      echo '
      ';
    }

    echo '</select></font></td>';
    echo '</tr>';
    echo '</table>';

  }







?>