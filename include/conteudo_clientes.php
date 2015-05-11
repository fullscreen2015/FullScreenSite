<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_cliente">CLIENTES</h1>
<!-- 
		<div class="categorias_clientes">
      <div class="cat" id="1">
        <h2><a href="#" class="titulo_cat" rel="1">CATEGORIA DE CLIENTES</a></h2>
        
      </div>
      <div class="geral_clientes" id="1">
        <div class="sub_cat"  >
          <img src="imagens/clientes/cliente1.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente2.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente3.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente4.png" border="0" class="img_cliente_ultimo"/>
        </div>
      </div>
    <div style="clear:both;"></div>
    </div>

 -->
    <?php

    $sql = "SELECT * FROM tabela_categorias_portifolios WHERE publicar=1 AND ativo=1";
    $rs_categorias = mysql_query($sql, $conexao);
    $i = 1;
    while($linha_categoria = mysql_fetch_array($rs_categorias))
    {
        $sql_cli = "SELECT * FROM tabela_portifolios WHERE codigo_categoria=".$linha_categoria['codigo_categoria']." AND publicar=1 AND ativo=1";
        $rs_cli = mysql_query($sql_cli, $conexao);

        if(mysql_num_rows($rs_cli))
        {

          echo '<div class="categorias_clientes">
                <div class="cat" id="'.$i.'">
                  <h2><a href="#" class="titulo_cat" rel="'.$i.'">'.$linha_categoria['descricao_categoria'].'</a></h2>
                  
                </div>
                <div class="geral_clientes" id="1">
                  <div class="sub_cat">';

                  while($linha_cli = mysql_fetch_array($rs_cli))
                  {

                      $foto = 'imagens/portifolio/thumbs/'.zerosaesquerda($linha_cli['codigo_portifolio'],6).'.jpg';

                      if(file_exists($foto))
                      {

                        if($linha_cli['url_portifolio'] != "")
                        {
                          echo '<a href="'.$linha_cli['url_portifolio'].'" target="_blank">';
                        }

                        echo '<img src="'.$foto.'" border="0" class="img_cliente"/>';

                        if($linha_cli['url_portifolio'] != "")
                        {
                          echo '</a>';
                        }
                        
                      }
      
                  }


          echo '</div>
                </div>
                <div style="clear:both;"></div>
                </div>';




        }

        $i++;

    }




    ?>



	<!-- 	 <div class="categorias_clientes">
      <div class="cat " id="2">
        <h2><a href="#" class="titulo_cat" rel="2">CATEGORIA DE CLIENTES</a></h2>
        
      </div>
      <div class="geral_clientes" id="2">
        <div class="sub_cat"  >
          <img src="imagens/clientes/cliente1.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente2.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente3.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente4.png" border="0" class="img_cliente_ultimo"/>
        </div>
      </div>
    </div>
   <div class="categorias_clientes">
      <div class="cat " id="3">
        <h2><a href="#" class="titulo_cat" rel="3">CATEGORIA DE CLIENTES</a></h2>
        
      </div>
      <div class="geral_clientes" id="3">
        <div class="sub_cat"  >
          <img src="imagens/clientes/cliente1.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente2.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente3.png" border="0" class="img_cliente"/>
          <img src="imagens/clientes/cliente4.png" border="0" class="img_cliente_ultimo"/>
        </div>
      </div>
    </div>
    <div class="categorias_clientes">
      <div class="cat " id="4">
        <h2><a href="#" class="titulo_cat" rel="4">CATEGORIA DE CLIENTES</a></h2>
        
      </div>
      <div class="geral_clientes" id="4">
	      <div class="sub_cat"  >
	        <img src="imagens/clientes/cliente1.png" border="0" class="img_cliente"/>
	        <img src="imagens/clientes/cliente2.png" border="0" class="img_cliente"/>
	        <img src="imagens/clientes/cliente3.png" border="0" class="img_cliente"/>
	        <img src="imagens/clientes/cliente4.png" border="0" class="img_cliente_ultimo"/>
	      </div>
      </div>
    </div> -->


	</div>
</div>