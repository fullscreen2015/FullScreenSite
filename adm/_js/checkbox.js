function marcarTodos(maior_codigo_sistema, maior_codigo_tipo, tipoMarcarTodos)
{

	var marcarTodos = document.getElementById(tipoMarcarTodos);
	var checkbox = "";
	var marcarTodosDoSistema = "";
	
	if (marcarTodos.checked)
	{
		for (indicex=1; indicex <= maior_codigo_sistema; indicex++)
		{
		
			if (marcarTodosDoSistema = document.getElementById(tipoMarcarTodos+"_"+indicex))
			{
				marcarTodosDoSistema.checked = true;
			}
			
			for (indicey=1; indicey <= maior_codigo_tipo; indicey++)
			{
			
				if (checkbox = document.getElementById(tipoMarcarTodos+"_"+indicex+"_"+indicey))
				{
					checkbox.checked = true;
				}
				
			}
		
		}
	
	}
	
	else
	{
		for (indicex=1; indicex <= maior_codigo_sistema; indicex++)
		{
		
			if (marcarTodosDoSistema = document.getElementById(tipoMarcarTodos+"_"+indicex))
			{
				marcarTodosDoSistema.checked = false;
			}
			
			for (indicey=1; indicey <= maior_codigo_tipo; indicey++)
			{
			
				if (checkbox = document.getElementById(tipoMarcarTodos+"_"+indicex+"_"+indicey))
				{
					checkbox.checked = false;
				}
				
			}
		
		}
	
	}
	
}

function marcarTodosDoSistema(maior_codigo_tipo, linha_sistema_atual, tipoMarcarTodos)
{

	var marcarTodos = document.getElementById(tipoMarcarTodos);
	var marcarTodosDoSistema = document.getElementById(tipoMarcarTodos+"_"+linha_sistema_atual);
	var checkbox = "";
	
	
	if (marcarTodosDoSistema.checked)
	{
		
		for (indice=1; indice <= maior_codigo_tipo; indice++)
		{
		
			if (checkbox = document.getElementById(tipoMarcarTodos+"_"+linha_sistema_atual+"_"+indice))
			{
				checkbox.checked = true;
			}
		
		}
	
	}
	
	else
	{

		marcarTodos.checked = false;
		for (indice=1; indice <= maior_codigo_tipo; indice++)
		{
		
			if (checkbox = document.getElementById(tipoMarcarTodos+"_"+linha_sistema_atual+"_"+indice))
			{
				checkbox.checked = false;
			}
		
		}
	
	}
	
}

function checkarCheckboxesDoSistema(sistema, maior_codigo_tipo, tipoMarcacao)
{

	var marcarTodosDoSistema = document.getElementById(tipoMarcacao+"_"+sistema);
	
	var checkbox = "";
	
	for(indice=1; indice <= maior_codigo_tipo; indice++)
	{
	
		
		if (checkbox = document.getElementById(tipoMarcacao+"_"+sistema+"_"+indice))
		{
		
			if (!checkbox.checked)
			{
			
				marcarTodosDoSistema.checked = false;
				return false;
			
			}
			else
			{
			
				marcarTodosDoSistema.checked = true;
			
			}
		
		}
		
	}

}

function checkarCheckboxes(maior_codigo_sistema, maior_codigo_tipo, tipoMarcacao)
{

	var marcarTodos = document.getElementById(tipoMarcacao);
	var checkbox = "";
	
	for(indicex=1; indicex <= maior_codigo_sistema; indicex++)
	{
	
		for(indicey=1; indicey <= maior_codigo_tipo; indicey++)
		{
		
			if (checkbox = document.getElementById(tipoMarcacao+"_"+indicex+"_"+indicey))
			{
			
				if (!checkbox.checked)
				{
				
					marcarTodos.checked = false;
					return false;
				
				}
				
				else
				{
				
					marcarTodos.checked = true;
				
				}
			
			}
			
		}
	
	}

}






