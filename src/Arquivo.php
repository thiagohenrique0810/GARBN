<?php
include 'HeaderLabel.php';
include 'Detalhes.php';
include 'Trailler.php';

class Arquivo {
	private $header_label;
	private $filename;
	private $trailler;
	const   QUEBRA_LINHA = "\r\n";
	private  $detalhes = array();
	
	/**
	 * @return the $filename
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * @param field_type $filename
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	/**
	 * @return the $detalhes
	 */
	public function getDetalhes() {
		return $this->detalhes;
	}

	/**
	 * @param multitype: $detalhes
	 */
	public function setDetalhes($detalhes) {
		$this->detalhes[] = $detalhes;
	}

	/**
	 * @return the $header_label
	 */
	public function getHeader_label() {
		return $this->header_label;
	}

	/**
	 * @return the $trailler
	 */
	public function getTrailler() {
		return $this->trailler;
	}

	/**
	 * @param field_type $header_label
	 */
	public function setHeader_label($header_label) {
		$this->header_label = $header_label;
	}

	/**
	 * @param field_type $trailler
	 */
	public function setTrailler($trailler) {
		$this->trailler = $trailler;
	}

	/**
	 * metodo para adicionar boletos na remessa
	 * @param unknown $boleto
	 */
	public function add_boleto($boleto) {
		//die(print_r($boleto));
		//preenchendo dados dos detalhes
		$detalhes = new Detalhes();
		
		//informações da conta
		$detalhes->setAgenciaCedente($boleto['agencia']);
		$detalhes->setAgenciaCobradora($boleto['agencia']);
		$detalhes->setContaCliente($boleto['conta']);
		$detalhes->setDigitoConta($boleto['conta_dv']);
		$detalhes->setCarteira($boleto['carteira'], $boleto['carteira_tipo_emissor']);
		
		//informações do boleto
		$detalhes->setNossoNumero($boleto['nosso_numero']);
		$detalhes->setDigitoNossoNumero($boleto['digito_nosso_numero']);
		$detalhes->setEspecie($boleto['especie']);
		$detalhes->setAceite($boleto['aceite']);
		$detalhes->setCodigoInstrucao($boleto['codigo_instrucao']);
		$detalhes->setCodigoServico($boleto['codigo_servico']);
		$detalhes->setValorDesconto($boleto['desconto_dia']);
		$detalhes->setNumeroDocumento($boleto['numero_documento']);
		$detalhes->setNumeroControle($boleto['numero_documento']);
		$detalhes->setDataVencimento($boleto['vencimento']);
		$detalhes->setValorTitulo($boleto['valor']);
		$detalhes->setDataEmissao($boleto['data_emissao_titulo']);
		
		//taxas do boleto
		$detalhes->setTaxaMulta($boleto['percentual_multa']);
		$detalhes->setJurosUmDia($boleto['valor_dia_atraso']);
		$detalhes->setDataDesconto($boleto['data_limite_desconto']);
		$detalhes->setValorDesconto($boleto['valor_desconto']);
		$detalhes->setDataSegundoDesconto($boleto['data_limite_segundo_desconto']);
		$detalhes->setValorSegundoDesconto($boleto['valor_segundo_desconto']);
		$detalhes->setValorIoc($boleto['valor_iof']);
		$detalhes->setValorAbatimento($boleto['valor_abatimento']);
		
		//informações do pagador
		$detalhes->setCodigoInscricaoSacado($boleto['tipo_inscricao_pagador']);
		$detalhes->setNumeroCpfCnpjSacado($boleto['numero_inscricao']);
		$detalhes->setNomeSacado($boleto['nome_pagador']);
		$detalhes->setEnderecoSacado($boleto['endereco_pagador']);
		$detalhes->setComplementoEnderecoSacado($boleto['complemento_pagador']);
		$detalhes->setCepSacado($boleto['cep_pagador']);
		$detalhes->setCidadeSacado($boleto['cidade_pagador']);
		$detalhes->setUfSacado($boleto['uf_pagador']);
		$detalhes->setMensagemCedente($boleto['sacador_mensagem']);
		$detalhes->setPrazoProtesto($boleto['prazo_protesto']);
		
		//adicionando boleto
		$this->setDetalhes($detalhes);
	}
	
	/**
	 * metodo para configurar a remessa
	 * @param unknown $dados
	 */
	public function config($dados) {
		$cabecalho = new HeaderLabel();
		//TESTANDO O HEADERLABEL
		$cabecalho->setNome_empresa($dados['razao_social']);
		$cabecalho->setAgenciaCedente($dados['agencia']);
		$cabecalho->setContaCliente($dados['conta']);
		$cabecalho->setDigitoConta($dados['conta_dv']);
		$cabecalho->setData_gravacao($dados['data_gravacao']);
		$cabecalho->setCodigoUsuario($dados['codigo_usuario']);

		$this->setHeader_label($cabecalho);
	}
	
	/**
	 * metodo para criar o texto inteiro da remessa
	 */
	public function get_text() {
		//Montando texto
		$dados = $this->getHeader_label()->montar_linha() . self::QUEBRA_LINHA;

		//testando cabeçalho
		//die($dados);

		//montando linhas dos boletos
		$numero_sequencial = 2;
		foreach ($this->getDetalhes() as $detalhe) {
			$detalhe->setNumeroSequencialRegistro($numero_sequencial++);
			$dados .= $detalhe->montar_linha() . self::QUEBRA_LINHA;
		}
		//montando rodap�
		$trailler = new Trailler();
		$trailler->setNumero_sequencial_regsitro($numero_sequencial++);
		$this->setTrailler($trailler);
		$dados .= $this->getTrailler()->montar_linha();
		
		return $dados;
	}
	
	/**
	 * metodo para fazer download do arquivo de remessa
	 */
	public function save() {
		$text = $this->get_text();
		//die($text);
		//atribuindo um nome do arquivo
		if($this->getFilename() == '') {
			$this->setFilename('CB' . date('dm') . 'A1');
		}
		
		if(file_put_contents($this->getFilename() . '.REM', $text) != false) {
			return true;
		}else {
			return false;
		}

	}
	
	/**
	 * Metodo para retornar a quantida de detalhes inseridos na remessa
	 * @return number
	 */
	public function count_detalhes() {
		return count($this->detalhes);
	}
	
}