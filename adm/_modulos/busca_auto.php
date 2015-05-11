<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busca Com AJAX</title>

<script>
//CRÉDITOS

//SITES ACESSADOS:
//http://stackoverflow.com/questions/402448/access-div-contents-using-up-and-down-arrow-keys-using-javascript
//http://www.codingforums.com/showthread.php?t=175204
//http://www.webdeveloper.com/forum/showthread.php?t=100179
//http://www.java2s.com/Tutorial/JavaScript/0280__Document/documentonkeyup.htm
//http://www.w3schools.com/asp/asp_ajax_asp.asp
//http://wbruno.com.br/blog/2010/01/08/suggest-ajax-jquery-phpmysql/
//http://wbruno.com.br/blog/2011/11/19/navegando-pela-lista-suggest-setas-teclado-autocomplete-teclado-javascript/
</script>

<style>
ul{
  position:relative;
  list-style-position:outside;
  list-style:none;
  padding:0;
  margin:0;
}
li{
  font-size:16px;
  list-style:none;
  margin:0;
  overflow:hidden;
  padding:0;
  cursor:pointer;
  padding:4px 5px;
  font-weight:bold;
}
li:hover{
  background-color:#C00;
  color:#FFF;
}
.resultado{
  width:390px;
  border:1px solid;
  font-family:Arial, Helvetica, sans-serif;
  position:absolute;
  visibility:hidden;
}
#main{
  width:460px;
  position:relative;
}
.inputAuto{
  text-transform:uppercase;
}
.active{
  background-color:#C00;
  color:#FFF;
}
</style>

<script type="text/javascript">
function showHint(str)
{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  document.getElementById("txtHint").style.visibility='hidden';
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
  document.getElementById("txtHint").style.visibility='visible';
    }
  }
xmlhttp.open("GET","busca.php?palavra="+str,true);
xmlhttp.send();
}
</script>
</head>

<body onload="document.form.nome.focus();">



<h3>AUTOCOMPLETAR:</h3>

<div id="main">
<form name="form"> 
<!--input type="text" name="nome" id="nome" size="60" autocomplete="off" onkeyup="showHint(this.value);" /-->
<input type="text" name="nome" id="nome" size="60" autocomplete="off" />
&nbsp;<input type="submit" value="Buscar" />
<div id="txtHint" class="resultado" align="left"></div>
</form>
</div>





<script type="text/javascript">
<!--
document.onkeydown = myKeyDownHandler;
function myKeyDownHandler(event){
  if ( typeof event == "undefined" ) {event = window.event};
  Vkey = event.keyCode;
  var vnome = document.getElementById('nome').value;
  if (Vkey !== 40 && Vkey !== 38){
  showHint(vnome);
  };
};
-->
<!--
function autocomplete( inputname, containerId ) {
    var ac = this;
    this.textbox     = document.getElementById(inputname);
    this.div         = document.getElementById(containerId);
    this.list        = this.div.getElementsByTagName('li');
    this.pointer     = null;

    this.textbox.onkeydown = function( e ) {
        e = e || window.event;
        switch( e.keyCode ) {
            case 38: //up
                ac.selectDiv(-1);
                break;
            case 40: //down
                ac.selectDiv(1);
                break;
        }
    }
    this.selectDiv = function( inc ) {
        if( this.pointer !== null && this.pointer+inc >= 0 && this.pointer+inc < this.list.length ) {
            this.list[this.pointer].className = '';
            this.pointer += inc;
            this.list[this.pointer].className = 'active';
            this.textbox.value = this.list[this.pointer].innerHTML;
        }
        if( this.pointer === null ) {
            this.pointer = 0;
            this.list[this.pointer].className = 'active';
            this.textbox.value = this.list[this.pointer].innerHTML;
        }
    }
} 
new autocomplete( 'nome', 'txtHint' );
-->
</script>




</body>
</html>