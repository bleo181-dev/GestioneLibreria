<?php

include_once('php/connessione.php');


    $sql = "SELECT *
	FROM Libreria.Dipartimento";

    $result = mysqli_query($link, $sql);


    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2], N.$row[3], $row[5]</td> <td>$row[4]</td><td>
		<form action='php/Q8_2A.php' method='POST'>
		<input type='hidden' value='$row[0]' name='codice'><input type='submit' value='Conta'>
		</form></td></tr>";
    }

    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Prestiti succursale</title>

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
			<h1 style="text-align:center">Calcolo di statistiche relative a libri e autori:</h1>
		<p style="text-align: center">
		Numero di prestiti effettuati in una determinata succursale
		</p>
            </fieldset>


		<table style="width:100%">
  		<tr>
    	<th>Codice</th>
    	<th>Nome</th>
    	<th>Indirizzo</th>
        <th>Codice postale</th>
        <th>Numero prestiti</th>
  		</tr>
		  <?php echo $Html?>

		</table>


    </body>

</html>
