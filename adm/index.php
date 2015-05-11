<?php

	$url = "_sistema/php_manutencao.php";

	if(ISSET($_REQUEST['msg']))
	{
		$url.="?msg=" . $_REQUEST['msg'];
	}

  header("Location: " . $url);  

?>
