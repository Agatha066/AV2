<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		$categoria = $_GET["categoria"];
		//$categoria = "Alimentos e Bebidas";
		$formInvalido = 0;
		
		function validaDadosAlpha($formDado) {
			if ($formDado == "" or ctype_alpha($formDado)) {
				$formInvalido = 1;
			}
		}
		
		validaDadosAlpha($categoria);
		
		if ($formInvalido == 0) {
			
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
			
			//SQL 1
			$sqll=" SELECT ID FROM categoria WHERE NOME = '$categoria' ";
			$resultado = $conn->query($sqll);
			$res = $resultado->fetch_assoc();
		
			$id = $res['ID'];
			
			//SQL 2
			$sql="SELECT * FROM tipo WHERE ID_CATEGORIA = $id";
			
			$result = $conn->query($sql);
			$arrCat = array();
			
			$i=0;
			
			if($result = $conn->query($sql))
			{
				while($db_field = $result->fetch_assoc())
				{
					$arrCat[$i]= utf8_decode($db_field["NOME"]);
					$i++;
				}
			}
			header('Content-Type: application/json; charset=utf-8 ');
			echo json_encode($arrCat); //criando um json pra ser consumido via javascript
		}
}

?>