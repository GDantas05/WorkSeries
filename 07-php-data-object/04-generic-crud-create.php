<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		require('./_app/Config.inc.php');

		$dados = array('agent_name'  => 'Firefox',
					   'agent_views' => '1280'
		);

		$cadastra = new Create;

		$cadastra->exeCreate('ws_siteviews_agent', $dados);

		var_dump($cadastra);

		if ($cadastra->getResult()) {
			echo "<hr> Cadastrado com sucesso!";
		}
	?>
</body>
</html>