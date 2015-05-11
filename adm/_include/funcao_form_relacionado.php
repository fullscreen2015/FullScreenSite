<?php

  function input_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" name="' . $nome_campo . '[]">';
    return $codigo;
  }



  function edit_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    global $linha_relacionado;  

    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" value="' . $linha_relacionado[$nome_campo] . '" name="' . $nome_campo . '_rel[]">';
    return $codigo;
  }



  function edit_relacionado2($descricao_campo,$nome_campo,$tam,$validacao)
  {  
    global $linha_relacionado;  

    $valor_alt="";
    if($validacao=="")
    { 
      $valor_alt = "no_required";
    }


    $codigo = '<input alt="' . $valor_alt . '" type="text" maxlength="' . $tam . '" class="input" value="' . $linha_relacionado[$nome_campo] . '" name="' . $nome_campo . '_rel[]">';
    return $codigo;
  }





  function input_check_relacionado($nome_campo)
  {

    $codigo = '<select alt="no_required" title="no_required" class="select" name="' . $nome_campo. '_novo[]">';
    $codigo.= '<option value="" selected >-</option>';
    $codigo.= '<option value="0">Não</option>';
    $codigo.= '<option value="1">Sim</option>';
    $codigo.= '</select>';

    return $codigo;
  }




  function edit_check_relacionado($nome_campo,$pos)
  {
    global $linha_relacionado;  

    $codigo = '<input type="checkbox" value="0" name="' . $nome_campo . '_rel_' . $pos . '"';
    if ($linha_relacionado[$nome_campo]==1) 
    {
      $codigo.= ' checked '; 
    }
    $codigo.= '>';

    return $codigo;
  }



  function edit_check_relacionado2($nome_campo)
  {
    global $linha_relacionado;  


    $codigo = '<select class="select" name="' . $nome_campo. '_rel[]">';

    $checked = "";
    if ($linha_relacionado[$nome_campo]==0) 
    {
      $checked = "selected";
    }
    $codigo.= '<option value="0" ' . $checked . '>Não</option>';

    $checked="";
    if ($linha_relacionado[$nome_campo]==1) 
    {
      $checked="selected";
    }
    $codigo.= '<option value="1" '.$checked.'>Sim</option>';


    $codigo.= '</select>';


    return $codigo;
  }




  function input_inteiro_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" name="' . $nome_campo . '[]" onkeyup="so_numero(this);" onkeydown="so_numero(this);" onblur="so_numero(this);">';
    return $codigo;
  }


  function edit_inteiro_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    global $linha_relacionado;  

    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" value="' . $linha_relacionado[$nome_campo] . '" name="' . $nome_campo . '_rel[]"  onkeyup="so_numero(this);" onkeydown="so_numero(this);" onblur="so_numero(this);">';
    return $codigo;
  }


  function edit_inteiro_relacionado2($descricao_campo,$nome_campo,$tam,$validacao)
  {  
    global $linha_relacionado;  

    $valor_alt="";
    if($validacao=="")
    { 
      $valor_alt = "no_required";
    }


    $codigo = '<input alt="' . $valor_alt . '" type="text" maxlength="' . $tam . '" class="input" value="' . $linha_relacionado[$nome_campo] . '" name="' . $nome_campo . '_rel[]"  onkeyup="so_numero(this);" onkeydown="so_numero(this);" onblur="so_numero(this);">';
    return $codigo;
  }



  function input_moeda_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    global $conexao;  
    global $linha_relacionado;  

    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" value="" name="' . $nome_campo . '[]"  onkeypress="return mascara(this,';
    $codigo.= "\'num_virgula\'";
    $codigo.= ',event);">';

    return $codigo;
  }

  function edit_moeda_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    global $conexao;  
    global $linha_relacionado;  

    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" value="' . number_format($linha_relacionado[$nome_campo],2,',','.') . '" name="' . $nome_campo . '_rel[]"  onkeypress="return mascara(this,';
    $codigo.= "\'num_virgula\'";
    $codigo.= ',event);">';

    return $codigo;
  }


  function edit_moeda_relacionado2($descricao_campo,$nome_campo,$tam,$validacao)
  {  
    global $conexao;  
    global $linha_relacionado;  

    $valor_alt="";
    if($validacao=="")
    { 
      $valor_alt = "no_required";
    }


    $codigo = '<input alt="' . $valor_alt . '" type="text" maxlength="' . $tam . '" class="input" value="' . number_format($linha_relacionado[$nome_campo],2,',','.') . '" name="' . $nome_campo . '_rel[]"  onkeypress="return mascara(this,';
    $codigo.= "\'num_virgula\'";
    $codigo.= ',event);">';

    return $codigo;
  }

  function input_real_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    global $conexao;  
    global $linha_relacionado;  

    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" value="" name="' . $nome_campo . '[]"  onkeypress="return mascara(this,';
    $codigo.= "\'num_virgula\'";
    $codigo.= ',event);">';

    return $codigo;
  }

  function edit_real_relacionado($descricao_campo,$nome_campo,$tam)
  {  
    global $conexao;  
    global $linha_relacionado;  

    $codigo = '<input alt="no_required" type="text" maxlength="' . $tam . '" class="input" value="' . number_format($linha_relacionado[$nome_campo],3,',','.') . '" name="' . $nome_campo . '_rel[]"  onkeypress="return mascara(this,';
    $codigo.= "\'num_virgula\'";
    $codigo.= ',event);">';

    return $codigo;
  }

  function edit_real_relacionado2($descricao_campo,$nome_campo,$tam,$validacao)
  {  
    global $conexao;  
    global $linha_relacionado;  

    $valor_alt="";
    if($validacao=="")
    { 
      $valor_alt = "no_required";
    }


    $codigo = '<input alt="' . $valor_alt . '" type="text" maxlength="' . $tam . '" class="input" value="' . number_format($linha_relacionado[$nome_campo],3,',','.') . '" name="' . $nome_campo . '_rel[]"  onkeypress="return mascara(this,';
    $codigo.= "\'num_virgula\'";
    $codigo.= ',event);">';

    return $codigo;
  }




  function select_edit_relacionado($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$sistema_exclusao)
  {

    global $conexao;
    global $linha_relacionado;

    $sql = " SELECT DISTINCT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= " ativo, ";
    }


    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;



    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome
    if($sistema_exclusao==1)
    {
      $sql.= " WHERE (ativo=1)";
      $sql.= " OR (" . $nome_campo_codigo. "=" . $linha_relacionado[$nome_campo_codigo] . ")";
    }


    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

    $codigo = '<select alt="no_required" class="select" name="' . $nome_campo_codigo . '_rel[]">';
    $codigo.= '<option value="">Selecione</option>';

    while ($linha_itens = mysql_fetch_array($rs_itens))
    {  

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }

        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
      }

      //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

      if($sistema_exclusao==1)
      {
        if($linha_itens['ativo']==0)
        {
          $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
        }
      }


      $codigo.= '<option value="' . $linha_itens[$nome_campo_codigo] . '"';
      if ($linha_itens[$nome_campo_codigo]==$linha_relacionado[$nome_campo_codigo]) 
      {
        $codigo.= " selected "; 
      }
      $codigo.= '>' . $valores_para_mostrar . '</option>';
      $codigo.= '
