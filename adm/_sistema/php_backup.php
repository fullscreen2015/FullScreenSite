<?php

ob_start();

session_start();
 
if (ISSET($_SESSION['senha_result']) && ISSET($_SESSION['login_result']))
{
  
	include("../../include/sistema_conexao.php");
	include("configuracoes.php");


  $sql_verificacao = " SELECT administrador_sistema";
  $sql_verificacao.= " FROM tabela_adm_usuarios";
  $sql_verificacao.= " WHERE codigo_usuario=" . $_SESSION['fw_codigo_usuario'];
  $rs_verificacao = mysql_query($sql_verificacao);
  $linha_verificacao = mysql_fetch_array($rs_verificacao);

  if($linha_verificacao['administrador_sistema']==1)
  {


		function mysql_current_db() 
		{
			$r = mysql_query("SELECT DATABASE()") or die(mysql_error());
			return mysql_result($r,0);
		}

		$dbname = mysql_current_db();

		$data = date("Y_m_d");
		$arquivo = "../_backup/backup_".$data.".sql";

		$back = fopen($arquivo,"w");

		// Pega a lista de todas as tabelas 

		$res = mysql_query("SHOW TABLES FROM ".$dbname." ") or die(mysql_error());

		//$res = mysql_list_tables($dbname) or die(mysql_error());

		while ($row = mysql_fetch_row($res)) 
		{ 
			$table = $row[0]; // cada uma das tabelas
			$res2 = mysql_query("SHOW CREATE TABLE $table");

			while ( $lin = mysql_fetch_row($res2)) // Para cada tabela
			{
				#fwrite($back,"-- Criando tabela : $table\n");
				$lin[1].= ";";
				fwrite($back,"$lin[1]");
				#echo $lin[1]."<br><br>";
				$res3 = mysql_query("SELECT * FROM $table"); 
    
				while($r=mysql_fetch_row($res3)) // Dump de todos os dados das tabelas 
				{
					$sql=" INSERT INTO $table VALUES ('"; 
					$sql .= implode("','",$r); 
					$sql .= "');\n\n";
					#echo $sql."<br><br>";
					fwrite($back,$sql); 
				} 
			} 
		}

		fclose($back);

		// gerando o arquivo para download, com o nome do banco e extensÃ£o sql.

		$site = str_replace(".", "-", $url_site);
		$site = str_replace("http://", "", $site);

		$nome_arquivo = "backup_" . $site . "_" . date("Y-m-d") . ".sql";

		header("Content-type: application/sql");
		header("Content-Disposition: attachment; filename=" . $nome_arquivo);

		// lê e exibe o conteúdo do arquivo gerado
		#readfile($arquivo);

		$back = fopen($arquivo,"r");
		fpassthru($back);
		fclose($back);
	}


}
else
{
	header("Location: ../_sistema/php_manutencao_login.php");  
}

ob_end_flush();

?>