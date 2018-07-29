<?php
/**
 * Lay-out do Arquivo-Remessa - Registro de Transacao - Tipo 1
 * Lay-out para Cobranca com Registro e sem Registro com Emissao do Boleto pelo 
 * Banco ou pela Empresa
 * Descricao de Registro - Tamanho 400 Bytes
 * A - Alfanumerico - Conteudo em Caixa Alta (Letras Maiuscula)
 * N e Numerico
 */
require_once 'Funcoes.php';
require_once 'IFuncoes.php';

class Detalhes extends Funcoes implements IFuncoes {
	
	//001 - 001 - 1 -  N CONSTANTE
	private $identificacao_registro = '1';
	//002 - 017 - 16 - A FILLER
	private $filler1;
	//018 - 021 - 4 - N AGENCIA CEDENTE
	private $agencia_cedente;
	//022 - 023 - 2 - N FILLER
	private $filler2;
	//024 - 030 - 7 - N CONTA DO CLIENTE
	private $conta_cliente;
	//031 - 031 - 1 - N DIGITO DA CONTA
	private $digito_conta;
	//032 - 033 - 2 - N TAXA MULTA
	private $taxa_multa;
	//034 - 037 - 4 - A FILER
	private $filler3;
	//038 - 062 - 24 - A NUMERO CONTROLE
	private $numero_controle;
	//063 - 069 - 7 - N NOSSO NUMERO
	private $nosso_numero;
	//070 - 070 - 1 - N DIGITO DO NOSSO NUMERO
	private $digito_nosso_numero;
	//071 - 080 - 10 - N NUMERO DO CONTRATO
	private $numero_contrato;
	//081 - 086 - 6 - N DATA DO SEGUNDO DESCONTO
	private $data_segundo_desconto;
	//087 - 099 - 13 - N VALOR DO SEGUNDO DESCONTO
	private $valor_segundo_desconto;
	//100 - 107 - 8 - A FILLER
	private $filler4;
	//108 - 108 - 1 - N CARTEIRA
	private $carteira;
	//109 - 110 - 2 - N CODIGO DE SERVICO
	private $codigo_servico;
	//111 - 120 - 10 - A SEU NUMERO OU NUMERO DO DOCUMENTO EM COBRANCA
	private $numero_documento;
	//121 - 126 - 6 - N DATA DE VENCIMENTO
	private $data_vencimento;
	//127 - 139 - 13 - N VALOR TITULO
	private $valor_titulo;
	//140 - 142 - 3 - N NUMERO DO BANCO
	private $numero_banco;
	//143 - 146 - 4 - N AGENCIA COBRADORA
	private $agencia_cobradora;
	//147 - 147 - 1 - A FILLER
	private $filler5;
	//148 - 149 - 2 - N ESPECIE
	private $especie;
	//150 - 150 - 1 - A ACEITE
	private $aceite;
	//151 - 156 - 6 - N DATA EMISSAO
	private $data_emissao;
	//157 - 160 - 4 - N CODIGO DE INSTRUCAO
	private $codigo_instrucao;
	//161 - 173 - 13 - N JUROS DE UM DIA
	private $juros_um_dia;
	//174 - 179 - 6 - N DATA DE DESCONTO
	private $data_desconto;
	//180 - 192 - 13 - N VALOR DO DESCONTO
	private $valor_desconto;
	//193 - 205 - 13 - N VALOR IOC
	private $valor_ioc;
	//206 - 218 - 13 - N VALOR DO ABATIMENTO
	private $valor_abatimento;
	//219 - 220 - 2 - N CODIGO DE INSCRICAO DO SACADO
	private $codigo_inscricao_sacado;
	//221 - 234 - 14 - N NUMERO DO CPF/CNPJ DO SACADO
	private $numero_cpf_cnpj_sacado;
	//235 - 274 - 40 - A NOME DO SACADO
	private $nome_sacado;
	//275 - 314 - 40 - A ENDERECO DO SACADO
	private $endereco_sacado;
	//315 - 326 - 12 - A COMPLEMENTO DO ENDERECO DO SACADO
	private $complemento_endereco_sacado;
	//327 - 334 - 8 - N CEP DO SACADO
	private $cep_sacado;
	//335 - 349 - 15 - A CIDADE DO SACADO
	private $cidade_sacado;
	//350 - 351 - 2 - A UF SACADO
	private $uf_sacado;
	//352 - 391 - 40 - A MENSAGEM DO CEDENTE OU NOME DO SACADOR / AVALISTA
	private $mensagem_cedente;
	//392 - 393 - 2 - N PRAZO DE PROTESTO
	private $prazo_protesto;
	//394 - 394 - 1 - A CODIGO DA MOEDA
	private $codigo_moeda;
	//395 - 400 - 6 - N SEQUENCIAL DO REGISTRO
	private $numero_sequencial_registro;

