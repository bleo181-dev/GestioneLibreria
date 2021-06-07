<?php

include_once('php/connessione.php');


    $sql = "SELECT Autore.Codice_autore, Autore.Nome, Autore.Cognome, Autore.Data_nascita, Autore.Luogo_nascita
	FROM Libreria.Autore";

    $result = mysqli_query($link, $sql);


    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>
		<form action='php/getLibriA.php' method='POST'>
		<input type='hidden' value='$row[0]' name='codice'><input type='submit' value='Vedi libri'>
		</form></td></tr>";
    }

    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Libri per autore</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

		<style>
			body {
				max-width: 1200px;
			}

			table, td, th {
				text-align:center;
				width: 100%;
				vertical-align: middle;
			}
		</style>
    </head>

    <body>

        <fieldset>
			<h1 style="text-align:center">Bibliografia di un determinato autore</h1>
		<p style="text-align: center">
			Visualizzazione di tutti i libri di un determinato autore,
			eventualmente suddivisi per anno di pubblicazione
		</p>
            </fieldset>


		<table style="width:100%">
  		<tr>
    	<th>Codice</th>
    	<th>nome</th>
    	<th>cognome</th>
		<th>data nascita</th>
		<th>luogo nascita</th>
		<th>Bibliografia</th>
  		</tr>
		  <?php echo $Html?>

		</table>


    </body>

</html>
