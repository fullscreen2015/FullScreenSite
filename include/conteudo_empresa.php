<div class="geral_interna">
  <div class="container">

    <div class="texto_empresa">

      <h2>APRESENTA��O</h2>

      <p>A Full Screen preocupada sempre com qualidade e inova��o tem como proposta principal unir tradi��o e juventude para melhorar a cada dia a qualidade dos seus produtos e servi�os. O nosso diferencial se deve ao atendimento personalizado e a utiliza��o de tecnologia de ponta na gest�o administrativa dos seus clientes.</p>

      <h1>A FULL SCREEN</h1>

      <p>A Full Screen foi criada em 1996 para atuar no desenvolvimento de soluções corporativas para empresas que buscam aprimorar o controle interno apoiado em sistema de gest�o administrativa com m�dulos integrados em todos os setores da empresa no padr�o �ERP�.</p>

      <p>Nosso principal foco s�o as empresas de com�rcio em geral, ind�strias, metal�rgicas entre outras. Nossos sistemas s�o parametrizados e atendem tamb�m aos segmentos de Atacado/Distribui��o, Auto-Pe�as, pequenos com�rcios at� grandes lojas de departamentos.</p>

      <p>A empresa possui em seu quadro de funcion�rios, profissionais formados nas diversas �reas de TI, com grande experi�ncia em desenvolvimento, implanta��o e treinamento.</p>


    </div>


    <div class="caixa_right_empresa">
      <img src="imagens/layout/empresa-v03.png" brder="0" title="A Full Screen" alt="A Full Screen" width="409" height="435">
    </div>

    <div class="texto_empresa_grande">
       <h2>soluções</h2>

        <p><span>Automa��o Comercial: </span>Automa��o comercial � a aplica��o de m�todos e ferramentas para automatizar, mecanizar e agilizar processos manuais, alcan�ando total efici�ncia. Com a automa��o, tarefas pass�veis de erros, como: c�lculo e digita��o de pre�os, quantidades, emiss�o de nota fiscal; ficam mais seguras e eficientes. Atualmente as leis brasileiras est�o ficando mais complexas e exigentes no que se refere a automa��o comercial exigindo da empresa desenvolvedora bem como do usuário final r�gidos controles. A �Full Screen� possui software pr�prio desenvolvido de acordo com as novas leis vigentes do pa�s.         </p>
        <p><span>Automa��o de Vendas: </span>O VDM Plus � um aplicativo desenvolvido para Tablets e Smartphones, que tenham como sistema operacional o Android. Destina-se a atender empresas que trabalham com vendas externas (atacadistas / distribuidores).        </p>
        <p><span>Servi�os de Hardware:</span> Temos equipe t�cnica treinada e devidamente habilitada na execu��o de servi�os t�cnicos de manuten��o de computadores em geral bem como instala��o e configura��o de redes em geral. Contamos hoje com laborat�rio pr�prio para reparos emergenciais e parcerias formatadas de forma a buscar a melhor solu��o para os nossos clientes. Oferecemos aos nossos clientes contratos de �manuten��o de computadoresó que incluem desde visitas peri�dicas com o prop�sito preventivo at� reparos emergenciais.       </p>


        <h2>A EQUIPE</h2>

        <p>A Full Screen traz em sua bagagem a pessoa do diretor Alcindo Alves dos Reis Filho, 35 anos de experi�ncia no desenvolvimento de aplicativos administrativos, financeiros e industriais para ambientes multiusuários em plataformas UNIX. Durante estes anos, o mesmo foi funcion�rio de algumas empresas de m�dio e grande porte onde iniciou a carreira como programador, tendo sido promovido posteriormente a analista de sistemas. Nos �ltimos 10 (dez) anos ainda como funcion�rio atuou na ger�ncia de setores de inform�tica (CPD�S) tendo tamb�m publicado alguns livros na �rea de desenvolvimento de sistemas em Visual Basic. </p>


        
        <div class="graficos_empresa margin_graficos_empresa">
          <img src="imagens/layout/grafico_empresa01.gif" title="" alt="" border="0" width="202" height="200">
          <p class="graficos_empresa_p">100% dos nossos colaboradores na equipe de desenvolvimento tem n�vel superior</p>
        </div>
        <div class="graficos_empresa">
          <img src="imagens/layout/grafico_empresa02.gif" title="" alt="" border="0" width="200" height="200">
          <p class="graficos_empresa_p">+ 85% S�o P�s-Graduados, Estudantes de P�s-Gradua��o ou Tem Certifica��es em TI.</p>
        </div>

    </div>

    <div class="caixa_equipe">
      <h2>conheça A EQUIPE</h2>
      
      <?php
 
        $funcionarios = array(
          'Alcindo#Diretor Geral<a href="livros.html">(Veja os seus livros publicados)</a>',
          'Gloria#Diretora',
          'Rafael#Diretor de Tecnologia',
          'Leonardo Fiasca#Gerente Financeiro',
          'Wellington#Gerente do Suporte',
          'Leandro#Gerente de Projetos',
          'Miguel#Gerente Comercial',
          'Alexandre#Gerente de Hardware',
          '�rica#Tester',
          'Shayane#Tester',
          'Leonardo Marques#Desenvolvedor',
          'Victor Hugo#Desenvolvedor',
          'Pedro# Desenvolvedor',
          'Andr�#Desenvolvedor',
          'Diego#Analista de Suporte',
          'Denilson#Analista de Suporte',
          'Marcos#Analista de Suporte',
          'Bruna Sardinha#Analista de Suporte',
          'Bruna Sangy#Analista de Suporte',
          'Victor Alt#Analista de Suporte',
          'Giselle#Secret�ria-Atendente',
          'Leandro Maduro#T�cnico de Hardware',
          'Adam#Auxiliar do Departamento Comercial'  
        );

         for ($i=1, $u=0; $i < 24; $i++,$u++) { 
          $foto = "imagens/equipe/".zerosaesquerda($i, 6).".jpg";
          $nome = substr($funcionarios[$u], 0, strpos( $funcionarios[$u],"#"));
          $cargo = substr($funcionarios[$u], strpos( $funcionarios[$u],"#")+1);

          if ( file_exists($foto) ) :
           
            if (($i%6)==0){
              echo '<div class="funcionario retira_margin_funcionario">';
            }
            else
            {              
              echo '<div class="funcionario">';
            }
              echo '<img src="'.$foto.'?'.filemtime($foto).'">';
              echo '<p class="nome_funcionarios">'.$nome.'</p>';
              echo '<p class="funcao_funcionario">'.$cargo.'</p>';
            echo '</div>';
            if (($i%6)==0){
              echo '<div style="clear:both"></div>';
            }
          endif;

        }
      ?>

    </div>

    <div class="imagem_fundo"></div>

  </div>
</div>