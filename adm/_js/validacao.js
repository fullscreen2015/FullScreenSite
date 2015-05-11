/**
 * Função para validar campos do formulário das páginas.
 * Para campos que NAO deseja validar, adicionar o atributo:  alt="no_required"
 * 
 * 
 * <code>
 *    	// Exemplo: 
 *     	<form id="frmCadastro" onsubmit="return validar('frmCadastro');">
 * </code> 
 */




function vercnpj(cnpj)
{
  var numeros, digitos, soma, icont, resultado, pos, tamanho, digitos_iguais;
  digitos_iguais = 1;

  cnpj = cnpj.replace(".","");
  cnpj = cnpj.replace(".","");
  cnpj = cnpj.replace(".","");
  cnpj = cnpj.replace(".","");
  cnpj = cnpj.replace(".","");
  cnpj = cnpj.replace("-","");
  cnpj = cnpj.replace("-","");
  cnpj = cnpj.replace("-","");
  cnpj = cnpj.replace("/","");
  cnpj = cnpj.replace("/","");
  cnpj = cnpj.replace("/","");
  cnpj = cnpj.replace("/","");


  if (cnpj.length != 14)
    return false;

  for (icont = 0; icont < cnpj.length - 1; icont++)
    if (cnpj.charAt(icont) != cnpj.charAt(icont + 1))
    {
      digitos_iguais = 0;
      break;
    }

  if (!digitos_iguais)
  {
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;

    for (icont = tamanho; icont >= 1; icont--)
    {
      soma += numeros.charAt(tamanho - icont) * pos--;
      if (pos < 2)
        pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    if (resultado != digitos.charAt(0))
      return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;

    for (icont = tamanho; icont >= 1; icont--)
    {
      soma += numeros.charAt(tamanho - icont) * pos--;
      if (pos < 2)
        pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    if (resultado != digitos.charAt(1))
      return false;

    return true;
  }
  else
    return false;
} 




function vercpf(cpf) 
{

  cpf = cpf.replace(".","");
  cpf = cpf.replace(".","");
  cpf = cpf.replace(".","");
  cpf = cpf.replace(".","");
  cpf = cpf.replace(".","");
  cpf = cpf.replace("-","");
  cpf = cpf.replace("-","");
  cpf = cpf.replace("-","");

  if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
  {
    return false;
  }

  add = 0;
  for (icpf=0; icpf < 9; icpf ++)
  {
    add += parseInt(cpf.charAt(icpf)) * (10 - icpf);
  }

  rev = 11 - (add % 11);

  if (rev == 10 || rev == 11)
  {
    rev = 0;
  }

  if (rev != parseInt(cpf.charAt(9)))
  {
    return false;
  }

  add = 0;

  for (icpf = 0; icpf < 10; icpf ++)
  {
    add += parseInt(cpf.charAt(icpf)) * (11 - icpf);
  }

  rev = 11 - (add % 11);

  if (rev == 10 || rev == 11)
  {
    rev = 0;
  }

  if (rev != parseInt(cpf.charAt(10)))
  {
    return false;
  }

  return true;
}








/** 
 * Função Máscara de Entrada. Modo de usar: 
 *
 * Evento onkeypress:	onkeypress="return mascara(this,'(99) 9999-9999',event);"
 * 		CEP  -> 99999-999 							CPF  -> 999.999.999-99
 * 		CNPJ -> 99.999.999/9999-99 					Data -> 99/99/9999
 * 		TEL  -> (99) 999-9999 						C/C  -> 999999-!
 * 
 * 
 * Evento onkeypress:	onkeypress="return mascara(this,'num',event);"
 * 		Somente Números				-> 'num'	
 * 		Somente Números com Ponto	-> 'num_ponto'	
 * 		Somente Números	com Vírgula	-> 'num_virgula'	
 * 
 * 
 * Evento onkeyup:	onkeyup="return mascara(this,'m_s',event);"
 * 		Texto em Minúsulo 	e sem acento -> m	
 * 		Texto em Maiúsculo 	e sem acento -> M
 * 		Texto em Minúsulo 	e sem acento 	e sem espaço -> m_s
 * 		Texto em Maiúsculo 	e sem acento e sem espaço -> M_S	
 * 
 * @access public 
 * @param object campo	:	Coloca-se o 'this' para poder pegar o campo input.
 * @param string mask	:	Formato da máscara de entrada desejada.
 * @param string event	:	Coloca-se 'event' para que possa funcionar tanto no IE quanto no Firefox.
 * @return void 
 */ 

function mascara(campo,mask,event) 
{		

	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

	if((mask == "num") || (mask == "num_ponto") || (mask == "num_virgula"))
	{
		

		// Somente numeros aceitos
		if(mask == "num")
		{
			if( ((keyCode > 47) && (keyCode < 58)) || ((keyCode > 34) && (keyCode < 47)) || (keyCode == 8) || (keyCode == 9) || (keyCode == 13) ) {
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
			if( ((keyCode > 45) && (keyCode < 58)) || ((keyCode > 34) && (keyCode < 47)) || (keyCode == 8) || (keyCode == 9) || (keyCode == 13) ) {
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
			if( ((keyCode > 47) && (keyCode < 58)) || ((keyCode > 34) && (keyCode < 47)) || (keyCode == 44) || (keyCode == 8) || (keyCode == 9) || (keyCode == 13) ) {
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
		valor=valor.replace(/[á`ãâä]/g,'a')
		valor=valor.replace(/[éèêë&]/g,'e')
		valor=valor.replace(/[íìîï]/g,'i')
		valor=valor.replace(/[óòõôö]/g,'o')
		valor=valor.replace(/[úùûü]/g,'u')
		valor=valor.replace(/[ç]/g,'c')
		
		 // retira o espaço da string
		if(mask == 'M_S' || mask == 'm_s')   valor=valor.replace(/[ ]/g,''); 
		else valor=valor.replace(/[ ]/g,' ');
		
		
		for(var i=0;i<valor.length;i++){
			if(' @.-,_/:0123456789abcdefghijklmnopqrstuvwxyz'.indexOf(valor.charAt(i))==-1) valor=valor.replace(valor.charAt(i),' ')
		}
		
		if(mask == 'M' || mask == 'M_S') { valor=valor.toUpperCase() } // se a opc escolhida for 'M', entao transforma todas as letras em maiuscula
		if(mask == 'm' || mask == 'm_s') { valor=valor.toLowerCase() } // se a opc escolhida for 'm', entao transforma todas as letras em minusculas
	
		return (campo.value = valor);
	}
	else
	{

		for(var i=0;i<valor.length;i++)
		{
			if('.-,_/:0123456789'.indexOf(valor.charAt(i))==-1) valor=valor.replace(valor.charAt(i),' ');
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
		

		while (i <= maskLen) 
		{

			bolMask = ((mask.charAt(i) == "-") || (mask.charAt(i) == ":") || (mask.charAt(i) == ".") || (mask.charAt(i) == "/"));
			bolMask = bolMask || ((mask.charAt(i) == "(") || (mask.charAt(i) == ")") || (mask.charAt(i) == " "));
			
			if (bolMask) 
            {
                cod += mask.charAt(i);
                maskLen++; 
            }
			else 
            {
                cod += valor.charAt(count);
                count++;

			}
			i++;
		}

		campo.value = cod;
		
		if (keyCode != 8)  // backspace
        {  	
			//alert(campo.value[i-2]);
		  if (mask.charAt(i-1) == "9")  // apenas números...
          {	
			return ((keyCode > 47) && (keyCode < 58));	// números de 0 a 9
          } 
          else 
          {
            return true; 
          } // qualquer caracter...
		  
		}
		
		//Este 'else' foi modificado para resolver um bug no Firefox
		//Este c�digo salva o value do campo at� antes do pr�ximo caractere da m�scara quando se est� apagango os valores,
		//ap�s salvar o value inteiro � apagado e depois recuperado com a variável que já não tem o caractere da m�scara,
		//ou seja, quando um caractere da m�scara for ser apagado, será apagado tamb�m o caractere que vir depois dele ;D
		//Apenas o Firefox est� executando esta l�gica, porque os outros navegadores ignoram e apagam normalmente
		else
        {
			if(campo.value.charAt(i-2) == '|' || campo.value.charAt(i-2) == ' ' || campo.value.charAt(i-2) == '\\' || campo.value.charAt(i-2) == '/' || campo.value.charAt(i-2) == ':' || campo.value.charAt(i-2) == '-' || campo.value.charAt(i-2) == '(' || campo.value.charAt(i-2) == ')' || campo.value.charAt(i-2) == '.')
			{
				var campoMenosIfem = '';
				
				if(campo.value.charAt(i-2) == ' ' && (campo.value.charAt(i-2) == '|' || campo.value.charAt(i-2) == ' ' || campo.value.charAt(i-2) == '\\' || campo.value.charAt(i-2) == '/' || campo.value.charAt(i-2) == ':' || campo.value.charAt(i-2) == '-' || campo.value.charAt(i-2) == '(' || campo.value.charAt(i-2) == ')' || campo.value.charAt(i-2) == '.'))
				{
				
					for(var controle = 0; controle < (i-3); controle++)
					{
						
						campoMenosIfem += campo.value.charAt(controle);
					
					}
				
				}
				
				else
				{
					for(var controle = 0; controle < (i-2); controle++)
					{
					
						campoMenosIfem += campo.value.charAt(controle);
						
					}
				}
				//campo.value	= '';
				campo.value	= campoMenosIfem;
			}
        }
    }
}


/** 
 * Função para validar campos do formulário.
 * 
 * @access public 
 * @param object item	:	Coloca-se o ID do form do formulário
 * @return void 
 */ 

function validar(item) 
{

  var frm = document.getElementById(item);	
	
  for (i=0; i < frm.elements.length; i++)
  {		


    // Validando os checkbox obrigat�rios
    // Para que esta verifica��o funcione, o campo do tipo Checkbox deve ter a tag "rel=obrigatorio"

    if(frm.elements[i].type == "checkbox")
    {
      if(frm.elements[i].rel=="obrigatorio")
      {
        if(!(frm.elements[i].checked))
        {
          Erro(frm.elements[i],'Voce nao marcou o campo obrigat�rio "' + frm.elements[i].title + '"\n');
          return false;
        }
      }
    }


    // Validando os campos HIDDEN criados pelo AJAX
    // Para que esta verifica��o funcione, o campo criado pelo AJAX que tiver algum erro, deve ter o "value=x" e o erro escrito na tag "title"

    if(frm.elements[i].type == "hidden")
    {
      if (frm.elements[i].alt == "ajax") 
      {
        if (frm.elements[i].value == "x")
        {
            alert(frm.elements[i].title);
            return false;
        }
      }
    }




    // Validando campos
    if(frm.elements[i].type == "text" || frm.elements[i].type == "password" || frm.elements[i].type == "textarea" || frm.elements[i].type == "select-one")
    {

      if(frm.elements[i].title != "no_required" && frm.elements[i].alt != "no_required"  && frm.elements[i].disabled == false && frm.elements[i].readonly != false)
      {

        // Limpando o atributo CSS de estilo do campo do form
        frm.elements[i].className = "fmrbox";
		
        // Validando campos TEXT
        if (frm.elements[i].value == "")
        {
          Erro(frm.elements[i],'');
          return false;
        }
        else
        {

          // Validando EMAIL
          if ((frm.elements[i].name == "email")|| (frm.elements[i].alt == "email"))
          {

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  

            if(!(emailPattern.test(frm.elements[i].value)))
            { 
              Erro(frm.elements[i], 'E-mail inv�lido.\nPor favor, digite novamente\n');
              return false;
            } 
          }	



          // Validando TELEFONE
          if (frm.elements[i].name == "telefone"  || frm.elements[i].name == "telefone2" || frm.elements[i].name == "celular") 
          {
            if (frm.elements[i].value.length < 8) 
            {
              Erro(frm.elements[i], frm.elements[i].name.toUpperCase() + ' inv�lido!\nPor favor, digite novamente\n');
              return false;
            }
          }	



          // Validar o CEP
          if (frm.elements[i].name == "cep") 
          {
            if (frm.elements[i].value.length < 9) 
            {
              Erro(frm.elements[i], frm.elements[i].name.toUpperCase() + ' inv�lido.\nPor favor, digite novamente\n');
              return false;
            }
          }					





          // Validar o CPF
          if (frm.elements[i].name == "cpf") 
          {
            $retorno = vercpf(frm.elements[i].value);

            if ($retorno==false) 
            {
              Erro(frm.elements[i], frm.elements[i].name.toUpperCase() + ' inv�lido.\nPor favor, digite novamente\n');
              return false;
            }
          }


          // Validar o CNPJ
          if (frm.elements[i].name == "cnpj") 
          {
            if (!(vercnpj(frm.elements[i].value))) 
            {
              Erro(frm.elements[i], frm.elements[i].name.toUpperCase() + ' inv�lido.\nPor favor, digite novamente\n');
              return false;
            }
          }




          // Validar Confirmação de Senha
          // Para que funcione corretamente, o campo confirmação de senha tem que vir logo ap�s o campo senha no formul�rio

          if (frm.elements[i].name == "senha") 
          {
            if (frm.elements[i].value!=frm.elements[i+1].value) 
            {
              Erro(frm.elements[i], 'Os campos "senha" e "confirmação da senha" devem ser iguais! \n');
              return false;
            }
          }



        }




        // Validando campos SELECT
        if ((frm.elements[i].type == "select-one") && (frm.elements[i].value == ""))
        {
          Erro(frm.elements[i],'Voc� não selecionou uma das op��es.\n');
          return false;
        }
		
      }

    }

  } // fim do FOR

  return true;
}


function Erro( form, msg )
{
  // Inserindo valor inicial na variável de erro	

  if(form.alt)
  {
    nome_do_campo = form.alt;
  }
  else
  {
    if(form.title)
    {
      nome_do_campo = form.title;
    }
    else
    {
      nome_do_campo = form.name.toUpperCase();
    }
  }

  erro  = 'Por favor, preencha o campo: "'+ nome_do_campo +'"\n';

  if(msg != "") 
  {
    erro = msg; 
  }


  // Mudando o atributo de CSS para dar destaque
  if(form.type != "hidden")
  {
    form.className = "fmrboxerro";
  }

		
  // Limpando o valor errado e setando como focus
  if(form.type == "text" || form.type == "password")
  {
    // form.value = "";
  }

  // Exibindo o erro
  alert(erro);

  if((form.type != "hidden") && (form.type != "radio") && (form.type != "checkbox"))
  {
    form.focus(); 
  }

  return false;
}