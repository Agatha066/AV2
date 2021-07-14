<?php
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
			$sql = "SELECT * FROM produto WHERE DISPONIVEL = TRUE";
				
			if ($result = $conn->query($sql)) 
			{
				$arr = array();
				$i=1;
				
				echo "<br>========================================================================================================<br><br>";
				echo "Busca feita com sucesso!!<br><br>";
				echo "<table width='80%' border=1>";
				echo "<tr bgcolor='#CCCCCC'>
					<th>NOME</th>
					<th>CATEGORIA</th>
					<th>COD_BARRA</th>
					<th>PRECO</th>
					<th>QUANT_EST</th>
					<th>ACAO</th>
				</tr>";
				while ($res = $result->fetch_assoc()) 
				{
					echo "<tr>";
					echo "<td style='text-align: center'><a href=\"detalheProd.html?codigo=$res[COD_BARRA]\">".$res['NOME']."</a></td>";
					echo "<td style='text-align: center'>".$res['CATEGORIA']."</td>";
					echo "<td style='text-align: center'>".$res['COD_BARRA']."</td>";
					echo "<td style='text-align: center'>".$res['PRECO']."</td>";
					echo "<td style='text-align: center'>".$res['QUANT_EST']."</td>";
					echo "<td style='text-align: center'><a href=\"AV2_update.html?cod=$res[COD_BARRA]\">Editar</a>  |  <a href=\"AV2_delete.html\">Deletar</a></td>";		
					echo "<br>";
					echo "</tr>";
				}
				echo "</table>";
				$result->close();
			}
?>