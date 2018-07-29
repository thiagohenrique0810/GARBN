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

for ($i = 0; $i < 2; $i++) {
	//adicionando boleto
	$boleto['codigo_servico']				= '01';
	$boleto['agencia'] 						= '1800';
	$boleto['razao_conta_corrente']			= '1250';
	$boleto['especie']						= 'DM';
	$boleto['aceite']						= 'N';
	$boleto['codigo_instrucao']				= '00';
	$boleto['conta'] 						= '18399';
	$boleto['conta_dv'] 					= '7';
	$boleto['carteira'] 					= '21';
	$boleto['carteira_tipo_emissor']		= '2';
	$boleto['numero_controle'] 				= '5219';
	$boleto['percentual_multa'] 			= '5';
	$boleto['nosso_numero'] 				= '1255';
	$boleto['digito_nosso_numero'] 			= '8';
	$boleto['desconto_dia']	 				= '0';
	$boleto['numero_documento'] 			= '5654';
	$boleto['vencimento'] 					= '201115';
	$boleto['valor'] 						= '1200';
	$boleto['data_emissao_titulo'] 			= '161115';
	$boleto['valor_dia_atraso'] 			= '0';
	$boleto['data_limite_desconto'] 		= '201115';
	$boleto['valor_desconto'] 				= '0';
	$boleto['data_limite_segundo_desconto'] = '201115';
	$boleto['valor_segundo_desconto'] 		= '0';
	$boleto['valor_iof'] 					= '0';
	$boleto['valor_abatimento'] 			= '00';
	$boleto['tipo_inscricao_pagador'] 		= 'CPF';
	$boleto['numero_inscricao'] 			= '09191332400';
	$boleto['nome_pagador'] 				= 'thiago henrique pequeno da silva';
	$boleto['endereco_pagador'] 			= 'rua capitao lima, recife, pernambuco';
	$boleto['primeira_mensagem'] 			= '';
	$boleto['uf_pagador'] 					= 'PE';
	$boleto['cidade_pagador'] 				= 'JABOATAO';
	$boleto['cep_pagador'] 					= '54100';
	$boleto['sufixo_cep_pagador'] 			= '230';
	$boleto['sacador_mensagem'] 			= 'Mensagem teste';
	$boleto['prazo_protesto'] 				= '99';
	//debug
	//die(print_r($boleto));

	//adicionando boleto
	$arquivo->add_boleto($boleto);
}

$arquivo->setFilename('gerados/arquivo');

if($arquivo->save()) {
	echo 'arquivo processado';
}else {
	echo 'erro, nao pode procesa';
}
