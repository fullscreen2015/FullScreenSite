<?php
	

	if(isset($_REQUEST['codigo_produto']))
	{
		$codigo_produto = anti_injection($_REQUEST['codigo_produto']);
	}

	// $codigo_produto = 1;


	$sql = "SELECT * FROM tabela_produtos WHERE codigo_produto=".$codigo_produto." AND publicar=1 AND ativo=1";
	$rs_produtos = mysql_query($sql, $conexao);
	$linha_produto = mysql_fetch_array($rs_produtos);

?>



<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_produtos">PRODUTOS</h1>
		<div class="caixa_total_detalhe">
			<div class="caixa_imagens">

			<?php


				   $i=1;
				   $x=0;

				   $maior = '';
				   $miniaria = '';

                    while($i < 100)
                    {


                      $thumbs = 'imagens/produtos/thumbs/'.zerosaesquerda($linha_produto['codigo_produto'],6).'_'.zerosaesquerda($i,6).'.jpg';
                      $foto = 'imagens/produtos/fotos/'.zerosaesquerda($linha_produto['codigo_produto'],6).'_'.zerosaesquerda($i,6).'.jpg';

                      if(file_exists($foto))
                      {

                      	if($x == 0)
                      	{
                      		$maior = '<img src="'.$foto.'" border="0" class="foto_principal" width="367" height="367" alt="'.$linha_produto['descricao_produto'].'"/>';
                      		$miniaria.= '<li><a href="'.$foto.'"><img src="'.$thumbs.'" width="112" height="112" alt="'.$linha_produto['descricao_produto'].'" border="0" /></a></li>';
                      		$x = 1;
                      	}
                      	else
                      	{
                      		$miniaria.= '<li><a href="'.$foto.'"><img src="'.$thumbs.'" width="112" height="112" alt="'.$linha_produto['descricao_produto'].'" border="0" /></a></li>';
                      	}

                      }

                       $i++;


                     }


				echo '<div id="total_mini">
						<ul id="img_menores">
							'.$miniaria.'
						</ul>
					</div>'.$maior;

               ?>




			</div>
			<div class="caixa_detalhes_right">
				<p class="nome_produto_detalhe"><?php echo $linha_produto['descricao_produto'];?></p>

				<?php

				if($linha_produto['preco_produto'] != 0)
				{

					echo '<div class="valor_produto">
							<p class="texto_valor_produto">R$ '.number_format($linha_produto['preco_produto'],2,',','.').'</p>
						</div>';

					echo '<p class="unidade">unid.</p>';
				}


				?>
				
				<img src="imagens/layout/bndes.jpg" border="0" class="bndes" />
				<img src="imagens/layout/botao_cielo.jpg" border="0" class="cielo" />

				<div class="botoes_redes">
					<div class="btn_twitter">
						<a href="https://twitter.com/share" class="twitter-share-button" data-lang="pt">Tweetar</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
					<div class="btn_face">
						<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width=58&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:58px; height:21px;" allowTransparency="true"></iframe>
					</div>
					<div class="btn_mais">
						<!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
						<script type="text/javascript" src="https://apis.google.com/js/platform.js">
						  {lang: 'pt-BR'}
						</script>

						<!-- Posicione esta tag onde você deseja que o botão +1 apareça. -->
						<div class="g-plusone"></div>
					</div>
				</div>
			</div>
			<div class="descricao_produto">
				<p class="texto_descricao"><?php echo $linha_produto['texto_produto'];?></p>

			<!-- 	<ul>
					<li class="texto_descricao_"> ColorLok® é a mais nova tecnologia em papéis para imprimir. Uma inovação que é resultado de estudos e pesquisas realizadas por meio de uma parceria entre cientistas da International Paper e da Hewlett-Packard.</li>
					<li class="texto_descricao_">Com a tecnologia ColorLok® é possível fixar melhor as cores impressas, produzindo documentos com imagens mais vivas. Também oferece secagem mais rápida que contribui para a diminuição de manchas.</li>
					<li class="texto_descricao_"> A tecnologia ColorLok® proporciona:</li>
					<li> Cores mais brilhantes para imagens mais ricas e verdadeiras.</li>
					<li> Secagem de tinta mais rápida que reduz o risco de manchas.</li>
					<li> Preto mais intenso para uma melhor nitidez.</li>
				</ul> -->


			</div>
             
             <a href="javascript:history.go(-1);" class="voltar_prod_detalhe"><img src="imagens/layout/voltar.png" title="Voltar" alt="Voltar" border="0" width="113" height="24"></a>

		</div>
		<div class="imagem_fundo">
		</div>
		
	</div>
</div>