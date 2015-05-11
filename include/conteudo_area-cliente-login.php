<div class="geral_interna">
	<div class="container">
		<h1 class="titulo_area_cliente">ÁREA DO CLIENTE</h1>
		<form id="form_contato_login" name="form_dados" class="form-entrar-contato_login" method="post" action="sistema_login.php" onsubmit="return validar(this);" >
			<div class="forms_login">
				<p class="p-contato_login">LOGIN</p>
				<input type="text" alt="E-mail" name="email" id="email" title="E-mail"  class="input-contato_login" value="<?php if ( isset ( $_SESSION["dados"]["email"] ) ) { echo $_SESSION["dados"]["email"]; } ?>"> 
				<p class="p-contato_login">SENHA</p>
				<input type="password" title="Senha" name="senha"  id="senha" class="input-contato_login" alt="Senha"  value="">
					
				<input type="submit" name="enviar" id="enviar" value="ENVIAR" class="enviar_contatologin" />
			</div>
		</form> 
		<div class="imagem_fundo">
		</div>
	</div>
</div>