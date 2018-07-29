<?php
/**
 * Lay-out do Arquivo-Remessa - Registro Header Label
 * Lay-out para Cobranca com Registro e sem Registro com Emissao do Boleto pelo 
 * Banco ou pela Empresa
 * Descricao de Registro - Tamanho 400 Bytes
 * A - Alfanumerico - Conte�do em Caixa Alta (Letras Masiusculas)
 * N - Numerico
 */
require_once 'Funcoes.php';
require_once 'IFuncoes.php';

class HeaderLabel extends Funcoes implements IFuncoes {
	//001 - 001 - 1 -  N CONSTANTE
	private $identificacao_registro = '0';		
	//002 - 002 - 1 - N CONSTANTE
	private $identificacao_arquivo_remessa = '1';	
	//003 - 009 - 7 - A CONSTANTE
	private $literal_remessa = 'REMESSA'; 		
	//010 - 011 - 2 - N CONSTANTE
	private $codigo_servico = '01';				
	//012 - 026 - 15 - A CONSTANTE - COMPLETAR COM ESPA�OS EM BRANCO A DIREITA
	private $literal_servico = 'COBRANCA';		
	//027 - 030 - 4 - N COMPLETAR COM ZEROS A ESQUERDA
	private $agencia_cedente = ''; 				//<---- verificar observacoes
	//031 - 032 - 2 - N FILLER
	private $filer = '00';
	//033 - 039 - 7 - N CONTA CORRENTE DE COBRANCA, COMPLETAR COM ZEROS A ESQUERDA
	private $conta_cliente = '';
	//040 - 040 - 1 - N DIGITO DA CONTA CORRENTE
	private $digito_conta = '';
	//041 - 046 - 6 - A FILER, COMPLETAR COM ESPACOS EM BRANCO
	private $filer_brancos01;
	//047 - 076 - 30 - A - COMPLETAR COM ESPA�OS EM BRANCO A DIREITA
	private $nome_empresa = '';
	//077 - 079 - 3 - N CONSTANTE
	private $numero_banco_compensacao = '004';	
	//080 - 094 - 15 - A CONSTANTE - COMPLETAR COM ESPACOS EM BRANCO A DIREITA
	private $nome_banco = 'B  DO NORDESTE';			
	//095 - 100 - 6 - N
	private $data_gravacao = ''; 				//<---- verificar observacoes
	//101 - 103 - 3 - A CODIGO USUARIO, CODIGO DA CAIXA POSTAL NO SISTEMA EDI. SE TRANSMISSAO PELA NEXXXRA INFORMAR BRANCOS
	private $codigo_usuario = '';
	//104 - 394 - 291 - A COMPLETAR COM BRANCOS
	private $filer_brancos02 = '';
	//395 - 400 - 6 - N CONSTANTE
	private $numero_sequencial_regsitro = '000001';
	
	
	/**
	 * @return the $nome_empresa
	 */
	public function getNome_empresa() {
		return $this->nome_empresa;
	}

	/**
	 * @return the $data_gravacao
	 */
	public function getData_gravacao() {
		//verifica se a variavel esta vazia, se sim poe a data atual como default
		if(empty($this->data_gravacao)) {
			$this->setData_gravacao(date('dmy'));
		}
		
		return $this->data_gravacao;
	}

	/**
	 * @param string $nome_empresa
	 */
	public function setNome_empresa($nome_empresa) {
		$length = (int) strlen($nome_empresa);
		
		if($length > 0 && $length <= 30) {
			$this->nome_empresa = $this->montar_branco($this->removeAccents($nome_empresa), 30, 'right');
		}else {
			throw new Exception('Error - Tamanho de texto invalido, para o nome da empresa.');
		}
	}
	
	/**
	 * @param string $data_gravacao
	 */
	public function setData_gravacao($data_gravacao) {
		if(is_numeric($data_gravacao)) {
			$this->data_gravacao = $data_gravacao;
		}else {
			throw new Exception('Error - O campo data de gravacao nao e um numero.');
		}
	}

	public function setCodigoUsuario($codigo_usuario) {
		if($codigo_usuario != '' && $codigo_usuario != null) {
			$this->codigo_usuario = $this->montar_branco($codigo_usuario, 3);
		}else {
			$this->codigo_usuario = $this->montar_branco('', 3); 
		}
	}

	public function getCodigoUsuario() {
		return $this->codigo_usuario;
	}

	public function setAgenciaCedente($agencia_cedente) {
		$this->agencia_cedente = $agencia_cedente;
	}

	public function getAgenciaCedente() {
		return $this->agencia_cedente;
	}

	public function setContaCliente($conta_cliente) {
		$this->conta_cliente = $conta_cliente;
	}

	public function getContaCliente() {
		return $this->conta_cliente;
	}

	public function setDigitoConta($digito_conta) {
		$this->digito_conta = $digito_conta;
	}

	public function getDigitoConta() {
		return $this->digito_conta;
	}

	/* (non-PHPdoc)
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		
		//motando linha do cabe�alho da remessa
			$linha = 	
			$this->identificacao_registro 								.
			$this->identificacao_arquivo_remessa 						.
			$this->literal_remessa										.
			$this->codigo_servico										.
			$this->montar_branco($this->literal_servico, 15, 'right')	.
			$this->add_zeros($this->getAgenciaCedente(), 4)				.
			$this->filer 												.
			$this->add_zeros($this->getContaCliente(), 7)				.
			$this->getDigitoConta()										.
			$this->montar_branco('', 6)									.
			$this->getNome_empresa()									.
			$this->numero_banco_compensacao								.
			$this->montar_branco($this->nome_banco, 15, 'right')		.
			$this->getData_gravacao()									.
			$this->getCodigoUsuario()									.
			$this->montar_branco('', 291)								.
			$this->numero_sequencial_regsitro;
			
			//echo 'QTD.: ' . strlen($linha) . '<BR>';//teste da quantidade de linha  para debug
			//echo $linha;
			//die();
			
			return $this->valid_linha($linha);
	}
	
}