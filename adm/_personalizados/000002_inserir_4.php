<?php

  //Fun��es de marca��o dos checkbox
  echo "<script type='text/javascript' src='../_js/checkbox.js'></script>";
	




	// Sistema de permiss�o de acesso{
	
	echo "<br><br><br>";

	echo "<font class=preto_8><b>:::::::::::::::::::: Controle de Acesso aos Sistemas ::::::::::::::::::::</b></font>";

	echo "<br><br><br>";

	// SELECT PARA SELECIONAR SISTEMAS E ACESSOS DOS usuárioS

	$sql = " SELECT tabela_adm_sistemas.codigo_sistema, descricao_sistema ";
	$sql.= " FROM tabela_adm_sistemas";
	$sql.= " WHERE publicar=1";
	$rs_sistemas = mysql_query($sql, $conexao);

	$sql = " SELECT MAX(tabela_adm_sistemas.codigo_sistema) as codigo_sistema";
	$sql.= " FROM tabela_adm_sistemas";
	$sql.= " WHERE publicar=1 ";// ORDER BY codigo_sistema DESC LIMIT 1";
	$rs_maior_codigo_sistema = mysql_query($sql, $conexao);
	$linha_maior_codigo = mysql_fetch_array($rs_maior_codigo_sistema);
	$maior_codigo_sistema = $linha_maior_codigo['codigo_sistema'];
  
	$sql = " SELECT MAX(tabela_adm_acesso_tipos.codigo_tipo) as codigo_tipo";
	$sql.= " FROM tabela_adm_acesso_tipos";// ORDER BY codigo_tipo DESC LIMIT 1";
	$rs_maior_codigo_tipo = mysql_query($sql, $conexao);
	$linha_maior_codigo = mysql_fetch_array($rs_maior_codigo_tipo);
	$maior_codigo_tipo = $linha_maior_codigo['codigo_tipo'];
	  
	  
	echo "<table border='0' cellspacing='0' cellpadding='0' width='50%' align=center>";
	
		echo "<tr valign='middle'>";
				
			echo "<td width=50% align=left>";
			  
				echo "<font class='preto_8'>";
					
					echo '<font class="preto_8"><input id="marcacao_sistemas" onClick="marcarTodos('.$maior_codigo_sistema.', '.$maior_codigo_tipo.', \'marcacao_sistemas\')" type="checkbox" /> <b>Marcar/Desmarcar todos</b></font><br><br><br>';

				echo "</font>";
				
			echo "</td>";
			
		echo "</tr>";
	
	echo "</table>";
	  
	  
	  while($linha_sistema=mysql_fetch_array($rs_sistemas))
	  {

		$sql = " SELECT tabela_adm_acesso_tipos.codigo_tipo, descricao_tipo ";
		$sql.= " FROM tabela_adm_acesso_tipos";

		$rs_tipos = mysql_query($sql, $conexao);

		$quantidade_tipos = mysql_num_rows($rs_tipos);


	  ?>

		<table border="0" cellspacing="0" cellpadding="0" width="50%" align=center>
		  <tr valign="middle"> 
			<td width=50% align=left>
			  <font class="preto_8">
				<b>Sistema - <?php echo $linha_sistema['descricao_sistema']; ?>:</b>
			  </font></td>
		  </tr>

		  <tr valign="middle"> 
			<td height=10>&nbsp;</td>
		  </tr>

		  <tr valign="middle"> 
			
			<td width=50% align=left>
			  
			  <font class="preto_8">
	<?php
			  
			  echo '<font style="margin-left:0px;"><input id="marcacao_sistemas_'.$linha_sistema['codigo_sistema'].'" onClick="marcarTodosDoSistema('.$maior_codigo_tipo.', '.$linha_sistema["codigo_sistema"].', \'marcacao_sistemas\'); checkarCheckboxesDoSistema('.$linha_sistema["codigo_sistema"].', '.$maior_codigo_tipo.',  \'marcacao_sistemas\'); checkarCheckboxes('.$maior_codigo_sistema.', '.$maior_codigo_tipo.', \'marcacao_sistemas\');" type="checkbox" /> Todos</font>';
			  
				$id_checkbox = 1;
				while($linha_tipo=mysql_fetch_array($rs_tipos))
				{
				
					echo ' <input onClick="checkarCheckboxesDoSistema('.$linha_sistema["codigo_sistema"].', '.$maior_codigo_tipo.', \'marcacao_sistemas\'); checkarCheckboxes('.$maior_codigo_sistema.', '.$maior_codigo_tipo.', \'marcacao_sistemas\');" id="marcacao_sistemas_'.$linha_sistema['codigo_sistema'].'_'.$id_checkbox.'" type="checkbox" name=sistema_'.$linha_sistema['codigo_sistema'].'[] value="' . $linha_tipo['codigo_tipo'] . '"> ' . $linha_tipo['descricao_tipo'];
					$id_checkbox++;
					
				}

	?>
			  </font>
			  
			</td>
			
		  </tr>

		</table>
		<br><br>
	<?php
	  }  //} Fim do gerenciamento de permiss�es dos sistemas
	  










	  
	$sql = " SELECT tabela_adm_relatorios.codigo_relatorio, descricao_relatorio ";
	$sql.= " FROM tabela_adm_relatorios";
	$sql.= " WHERE publicar=1";
	$rs_relatorios = mysql_query($sql, $conexao);
  
	if (mysql_num_rows($rs_relatorios))
	{
	
	echo "<br><br><br>";

	echo "<font class=preto_8><b>:::::::::::::::::::: Controle de Acesso aos Relat�rios ::::::::::::::::::::</b></font>";

	echo "<br><br><br>";


	$sql = " SELECT MAX(tabela_adm_relatorios.codigo_relatorio) as codigo_relatorio ";
	$sql.= " FROM tabela_adm_relatorios";
	$sql.= " WHERE publicar=1 ";// ORDER BY codigo_relatorio DESC LIMIT 1";
	$rs_maior_codigo_relatorios = mysql_query($sql, $conexao);
	$linha_maior_codigo = mysql_fetch_array($rs_maior_codigo_relatorios);
	$maior_codigo_relatorio = $linha_maior_codigo['codigo_relatorio'];
	
	echo "<table border='0' cellspacing='0' cellpadding='0' width='50%' align=center>";
	
		echo "<tr valign='middle'>";
				
			echo "<td width=50% align=left>";
			  
				echo "<font class='preto_8'>";
					
					echo "<font class='preto_8'><input id='marcacao_relatorios' onClick='marcarTodos(".$maior_codigo_relatorio.", 1, this.id)' type='checkbox' /> <b>Marcar/Desmarcar todos</b></font><br><br><br>";

				echo "</font>";
				
			echo "</td>";
			
		echo "</tr>";
	
	echo "</table>";


	while($linha_relatorio=mysql_fetch_array($rs_relatorios))
	{
	
	$id_checkbox = 1;

  ?>

    <table border="0" cellspacing="0" cellpadding="0" width="50%" align=center>
      <tr valign="middle"> 
        <td width=50% align=left>
          <font class="preto_8">
            <b>Relat�rio - <?php echo $linha_relatorio['descricao_relatorio']; ?>:</b>
          </font></td>
      </tr>

      <tr valign="middle"> 
        <td height=10>&nbsp;</td>
      </tr>

      <tr valign="middle"> 
      
		<td width=50% align=left>
			
			<font class="preto_8">
<?php
				$checked = "";

				$sql = " SELECT * FROM ";
				$sql.= " tabela_adm_ass_usuario_relatorio";
				$sql.= " WHERE codigo_relatorio=" . $linha_relatorio['codigo_relatorio'];
				$rs_dados = mysql_query($sql,$conexao);

				if(mysql_num_rows($rs_dados)>0)
				{
					$checked = "";
				}

				echo ' <input onClick="checkarCheckboxes('.$maior_codigo_relatorio.', \'1\', \'marcacao_relatorios\');" id="marcacao_relatorios_'.$linha_relatorio['codigo_relatorio'].'_'.$id_checkbox.'" type="checkbox" ' . $checked . ' name="codigo_relatorio[]" value="' . $linha_relatorio['codigo_relatorio'] . '"> Leitura';

?>
			</font>
		  
		  </td>
      </tr>

    </table>
    <br><br>
<?php
  }

}

















  $sql = " SELECT MAX(codigo_grafico) as  codigo_grafico";
  $sql.= " FROM tabela_adm_graficos";
  $sql.= " WHERE publicar=1 ";// ORDER BY codigo_grafico DESC LIMIT 1";
  $rs_maior_codigo_grafico = mysql_query($sql, $conexao);
  $linha_maior_codigo_grafico = mysql_fetch_array($rs_maior_codigo_grafico);
  $maior_codigo_grafico = $linha_maior_codigo_grafico['codigo_grafico'];
  $maior_codigo_tipo_grafico = 1;


  
  $sql = " SELECT tabela_adm_graficos.codigo_grafico, descricao_grafico ";
  $sql.= " FROM tabela_adm_graficos";
  $sql.= " WHERE publicar=1";
  $rs_graficos = mysql_query($sql, $conexao);
  
  if (mysql_num_rows($rs_graficos))
  {
  
		echo "<br><br><br>";

		echo "<font class=preto_8><b>:::::::::::::::::::: Controle de Acesso aos Gr�ficos ::::::::::::::::::::</b></font>";

		echo "<br><br><br>";

		$sql = " SELECT MAX(tabela_adm_graficos.codigo_grafico) as codigo_grafico ";
		$sql.= " FROM tabela_adm_graficos";
		$sql.= " WHERE publicar=1 ";// ORDER BY codigo_grafico DESC LIMIT 1";
		$rs_maior_codigo_graficos = mysql_query($sql, $conexao);
		$linha_maior_codigo = mysql_fetch_array($rs_maior_codigo_graficos);
		$maior_codigo_grafico = $linha_maior_codigo['codigo_grafico'];
		
		echo "<table border='0' cellspacing='0' cellpadding='0' width='50%' align=center>";
	
			echo "<tr valign='middle'>";
					
				echo "<td width=50% align=left>";
				  
					echo "<font class='preto_8'>";
						
						echo "<font class='preto_8'><input id='marcacao_graficos' onClick='marcarTodos(".$maior_codigo_grafico.", 1, this.id)' type='checkbox' /> <b>Marcar/Desmarcar todos</b></font><br><br><br>";

					echo "</font>";
					
				echo "</td>";
				
			echo "</tr>";
	
		echo "</table>";


		while($linha_grafico=mysql_fetch_array($rs_graficos))
		{
		
			$id_checkbox = 1;

  ?>
			<table border="0" cellspacing="0" cellpadding="0" width="50%" align=center>
			
				<tr valign="middle"> 
				
					<td width=50% align=left>
					
						<font class="preto_8">
						
							<b>Gr�fico - <?php echo $linha_grafico['descricao_grafico']; ?>:</b>
						
						</font>
					
					</td>
				
				</tr>

			
			
				<tr valign="middle"> 
				
					<td height=10>&nbsp;</td>
				
				</tr>

				<tr valign="middle"> 
				
					<td width=50% align=left>
					
						<font class="preto_8">
<?php
							$checked = "";

							$sql = " SELECT * FROM ";
							$sql.= " tabela_adm_ass_usuario_grafico";
							$sql.= " WHERE codigo_grafico=" . $linha_grafico['codigo_grafico'];
							$rs_dados = mysql_query($sql,$conexao);

							if(mysql_num_rows($rs_dados)>0)
							{
							  $checked = "";
							}

							echo ' <input onClick="checkarCheckboxes('.$maior_codigo_grafico.', \'1\', \'marcacao_graficos\');" id="marcacao_graficos_'.$linha_grafico['codigo_grafico'].'_'.$id_checkbox.'" type="checkbox" ' . $checked . ' name="codigo_grafico[]" value="' . $linha_grafico['codigo_grafico'] . '"> Leitura';

?>
						</font>
				  
					</td>
					
				</tr>

			</table>
			
			<br><br>
<?php
		}
		
		echo "<script type='text/javascript'>checkarCheckboxes('".$maior_codigo_grafico."', '".$maior_codigo_tipo_grafico."', 'marcacao_graficos');</script>";


	}







  $sql = " SELECT MAX(codigo_painel) as  codigo_painel ";
  $sql.= " FROM tabela_adm_paineis";
  $sql.= " WHERE publicar=1 ";//" ORDER BY codigo_painel DESC LIMIT 1";
  $rs_maior_codigo_painel = mysql_query($sql, $conexao);
  $linha_maior_codigo_painel = mysql_fetch_array($rs_maior_codigo_painel);
  $maior_codigo_painel = $linha_maior_codigo_painel['codigo_painel'];
  $maior_codigo_tipo_painel = 1;


  
  $sql = " SELECT tabela_adm_paineis.codigo_painel, descricao_painel ";
  $sql.= " FROM tabela_adm_paineis";
  $sql.= " WHERE publicar=1";
  $rs_paineis = mysql_query($sql, $conexao);
  
  if (mysql_num_rows($rs_paineis))
  {
  
		echo "<br><br><br>";

		echo "<font class=preto_8><b>:::::::::::::::::::: Controle de Acesso aos Paineis ::::::::::::::::::::</b></font>";

		echo "<br><br><br>";

		$sql = " SELECT MAX(tabela_adm_paineis.codigo_painel) as codigo_painel ";
		$sql.= " FROM tabela_adm_paineis";
		$sql.= " WHERE publicar=1 ";// ORDER BY codigo_painel DESC LIMIT 1";
		$rs_maior_codigo_paineis = mysql_query($sql, $conexao);
		$linha_maior_codigo = mysql_fetch_array($rs_maior_codigo_paineis);
		$maior_codigo_painel = $linha_maior_codigo['codigo_painel'];
		
		echo "<table border='0' cellspacing='0' cellpadding='0' width='50%' align=center>";
	
			echo "<tr valign='middle'>";
					
				echo "<td width=50% align=left>";
				  
					echo "<font class='preto_8'>";
						
						echo "<font class='preto_8'><input id='marcacao_paineis' onClick='marcarTodos(".$maior_codigo_painel.", 1, this.id)' type='checkbox' /> <b>Marcar/Desmarcar todos</b></font><br><br><br>";

					echo "</font>";
					
				echo "</td>";
				
			echo "</tr>";
	
		echo "</table>";


		while($linha_painel=mysql_fetch_array($rs_paineis))
		{
		
			$id_checkbox = 1;

  ?>
			<table border="0" cellspacing="0" cellpadding="0" width="50%" align=center>
			
				<tr valign="middle"> 
				
					<td width=50% align=left>
					
						<font class="preto_8">
						
							<b>Gr�fico - <?php echo $linha_painel['descricao_painel']; ?>:</b>
						
						</font>
					
					</td>
				
				</tr>

			
			
				<tr valign="middle"> 
				
					<td height=10>&nbsp;</td>
				
				</tr>

				<tr valign="middle"> 
				
					<td width=50% align=left>
					
						<font class="preto_8">
<?php
							$checked = "";

							$sql = " SELECT * FROM ";
							$sql.= " tabela_adm_ass_usuario_painel";
							$sql.= " WHERE codigo_painel=" . $linha_painel['codigo_painel'];
							$rs_dados = mysql_query($sql,$conexao);

							if(mysql_num_rows($rs_dados)>0)
							{
							  $checked = "";
							}

							echo ' <input onClick="checkarCheckboxes('.$maior_codigo_painel.', \'1\', \'marcacao_paineis\');" id="marcacao_paineis_'.$linha_painel['codigo_painel'].'_'.$id_checkbox.'" type="checkbox" ' . $checked . ' name="codigo_painel[]" value="' . $linha_painel['codigo_painel'] . '"> Leitura';

?>
						</font>
				  
					</td>
					
				</tr>

			</table>
			
			<br><br>
<?php
		}
		
		echo "<script type='text/javascript'>checkarCheckboxes('".$maior_codigo_painel."', '".$maior_codigo_tipo_painel."', 'marcacao_paineis');</script>";


	}









?>