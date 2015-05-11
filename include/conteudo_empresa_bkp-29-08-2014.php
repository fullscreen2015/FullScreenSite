<div class="geral_interna">
  <div class="container">

    <div class="texto_empresa">
      <h1>A FULL SCREEN</h1>

      <p>A Full Screen foi criada em 1996 para atuar no desenvolvimento de soluções corporativas para empresas que buscam aprimorar o controle interno apoiado em sistema de gest�o administrativa com m�dulos integrados em todos os setores da empresa no padr�o �ERP�.</p>

      <p>Nosso principal foco s�o as empresas de com�rcio em geral, ind�strias de confec��o, metal�rgicas entre outras.</p>

      <p>Nossos sistemas s�o parametrizados e atendem tamb�m aos segmentos de Atacado/Distribui��o, Auto-Pe�as, Auto-Center, pequenos com�rcios at� grandes lojas de departamentos.</p>

      <p>A empresa possui em seu quadro de funcion�rios, profissionais formados em an�lise de sistemas e processamentos de dados, com grande experi�ncia em desenvolver e implantar sistemas de gest�o empresarial, assim como treinar os nossos usuários na utiliza��o dos Sistemas.</p>

      <p>A Full Screen traz em sua bagagem inicial na pessoa do nosso diretor Alcindo Alves dos Reis Filho, 35 anos de experi�ncia no desenvolvimento de aplicativos administrativos, financeiros e industriais para ambientes multiusuários em plataformas UNIX . Durante estes anos, nosso diretor foi funcion�rio de algumas empresas de m�dio e grande porte onde iniciou a carreira como programador, tendo sido promovido posteriormente a analista de sistemas. Nos �ltimos 10(dez) anos ainda como funcion�rio atuou na ger�ncia de setores de inform�tica (CPD�S) tendo tamb�m publicado alguns livros na �rea de desenvolvimento de sistemas em Visual Basic.</p>
    
    </div>

    <div class="caixa_right_empresa">
      <img src="imagens/layout/empresa.png">
    </div>

    <div class="caixa_equipe">
      <h2>A EQUIPE</h2>
      
      <?php

        $funcionarios = array(
          'Alcindo#Proprietario',
          'Gloria#Proprietaria',
          'Miguel#Gerente Comercial',
          'Leonardo Fiasca#Gerente Financeiro',
          'Rafael#Gerente do Desenvolvimento',
          'Wellington#Gerente do Suporte',
          'Leandro#Gerente de Projetos',
          'Giselle#Secret�ria-Atendente',
          '�rica#Tester',
          'Shayane#Tester',
          'Bruna Sangy#Analista de Suporte',
          'Bruna Sardinha#Analista de Suporte',
          'Denilson#Analista de Suporte',
          'Diego#Analista de Suporte',
          'Marcos#Analista de Suporte',
          'Victor Alt#Analista de Suporte',
          'Leonardo Marques#Desenvolvedor',
          'Pedro# Desenvolvedor',
          'Victor Hugo#Desenvolvedor',
          'Andr�#Desenvolvedor',
          'Alexandre#Gerentre de Hardware',
          'Leandro Maduro#T�cnico de Hardware',
          'Adam#T�cnico de Hardware'
        );

        for ($i=1, $u=0; $i < 24; $i++,$u++) { 
          $foto = "imagens/equipe/old/".zerosaesquerda($i, 6).".jpg";
          $nome = substr($funcionarios[$u], 0, strpos( $funcionarios[$u],"#"));
          $cargo = substr($funcionarios[$u], strpos( $funcionarios[$u],"#")+1);

          if ( file_exists($foto) ) :
            echo '<div class="funcionario">';
              echo '<img src="'.$foto.'">';
              echo '<p class="nome_funcionarios">'.$nome.'</p>';
              echo '<p class="funcao_funcionario">'.$cargo.'</p>';
            echo '</div>';
          endif;

        }
      ?>

    </div>

    <div class="imagem_fundo"></div>

  </div>
</div>