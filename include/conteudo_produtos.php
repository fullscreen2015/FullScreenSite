<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_produtos">PRODUTOS</h1>


        <p class="p_produtos_top">Para comprar ou cotar qualquer equipamento abaixo, entre em contato direto com o nosso departamento comercial. <a href="contato.html">Clique aqui!</a></p>

		<div class="caixa_total_produtos">





		<?php

			// $sql = "SELECT * FROM tabela_produtos WHERE publicar=1 AND ativo=1";

			// $rs_produtos = mysql_query($sql, $conexao);

			// while($linha_produto = mysql_fetch_array($rs_produtos))
			// {

			// 	$link_ht = linkht('pdt,',$linha_produto['codigo_produto'],$linha_produto['descricao_produto']);

			// 	$i=1;

   //              while($i < 10)
   //              {


			// 		$foto = 'imagens/produtos/fotos/'.zerosaesquerda($linha_produto['codigo_produto'],6).'_'.zerosaesquerda($i,6).'.jpg';
			// 		// echo $foto;
		 //            if(file_exists($foto))
		 //            {

			// 			echo '<div class="caixa_produto">
			// 					<a href="'.$link_ht.'">
			// 						<div class="ch-item" style="background-image:url(\''.$foto.'\') ">
			// 							<div class="ch-info">
			// 								<img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
			// 								<div class="fundo_texto">
			// 									<p class="nome_produto_hover">'.$linha_produto['descricao_produto'].'</p>
			// 								</div>
			// 							</div>
			// 						</div>
			// 					</a>
			// 				</div>';

			// 			$i = 100;

	  //               }
	  //               else
	  //               {
	  //                    $i++;
	  //               }


			// 	}

			// }
		?>






        <?php

            $sql = "SELECT * FROM tabela_categorias_produtos WHERE publicar=1 AND ativo=1";

            $rs_categorias = mysql_query($sql, $conexao);

            while($linha_categoria = mysql_fetch_array($rs_categorias))
            {

    

            $sql = "SELECT * FROM tabela_produtos WHERE publicar=1 AND ativo=1 AND codigo_categoria=".$linha_categoria["codigo_categoria"];

            $rs_produtos = mysql_query($sql, $conexao);

            if(mysql_num_rows($rs_produtos))
            {

               echo'<div class="categorias_clientes">
                <div class="cat" id="'.$linha_categoria["codigo_categoria"].'">
                  <h2 style="float:left;"><a href="#" class="titulo_cat" rel="'.$linha_categoria["codigo_categoria"].'">'.$linha_categoria["descricao_categoria"].'</a></h2>
                  
                </div>
                <div class="geral_clientes" id="1">
                  <div class="sub_cat">';



            }

            while($linha_produto = mysql_fetch_array($rs_produtos))
            {

                $link_ht = linkht('pdt,',$linha_produto['codigo_produto'],$linha_produto['descricao_produto']);

                $i=1;

                while($i < 10)
                {


                    $foto = 'imagens/produtos/fotos/'.zerosaesquerda($linha_produto['codigo_produto'],6).'_'.zerosaesquerda($i,6).'.jpg';
                    // echo $foto;
                    if(file_exists($foto))
                    {

                        echo '<div class="caixa_produto">
                                <a href="'.$link_ht.'">
                                    <div class="ch-item" style="background-image:url(\''.$foto.'\') ">
                                        <div class="ch-info">
                                            <img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
                                            <div class="fundo_texto">
                                                <p class="nome_produto_hover">'.$linha_produto['descricao_produto'].'</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>';

                        $i = 100;

                    }
                    else
                    {
                         $i++;
                    }


                }


            }

           if(mysql_num_rows($rs_produtos))
            {

            echo'</div>
                 </div>
                <div style="clear:both;"></div>
                </div>';

              }
      }
        ?>













		</div>
				
	<!-- 	<div class="imagem_fundo">
		</div> -->
	</div>
</div>