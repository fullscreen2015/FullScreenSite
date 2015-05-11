<?php

  header("Content-Type: text/html; charset=ISO-8859-1",true);
  

  include("../../include/sistema_conexao.php");
  include("../../include/sistema_data.php");
  include("../../include/sistema_zeros.php"); 

  echo '<link rel="stylesheet" href="../_css/paineis.css" type="text/css" />
  ';

  echo "<h1>Enviar Código de Rastreamento</h1>";


?>


<script src="..\_js\jquery.min.js" ></script>

<script type="text/javascript">

     function enviaKey(d)
     {
      
        if(document.getElementById("nome_cliente").value!= ""){

          $(document).ready(function()
          {

              $("#rastrear").load('../_paineis/ajax_rastreamento.php','nome_cliente='+  $('input#nome_cliente').val()); 
              //$("#rastrear").load('../_paineis/ajax_rastreamento.php','numero_pedido='+  $('input#numero_pedido').val()); 
          });

     }
}

</script>














<form name="grava_rastreamento" method="" action="">

<div  style="font-size: 12px; font-family:verdana; margin-left:4px; float:left;  width:290px; height:30px; "> 

<b>Nome Cliente: </b>

<input type="text"  name="nome_cliente" id="nome_cliente" onkeyup="enviaKey();" value="" />

<!-- <input type="button" value="OK" name="ok" onclick="enviaKey();"> -->
</form>


<div id="rastrear" style="margin-top:10px;float:left; width:290px; height:165px; overflow-y:auto;">


        
</div>





</div>