';

    }

    $codigo.= '</select>';

    return $codigo;
  }













  function select_edit_relacionado2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$sistema_exclusao,$validacao)
  {

    global $conexao;
    global $linha_relacionado;


    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo;
    }
    else
    {
      $tag_title = "no_required";
    }




    $sql = " SELECT DISTINCT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= " ativo, ";
    }


    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;



    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome
    if($sistema_exclusao==1)
    {
      $sql.= " WHERE (ativo=1)";
      $sql.= " OR (" . $nome_campo_codigo. "=" . $linha_relacionado[$nome_campo_codigo] . ")";
    }


    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

    $codigo = '<select alt="' . $descricao_campo . '" title="' . $tag_title . '" class="select" name="' . $nome_campo_codigo . '_rel[]">';
    $codigo.= '<option value="">Selecione</option>';

    while ($linha_itens = mysql_fetch_array($rs_itens))
    {  

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }

        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
      }

      //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

      if($sistema_exclusao==1)
      {
        if($linha_itens['ativo']==0)
        {
          $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
        }
      }


      $codigo.= '<option value="' . $linha_itens[$nome_campo_codigo] . '"';
      if ($linha_itens[$nome_campo_codigo]==$linha_relacionado[$nome_campo_codigo]) 
      {
        $codigo.= " selected "; 
      }
      $codigo.= '>' . $valores_para_mostrar . '</option>';
      $codigo.= '
