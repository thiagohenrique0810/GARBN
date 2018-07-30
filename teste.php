<?php
//REALIZANDO TESTES
include 'src/Arquivo.php';

//configurando o arquivo de remessa
$config['razao_social'] = 'TOP PROTECAO';
$config['codigo_usuario'] = '';
$config['data_gravacao'] = '270718';
$config['agencia'] = '4001';
$config['conta'] = '9345';
$config['conta_dv'] = '7';

$arquivo = new Arquivo();
//configurando remessa
$arquivo->config($config);

for ($i = 0; $i < 5; $i++) {
	//adicionando boleto
	$boleto['codigo_servico']				= '01';
	$boleto['agencia'] 						= '1800';
	$boleto['especie']						= 'DM';
	$boleto['aceite']						= 'N';
	$boleto['codigo_instrucao']				= '00';
	$boleto['conta'] 						= '18399';
	$boleto['conta_dv'] 					= '7';
	$boleto['carteira'] 					= '21';
	$boleto['carteira_tipo_emissor']		= '2';// 1 - EMITIDO PELA EMPRESA 2 - EMITIDO PELO CLIENTE
	$boleto['percentual_multa'] 			= '5';
	$boleto['nosso_numero'] 				= '10';
	$boleto['numero_documento'] 			= '0000001';
	$boleto['vencimento'] 					= '201115';
	$boleto['valor'] 						= '1200';
	$boleto['data_emissao_titulo'] 			= '161115';
	$boleto['valor_abatimento'] 			= '00';
	$boleto['tipo_inscricao_pagador'] 		= 'CPF';//CPF OU CNPJ
	$boleto['numero_inscricao'] 			= '09191332400';//NUMERO DO CPF/CNPJ DO PAGADOR
	$boleto['nome_pagador'] 				= 'thiago henrique pequeno da silva';
	$boleto['endereco_pagador'] 			= 'RUA PADRE ROMA, 343';
	$boleto['uf_pagador'] 					= 'PE';
	$boleto['cidade_pagador'] 				= 'JABOATAO';
	$boleto['cep_pagador'] 					= '54100';
	$boleto['sacador_mensagem'] 			= 'NAO ACEITAR APOS VENCIMENTO';
	/** OPCIONAIS **/
	//$boleto['prazo_protesto'] 				= '99';
	//$boleto['primeira_mensagem'] 			= '';
	//$boleto['desconto_dia']	 			= '0';
	//$boleto['valor_dia_atraso'] 			= '0';
	//$boleto['data_limite_desconto'] 		= '201115';
	//$boleto['valor_desconto'] 			= '0';
	//$boleto['data_limite_segundo_desconto'] = '201115';
	//$boleto['valor_segundo_desconto'] 		= '0';
	//$boleto['valor_iof'] 					= '0';

	//adicionando boleto
	$arquivo->add_boleto($boleto);
}

$arquivo->setFilename('gerados/arquivo');

if($arquivo->save()) {
	echo 'arquivo processado';
}else {
	echo 'erro, nao pode procesa';
}
