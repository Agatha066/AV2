<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		$cod = $_GET["codigo"];
		
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
		$sql="SELECT * FROM produto WHERE COD_BARRA='$cod' AND DISPONIVEL=true";
		$result = $conn->query($sql);
		$contagem = mysqli_num_rows($result);
		
			if ($contagem > 0) 
			{
				$arr = array();
				$i=1;
				
				while ($res = $result->fetch_assoc()) 
				{
					echo "<fieldset style='width:40%'>";
					echo "<img src='Imagens/".$res["IMG"]."' alt='Foto de Produto' style='width:30%'/><br />";
					echo "<p>Nome do Produto: ".$res['NOME']."</p>";
					echo "<p>Categoria: ".$res['CATEGORIA']."</p>";
					echo "<p>Tipo: ".$res['TIPO']."</p>";
					echo "<p>Fabricante: ".$res['FABRICANTE']."</p>";	
					echo "<p>Cod_Barra: ".$res['COD_BARRA']."</p>";
					echo "<p>Peso: ".$res['PESO']."</p>";
					echo "<p>Quant_Est: ".$res['QUANT_EST']."</p>";
					echo "<p>Data_Cadastro: ".$res['DATA_CADASTRO']."</p>";
					echo "<p style='color: grey; font-size: 22px'>".$res['PRECO']."</p>";
					echo "<p>".$res['DESCRICAO']."</p><br>";
					echo "</fieldset>";
				}
				echo "</table>";
				$result->close();
			}
			else {
				echo "Produto Nao existe para ser Apagado !!";
			}
}

?>