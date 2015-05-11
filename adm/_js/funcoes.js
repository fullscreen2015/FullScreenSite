function adicionar_valor_relacionado()
{
  alert('oi');

  var inp3 = document.createElement("input");   
  inp3.setAttribute("id", "voltar");   
  inp3.setAttribute("type", "hidden");  
  inp3.setAttribute("name", "voltar");  

  var inpP = document.getElementById("frmCadastro");  
  var parentInp = inpP.parentNode;  
  parentInp.insertBefore(inp, nextSibling);

  document.forms['frmCadastro'].submit();
}


function abre_sistema(sistema)
{
  window.location.href='../'+sistema;
}


function cor()
{
  window.open("../_include/cor.php", "cor", "height=200, width=400");
}


function mascara(campo,mask,event) 
{		

	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;


	if((mask == "num") || (mask == "num_ponto") || (mask == "num_virgula"))
	{
		
		// Somente numeros aceitos
		if(mask == "num")
		{
			if((keyCode > 47) && (keyCode < 58)) {
				return true;
			}
			else{
				keyCode=0;
				return false;
			}
		}

		// Somente numeros e ponto aceitos
		if(mask == "num_ponto")
		{
			if((keyCode > 45) && (keyCode < 58)) {
				return true;
			}
			else{
				keyCode=0;
				return false;
			}
		}

		// Somente numeros e virgula aceitos
		if(mask == "num_virgula")
		{
			if(((keyCode > 47) && (keyCode < 58)) || (keyCode == 44)) {
				return true;
			}
			else{
				keyCode=0;
				return false;
			}
		}
		
	}
	
	
	
	var i, count, valor, campoLen, maskLen, bolMask, cod;
		
	valor = campo.value;
	
	if(mask == "m" || mask == "M" || mask == 'M_S' || mask == 'm_s')
	{
		valor=valor.toLowerCase()// transforma todas as letras em minusculas para fazer as substituicoes de acentuacao
		valor=valor.replace(/[áàãâä]/g,'a')
		valor=valor.replace(/[éèêë&]/g,'e')
		valor=valor.replace(/[íìîï]/g,'i')
		valor=valor.replace(/[óòõôö]/g,'o')
		valor=valor.replace(/[úùûü]/g,'u')
		valor=valor.replace(/[ç]/g,'c')
		
		 // retira o espaço da string
		if(mask == 'M_S' || mask == 'm_s')   valor=valor.replace(/[ ]/g,''); 
		else valor=valor.replace(/[ ]/g,' ');
		
		
		for(var i=0;i<valor.length;i++){
			if(' @.-,_/:0123456789abcdefghijklmnopqrstuvwxyz'.indexOf(valor.charAt(i))==-1)valor=valor.replace(valor.charAt(i),' ')
		}
		
		if(mask == 'M' || mask == 'M_S') { valor=valor.toUpperCase() } // se a opc escolhida for 'M', entao transforma todas as letras em maiuscula
		if(mask == 'm' || mask == 'm_s') { valor=valor.toLowerCase() } // se a opc escolhida for 'm', entao transforma todas as letras em minusculas
	
		return (campo.value = valor);
	}
	else
	{
		for(var i=0;i<valor.length;i++){
			if('.-,_/:0123456789'.indexOf(valor.charAt(i))==-1)valor=valor.replace(valor.charAt(i),' ')
		}

		// Limpa todos os caracteres de formatação que já estiverem no campo.
		valor = valor.toString().replace( "-", "" );
		valor = valor.toString().replace( "-", "" );
		valor = valor.toString().replace( ":", "" );
		valor = valor.toString().replace( ".", "" );
		valor = valor.toString().replace( ".", "" );
		valor = valor.toString().replace( "/", "" );
		valor = valor.toString().replace( "/", "" );
		valor = valor.toString().replace( "(", "" );
		valor = valor.toString().replace( "(", "" );
		valor = valor.toString().replace( ")", "" );
		valor = valor.toString().replace( ")", "" );
		valor = valor.toString().replace( " ", "" );
		valor = valor.toString().replace( " ", "" );
		valor = valor.toString().replace( "-", "" );
		valor = valor.toString().replace( "-", "" );
		valor = valor.toString().replace( ":", "" );
		valor = valor.toString().replace( ".", "" );
		valor = valor.toString().replace( ".", "" );
		valor = valor.toString().replace( "/", "" );
		valor = valor.toString().replace( "/", "" );
		valor = valor.toString().replace( "(", "" );
		valor = valor.toString().replace( "(", "" );
		valor = valor.toString().replace( ")", "" );
		valor = valor.toString().replace( ")", "" );
		valor = valor.toString().replace( " ", "" );
		valor = valor.toString().replace( " ", "" );
		campoLen = valor.length;
		maskLen = mask.length;
		
		i = 0;
		count = 0;
		cod = "";
		maskLen = campoLen;
		
		while (i <= maskLen) {
			bolMask = ((mask.charAt(i) == "-") || (mask.charAt(i) == ":") || (mask.charAt(i) == ".") || (mask.charAt(i) == "/"))
			bolMask = bolMask || ((mask.charAt(i) == "(") || (mask.charAt(i) == ")") || (mask.charAt(i) == " "))
			
			if (bolMask) {
				cod += mask.charAt(i);
				maskLen++; }
			else {
				cod += valor.charAt(count);
				count++;
			}
			i++;
		}
		campo.value = cod;
		
		if (keyCode != 8) {  	// backspace
			if (mask.charAt(i-1) == "9"){	// apenas números...
				return ((keyCode > 47) && (keyCode < 58));	// números de 0 a 9
			} 
			else { return true; } // qualquer caracter...
		}
		else { return true; }
	}
}





