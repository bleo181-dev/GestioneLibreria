<?php 

include_once('php/connessione.php');
	
	//query
    $sql = "SELECT *
	FROM Libreria.Utente";
    
    $result = mysqli_query($link, $sql);
    

	//creo una tabella che dopo verrà visualizzata in html
    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4], N.$row[5], $row[7], $row[6]</td><td>$row[8]</td><td>$row[9]</td></tr>";
    }
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Elenco utenti</title>
		
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
			<h1 style="text-align:center">Elenco degli utenti della biblioteca</h1>
            </fieldset>
		

		<table style="width:100%;">
  		<tr>
    	<th>Matricola</th>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Numero di telefono</th>
		<th>Indirizzo</th>
		<th>Sesso</th>
		<th>Data di nascita</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


