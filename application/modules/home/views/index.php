<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script type="text/javascript">
	var hash = "0";

	PagSeguroDirectPayment.setSessionId('<?php echo $sessao_pagseguro; ?>');

	PagSeguroDirectPayment.onSenderHashReady(function(response){
	    if(response.status == 'error') {
	        alert("Erro ao gerar hash! Entre em contato com a equipe de desenvolvimento de sistemas.");
	        return false;
	    }
	    hash = response.senderHash; //Hash estará disponível nesta variável.
	    // console.log(hash);
	    document.getElementById("hash_cliente").value = hash;
	    document.getElementById("form_produto").style.display = "block";
	});
</script>

<?php if($this -> session -> flashdata("mensagem")): ?>
<div class="alert alert-info">
	<?php echo $this -> session -> flashdata("mensagem"); ?>
</div>
<?php endif; ?>

<h4>Exemplo de formulário de produto</h4>

<?php echo form_open($this -> uri -> uri_string(), array('id' => 'form_produto', "class" => "form-horizontal")); ?>

<div class="control-group">
	<?php echo form_label("Hash:", "hash_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "hash_cliente", "id" => "hash_cliente", "value" => "", "readonly" => true)); ?>
		<?php echo form_error('hash_cliente'); ?>
	</div>
</div>

<div class="control-group">
	<?php echo form_label("Referência:", "referencia", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "referencia", "id" => "referencia", "value" => "REF001")); ?>
		<?php echo form_error('referencia'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Nome cliente:", "nome_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "nome_cliente", "id" => "nome_cliente", "value" => "Cliente de Teste")); ?>
		<?php echo form_error('nome_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("E-mail cliente:", "email_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "email_cliente", "id" => "email_cliente", "value" => "email@dominio.com.br")); ?>
		<?php echo form_error('email_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Telefone cliente:", "tel_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "tel_cliente", "id" => "tel_cliente", "value" => "91 999999999")); ?>
		<?php echo form_error('tel_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("CPF cliente:", "cpf_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cpf_cliente", "id" => "cpf_cliente", "value" => "78114210702")); ?>
		<?php echo form_error('cpf_cliente'); ?>
	</div>
</div>

<div class="control-group">
	<?php echo form_label("Endereço:", "endereco_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "endereco_cliente", "id" => "endereco_cliente", "value" => "Tv. Lomas Valentina")); ?>
		<?php echo form_error('endereco_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Número endereço:", "num_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "num_cliente", "id" => "num_cliente", "value" => "1000")); ?>
		<?php echo form_error('num_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Bairro endereço:", "bairro_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "bairro_cliente", "id" => "bairro_cliente", "value" => "Marco")); ?>
		<?php echo form_error('bairro_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("CEP endereço:", "cep_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cep_cliente", "id" => "cep_cliente", "value" => "66095670")); ?>
		<?php echo form_error('cep_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Cidade endereço:", "cidade_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cidade_cliente", "id" => "cidade_cliente", "value" => "Belém")); ?>
		<?php echo form_error('cidade_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Estado endereço:", "estado_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "estado_cliente", "id" => "estado_cliente", "value" => "PA")); ?>
		<?php echo form_error('estado_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("País endereço:", "pais_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "pais_cliente", "id" => "pais_cliente", "value" => "BRA")); ?>
		<?php echo form_error('pais_cliente'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Complemento endereço:", "complemento_cliente", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "complemento_cliente", "id" => "complemento_cliente", "value" => "Apto. 702")); ?>
		<?php echo form_error('complemento_cliente'); ?>
	</div>
</div>

<div class="control-group">
	<?php echo form_label("Código produto:", "codigo_produto", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "codigo_produto", "id" => "codigo_produto", "value" => "0001")); ?>
		<?php echo form_error('codigo_produto'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Nome produto:", "nome_produto", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "nome_produto", "id" => "nome_produto", "value" => "Livro Redes Neurais. Ed. Packt.")); ?>
		<?php echo form_error('nome_produto'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Quantidade produto:", "qtd_produto", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "qtd_produto", "id" => "qtd_produto", "value" => "1")); ?>
		<?php echo form_error('qtd_produto'); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label("Valor produto:", "valor_produto", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "valor_produto", "id" => "valor_produto", "value" => "1.00")); ?>
		<?php echo form_error('valor_produto'); ?>
	</div>
</div>

<div class="control-group">
	<?php echo form_label("Tipo de pagamento:", "tipo_pagamento", array("class" => "control-label")); ?>
	<div class="controls">
		<input type="radio" name="tipo_pagamento" value="boleto"  onclick="exibirBoleto()" checked> Boleto<br>
		<input type="radio" name="tipo_pagamento" value="credito" onclick="exibirCredito()"> Crédito<br>
		<input type="radio" name="tipo_pagamento" value="debito"  onclick="exibirDebito()"> Débito
	</div>
	<?php echo form_error('tipo_pagamento'); ?>
</div>

<div id="credito">
	<br/><hr/>
	<h4>Informações de Crédito</h4>
	<hr/>
	<?php echo form_label("Nome do titular (idêntico ao impresso no cartão):", "cartao_nome", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_nome", "id" => "cartao_nome", "value" => "Fulano de Tal")); ?>
		<?php echo form_error('cartao_nome'); ?>
	</div>

	<?php echo form_label("Número do cartão:", "cartao_numero", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_numero", "id" => "cartao_numero", "value" => "???", "maxlength" => 16)); ?>
		<?php echo form_error('cartao_numero'); ?>
	</div>

	<?php echo form_label("Código de segurança (CVV):", "cartao_cvv", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_cvv", "id" => "cartao_cvv", "value" => "???")); ?>
		<?php echo form_error('cartao_cvv'); ?>
	</div>

	<?php echo form_label("Mês/Ano de expiração do cartão:", "cartao_mes", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_mes", "id" => "cartao_mes", "value" => "???", "size" => 3)); ?>
		<?php echo form_error('cartao_mes'); ?>
		/
		<?php echo form_input(array("name" => "cartao_ano", "id" => "cartao_ano", "value" => "???", "size" => 3,
			"onblur" => "getBandeiraCartaoCredito()")); ?>
		<?php echo form_error('cartao_ano'); ?>
	</div>

	<?php echo form_label("Bandeira do cartão:", "cartao_bandeira", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_bandeira", "id" => "cartao_bandeira", "value" => "", "readonly" => true)); ?>
		<?php echo form_error('cartao_bandeira'); ?>
	</div>

	<?php echo form_label("Token gerado para o cartão:", "cartao_token", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_token", "id" => "cartao_token", "value" => "", "readonly" => true)); ?>
		<?php echo form_error('cartao_token'); ?>
	</div>

	<?php echo form_label("Data de nascimento do titular:", "cartao_data_nascimento", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_data_nascimento", "id" => "cartao_data_nascimento", "value" => "10/06/1990")); ?>
		<?php echo form_error('cartao_data_nascimento'); ?>
	</div>

	<?php echo form_label("Telefone do titular:", "cartao_tel", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_tel", "id" => "cartao_tel", "value" => "91 998899889")); ?>
		<?php echo form_error('cartao_tel'); ?>
	</div>

	<?php echo form_label("CPF do titular:", "cartao_cpf", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_input(array("name" => "cartao_cpf", "id" => "cartao_cpf", "value" => "83901442120")); ?>
		<?php echo form_error('cartao_cpf'); ?>
	</div>

	<?php echo form_label("Quantidade de parcelas:", "cartao_parcelas", array("class" => "control-label")); ?>
	<div class="controls">
		<?php echo form_dropdown("cartao_parcelas", array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'), '1'); ?>
		<?php echo form_error('cartao_parcelas'); ?>
	</div>
</div>

<div id="debito">
	<br/><hr/>
	<h4>Informações de Débito</h4>
	<hr/>
	<div class="control-group">
		<?php echo form_label("Banco para débito online:", "banco_debito", array("class" => "control-label")); ?>
		<div class="controls">
			<input type="radio" name="banco_debito" value="bancodobrasil" checked> Banco do Brasil<br>
			<input type="radio" name="banco_debito" value="itau"> Itaú<br>
			<input type="radio" name="banco_debito" value="bradesco"> Bradesco<br>
			<input type="radio" name="banco_debito" value="hsbc"> HSBC<br>
			<input type="radio" name="banco_debito" value="banrisul"> BanriSul
		</div>
		<?php echo form_error('banco_debito'); ?>
	</div>
</div>

<br/>
<div class="form-actions">
	<button type="submit" name="botao" value="entrar" class="btn btn-primary">Pagar</button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
	document.getElementById("form_produto").style.display = "none";
	
	// getMeiosPagamento();
	exibirBoleto();

	function exibirBoleto() {
		document.getElementById("credito").style.display = "none";
		document.getElementById("debito").style.display  = "none";
	}
	function exibirCredito() {
		document.getElementById("credito").style.display = "block";
		document.getElementById("debito").style.display  = "none";
	}
	function exibirDebito() {
		document.getElementById("credito").style.display = "none";
		document.getElementById("debito").style.display  = "block";
	}

	function getMeiosPagamento() {
		PagSeguroDirectPayment.getPaymentMethods({
			amount: 500.00,
			success: function(response) {
				//meios de pagamento disponíveis
				if( ! response["error"] ) {
					metodosPagamento = response["paymentMethods"];
					// console.log(metodosPagamento);
				} else {
					alert("Erro ao acessar os meios de pagamento! Entre em contato com a equipe de desenvolvimento de sistemas.");
	        		return false;
				}
			},
			error: function(response) {
				//tratamento do erro
				alert("Erro ao acessar os meios de pagamento! Entre em contato com a equipe de desenvolvimento de sistemas.");
	        	return false;
			},
			complete: function(response) {
				//tratamento comum para todas chamadas
			}
		});
	}
	function getBandeiraCartaoCredito() {
		cartao = document.getElementById('cartao_numero').value;

		if ( cartao.length === 16 ) {
			PagSeguroDirectPayment.getBrand({
				cardBin: cartao.substring(0, 6),
					success: function(response) {
						//bandeira encontrada
						//console.log(response);
						document.getElementById('cartao_bandeira').value = response.brand.name;
						getTokenCartaoCredito();
					},
					error: function(response) {
						//tratamento do erro
						alert("Erro ao acessar a bandeira do cartão de crédito informado! Confirme o número informado ou entre em contato com a equipe de desenvolvimento de sistemas.");
		        		return false;
					},
					complete: function(response) {
						//tratamento comum para todas chamadas
					}
			});
		} else {
			alert("Informe os 16 números do cartão de crédito (sem espaços).");
		    return false;
		}
	}
	function getOpcoesParcelamentoCartaoCredito() {

	}
	function validarMesAnoCartaoCredito() {

	}
	function getTokenCartaoCredito() {
		cartao   = document.getElementById('cartao_numero').value;
		bandeira = document.getElementById('cartao_bandeira').value;
		cvv      = document.getElementById('cartao_cvv').value,
		mes      = document.getElementById('cartao_mes').value,
		ano      = document.getElementById('cartao_ano').value;

		var param = {
			cardNumber: cartao,
		 	brand: bandeira,
			cvv:   cvv,
			expirationMonth: mes,
			expirationYear:  "20"+ano,
			success: function(response) {
				//token gerado, esse deve ser usado na chamada da API do Checkout Transparente
				console.log(response);
				document.getElementById("cartao_token").value = response.card.token;
			},
			error: function(response) {
				//tratamento do erro
				alert("Erro ao tentar gerar token do carão de crédito! O número, o código de segurança, a bandeira, o mês e o ano de expiração do cartão são, respectivamente, "+cartao+", "+cvv+", "+bandeira+", "+mes+", "+ano+"?\n\nSe os valores estão válidos e o erro persiste, entre em contato com a equipe de desenvolvimento de sistemas.");
		        		return false;
			},
			complete: function(response) {
				//tratamento comum para todas chamadas
			}
		}
		PagSeguroDirectPayment.createCardToken(param);
	}
</script>