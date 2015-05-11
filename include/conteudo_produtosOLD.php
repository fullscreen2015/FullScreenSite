<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_produtos">PRODUTOS</h1>
		<div class="caixa_total_produtos">


		<?php

			$sql = "SELECT * FROM tabela_produtos WHERE publicar=1 AND ativo=1";

			$rs_produtos = mysql_query($sql, $conexao);

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
		?>
			<!-- <div class="caixa_produto">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto4.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
							<div class="fundo_texto">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="caixa_produto">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto5.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
							<div class="fundo_texto">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="caixa_produto_ultimo">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto5.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover2.png" border="0" class="seta_fundo2" />
							<div class="fundo_texto2">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="caixa_produto">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto3.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
							<div class="fundo_texto">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="caixa_produto">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto4.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
							<div class="fundo_texto">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="caixa_produto">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto5.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover.png" border="0" class="seta_fundo" />
							<div class="fundo_texto">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="caixa_produto_ultimo">
				<a href="detalhe.html">
					<div class="ch-item" style="background-image:url('imagens/produtos/produto3.png') ">
						<div class="ch-info">
							<img src="imagens/produtos/fundo_hover2.png" border="0" class="seta_fundo2" />
							<div class="fundo_texto2">
								<p class="nome_produto_hover">Papel HP Office A4 ColorLok®</p>
								<p class="tamanho_produto_hover">75 Grs 210 x 297 mm</p>
							</div>
						</div>
					</div>
				</a>
			</div> -->
		</div>
				
		<div class="imagem_fundo">
		</div>
	</div>
</div>