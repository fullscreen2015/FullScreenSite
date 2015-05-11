var req;

function loadXMLDoc(url, valor)
{
  req = null;

  // Procura por um objeto nativo (Mozilla/Safari)
  if (window.XMLHttpRequest) 
  {
    req = new XMLHttpRequest();
    req.onreadystatechange = processReqChange;
    req.open("GET", url+'?codigo_imagem='+valor, true);

    req.send(null);

    // Procura por uma versao ActiveX (IE)
  }
  else if(window.ActiveXObject) 
  {
    req = new ActiveXObject("Microsoft.XMLHTTP");
    if (req) 
    {
      req.onreadystatechange = processReqChange;
      req.open("GET", url+'?codigo_imagem='+valor, true);
      req.send();
    }
  }
}

function processReqChange()
{
  // apenas quando o subgrupo for "completado"
  if (req.readyState == 4) 
  {

     // apenas se o servidor retornar "OK"
     if (req.status == 200) 
     {
       document.getElementById('atualiza_imagem').innerHTML = req.responseText;
     }
     else 
     {
       alert("Houve um problema ao obter os dados:\n" + req.statusText);
     }
  }
  if (window.XMLHttpRequest) 
  {
    if(req.readyState == 1) 
    {
      document.getElementById('atualiza_imagem').innerHTML = "<p><img src=imagens/layout/carregando.gif></p>";
    }
  }
}


function funcao_atualiza_div(codigo_imagem)
{
  loadXMLDoc("ajax_atualiza_imagem.php",codigo_imagem);
}
