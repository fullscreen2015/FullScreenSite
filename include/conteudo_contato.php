<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_contato">CONTATO</h1>
		<div class="caixa_left_contato">
			<p class="texto_contato">DEIXE SUA SUGESTÃO, DÚVIDA OU CRÍTICA QUE RESPONDEREMOS O MAIS BREVE POSSÍVEL!</p>
			<form id="form_contato" name="form_dados" class="form-entrar-contato" method="post" action="php_envia_contato.php" onsubmit="return validar(this);" >
				<div class="forms">
					<p class="p-contato_ ">NOME</p>
					<input type="text" title="Nome" name="nome"  id="nome" class="input-contato_" alt="Nome" value="<?php  if ( isset ( $_SESSION["dados"]["nome"] ) ) { echo $_SESSION["dados"]["nome"]; }?>">
					<p class="p-contato_">E-MAIL</p>
					<input type="text" alt="E-mail" name="email" id="email" title="E-mail"  class="input-contato_" value="<?php if ( isset ( $_SESSION["dados"]["email"] ) ) { echo $_SESSION["dados"]["email"]; } ?>"> 
					<p class="p-contato_ ">MENSAGEM</p>
					<textarea title="Mensagem" name="mensagem" rows="10" id="mensagem" class="input-contato-mens"></textarea> 
					<input type="submit" name="enviar" id="enviar" value="ENVIAR" class="enviar_contato" />
				</div>
			</form> 
		</div>
		<img src="imagens/layout/telefone_contato.png" border="0" class="tel_contato"/>

		<div class="imagem_fundo">
		</div>
	</div>
</div>