<?php 
	$matricola=$_POST["matricola"];

	include_once('connessione.php');
	
	
    $sql = "SELECT Libro.Titolo, Libro.ISBN, Libro.Lingua, Libro.Anno_pubblicazione, Prestito.Data_uscita, Prestito.Restituito, Dipartimento.Nome, Dipartimento.Via, Dipartimento.Numero_civico, Dipartimento.Codice_postale, Dipartimento.Città
	FROM Utente, Prestito, Libro, Dipartimento
	WHERE Utente.Matricola = '$matricola' AND Utente.Matricola = Prestito.Matricola AND
	Libro.Codice_libro = Prestito.Codice_libro AND Libro.Codice_dipartimento = Dipartimento.Codice_dipartimento
	ORDER BY Prestito.Data_uscita DESC;
	";
    
    $result = mysqli_query($link, $sql);
    

    while ($row = mysqli_fetch_array($result)) {
		$state="Non restituito";
		if($row[5]==1){
			$state="Restituito";
		}
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$state</td><td>$row[6]</td><td>$row[7], N.$row[8], $row[10], $row[9]</td></tr>";
    }
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Storico utente</title>
		
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
			<h1 style="text-align:center">Ricerca utente e storico</h1>
		<p style="text-align: center">
		Ricerca di un utente della biblioteca e il suo storico dei prestiti 
		(compresi quelli in corso)
		</p>
            </fieldset>
	

		<table style="width:100%">
  		<tr>
    	<th>Titolo</th>
    	<th>ISBN</th>
		<th>Lingua</th>
		<th>Anno pubblicazione</th>
		<th>Data del prestito</th>
		<th>Stato</th>
		<th>Nome del dipartimento</th>
		<th>Indirizzo del dipartimento</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