';

    }

    $codigo.= '</select>';

    return $codigo;
  }







  
  

  function select_relacionado($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$sistema_exclusao)
  {

    global $conexao;
    global $linha_relacionado;

    $sql = " SELECT DISTINCT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {
      $sql.= " ativo, ";
    }


    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    if($sistema_exclusao==1)
    {

      if(substr_count($sql, 'WHERE'))
      {
        $sql.= " AND ativo=1 ";
      }
      else
      {
        $sql.= " WHERE ativo=1 ";
      }

    }

    $sql.= " ORDER BY " . $nome_campo_descricao;

    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

    $codigo = '<select alt="no_required" title="no_required" class="select" name="' . $nome_campo_codigo . '_novo[]">';
    $codigo.= '<option value="">Selecione</option>';

    while ($linha_itens = mysql_fetch_array($rs_itens))
    {  

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }

        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
      }

      //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

      if($sistema_exclusao==1)
      {
        if($linha_itens['ativo']==0)
        {
          $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
        }
      }


      $codigo.= '<option value="' . $linha_itens[$nome_campo_codigo] . '">';
      $codigo.= $valores_para_mostrar . '</option>';
      $codigo.= '
';

    }

    $codigo.= '</select>';

    return $codigo;

  }


  
  
  // A fun��o "select_relacionado2" foi criada para ser utilizada quando o nome da chave-estrangeira � diferente da chave-prim�ria da outra tabela 
  // ent�o foi inserido mais um campo chamado $nome_campo_codigo_primario

  function select_relacionado2($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao)
  {

    global $conexao;
  


    $tag_title = "no_required";





    $sql = "SELECT ".$nome_campo_codigo." , ".$nome_campo_descricao." FROM ".$nome_tabela;


    if($sistema_exclusao==1)
    {

   
      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        foreach($tabelas AS $nome_da_tabela)
        {
          $sql.= " AND ". trim($nome_da_tabela).".ativo=1 ";
        }

      }
       else
      {
        $sql.= " WHERE ativo=1 ";
      }
    }









    $sql.= " ORDER BY " . $nome_campo_descricao;
    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  ?>

    
          <select class="select" alt="<? echo $descricao_campo; ?>" title="<? echo $tag_title; ?>" name="<? echo $nome_campo_codigo_primario; ?>_novo[]">
            <option value="">Selecione</option>

<?          while ($linha_itens = mysql_fetch_array($rs_itens))
            {  



              $valores_para_mostrar="";

              foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
              {
                $tracinho = "";

                if($valores_para_mostrar!="")
                {
                  $tracinho = " - ";
                }

                $valores_para_mostrar.= $tracinho;
                $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
              }

              // para o caso de se usar o nome da tabela antes do nome do campo na configura��o. Ex: tabela_adm_usuarios.codigo_usuario
              // vamos limpar o nome da tabela

              $nome_campo_codigo_limpo = $nome_campo_codigo;
              $posicao = strcspn($nome_campo_codigo_limpo,'.');
              $nome_campo_codigo_limpo = substr($nome_campo_codigo_limpo, $posicao+1);
?>
 
              <option value="<? echo $linha_itens[$nome_campo_codigo_limpo];  ?>"><? echo $valores_para_mostrar;  ?></option>

<?          }  ?>

          </select>

<? 

  }








  
  
  
  
  

