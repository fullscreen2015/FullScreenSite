<script type="text/javascript" src="../_js/ExpandSelect_1.00.js"></script>

    

<script language="javascript">

  function mostrar_div(iDiv) 
  {
    var nome_id = "#" + iDiv;
    var aleatorio3 = Math.floor(Math.random()*100000);
	var rabicho_filtro = '<?php echo $rabicho_filtro; ?>';

    $(nome_id).html('<span class=caminho><b>&nbsp;&nbsp;&nbsp;:: Carregando Filtros ...</b><br><br></span>');	
    $(nome_id).load('ajax_painel_filtros.php?codigo_modulo=<? echo $codigo_modulo; ?>&a=' + aleatorio3 + rabicho_filtro);
  }

 
 
  function esconder_div(iDiv) 
  {
    var sDiv = document.getElementById(iDiv);

    sDiv.style.display = "none";
  }



  function css_focus(campo)
  {
    $(campo).css("background-color", "#fff");
    $("#atualizando").html('Editando dados. Para salvar, basta clicar fora da caixa de edição.');	
  }

  
  function css_blur(campo)
  {
    $(campo).css("background-color", "#ccc");
  }

  
  function atualizar(valor,cp,cmp)
  {

    var aleatorio2 = Math.floor(Math.random()*100000);

    $("#atualizando").html('gravando dados ...');	
    var cm = '<? echo $codigo_modulo; ?>';
    $.post("ajax_painel_atualizar.php", { codigo_modulo: cm, valor: valor, chave_primaria: cp, campo: cmp, a: aleatorio2 }, 
    function(data) { 
      $("#atualizando").html(data);	
    });

  }

  
  function mostrar_select(ct,id,reg,v)
  {
    var nome_id = "#div_" + id;
    var aleatorio3 = Math.floor(Math.random()*100000);
    var cm = '<? echo $codigo_modulo; ?>';
	
    $(nome_id).html('abrindo select ...');	
    $(nome_id).load('ajax_painel_mostrar_select.php?codigo_modulo=' + cm + '&cont=' + ct +  '&codigo_registro=' + reg + '&valor_atual=' + v + '&a=' + aleatorio3);

  }


  function filtros_mostrar_select(ct,id,reg,v)
  {
    var nome_id = "#div_" + id;
    var aleatorio3 = Math.floor(Math.random()*100000);
    var cm = '<? echo $codigo_modulo; ?>';
  
    $(nome_id).html('abrindo select ...');  
    $(nome_id).load('ajax_painel_filtros_mostrar_select.php?codigo_modulo=' + cm + '&cont=' + ct +  '&codigo_registro=' + reg + '&valor_atual=' + v + '&a=' + aleatorio3);

  }



function mostar_exportacao(iDiv)
{

if(document.getElementById(iDiv).style.display =='none'){

  document.getElementById(iDiv).style.display = 'block';

}else{

  document.getElementById(iDiv).style.display = 'none';

}

}





</script>