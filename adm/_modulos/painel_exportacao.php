<?php

		///
		//COME�A Exportação
        if(isset($sistema_exportacao) && $sistema_exportacao == 1){


?>

    	<a class="caminho" href="javascript:mostar_exportacao('painel_exportacao');" ><b>&nbsp;&nbsp;&nbsp;:: Exportar</b></a>

<?

    	///DIVS PAINEL Exportação
    	echo '<div id="painel_exportacao" style="margin-top:10px;display:none;">';

    	echo '<div>';
    	
        echo '&nbsp;<a class="caminho" href="exportar_csv.php?pagina='.$pagina.'&codigo_modulo='.$codigo_modulo.'"><b>&nbsp;&nbsp;&nbsp;:: Exportar CSV</b> (Todos os dados)</a><br>';

        echo '&nbsp;<a class="caminho" href="exportar_txt.php?pagina='.$pagina.'&codigo_modulo='.$codigo_modulo.'"><b>&nbsp;&nbsp;&nbsp;:: Exportar TXT</b> (Todos os dados)</a><br>';
		
?>

        &nbsp;<a class="caminho" href="javascript:mostar_exportacao('painel_exportacao2');" ><b>&nbsp;&nbsp;&nbsp;:: Exportar seleção</b></a>

<?

		echo '</div>';

		echo '<div id="painel_exportacao2" style="margin-left:20px; margin-top:10px; display:none; overflow:hidden; "><font class="caminho">';

		echo '<div style="height:30px;  width:100%; display: inline; float:left; ">';
  		echo 'Selecione os campos desejados. | <a href="javascript:marcar_checkbox()">Marcar todos</a> | <a href="javascript:desmarcar_checkbox()">Desmarcar todos</a><br>';
		echo '</div>';

?>

				
				<script>
				
				function validar_checks(){

					campos_selecionados = document.seleciona_campos.campos_selecionados
					conta=0
					for (i=0;i<campos_selecionados.length;++ i)	{

					if (campos_selecionados[i].checked == true)	{
					conta++
					}

					}

					if (conta==0){
					alert("Selecione pelo menos uma opção");
					return false;
					}

					else
					    return true;
					}

				</script>


				<form name="seleciona_campos"  action="exportar_exibicao.php" method="post" onsubmit="return validar_checks();" >
				<input type="hidden" name="sql" value="<?=$sql;?>">
				<input type="hidden" name="pagina" value="<?=$pagina;?>">
				<input type="hidden" name="codigo_modulo" value="<?=$codigo_modulo;?>">
				

<?
          for($cont=1;$cont<=$numero_campos;$cont++)
          {
            $cont_ = (10 + $cont);
            $cont1 = $cont_ . "1";
            $cont2 = $cont_ . "2";
            $cont9 = $cont_ . "9";
           
?>

            <div style=" margin-left:4px; width:400px; display: inline; float:left; ">
              <input id="campos_selecionados" type="checkbox" name="campos_selecionados[]" value="<?=$cont;?>">
              <?
              echo '<b >'.$campos[$cont2].'</b>';
             
            ?>

          </div>

            <?
                     
          }  

?>

		<div style="margin-top:10px; margin-left:4px; width:100%; display: inline; float:left; ">

		  <input type="submit" name="exportar" value="Exportar Campos Selecionados">
		  
		</div>

		</form>

							<script type="text/javascript">
							function marcar_checkbox(){
							   for (i=0;i<document.seleciona_campos.elements.length;i++)
							      if(document.seleciona_campos.elements[i].type == "checkbox")
							      	  document.seleciona_campos.elements[i].checked=1
							}
							function desmarcar_checkbox(){
							   for (i=0;i<document.seleciona_campos.elements.length;i++)
							      if(document.seleciona_campos.elements[i].type == "checkbox")
							      	  document.seleciona_campos.elements[i].checked=0
							}
							</script>

<!-- FIM FORM QUE ENVIA CAMPOS PARA Exportação -->

<?
		
		echo '</font></div>';
		echo '</div>';
		

	}

		//FIM DIVS Exportação
		//FIM Exportação

		///
?>