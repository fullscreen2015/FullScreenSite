    <br>
    &nbsp;&nbsp;
    <font class="caminho"><b>:: Busca: </b></font>
    &nbsp;&nbsp;&nbsp;
    <input class=input type=text name=expressao_busca value="<? echo $expressao_busca; ?>">

    <select class="select" name="nome_campo_busca">
      <option value="">Selecione</option>

<?


      for($cont=1;$cont<=$numero_campos;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont1 = $cont_ . "1";
        $cont2 = $cont_ . "2";
        $cont5 = $cont_ . "5";
  
        if ($campos[$cont5]=="")
        {  ?>

          <option value="<? echo $campos[$cont1];  ?>" <? if($campos[$cont1]==$nome_campo_busca) echo "selected";?>>Por <? echo $campos[$cont2];  ?></option>

<?      }  
      }  ?>

    </select>
  
    <input class=submit type="submit" value="ok">

    <br><br>


<?

  for($cont=1;$cont<=$numero_campos;$cont++)
  {
    $cont_ = (10 + $cont);
    $cont2 = $cont_ . "2";
    $cont5 = $cont_ . "5";
    $cont6 = $cont_ . "6";
    $cont7 = $cont_ . "7";

    if (($campos[$cont5]!="")&&($campos[$cont6]!="")&&($campos[$cont7]!=""))
    {  ?>

      &nbsp;&nbsp;

<?    select(":: Filtro - " . $campos[$cont2],$campos[$cont6],$campos[$cont5],$campos[$cont7]);  ?>

      <input class=submit type="submit" value="ok">

      <br><br>

<?
    }
  }
?>



    &nbsp;&nbsp;
    <font class="caminho"><b>:: Ordenar <? echo $sistema_plural; ?> por: </b></font>
    &nbsp;&nbsp;&nbsp;

    <select class="select" name="nome_campo_ordem">
      <option value="">Selecione</option>

<?


      for($cont=1;$cont<=$numero_campos;$cont++)
      {
        $cont_ = (10 + $cont);
        $cont1 = $cont_ . "1";
        $cont2 = $cont_ . "2";
        $cont5 = $cont_ . "5";
  
        if ($campos[$cont5]=="")
        {  ?>

          <option value="<? echo $campos[$cont1];  ?>" <? if($campos[$cont1]==$nome_campo_ordem) echo "selected";?>><? echo $campos[$cont2];  ?></option>

<?      }  
      }  ?>

    </select>
  
    <font class="caminho"><b>Na ordem: </b></font>

    <select class="select" name="tipo_ordem">
      <option value="">Selecione</option>
      <option value="asc" <? if($tipo_ordem=="asc") echo "selected";?>>Crescente</option>
      <option value="desc" <? if($tipo_ordem=="desc") echo "selected";?>>Decrescente</option>
    </select>



    <input type="submit" class=submit value="ok">

    <br><br>