function input_data_int_relacionado($nome_campo,$descricao_campo,$indice)
{

 

	$valor_ano = date("Y");
	$valor_mes = date("m");
	$valor_dia = date("d");



	$codigo = '<div style="width:200px;">';

	$codigo.= '<input type="hidden" id="' . $nome_campo . '_' . $indice . '" name="' . $nome_campo . '_novo[]" value="">';
	
	$funcao_js = "javascript:relacionado_atualiza_data('" . $nome_campo. "'," . $indice . ");";
	

	$codigo.= '<select onchange="' . $funcao_js . '" class="select" alt="' . $descricao_campo . ' - Dia" id="' . $nome_campo . '_dia_' . $indice . '" name="' . $nome_campo . '_dia_' . $indice . '">';
		
	for($dia=1;$dia<=31;$dia++)
	{
		if ($valor_dia==$dia) 
		{
			$codigo.= "<option value=" . $dia . " selected>" . $dia . "</option>";
		}
		else
		{
			$codigo.= "<option value=" . $dia . ">" . $dia . "</option>";
		}
	}  
	$codigo.= '</select>';
	
	$codigo.= ' <select onchange="' . $funcao_js . '" class="select" alt="' . $descricao_campo . ' - M�s" id="' . $nome_campo . '_mes_' . $indice . '" name="' . $nome_campo . '_mes_' . $indice . '">';
	for($mes=1;$mes<=12;$mes++)
	{
		if ($valor_mes==$mes) 
		{
			$codigo.= "<option value=" . $mes . " selected>".$mes."</option>";
		}
		else
		{
			$codigo.= "<option value=" . $mes . ">".$mes."</option>";
		}
	}
    $codigo.= '</select>';
	
	$codigo.= ' <select onchange="' . $funcao_js . '" class="select" alt="' . $descricao_campo . ' - Ano" id="' . $nome_campo . '_ano_' . $indice . '" name="' . $nome_campo . '_ano_' . $indice . '">';
	for($ano=date("Y")+2;$ano>=1900;$ano--)
	{
		if ($valor_ano==$ano) 
		{
			$codigo.= "<option value=" . $ano . " selected>" . $ano . "</option>";
		}
		else
		{
			$codigo.= "<option value=" . $ano . ">" . $ano . "</option>";
		}
	}
    $codigo.= '</select>';

    $codigo.= '</div>';	
	
	return $codigo;	

  }

  
  

