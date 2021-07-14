<?php
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	// Recebe os dados e guarda-os em variáveis
	$cod = $_GET["codigo"];
	
	$codVal = 0;
	
	//valida
	if($cod != "" and ctype_digit($cod))
	{
		$codVal=1;
	}
	
		//fazendo conexao com o banco
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3daw_AV2";
				
		//$conexao = mysqli_connect('localhost','root','root','3daw');
		$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
		if (!$conn) 
		{
			echo "ERRO AO CONECTAR BANCO DE DADOS!!";
		}
		
		//resultado
		
		if($codVal==1 )
		{
			echo "<br>";
			$sql = "SELECT * FROM produto WHERE COD_BARRA = $cod AND DISPONIVEL = TRUE";
				
			if ($result = $conn->query($sql)) 
			{
				$arr = array();
				$i=1;
				
				echo "========================================================================================================<br>";
				echo "Busca feita com sucesso!!";
				echo "<br><br>";
				echo "<table width='80%' border=1>";
				echo "<tr bgcolor='#CCCCCC'>
					<th> NOME </th>
					<th> CATEGORIA </th>
					<th> COD_BARRA </th>
					<th> PRECO </th>
					<th> QUANT_EST </th>
					<th> ACAO </th>
				</tr>";
				while ($res = $result->fetch_assoc()) 
				{
					echo "<tr>";
					echo "<td style='text-align: center'><a href=\"detalheProd.html?codigo=$res[COD_BARRA]\">".$res['NOME']."</a></td>";
					echo "<td style='text-align: center'>".$res['CATEGORIA']."</td>";
					echo "<td style='text-align: center'>".$res['COD_BARRA']."</td>";
					echo "<td style='text-align: center'>".$res['PRECO']."</td>";
					echo "<td style='text-align: center'>".$res['QUANT_EST']."</td>";
					echo "<td style='text-align: center'><a href=\"AV2_update.html?cod=$res[COD_BARRA]\">Editar</a>  |  <a href=\"AV2_delete.html?cod=$res[COD_BARRA]\">Deletar</a></td>";		
					echo "</tr>";
				}
				echo "</table>";
				$result->close();
			}
		}
		else 
		{
			echo "Erro no select !!";
		}
	
}
?>