	/**
     * @return mixed
     */
    public function getIdentificacaoRegistro()
    {
        return $this->identificacao_registro;
    }


    /**
     * @return mixed
     */
    public function getFiller1()
    {
        $this->filler1 = $this->montar_branco('', 16);
        return $this->filler1;
    }

    /**
     * @return mixed
     */
    public function getAgenciaCedente()
    {
        return $this->agencia_cedente;
    }

    /**
     * @param mixed $agencia_cedente
     *
     * @return self
     */
    public function setAgenciaCedente($agencia_cedente)
    {
        if(!empty($agencia_cedente)) {
            if($this->valid_tamanho_campo($agencia_cedente, 4)) {
                $this->agencia_cedente = $this->add_zeros($agencia_cedente, 4);

                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo agencia cedente invalido');
            }
        }else {
            throw new Exception('Error: O campo a gencia cedente nao pode ser vazio');
        }
        
    }

    /**
     * @return mixed
     */
    public function getFiller2()
    {
        $result = $this->add_zeros('', 2);
        return $result;
    }


    /**
     * @return mixed
     */
    public function getContaCliente()
    {
        return $this->conta_cliente;
    }

    /**
     * @param mixed $conta_cliente
     *
     * @return self
     */
    public function setContaCliente($conta_cliente)
    {
        if(!empty($conta_cliente)) {
            if($this->valid_tamanho_campo($conta_cliente, 7, 7)) {
                $this->conta_cliente = $this->add_zeros($conta_cliente, 7);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo conta cliente invalido');
            }
        }else {
            throw new Exception('Error: O campo a conta cliente nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getDigitoConta()
    {
        return $this->digito_conta;
    }

    /**
     * @param mixed $digito_conta
     *
     * @return self
     */
    public function setDigitoConta($digito_conta)
    {
        if(!empty($digito_conta)) {
            if($this->valid_tamanho_campo($digito_conta, 1)) {
                $this->digito_conta = $digito_conta;
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo digito da conta invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo digito da conta nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getTaxaMulta()
    {
        return $this->taxa_multa;
    }

    /**
     * @param mixed $taxa_multa
     *
     * @return self
     */
    public function setTaxaMulta($taxa_multa)
    {
        if($this->valid_tamanho_campo($taxa_multa, 2, 2)) {
            $this->taxa_multa = $this->add_zeros($taxa_multa, 2);
            
            return $this;
        }else {
            throw new Exception('Error: Quantidade de caracteres do campo taxa multa invalido');
        }
    }

    /**
     * @return mixed
     */
    public function getFiller3()
    {
        $result = $this->add_zeros('', 4);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getNumeroControle()
    {
        return $this->numero_controle;
    }

    /**
     * @param mixed $numero_controle
     *
     * @return self
     */
    public function setNumeroControle($numero_controle)
    {
        if(!empty($numero_controle)) {
            if($this->valid_tamanho_campo($numero_controle, 25, 25)) {
                $this->numero_controle = $this->montar_branco($numero_controle, 25);

                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo numero de controle invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo numero controle nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getNossoNumero()
    {
        return $this->nosso_numero;
    }

    /**
     * @param mixed $nosso_numero
     *
     * @return self
     */
    public function setNossoNumero($nosso_numero)
    {
        if(!empty($nosso_numero)) {
            if($this->valid_tamanho_campo($nosso_numero, 7, 7)) {
                $this->nosso_numero = $this->add_zeros($nosso_numero, 7);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo nosso numero invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo nosso numero nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getDigitoNossoNumero()
    {
        return $this->digito_nosso_numero;
    }

    /**
     * @param mixed $digito_nosso_numero
     *
     * @return self
     */
    public function setDigitoNossoNumero($digito_nosso_numero)
    {
        if(!empty($digito_nosso_numero)) {
            if($this->valid_tamanho_campo($digito_nosso_numero, 1)) {
                $this->digito_nosso_numero = $digito_nosso_numero;
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo digito nosso numero invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo digito nosso numero nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getNumeroContrato()
    {
        return $this->add_zeros('', 10);
    }

    /**
     * @return mixed
     */
    public function getDataSegundoDesconto()
    {
        return $this->data_segundo_desconto;
    }

    /**
     * @param mixed $data_segundo_desconto
     *
     * @return self
     */
    public function setDataSegundoDesconto($data_segundo_desconto)
    {
        if(!empty($data_segundo_desconto)) {
            if($this->valid_tamanho_campo($data_segundo_desconto, 6)) {
                $this->data_segundo_desconto = $this->add_zeros($data_segundo_desconto, 6);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo data segundo desconto invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo data segundo desconto nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getValorSegundoDesconto()
    {
        return $this->valor_segundo_desconto;
    }

    /**
     * @param mixed $valor_segundo_desconto
     *
     * @return self
     */
    public function setValorSegundoDesconto($valor_segundo_desconto)
    {
        if(!empty($valor_segundo_desconto)) {
            if($this->valid_tamanho_campo($valor_segundo_desconto, 13, 13)) {
                $this->valor_segundo_desconto = $this->add_zeros($valor_segundo_desconto, 13);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo valor segundo desconto invalido');
            }
        }else {
            $this->valor_segundo_desconto = $this->add_zeros('', 13);
        }
    }

    /**
     * @return mixed
     */
    public function getFiller4()
    {
        $result = $this->montar_branco('', 8);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @param mixed $carteira
     *
     * @return self
     */
    public function setCarteira($carteira, $tipo_emissor)
    {
        if(!empty($carteira)) {
            if($this->valid_tamanho_campo($carteira, 2)) {
                //verificando o tipo de emissor dos registros
                if(!empty($tipo_emissor) && $tipo_emissor == 1 || $tipo_emissor == 2) {
                    //logica definição carteira
                    switch ($carteira) {
                        case '21':
                            if($tipo_emissor == 1) {
                                $this->carteira = '1';
                            }else {
                                $this->carteira = '4';
                            }
                            break;
                        case '41':
                            if($tipo_emissor == 1) {
                                $this->carteira = '2';
                            }else {
                                $this->carteira = '5';
                            }
                            break;
                        case '51':
                            $this->carteira = 'I';
                            break;
                        
                        default:
                            throw new Exception('Error: Carteira informada invalida');
                            break;
                    }
                }else{
                    throw new Exception('Error: O tipo de emissor nao foi definido, informe 1 banco ou 2 cliente');
                }
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo carteira invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo carteira nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getCodigoServico()
    {
        return $this->codigo_servico;
    }

    /**
     * @param mixed $codigo_servico
     *
     * @return self
     */
    public function setCodigoServico($codigo_servico)
    {
        if(!empty($codigo_servico)) {
            if($this->valid_tamanho_campo($codigo_servico, 2)) {
                //verificando o tipo de codigo de operação de serviço
                if( $codigo_servico == '01' ||//Entrada Normal
                    $codigo_servico == '02' ||//Pedido de baixa
                    $codigo_servico == '04' ||//Concessão de Abatimento
                    $codigo_servico == '06' ||//Alteração de Vencimento
                    $codigo_servico == '07' ||//Alteração do Uso da empresa (Número de Controle)
                    $codigo_servico == '08' ||//Alteração de Seu número
                    $codigo_servico == '09' ||//Protestar
                    $codigo_servico == '10' ||//Não Protestar
                    $codigo_servico == '12' ||//Inclusão de Ocorrência
                    $codigo_servico == '13' ||//Exclusão de ocorrência
                    $codigo_servico == '31' ||//Alteração de Outros Dados (Nome do Sacado, Endereço, CEP,
                                                //Estado, CGC ou
                                                //CPF, Data de Emissão, Data de Desconto, Valor do Desconto,
                                                //Aceite, Instrução de Cobrança e Espécie de Documento)
                    $codigo_servico == '32' ||//Pedido de Devolução
                    $codigo_servico == '33' ||//Pedido de Devolução (entregue ao Sacado).
                    $codigo_servico == '99'   //Pedido dos Títulos em Aberto
                ) {
                    $this->codigo_servico = $codigo_servico;

                    return $this;
                }else {
                    throw new Exception('Error: Codigo de operacao de servico invalido, verifique por favor');
                }
                
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo codigo servico invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo codigo servico nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getNumeroDocumento()
    {
        return $this->numero_documento;
    }

    /**
     * @param mixed $numero_documento
     *
     * @return self
     */
    public function setNumeroDocumento($numero_documento)
    {
        if(!empty($numero_documento)) {
            if($this->valid_tamanho_campo($numero_documento, 10, 10)) {
                $this->numero_documento = $this->montar_branco($numero_documento, 10, 'right');
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo numero documento invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo numero documento nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getDataVencimento()
    {
        return $this->data_vencimento;
    }

    /**
     * @param mixed $data_vencimento
     *
     * @return self
     */
    public function setDataVencimento($data_vencimento)
    {
        if(!empty($data_vencimento)) {
            if($this->valid_tamanho_campo($data_vencimento, 6)) {
                $this->data_vencimento = $this->add_zeros($data_vencimento, 6);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo vencimento invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo vencimento nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getValorTitulo()
    {
        return $this->valor_titulo;
    }

    /**
     * @param mixed $valor_titulo
     *
     * @return self
     */
    public function setValorTitulo($valor_titulo)
    {
        if(!empty($valor_titulo)) {
            if($this->valid_tamanho_campo($valor_titulo, 13, 13)) {
                $this->valor_titulo = $this->add_zeros($valor_titulo, 13);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo valor titulo invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo valor titulo nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getNumeroBanco()
    {
        return '004';
    }

    /**
     * @return mixed
     */
    public function getAgenciaCobradora()
    {
        return $this->agencia_cobradora;
    }

    /**
     * @param mixed $agencia_cobradora
     *
     * @return self
     */
    public function setAgenciaCobradora($agencia_cobradora)
    {
        if(!empty($agencia_cobradora)) {
            if($this->valid_tamanho_campo($agencia_cobradora, 4)) {
                $this->agencia_cobradora = $this->add_zeros($agencia_cobradora, 4);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo agencia cobradora invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo agencia cobradora nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getFiller5()
    {
        $result = $this->montar_branco('', 1);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * @param mixed $especie
     *
     * @return self
     */
    public function setEspecie($especie)
    {
        if(!empty($especie)) {
            if($this->valid_tamanho_campo($especie, 2)) {
                switch ($especie) {
                    case 'DM':
                        $this->especie = '01';//Duplicata Mercantil
                        break;
                    case 'NP':
                        $this->especie = '02';//Nota Promissória.
                        break;
                    case 'CH':
                        $this->especie = '03';//Cheque.
                        break;
                    case 'CR':
                        $this->especie = '04';//Carnê.
                        break;
                    case 'RC':
                        $this->especie = '05';//Recibo.
                        break;
                    case 'DS':
                        $this->especie = '06';//Duplicata Prest. Serviços
                        break;
                    case 'OU':
                        $this->especie = '19';//Outros.
                        break;
                    default:
                        throw new Exception('Error: Especie da cobranca invalida, por favor verifique');
                        break;
                }
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo especie invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo especie nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getAceite()
    {
        return $this->aceite;
    }

    /**
     * @param mixed $aceite
     *
     * @return self
     */
    public function setAceite($aceite)
    {
        if(!empty($aceite)) {
            if($this->valid_tamanho_campo($aceite, 1, 1)) {
                //verificando o codigo enviado do aceite
                if($aceite == 'S' || $aceite == 's') {
                    $this->aceite = 'S';
                }elseif($aceite == 'N' || $aceite == 'n') {
                     $this->aceite = 'N';
                }else {
                    throw new Exception('Error: Codigo do campo aceite invalido, por favor verifique');
                }
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo aceite invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo aceite nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getDataEmissao()
    {
        return $this->data_emissao;
    }

    /**
     * @param mixed $data_emissao
     *
     * @return self
     */
    public function setDataEmissao($data_emissao)
    {
        if(!empty($data_emissao)) {
            if($this->valid_tamanho_campo($data_emissao, 6)) {
                $this->data_emissao = $data_emissao;
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo data emissao invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo data emissao nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getCodigoInstrucao()
    {
        return $this->codigo_instrucao;
    }

    /**
     * @param mixed $codigo_instrucao
     *
     * @return self
     */
    public function setCodigoInstrucao($codigo_instrucao)
    {
        if(!empty($codigo_instrucao)) {
            if($this->valid_tamanho_campo($codigo_instrucao, 2)) {
                switch ($codigo_instrucao) {
                    case '05':
                        $this->codigo_instrucao = '00'.$codigo_instrucao;//Acatar instruções contidas no título.
                        break;
                    case '08':
                        $this->codigo_instrucao = '00'.$codigo_instrucao;//Não cobrar encargos moratórios
                        break;
                    case '12':
                        $this->codigo_instrucao = '00'.$codigo_instrucao;//Não receber após vencimento
                        break;
                    case '15':
                        $this->codigo_instrucao = '00'.$codigo_instrucao;//Após vencimento, cobrar comissão de permanência do BANCO DO NORDESTE.
                        break;
                    case '00':
                        $this->codigo_instrucao = '00'.$codigo_instrucao;//Sem Instruções – Acata as instruções da Carteira do Cedente
                        break;
                    default:
                        throw new Exception('Error: Codigo de instrucao invalido, por favor verifique');
                        break;
                }
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo codigo instrucao invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo codigo instrucao nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getJurosUmDia()
    {
        return $this->juros_um_dia;
    }

    /**
     * @param mixed $juros_um_dia
     *
     * @return self
     */
    public function setJurosUmDia($juros_um_dia)
    {
        if(!empty($juros_um_dia)) {
            if($this->valid_tamanho_campo($juros_um_dia, 13)) {
                $this->juros_um_dia = $this->add_zeros($juros_um_dia, 13);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo juros um dia invalido');
            }
        }else {
            $this->juros_um_dia = $this->add_zeros('', 13);
        }
    }

    /**
     * @return mixed
     */
    public function getDataDesconto()
    {
        return $this->data_desconto;
    }

    /**
     * @param mixed $data_desconto
     *
     * @return self
     */
    public function setDataDesconto($data_desconto)
    {
        if(!empty($data_desconto)) {
            if($this->valid_tamanho_campo($data_desconto, 6)) {
                $this->data_desconto = $data_desconto;
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo data desconto invalido');
            }
        }else {
            $this->data_desconto = $this->add_zeros('', 6);
        }
    }

    /**
     * @return mixed
     */
    public function getValorDesconto()
    {
        return $this->valor_desconto;
    }

    /**
     * @param mixed $valor_desconto
     *
     * @return self
     */
    public function setValorDesconto($valor_desconto)
    {
        if(!empty($valor_desconto)) {
            if($this->valid_tamanho_campo($valor_desconto, 13)) {
                $this->valor_desconto = $this->add_zeros($valor_desconto, 13);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo valor desconto invalido');
            }
        }else {
            $this->valor_desconto = $this->add_zeros('', 13);
        }
    }

    /**
     * @return mixed
     */
    public function getValorIoc()
    {
        return $this->valor_ioc;
    }

    /**
     * @param mixed $valor_ioc
     *
     * @return self
     */
    public function setValorIoc($valor_ioc)
    {
        if(!empty($valor_ioc)) {
            if($this->valid_tamanho_campo($valor_ioc, 13)) {
                $this->valor_ioc = $this->add_zeros($valor_ioc, 13);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo valor ioc invalido');
            }
        }else {
            $this->valor_ioc = $this->add_zeros('', 13);
        }
    }

    /**
     * @return mixed
     */
    public function getValorAbatimento()
    {
        return $this->valor_abatimento;
    }

    /**
     * @param mixed $valor_abatimento
     *
     * @return self
     */
    public function setValorAbatimento($valor_abatimento)
    {
        if(!empty($valor_abatimento)) {
            if($this->valid_tamanho_campo($valor_abatimento, 13, 13)) {
                $this->valor_abatimento = $this->add_zeros($valor_abatimento, 13);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo valor abatimento invalido');
            }
        }else {
            $this->valor_ioc = $this->add_zeros('', 13);
        }
    }

    /**
     * @return mixed
     */
    public function getCodigoInscricaoSacado()
    {
        return $this->codigo_inscricao_sacado;
    }

    /**
     * @param mixed $codigo_inscricao_sacado
     *
     * @return self
     */
    public function setCodigoInscricaoSacado($codigo_inscricao_sacado)
    {
        if(!empty($codigo_inscricao_sacado)) {
            switch ($codigo_inscricao_sacado) {
                case 'CPF':
                    $this->codigo_inscricao_sacado = '01';//para cpf
                    break;
                case 'CNPJ':
                    $this->codigo_inscricao_sacado = '02';//para cnpj empresa
                    break;
                default:
                    throw new Exception('Error: Codigo de instrucao sacado invalido, por favor verifique');
                    break;
            }
            return $this;
        }else {
            throw new Exception('Error: O campo o campo codigo instrucao sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getNumeroCpfCnpjSacado()
    {
        return $this->numero_cpf_cnpj_sacado;
    }

    /**
     * @param mixed $numero_cpf_cnpj_sacado
     *
     * @return self
     */
    public function setNumeroCpfCnpjSacado($numero_cpf_cnpj_sacado)
    {
        if(!empty($numero_cpf_cnpj_sacado)) {
            if($this->valid_tamanho_campo($numero_cpf_cnpj_sacado, 14, 14)) {
                $this->numero_cpf_cnpj_sacado = $this->add_zeros($numero_cpf_cnpj_sacado, 14);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo numero cpf/cnpj sacado invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo numero cpf/cnpj sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getNomeSacado()
    {
        return $this->nome_sacado;
    }

    /**
     * @param mixed $nome_sacado
     *
     * @return self
     */
    public function setNomeSacado($nome_sacado)
    {
        if(!empty($nome_sacado)) {
            if(strlen($nome_sacado) > 40) {
                $nome_sacado = $this->resume_texto($nome_sacado);
            }
            
            if($this->valid_tamanho_campo($nome_sacado, 40, 40)) {
                $this->nome_sacado = $this->montar_branco($nome_sacado, 40, 'right');
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo nome sacado invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo nome sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getEnderecoSacado()
    {
        return $this->endereco_sacado;
    }

    /**
     * @param mixed $endereco_sacado
     *
     * @return self
     */
    public function setEnderecoSacado($endereco_sacado)
    {
        if(!empty($endereco_sacado)) {
            if(strlen($endereco_sacado) > 40) {
                $endereco_sacado = $this->resume_texto($endereco_sacado);
            }
            
            if($this->valid_tamanho_campo($endereco_sacado, 40, 40)) {
                $this->endereco_sacado = $this->montar_branco($endereco_sacado, 40, 'right');
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo endereco sacado invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo endereco sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getComplementoEnderecoSacado()
    {
        return $this->complemento_endereco_sacado;
    }

    /**
     * @param mixed $complemento_endereco_sacado
     *
     * @return self
     */
    public function setComplementoEnderecoSacado($complemento_endereco_sacado)
    {
        if(!empty($complemento_endereco_sacado)) {
            if(strlen($complemento_endereco_sacado) > 12) {
                $complemento_endereco_sacado = $this->resume_texto($complemento_endereco_sacado);
            }
            
            $this->complemento_endereco_sacado = $this->montar_branco($complemento_endereco_sacado, 12, 'right');
            
            return $this;
        }else {
            $this->complemento_endereco_sacado = $this->montar_branco('', 12);
        }
    }

    /**
     * @return mixed
     */
    public function getCepSacado()
    {
        return $this->cep_sacado;
    }

    /**
     * @param mixed $cep_sacado
     *
     * @return self
     */
    public function setCepSacado($cep_sacado)
    {
        if(!empty($cep_sacado)) {
            if($this->valid_tamanho_campo($cep_sacado, 8, 8)) {
                $this->cep_sacado = $this->add_zeros($cep_sacado, 8);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo cep endereco sacado invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo cep endereco sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getCidadeSacado()
    {
        return $this->cidade_sacado;
    }

    /**
     * @param mixed $cidade_sacado
     *
     * @return self
     */
    public function setCidadeSacado($cidade_sacado)
    {
        if(!empty($cidade_sacado)) {
            if(strlen($cidade_sacado) > 15) {
                $cidade_sacado = $this->resume_texto($cidade_sacado);
            }
            
            if($this->valid_tamanho_campo($cidade_sacado, 15, 15)) {
                $this->cidade_sacado = $this->montar_branco($cidade_sacado, 15, 'right');
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo cidade endereco sacado invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo cidade endereco sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getUfSacado()
    {
        return $this->uf_sacado;
    }

    /**
     * @param mixed $uf_sacado
     *
     * @return self
     */
    public function setUfSacado($uf_sacado)
    {
        if(!empty($uf_sacado)) {
            if($this->valid_tamanho_campo($uf_sacado, 2)) {
                $this->uf_sacado = $uf_sacado;
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo uf/estado endereco sacado invalido');
            }
        }else {
            throw new Exception('Error: O campo o campo uf/estado endereco sacado nao pode ser vazio');
        }
    }

    /**
     * @return mixed
     */
    public function getMensagemCedente()
    {
        return $this->mensagem_cedente;
    }

    /**
     * @param mixed $mensagem_cedente
     *
     * @return self
     */
    public function setMensagemCedente($mensagem_cedente)
    {
        if(!empty($mensagem_cedente)) {
            if($this->valid_tamanho_campo($mensagem_cedente, 40, 40)) {
                $this->mensagem_cedente = $this->montar_branco($mensagem_cedente, 40, 'right');
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo mensagem cedente invalido');
            }
        }else {
            $this->mensagem_cedente = $this->montar_branco('', 40, 'right');
        }
    }

    /**
     * @return mixed
     */
    public function getPrazoProtesto()
    {
        return $this->prazo_protesto;
    }

    /**
     * @param mixed $prazo_protesto
     *
     * @return self
     */
    public function setPrazoProtesto($prazo_protesto)
    {
        if(!empty($prazo_protesto)) {
            if($this->valid_tamanho_campo($prazo_protesto, 2)) {
                $this->prazo_protesto = $prazo_protesto;
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo mensagem cedente invalido');
            }
        }else {
            $this->prazo_protesto = '99';
        }
    }

    /**
     * @return mixed
     */
    public function getCodigoMoeda()
    {
        $result = '0';
        return $result;
    }

    /**
     * @return mixed
     */
    public function getNumeroSequencialRegistro()
    {
        return $this->numero_sequencial_registro;
    }

    /**
     * @param mixed $numero_sequencial_registro
     *
     * @return self
     */
    public function setNumeroSequencialRegistro($numero_sequencial_registro)
    {
        if(!empty($numero_sequencial_registro)) {
            if($this->valid_tamanho_campo($numero_sequencial_registro, 6, 6)) {
                $this->numero_sequencial_registro = $this->add_zeros($numero_sequencial_registro, 6);
                
                return $this;
            }else {
                throw new Exception('Error: Quantidade de caracteres do campo numero sequencial registro invalido');
            }
        }else {
            throw new Exception('Error: Quantidade de caracteres do campo numero sequencial registro invalido');
        }
    }


	/* (non-PHPdoc)
	 * Medotos para gerar a linha dos detalhes dos boletos que seram gerados
	 * @see IFuncoes::montar_linha()
	 */
	public function montar_linha() {
		
		//Montando a linha 
		$linha = 
    		/*$this->getIdentificacaoRegistro() .   '|' .
            $this->getFiller1() .                 '|' .
            $this->getAgenciaCedente() .          '|' .
            $this->getFiller2() .  '|' .
            $this->getContaCliente() .  '|' .
            $this->getDigitoConta() .  '|' .
            $this->getTaxaMulta() .  '|' .
            $this->getFiller3() .  '|' .
            $this->getNumeroControle() .  '|' .
            $this->getNossoNumero() .  '|' .
            $this->getDigitoNossoNumero() .  '|' .
            $this->getNumeroContrato() .  '|' .
            $this->getDataSegundoDesconto() .  '|' .
            $this->getValorSegundoDesconto() .  '|' .
            $this->getFiller4() .  '|' .
            $this->getCarteira() .  '|' .
            $this->getCodigoServico() .  '|' .
            $this->getNumeroDocumento() . '|' .
            $this->getDataVencimento() .  '|' .
            $this->getValorTitulo() .  '|' .
            $this->getNumeroBanco() .  '|' .
            $this->getAgenciaCobradora() .  '|' .
            $this->getFiller5() .  '|' .
            $this->getEspecie() .  '|' .
            $this->getAceite() .  '| ' .
            $this->getDataEmissao() .  '|' .
            $this->getCodigoInstrucao() .  '|' .
            $this->getJurosUmDia() .  '|' .
            $this->getDataDesconto() .  '|' .
            $this->getValorDesconto() .  '|' .
            $this->getValorIoc() .  '|' .
            $this->getValorAbatimento() .  '|' .
            $this->getCodigoInscricaoSacado() .  '|' .
            $this->getNumeroCpfCnpjSacado() .  '|' .
            $this->getNomeSacado() .  '|' .
            $this->getEnderecoSacado() .  '|' .
            $this->getComplementoEnderecoSacado() .  '|' .
            $this->getCepSacado() .  '|' .
            $this->getCidadeSacado() .  '|' .
            $this->getUfSacado() .  '|' .
            $this->getMensagemCedente() .  '|' .
            $this->getPrazoProtesto() .  '|' .
            $this->getCodigoMoeda() . '|' .
            $this->getNumeroSequencialRegistro();*/

            $this->getIdentificacaoRegistro() .  
            $this->getFiller1() .  
            $this->getAgenciaCedente() .  
            $this->getFiller2() . 
            $this->getContaCliente() .  
            $this->getDigitoConta() . 
            $this->getTaxaMulta() .  
            $this->getFiller3() .  
            $this->getNumeroControle() .  
            $this->getNossoNumero() . 
            $this->getDigitoNossoNumero() .  
            $this->getNumeroContrato() . 
            $this->getDataSegundoDesconto() . 
            $this->getValorSegundoDesconto() . 
            $this->getFiller4() .  
            $this->getCarteira() . 
            $this->getCodigoServico() . 
            $this->getNumeroDocumento() . 
            $this->getDataVencimento() .  
            $this->getValorTitulo() .  
            $this->getNumeroBanco() .  
            $this->getAgenciaCobradora() .  
            $this->getFiller5() .  
            $this->getEspecie() .  
            $this->getAceite() .  
            $this->getDataEmissao() .  
            $this->getCodigoInstrucao() .  
            $this->getJurosUmDia() .  
            $this->getDataDesconto() .  
            $this->getValorDesconto() .  
            $this->getValorIoc() .  
            $this->getValorAbatimento() .  
            $this->getCodigoInscricaoSacado() . 
            $this->getNumeroCpfCnpjSacado() .  
            $this->getNomeSacado() .  
            $this->getEnderecoSacado() .  
            $this->getComplementoEnderecoSacado() .  
            $this->getCepSacado() . 
            $this->getCidadeSacado() .  
            $this->getUfSacado() .  
            $this->getMensagemCedente() .  
            $this->getPrazoProtesto() .  
            $this->getCodigoMoeda() . 
            $this->getNumeroSequencialRegistro();

        //testes
        //die((string)$linha);
        //$qtdLinha = (string)strlen($linha);
        //die($qtdLinha);

		return (string)$this->valid_linha($linha);
	}
    
}