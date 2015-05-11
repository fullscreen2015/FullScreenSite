
          <div class="conteudo_empresa">
            <div class="container">
                <div class="foto_empresa">
                  <img src="imagens/layout/imagem_empresa.png" border="0" />
                </div>
                <div class="caixa_right">
                  <h1 class="empresa_principal"><span>Automação Comercial</span></h1>
                  
                  <p class="empresa_principal_texto">soluções em automação comercial, com a integração entre homem e máquina somados a gestão. A automação lhe permite total ger�ncia e controle operacional sobre a empresa. A Full Screen possui softwares pr�prios, desenvolvidos de acordo com as novas leis vigentes, como nota fiscal eletr�nica e nota fiscal eletr�nica do consumidor, buscando o aprimoramento do controle interno, apoiado em sistema de gest�o administrativa com m�dulos integrados em todos os setores da empresa no padr�o �ERP�.</p>
                  
                </div>
                <div class="fundo_abaixo">
                  <img src="imagens/layout/imagem_conteudo.png" border="0" class="imagem_desenho"/>
                </div> 
            </div>

          </div>
          <div class="destaques">
            <div class="container">
              <div class="titulo_destaques">
                <h2>conheça ALGUNS DE NOSSOS PRODUTOS!</h2>
              </div>
              <div id="carrossel">
            
                <ul id="mycarousel" class="jcarousel jcarousel-skin-tango">

                  <?php

                  $sql = "SELECT * FROM tabela_produtos WHERE destaque=1 AND publicar=1 AND ativo=1";

                  $rs_produtos_destaques = mysql_query($sql, $conexao);

                  while($linha_produtos = mysql_fetch_array($rs_produtos_destaques))
                  {
                    $link_ht = linkht('pdt,',$linha_produtos['codigo_produto'],$linha_produtos['descricao_produto']);

                    $i=1;

                    while($i < 100)
                    {


                    $foto = 'imagens/produtos/amp/'.zerosaesquerda($linha_produtos['codigo_produto'],6).'_'.zerosaesquerda($i,6).'.jpg';

                      if(file_exists($foto))
                      {

                        echo '<li>
                        <a href="'.$link_ht.'" class="link_slide">
                        <img src="'.$foto.'" width="420" height="292" alt="'.$linha_produtos['descricao_produto'].'" border="0" />
                        <p class="titulo_produto_carrossel">'.$linha_produtos['descricao_produto'].'</p>
                        <p class="descricao_produto_carrossel">'.$linha_produtos['texto_produto'].'</p>
                        </a>
                        </li>';


                        $i = 100;

                      }
                      else
                      {
                          $i++;
                      }

                    }

                  }


                  ?>
                   
                 <!--   <li>
                    <img src="imagens/produtos/produto2.png" width="420" height="292" alt="Foto 1" border="0" />
                    <p class="titulo_produto_carrossel">MULTIFUNCIONAL HP LASERJET M1132 MFP</p>
                    <p class="descricao_produto_carrossel">Enfrente suas tarefas di�rias do escrit�rio com uma MFP acess�vel e f�cil de usar. 
                      Conecte e imprima em apenas cinco minutos com HP Smart Install, e imprima, copie, digitalize com uma m�quina compacta.</p>
                    </li>
                    <li>
                    <img src="imagens/produtos/produto1.png" width="420" height="292" alt="Foto 1" border="0" />
                    <p class="titulo_produto_carrossel">IMPRESSORA FISCAL DARUMA MACH 1</p>
                    <p class="descricao_produto_carrossel">A linha MACH � a mais nova fam�lia de impressoras fiscais 
                          da Urmet Daruma, adequada para a emiss�o de cupons fiscais, destinado ao com�rcio varejista e prestadores de servi�os em geral.</p>
                    </li>
                   <li>
                    <img src="imagens/produtos/produto2.png" width="420" height="292" alt="Foto 1" border="0" />
                    <p class="titulo_produto_carrossel">MULTIFUNCIONAL HP LASERJET M1132 MFP</p>
                    <p class="descricao_produto_carrossel">Enfrente suas tarefas di�rias do escrit�rio com uma MFP acess�vel e f�cil de usar. 
                      Conecte e imprima em apenas cinco minutos com HP Smart Install, e imprima, copie, digitalize com uma m�quina compacta.</p>
                    </li> -->
                </ul>
              </div>
            </div>
          </div> 