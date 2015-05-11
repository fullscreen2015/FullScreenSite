<?

  $titulo = "Full Screen"; 
  $cor_de_fundo = "#FFFFFF"; 


  if(ISSET($_REQUEST['opcao']))
  {
    $opcao = (int) $_REQUEST['opcao'];
  }
  else
  {
    $opcao = 1;
  }




  $imagem = $opcao . ".jpg";

  $imgsize = GetImageSize($imagem); 
  $largura = $imgsize[0]; 
  $altura = $imgsize[1]; 



  $nova_opcao = $opcao+1;
  $nova_imagem=$nova_opcao . ".jpg";

  if(!(file_exists($nova_imagem)))
  {
    $nova_opcao = 1;
  }





?>

<html>
  <head>
    <title><? echo $titulo; ?> - Em breve</title>
    <meta http-equiv="Page-Enter" content="blendTrans(Duration=0.6)">

<style>
* 
{
  margin:0px auto;
  padding:0px 0px 0px 0px;
}




body
{
background-image:url('<? echo $opcao; ?>.jpg');
background-repeat:no-repeat;
background-position:top center;
} 


</style>
  </head>

  <body bgcolor="<? echo $cor_de_fundo; ?>">

    <table cellspacing=0 cellpadding=0 height="<? echo $altura; ?>" border=0>
      <tr>
        <td height="<? echo $altura; ?>"><a href="index.php?opcao=<? echo $nova_opcao; ?>"><img src="nada.png" width="990" height="<? echo $altura; ?>" border="0"></a></td>
      </tr>
    </table>

  </body>
</html>
