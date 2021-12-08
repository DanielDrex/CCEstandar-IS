<?php
	$myfile = fopen("../storage/arc/25_11_2021_04_57_12_troliado.jpg", "r") or die("Unable to open file!");

		while(!feof($myfile)) {
		  echo fgetc($myfile) ;
		}


	fclose($myfile);
?>

