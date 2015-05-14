<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_contato">CONTATO</h1>
		<div class="caixa_left_contato">
			<p class="texto_contato">
				DEIXE SUA SUGESTÃO, DÍVIDA OU CRÍTICA QUE RESPONDEREMOS O MAIS BREVE POSSÍVEL!
			</p>
			<form id="form_contato" name="form_dados" class="form-entrar-contato" method="post" action="php_envia_contato.php" onsubmit="return validar(this);" >
				<div class="forms">
					<p class="p-contato_ ">
						NOME
					</p>
					<input type="text" title="Nome" name="nome"  id="nome" class="input-contato_" alt="Nome" value="<?php
						if (isset($_SESSION["dados"]["nome"])) { echo $_SESSION["dados"]["nome"];
						}
					?>">
					<p class="p-contato_">
						E-MAIL
					</p>
					<input type="text" alt="E-mail" name="email" id="email" title="E-mail"  class="input-contato_" value="<?php
						if (isset($_SESSION["dados"]["email"])) { echo $_SESSION["dados"]["email"];
						}
 ?>">
					<p class="p-contato_ ">
						MENSAGEM
					</p>
					<textarea title="Mensagem" name="mensagem" rows="10" id="mensagem" class="input-contato-mens"></textarea>
					<input type="submit" name="enviar" id="enviar" value="ENVIAR" class="enviar_contato" />
				</div>
			</form>
		</div>
		<div class="google_maps">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3692.011373574621!2d-42.53335!3d-22.277559!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x978a95037666db%3A0x54015fad14fd65c3!2sMaria+da+Gl%C3%B3ria+Leal+Reis!5e0!3m2!1spt-BR!2sbr!4v1431629441534" width="600" height="450" frameborder="0" style="border:0"></iframe>
		</div>
		<div class="imagem_fundo"></div>
	</div>
</div>