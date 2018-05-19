<?php 
	$FILE_NAME = readline("Nome do Arquivo CSV: ");
	$output_filename = $FILE_NAME;
	$FILE_NAME .= ".csv";
	#$FILE_NAME = "springer_13_16.csv";
	#$output_filename = "springer_13_16";

	#variavel para armazenar as novas linhas
	$novas_linhas = array();

	#ignora a primeira linhas, pois esta contém os cabeçalhos
	$ignorar_a_primeira_linha = true;

	#abre o arquivo e armazenas as linhas em uma lista
	$linhas = file_get_contents($FILE_NAME);
	$linhas = explode("\n", $linhas);
	
	#depois, para cada linha, monta uma entrada do bibtex
	#e salva em uma outra lista
	foreach($linhas as $linha){

		if($ignorar_a_primeira_linha){
			$ignorar_a_primeira_linha = false;
			continue;
		}else{
			
			$entradas = explode(",", $linha);
			$cabecalho = str_replace('"', "", $entradas[9]);

			$nova_linha  = "@$cabecalho{xx,\n";
			$nova_linha .= "  title={$entradas[0]},\n";
			$nova_linha .= "  booktitle={$entradas[1]},\n";
			$nova_linha .= "  series={$entradas[2]},\n";
			$nova_linha .= "  volume={$entradas[3]},\n";
			$nova_linha .= "  issue={$entradas[4]},\n";
			$nova_linha .= "  doi={$entradas[5]},\n";
			$nova_linha .= "  authors={$entradas[6]},\n";
			$nova_linha .= "  year={$entradas[7]},\n";
			$nova_linha .= "  howpublished={$entradas[8]}\n";
			$nova_linha .= "}\n\n";

			$novas_linhas[] = $nova_linha;
			
		}
	}
	
	#salva as linhas em outro arquivo
	foreach($novas_linhas as $linha){
		echo $linha;
	} 

	file_put_contents($output_filename . ".bib", implode("", $novas_linhas));



?>
