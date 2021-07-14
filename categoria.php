<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	
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
		
		//SQL
		$sql="SELECT * FROM categoria";
		
		$result = $conn->query($sql);
		$arrCat = array();
		
		$i=0;
		
		while($db_field = $result->fetch_assoc())
		{
			$arrCat[$i]= utf8_decode($db_field["NOME"]);
			$i++;
		}
		header('Content-Type: application/json; charset=utf-8 ');
		echo json_encode($arrCat); //criando um json pra ser consumido via javascript
	
}

?>