<?

  if((isset($_COOKIE["resolucao_largura"]))&&(isset($_COOKIE["resolucao_altura"])))
  {
    $largura_tela = intval($_COOKIE["resolucao_largura"]);
    $altura_tela = intval($_COOKIE["resolucao_altura"]);
  }
  else
  {

?>

<script type="text/javascript">
  $(document).ready(function() {
    var altura = $(window).height();
    var largura = $(window).width();
    $.cookie("resolucao_altura", altura, {expires: 365, path: '/'});
    $.cookie("resolucao_largura", largura, {expires: 365, path: '/'});
  });
</script>


<?
  }
?>
