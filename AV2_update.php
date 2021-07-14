<?php
$msgErro = "";
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	// Recebe os dados e guarda-os em variáveis
	
	$cod = $_GET["codigo"];
	//$cod = 842314;
	
	//fazendo conexao com o banco
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3daw_AV2";
		
		if($cod!="" and ctype_digit($cod))//validando
		{
			//$conexao = mysqli_connect('localhost','root','root','3daw');
			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "ERRO AO CONECTAR BANCO DE DADOS!!";
			}
			
			$sql = "SELECT * FROM produto WHERE COD_BARRA = $cod ";
			$resultado = $conn->query($sql);
			$res = $resultado->fetch_assoc();
			
			
			$valores["nome"] = $res["NOME"];
			$valores["id"] = $res["ID_PROD"];
			$valores["descricao"] = $res["DESCRICAO"];
			$valores["preco"] = $res["PRECO"];
			$valores["peso"] = $res["PESO"];
			$valores["tipo"] = $res["TIPO"];
			$valores["categoria"] = $res["CATEGORIA"];
			$valores["fabricante"] = $res["FABRICANTE"];
			$valores["quant"] = $res["QUANT_EST"];
			$valores["cod"] = $res["COD_BARRA"];
			$valores["data"] = $res["DATA_CADASTRO"];
			$valores["disponivel"]  = $res["DISPONIVEL"];
			$valores["img"]= "Imagens/".$res["IMG"];
			
			//echo "<img src='".$valores["img"]."' alt='Foto do Produto' style='width:20%'/><br />";
			//echo "".$valores["img"]."";
			header('Content-Type: application/json; charset=utf-8 ');
			echo json_encode($valores);
		}
		else
		{
			echo "COD_BARRA nao encontrado!!";
		}
}

?>