function so_moeda(fd) 
{
  quantidade = fd.value.length;
  tecla = fd.value.substring(quantidade-1,quantidade);

  if ((tecla!=",")&&(tecla!=0)&&(tecla!=1)&&(tecla!=2)&&(tecla!=3)&&(tecla!=4)&&(tecla!=5)&&(tecla!=6)&&(tecla!=7)&&(tecla!=8)&&(tecla!=9))
  {
    fd.value=fd.value.substring(0,quantidade-1);
  }
}







function so_numero(fd) 
{
  quantidade = fd.value.length;
  tecla = fd.value.substring(quantidade-1,quantidade);

  if ((tecla!=0)&&(tecla!=1)&&(tecla!=2)&&(tecla!=3)&&(tecla!=4)&&(tecla!=5)&&(tecla!=6)&&(tecla!=7)&&(tecla!=8)&&(tecla!=9))
  {
    fd.value=fd.value.substring(0,quantidade-1);
  }
}







$(function() {




	function mudar_aba(aba)
	{

		var nome_div = '#manutencao_lista_' + aba;
	  var div = $(nome_div);
	  var url = 'ajax_manutencao_lista_' + aba + '.php';
		var botao = '#botao_lista_' + aba;

	  var aleatorio = Math.floor(Math.random()*100000);

  	$('#manutencao_botoes').find('div').css('background-color','#dddddd');
		$("#manutencao_listas").find('div').css('display','none');
 		$(botao).parent('div').css('background-color','#FF9A33');
 		
	  div.css('display','block');

		if(div.html() == "")
		{
	  	div.html('<img src=../_imagens/loading.gif>');
	    div.load(url + '?a=' + aleatorio); 
		}

		

		jQuery.cookie('fw_aba_sistema', aba);

	}


	if(jQuery.cookie('fw_aba_sistema'))
	{
		var aba = jQuery.cookie('fw_aba_sistema');
		mudar_aba(aba);
	}
  


  $("#botao_lista_painel").click(function() {

		mudar_aba('painel');

  });


  $("#botao_lista_modulos").click(function() {

		mudar_aba('modulos');

  });


  $("#botao_lista_relatorios").click(function() {

  	$('#manutencao_botoes').find('div').css('background-color','#dddddd');
 		$(this).parent('div').css('background-color','#FF9A33');


		$("#manutencao_lista_modulos").css('display','none');
		$("#manutencao_lista_graficos").css('display','none');
		$("#manutencao_lista_sistema").css('display','none');

		mudar_aba('relatorios');

  });


  $("#botao_lista_graficos").click(function() {

  	$('#manutencao_botoes').find('div').css('background-color','#dddddd');
 		$(this).parent('div').css('background-color','#FF9A33');

		$("#manutencao_lista_relatorios").css('display','none');
		$("#manutencao_lista_modulos").css('display','none');
		$("#manutencao_lista_sistema").css('display','none');

		mudar_aba('graficos');

  });




  $("#botao_lista_sistema").click(function() {

  	$('#manutencao_botoes').find('div').css('background-color','#dddddd');
 		$(this).parent('div').css('background-color','#FF9A33');

		$("#manutencao_lista_relatorios").css('display','none');
		$("#manutencao_lista_modulos").css('display','none');
		$("#manutencao_lista_graficos").css('display','none');

		mudar_aba('sistema');

  });


});