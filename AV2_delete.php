<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		$cod = $_GET["codigo"];
		$disponivel = false;
		$codVal = 0;
		
		//valida
		if($cod != "" and ctype_digit($cod))
		{
			$codVal=1;
		}
		
		//resultado
		
		//fazendo conexao com o banco
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3daw_AV2";
			
		$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
		if (!$conn) 
		{
			echo "ERRO AO CONECTAR BANCO DE DADOS!!";
		}
			
		if($codVal==1 )//deletar no banco
		{
			echo "RESULTADO<br>";
			
			$sql = "UPDATE produto SET DISPONIVEL = false WHERE COD_BARRA = '$cod'";
			
			if($resultado = $conn->query($sql) == TRUE )
			{
				echo "<br><br>Produto Excluido com sucesso!!<br>";
			}
		}
		else 
		{
			echo "Erro Ao Deletar !!";
		}
	
	}
?>

