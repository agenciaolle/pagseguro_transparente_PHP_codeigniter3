<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Home extends MX_Controller {
	var $controle = NULL;
	function __construct() {
		parent::__construct ();
		
		//$this->load->model ( "ModelExemplo_model", "exemplo" );

		$this->load->library ( 'form_validation' );
		$this -> load -> library ( 'parser' );
		$this -> load -> library ( 'email' );
	}

	public function index($value='') {

		$sessao_pagseguro = $this -> getSessaoPagseguro();

		if($sessao_pagseguro == "0") {
			die( "Erro! Não gerou código de sessão do Pagseguro adequadamente" );
		}

		$this -> form_validation -> set_rules('hash_cliente', 'Hash', 'trim|required');

		$this -> form_validation -> set_rules('referencia', 'Referência', 'trim|required');
		$this -> form_validation -> set_rules('nome_cliente', 'Nome do cliente', 'trim|required');
		$this -> form_validation -> set_rules('email_cliente', 'E-mail do cliente', 'trim|required');
		$this -> form_validation -> set_rules('tel_cliente', 'Telefone do cliente', 'trim|required');
		$this -> form_validation -> set_rules('cpf_cliente', 'CPF do cliente', 'trim|required');
		$this -> form_validation -> set_rules('endereco_cliente', 'Endereço do cliente', 'trim|required');
		$this -> form_validation -> set_rules('num_cliente', 'Número do endereço', 'trim|required');
		$this -> form_validation -> set_rules('bairro_cliente', 'Bairro do endereço', 'trim|required');
		$this -> form_validation -> set_rules('cep_cliente', 'CEP do endereço', 'trim|required');
		$this -> form_validation -> set_rules('cidade_cliente', 'Cidade do endereço', 'trim|required');
		$this -> form_validation -> set_rules('estado_cliente', 'Estado do endereço', 'trim|required');
		$this -> form_validation -> set_rules('pais_cliente', 'País do endereço', 'trim|required');
		$this -> form_validation -> set_rules('complemento_cliente', 'Complemento do endereço', 'trim');
		$this -> form_validation -> set_rules('codigo_produto', 'Código do produto', 'trim|required');
		$this -> form_validation -> set_rules('nome_produto', 'Nome do produto', 'trim|required');
		$this -> form_validation -> set_rules('qtd_produto', 'Quantidade de produto', 'trim|required');
		$this -> form_validation -> set_rules('valor_produto', 'Valor do produto', 'trim|required');

		$this -> form_validation -> set_message('required', '%s é campo obrigatório');
		$this -> form_validation -> set_error_delimiters('<i style="color: red">', '</i>');

		if ($this -> form_validation -> run() == TRUE) {
			$hash_cliente  = $this -> input -> post("hash_cliente");
			$referencia    = $this -> input -> post("referencia");
			$nome_cliente  = $this -> input -> post("nome_cliente");
			$email_cliente = $this -> input -> post("email_cliente");
			$tel_cliente   = $this -> input -> post("tel_cliente");
			$cpf_cliente   = $this -> input -> post("cpf_cliente");
			$endereco_cliente = $this -> input -> post("endereco_cliente");
			$num_cliente    = $this -> input -> post("num_cliente");
			$bairro_cliente = $this -> input -> post("bairro_cliente");
			$cep_cliente    = $this -> input -> post("cep_cliente");
			$cidade_cliente = $this -> input -> post("cidade_cliente");
			$estado_cliente = $this -> input -> post("estado_cliente");
			$pais_cliente   = $this -> input -> post("pais_cliente");
			$complemento_cliente = $this -> input -> post("complemento_cliente");
			$codigo_produto = $this -> input -> post("codigo_produto");
			$nome_produto   = $this -> input -> post("nome_produto");
			$qtd_produto    = $this -> input -> post("qtd_produto");
			$valor_produto  = $this -> input -> post("valor_produto");

			$tipo_pagamento = $this -> input -> post("tipo_pagamento");

			// $hash = ????

			switch ($tipo_pagamento) {
				case 'boleto':
					$boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();

					$boleto->setMode('DEFAULT');
					$boleto->setCurrency("BRL");
					$boleto->addItems()->withParameters(
					    $codigo_produto,
					    $nome_produto,
					    $qtd_produto,
					    $valor_produto
					);
					$boleto->setReference($referencia);
					$boleto->setSender()->setName($nome_cliente);
					$boleto->setSender()->setEmail($email_cliente);
					$telefone = explode(" ", $tel_cliente );
					$boleto->setSender()->setPhone()->withParameters(
					    $telefone[0],
					    $telefone[1]
					);
					$boleto->setSender()->setDocument()->withParameters(
					    'CPF',
					    $cpf_cliente
					);
					$boleto->setShipping()->setAddress()->withParameters(
					    $endereco_cliente,
					    $num_cliente,
					    $bairro_cliente,
					    $cep_cliente,
					    $cidade_cliente,
					    $estado_cliente,
					    $pais_cliente,
					    $complemento_cliente
					);
					$boleto->setSender()->setHash($hash_cliente);
					// $boleto->setExtraAmount(0.00);

					try {
					    $result = $boleto->register(
					        \PagSeguro\Configuration\Configure::getAccountCredentials()
					    );

					    // echo "<pre>";
					    // die( $result -> getPaymentLink() );
					    redirect($result -> getPaymentLink(), 'refresh');
					} catch (Exception $e) {
					    echo "</br> <strong>";
					    die( $e->getMessage() );
					}

				break;
				case 'credito':
					$cartao_token = $this -> input -> post("cartao_token");
					$cartao_nome  = $this -> input -> post("cartao_nome");
					$cartao_cpf   = $this -> input -> post("cartao_cpf");
					$cartao_tel   = $this -> input -> post("cartao_tel");
					$cartao_data_nascimento = $this -> input -> post("cartao_data_nascimento");
					$cartao_parcelas = $this -> input -> post("cartao_parcelas");
					$cartao_valor_parcela = sprintf('%0.2f', $valor_produto / $cartao_parcelas);


					$creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

					$creditCard->setMode('DEFAULT');
					$creditCard->setCurrency("BRL");
					$creditCard->setReference($referencia);

					$creditCard->addItems()->withParameters(
					    $codigo_produto,
					    $nome_produto,
					    $qtd_produto,
					    $valor_produto
					);
					$creditCard->setSender()->setName($nome_cliente);
					$creditCard->setSender()->setEmail($email_cliente);

					$telefone = explode(" ", $tel_cliente );
					$creditCard->setSender()->setPhone()->withParameters(
					    $telefone[0],
					    $telefone[1]
					);

					$creditCard->setSender()->setDocument()->withParameters(
					    'CPF',
					    $cpf_cliente
					);

					$creditCard->setSender()->setHash($hash_cliente);

					$creditCard->setShipping()->setAddress()->withParameters(
					    $endereco_cliente,
					    $num_cliente,
					    $bairro_cliente,
					    $cep_cliente,
					    $cidade_cliente,
					    $estado_cliente,
					    $pais_cliente,
					    $complemento_cliente
					);

					$creditCard->setBilling()->setAddress()->withParameters(
					    $endereco_cliente,
					    $num_cliente,
					    $bairro_cliente,
					    $cep_cliente,
					    $cidade_cliente,
					    $estado_cliente,
					    $pais_cliente,
					    $complemento_cliente
					);

					// Set the installment quantity and value (could be obtained using the Installments
					// service, that have an example here in \public\getInstallments.php)
					
					// QTD DE PARCELAS E VALOR DE CADA PARCELA
					$creditCard->setInstallment()->withParameters($cartao_parcelas, $cartao_valor_parcela);

					// Set credit card token
					$creditCard->setToken($cartao_token);

					// Set the credit card holder information
					$creditCard->setHolder()->setBirthdate($cartao_data_nascimento);
					$creditCard->setHolder()->setName($cartao_nome); // Equals in Credit Card

					$cartao_tel = explode(" ", $tel_cliente );
					$creditCard->setHolder()->setPhone()->withParameters(
					    $cartao_tel[0],
					    $cartao_tel[1]
					);

					$creditCard->setHolder()->setDocument()->withParameters(
					    'CPF',
					    $cartao_cpf
					);

					try {
					    $result = $creditCard->register(
					        \PagSeguro\Configuration\Configure::getAccountCredentials()
					    );
					    echo "<pre>";
					    print_r($result);
					    exit;
					} catch (Exception $e) {
					    echo "</br> <strong>";
					    die($e->getMessage());
					}


				break;
				case 'debito':
					$banco_debito  = $this -> input -> post("banco_debito");

					$onlineDebit = new \PagSeguro\Domains\Requests\DirectPayment\OnlineDebit();

					$onlineDebit->setMode('DEFAULT');
					$onlineDebit->setCurrency("BRL");
					$onlineDebit->setBankName($banco_debito);
					// $onlineDebit->setReceiverEmail($email_cliente);
					$onlineDebit->setReference($referencia);
					
					$onlineDebit->addItems()->withParameters(
					    $codigo_produto,
					    $nome_produto,
					    $qtd_produto,
					    $valor_produto
					);

					// $onlineDebit->setExtraAmount(0.00);
					$onlineDebit->setSender()->setName($nome_cliente);
					$onlineDebit->setSender()->setEmail($email_cliente);

					$telefone = explode(" ", $tel_cliente );
					$onlineDebit->setSender()->setPhone()->withParameters(
					    $telefone[0],
					    $telefone[1]
					);

					$onlineDebit->setSender()->setDocument()->withParameters(
					    'CPF',
					    $cpf_cliente
					);

					$onlineDebit->setSender()->setHash($hash_cliente);

					// Set shipping information for this payment request
					$onlineDebit->setShipping()->setAddress()->withParameters(
					    $endereco_cliente,
					    $num_cliente,
					    $bairro_cliente,
					    $cep_cliente,
					    $cidade_cliente,
					    $estado_cliente,
					    $pais_cliente,
					    $complemento_cliente
					);

					try {
					    $result = $onlineDebit->register(
					        \PagSeguro\Configuration\Configure::getAccountCredentials()
					    );

					    // echo "<pre>";
					    // die($result);
					    redirect($result -> getPaymentLink(), 'refresh');
					} catch (Exception $e) {
					    echo "</br> <strong>";
					    die($e->getMessage());
					}
				break;
				default:
					die( "Erro! Tipo de pagamento indefinido." );
					break;
			}
		}

		$data = array ();
		$data ["conteudo"] = "index";
		$data ["sessao_pagseguro"] = $sessao_pagseguro;
		$this->load->view ( 'layout/publico', $data );

	}

	public function getSessaoPagseguro() {
		\PagSeguro\Library::initialize();
		\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
		\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

		$sessao_pagseguro = "0";

		try {
		    $sessionCode = \PagSeguro\Services\Session::create(
		        \PagSeguro\Configuration\Configure::getAccountCredentials()
		    );
		    // echo "<strong>ID de sess&atilde;o criado: </strong>{$sessionCode->getResult()}";
		    $sessao_pagseguro = $sessionCode->getResult();

		} catch (Exception $e) {
		    die($e->getMessage());
		}

		return $sessao_pagseguro;

	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */


