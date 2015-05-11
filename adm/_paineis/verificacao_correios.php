 <?php

	header("Content-Type: text/html; charset=ISO-8859-1",true);

 	include("../../include/sistema_conexao.php");
	include("../../include/sistema_funcionamento_frete.php");

  echo '<link rel="stylesheet" href="../_css/paineis.css" type="text/css" />
  ';



  $sql = " SELECT * FROM tabela_ec_tipos_envio WHERE publicar=1 AND ativo=1 ORDER BY tipo_padrao";
 	$cont=0;
 	$array_erros=null;
	$rs_tipos_envio = mysql_query($sql,$conexao);
	$tipos_disponiveis=mysql_num_rows($rs_tipos_envio);

	while($linha_tipo_envio=mysql_fetch_array($rs_tipos_envio))
 	{
		//$resultado_frete = FwCalcularFrete($codigo_correios, $cep_calculo, $cep_origem, $peso_calculo, $comprimento, $largura, $altura);

		$resultado_teste = FwVerificarFuncionamento($linha_tipo_envio['codigo_correios'], '28613060', '28613060', '5', '17', '12', '4');

		//print_r($resultado_teste);

		if(($resultado_teste['erro']!=0)&& (($resultado_teste['erro']==99)||($resultado_teste['erro']==7)))
		{
			$cont++;
			$array_erros[]=$resultado_teste['erro'];
		}

	}

	if($cont==$tipos_disponiveis)
	{
	$disponivel=0;	
	}
	else
	{
	$disponivel=1;
	}

	echo '<h1>Webservice dos Correios</h1>';

		echo "<table border='0' align='left' whith='300' cellspacing='2'>";

		echo "<tr>";
			echo "<th colspan='2'>";
				echo "&nbsp;"; 
			echo "</th>";
		echo "</tr>";

		if($disponivel==0)
		{
		echo "<tr>";
			echo "<td style='font-family:verdana; font-size:12px; color:#000;'>";
				echo "<b>Status:</b></td>";
				echo "<td style='font-family:verdana; font-size:12px; color:red;'>";
				echo "<b>não est� funcionando!</b></br>"; 
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<th colspan='2'>";
				echo "Erros encontrados";
			echo "</th>";
		echo "</tr>";

		  for($i=0;$i<$tipos_disponiveis;$i++)   //varre o array
		  {
		  	echo "<tr><td colspan='2'>".$array_erros[$i].'</td></tr>';
		  }

		}	
		else
		{
		if($disponivel==1)
		{
		echo "<tr>";
			echo "<td style='font-family:verdana; font-size:12px; color:#000;'>";
				echo "<b>Status:</b></td>";
				echo "<td style='font-family:verdana; font-size:12px; color:#579c60;'>";
				echo "<b>Est� funcionando corretamente!</b></br>"; 
			echo "</td>";
		echo "</tr>";
		}
		}


		echo "<tr>";
			echo "<th colspan='2'>";
				echo "&nbsp;"; 
			echo "</th>";
		echo "</tr>";


			echo "<tr>";
			echo "<td colspan='2'>";
				echo "<a  href='verificacao_correios.php'>Atualizar Status</a>"; 
			echo "</td>";
		echo "</tr>";


		echo "</table>";
	



 ?>