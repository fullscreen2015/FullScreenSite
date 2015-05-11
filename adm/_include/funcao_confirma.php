<script type="text/javascript" language="javascript">
  var confirmMsg  = 'Confirmação de Exclusão';
  function confirmLink(theLink, theSqlQuery)
  {
  	alert(theSqlQuery);
    // Confirmation is not required in the configuration file
    if (confirmMsg == '') {
        return true;
    }

    var is_confirmed = confirm(confirmMsg + ' :\n' + theSqlQuery);
    return is_confirmed;
 }

function confirmacao(codigo_modulo,pagina,chave_primaria,valor_chave_primaria,sistema_singular) {
     var resposta = confirm("\n****************************\n\nTem certeza que deseja\napagar este(a) "+ sistema_singular + " ?\n\n****************************");
     
     if (resposta == true) {
          window.location.href = 'excluir_registro.php?codigo_modulo=' + codigo_modulo + '&pagina=' + pagina + '&' + chave_primaria + '=' + valor_chave_primaria ;
     }
}
</script>
</head>