function edit_data_int_relacionado($nome_campo,$descricao_campo,$indice)
{

	global $linha_relacionado; 

    

	$valor_ano = $linha_relacionado[$nome_campo];
	$valor_ano = substr($valor_ano,0,4);
	$valor_ano = zerosaesquerda($valor_ano,4);  


	$valor_mes = $linha_relacionado[$nome_campo];
	$valor_mes = substr($valor_mes,4,2);
	$valor_mes = zerosaesquerda($valor_mes,2);  


	$valor_dia = $linha_relacionado[$nome_campo];
	$valor_dia = substr($valor_dia,-2);
	$valor_dia = zerosaesquerda($valor_dia,2);  


	$codigo = '<div style="width:200px;">';

	$codigo.= '<input type="hidden" id="' . $nome_campo . '_' . $indice . '" name="' . $nome_campo . '[]" value="' . $linha_relacionado[$nome_campo] . '">';

	$funcao_js = "javascript:relacionado_atualiza_data('" . $nome_campo. "'," . $indice . ");";
	
	$codigo.= '<select onchange="' . $funcao_js . '" class="select" alt="' . $descricao_campo . ' - Dia" id="' . $nome_campo . '_dia_' . $indice . '" name="' . $nome_campo . '_dia_' . $indice . '">';
	for($dia=1;$dia<=31;$dia++)
	{
		if ($valor_dia==$dia) 
		{
			$codigo.= "<option value=" . zerosaesquerda($dia,2) . " selected>" . $dia . "</option>";
		}
		else
		{
			$codigo.= "<option value=" . zerosaesquerda($dia,2) . ">" . $dia . "</option>";
		}
	}  
	$codigo.= '</select>';
	
	$codigo.= ' <select onchange="' . $funcao_js . '" class="select" alt="' . $descricao_campo . ' - M�s" id="' . $nome_campo . '_mes_' . $indice . '" name="' . $nome_campo . '_mes_' . $indice . '">';
	for($mes=1;$mes<=12;$mes++)
	{
		if ($valor_mes==$mes) 
		{
			$codigo.= "<option value=" . zerosaesquerda($mes,2) . " selected>".$mes."</option>";
		}
		else
		{
			$codigo.= "<option value=" . zerosaesquerda($mes,2) . ">".$mes."</option>";
		}
	}
    $codigo.= '</select>';
	
	$codigo.= ' <select onchange="' . $funcao_js . '" class="select" alt="' . $descricao_campo . ' - Ano" id="' . $nome_campo . '_ano_' . $indice . '" name="' . $nome_campo . '_ano_' . $indice . '">';
	for($ano=date("Y")+2;$ano>=1900;$ano--)
	{
		if ($valor_ano==$ano) 
		{
			$codigo.= "<option value=" . zerosaesquerda($ano,4) . " selected>" . $ano . "</option>";
		}
		else
		{
			$codigo.= "<option value=" . zerosaesquerda($ano,4) . ">" . $ano . "</option>";
		}
	}
    $codigo.= '</select>';

    $codigo.= '</div>';	
	
	return $codigo;	

  }



  
  
  
  
  
  
  
  // esta fun��o foi criada para ser utilizada no arquivo "editar_dados.php"
  // ela mostra um select com apenas uma posição, que � a posição atual da chave estrangeira.
  // quando clicado, um javascript chama um ajax com o select completo com todas as op��es da tabela estrangeira.
  // o objetivo desta fun��o � aumentar a velocidade do sistema, já que, em alguns casos, as tabelas estrangeiras
  // podem ter milhares de registros e todos eles eram exibidos todas as vezes que iamos editar um registro.
  // agora todos os registros só s�o exibidos quando queremos, realmente, alterar este campo espec�fico.


  function select_edit_ajax_relacionado($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$cont,$modulo,$y,$largura)
  {

    global $conexao;
    global $linha_relacionado;


		  
    // pegando valor m�ximo atual da tabela, para depois saber se realmente
	// foi inserido um novo registro e assim
    // já mostrar o select selecionado na posição nova
	  
    $nome_tabela2 = explode(",",$nome_tabela);
    $nome_tabela2 = $nome_tabela2[0];
    $sql_novo = "SELECT MAX("  . $nome_campo_codigo . ") as ultimo_codigo FROM " . $nome_tabela2;
    if($sistema_exclusao==1)
    {
      $sql_novo.= " WHERE ativo=1 ";
    }

    $rs_ultimo_codigo = mysql_query($sql_novo, $conexao);
	  
    $linha_ultimo_codigo = mysql_fetch_array($rs_ultimo_codigo);
    $ultimo_codigo = $linha_ultimo_codigo['ultimo_codigo'];


	
  
  
  
    $sql_ce = "SELECT "  . $nome_campo_descricao . " FROM " . $nome_tabela;

    if(substr_count($sql_ce, 'WHERE'))
    {
      $sql_ce.= " AND ";
    }
    else
    {
      $sql_ce.= " WHERE ";
    }


    $sql_ce.=  $nome_campo_codigo . "=" . $linha_relacionado[$nome_campo_codigo_primario];




    $rs_ce = mysql_query($sql_ce, $conexao);
    $linha_ce = mysql_fetch_array($rs_ce);



    $campos_para_mostrar = explode(",",$nome_campo_descricao);

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


    $id = $nome_campo_codigo_primario . "_" . $linha_relacionado[$nome_campo_codigo_primario] . "_" . $y;
    $id2 = "'" . $id . "'";


    $mod = "'" . $modulo . "'";

    echo '
	
	';
    echo '<span style="float:left; text-align:left; width:' . $largura .'px;" id="div_' . $id . '">';

    echo '<select ';
    echo 'onClick="javascript:mostrar_select_relacionado(' . $cont . ',' . $id2 . ',' . $linha_relacionado[$nome_campo_codigo_primario] . ',' . $ultimo_codigo . ',' . $mod . ');" ';
    echo 'id="' . $id . '"  class="select" alt="' . $descricao_campo . '" title="' . $descricao_campo . '" name="' . $nome_campo_codigo_primario . '_rel[]">';

    echo '<option value="' . $linha_relacionado[$nome_campo_codigo_primario] . '">' . $valores_para_mostrar . '  [clique para editar]</option>';
    echo '</select>';

    echo '</span>';
    echo '
	
	';


  }

  
  
  
  
  
  
  
  
  
  
  // esta fun��o foi criada para ser utilizada no arquivo "editar_dados.php"
  // ela mostra um select com apenas uma posição, que � a posição atual da chave estrangeira.
  // quando clicado, um javascript chama um ajax com o select completo com todas as op��es da tabela estrangeira.
  // o objetivo desta fun��o � aumentar a velocidade do sistema, já que, em alguns casos, as tabelas estrangeiras
  // podem ter milhares de registros e todos eles eram exibidos todas as vezes que iamos editar um registro.
  // agora todos os registros só s�o exibidos quando queremos, realmente, alterar este campo espec�fico.


  function select_inserir_ajax_relacionado($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$cont,$modulo,$y)
  {

    global $conexao;
    global $linha_relacionado;


    $id = $nome_campo_codigo_primario . "_" . $linha_relacionado[$nome_campo_codigo_primario] . "_" . $y;
    $id2 = "'" . $id . "'";


    $mod = "'" . $modulo . "'";

    echo '
	
	';
    echo '<span style="float:left;" id="div_' . $id . '">';

    echo '<select ';
    echo 'onClick="javascript:mostrar_select_relacionado_inserir(' . $cont . ',' . $id2 . ',' . $mod . ');" ';
    echo 'id="' . $id . '"  class="select" alt="no_required" title="no_required" name="' . $nome_campo_codigo_primario . '_novo[]">';

    echo '<option value="">[clique para editar]</option>';
    echo '</select>';

    echo '</span>';
    echo '
	
	';


  }

  
  
  
 
  // esta vers�o foi criada para ser chamada pelo arquivo "ajax_editar_dados_mostrar_select.php"
  // ela tem um par�metro adicional chamado "valor_atual", que não existia na vers�o anterior, pois o valor vinha direto do array original ($linha)
  // como agora ela vem de um arquivo ajax, este valor não pode mais ser retirado do array original do arquivo "editar_dados.php"

  function select_edit_relacionado3($descricao_campo,$nome_tabela,$nome_campo_codigo,$nome_campo_descricao,$nome_campo_codigo_primario,$sistema_exclusao,$validacao,$valor_atual,$modulo,$ultimo_codigo)
  {


    global $conexao;
	
	
    // selecionar o �ltimo c�digo registrado desta tabela
    // assim, podemos deixar selecionado o �ltimo registo feito 
    // no caso da atualiza��o via colorbox
	
    $valor_atual = "$valor_atual";
	
    $nome_tabela2 = explode(",",$nome_tabela);
    $nome_tabela2 = $nome_tabela2[0];
    $sql_novo = "SELECT MAX("  . $nome_campo_codigo . ") as ultimo_codigo FROM " . $nome_tabela2;
    if($sistema_exclusao==1)
    {
      $sql_novo.= " WHERE ativo=1 ";
    }

    $rs_ultimo_codigo = mysql_query($sql_novo, $conexao);
	  
    $linha_ultimo_codigo = mysql_fetch_array($rs_ultimo_codigo);

    if((int)$linha_ultimo_codigo['ultimo_codigo']>(int)$ultimo_codigo)
    {
      $valor_atual = $linha_ultimo_codigo['ultimo_codigo'];
    }

	
    if($validacao=="obrigatorio")
    {
      $tag_title = $descricao_campo;
    }
    else
    {
      $tag_title = "no_required";
    }


    $sql = " SELECT ";


    //  Caso exista o sistema de exclusão por ativa��o, inserimos o campo "ativo" no SQL

    if($sistema_exclusao==1)
    {



      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);
        foreach($tabelas AS $nome_da_tabela)
        {
          $sql.= " " . trim($nome_da_tabela).".ativo, ";
        }

      }
       else
      {
        $sql.= " ativo, ";
      }




    }


    $sql.= $nome_campo_codigo . " , " . $nome_campo_descricao . " FROM " . $nome_tabela;


    // caso exista sistema de exclusão no m�dulo da chave estrangeira,
    // o select só ir� mostrar a opção caso esteja ativa ou
    // caso ela não esteja ativa, mas seja a opção atualmente selecionada
    // neste segundo caso, a opção ter� a express�o (REGISTRO EXCLU�DO) ao lado do nome
    if($sistema_exclusao==1)
    {



      $tabelas = $nome_tabela;
      if(substr_count($tabelas, 'WHERE'))
      {
        $posicao = strcspn($tabelas,'WHERE');
        $tabelas = substr($tabelas, 0,$posicao);
        $tabelas = explode(",",$tabelas);

        $sql.= " AND ( " ;
        $sql2="";
        foreach($tabelas AS $nome_da_tabela)
        {
          if($sql2!="")
          {
            $sql2.= " AND ";
          }
          $sql2.= trim($nome_da_tabela) . ".ativo=1 ";
        }
        $sql.= $sql2 ;
        $sql.= " )" ;

      }
       else
      {
        $sql.= " WHERE (ativo=1) ";
      }








      $sql.= " OR (" . $nome_campo_codigo . "=" . $valor_atual . ")";
    }

    $sql.= " GROUP BY " . $nome_campo_codigo;
    $sql.= " ORDER BY " . $nome_campo_descricao;



    $rs_itens = mysql_query($sql, $conexao);

    $campos_para_mostrar = explode(",",$nome_campo_descricao);

  


    echo '<select class="select" alt="' . $descricao_campo . '" title="' . $tag_title . '"';
    echo ' name="' . $nome_campo_codigo_primario;
    echo "_rel[]";
    echo '"';
    echo ' id="select_' . $nome_campo_codigo_primario . '">
	';
	
    echo '<option value="">Selecione</option>';

       
    while ($linha_itens = mysql_fetch_array($rs_itens))
    {  

      $valores_para_mostrar="";

      foreach($campos_para_mostrar AS $nome_do_campo_para_mostrar)
      {
        $tracinho = "";

        if($valores_para_mostrar!="")
        {
          $tracinho = " - ";
        }

        $valores_para_mostrar.= $tracinho;
        $valores_para_mostrar.= $linha_itens["$nome_do_campo_para_mostrar"];
      }



      //  Caso exista o sistema de exclusão por ativa��o, mostramos a express�o "REGISTRO EXCLU�DO ao lado da descri��o"

      if($sistema_exclusao==1)
      {

        if($linha_itens['ativo']==0)
        {
          $valores_para_mostrar.= " (REGISTRO EXCLU�DO)";
        }
      }



      // para o caso de se usar o nome da tabela antes do nome do campo na configura��o. Ex: tabela_adm_usuarios.codigo_usuario
      // vamos limpar o nome da tabela

      $nome_campo_codigo_limpo = $nome_campo_codigo;
      if(strstr($nome_campo_codigo,"."))
      {
        $posicao = strcspn($nome_campo_codigo_limpo,'.');
        $nome_campo_codigo_limpo = substr($nome_campo_codigo_limpo, $posicao+1);
      }


      $selected = ""; 
	  
	  if($linha_itens[$nome_campo_codigo_limpo]==$valor_atual) 
	  {
	    $selected = " selected "; 
	  } 
      echo '<option value="' . $linha_itens[$nome_campo_codigo_limpo] . '" ' . $selected . '>' . $valores_para_mostrar . '</option>
	  ';

    }  

    echo '</select>
	';

  }

  

?>