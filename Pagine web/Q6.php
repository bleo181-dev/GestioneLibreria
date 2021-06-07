<?php 

	include_once('php/connessione.php');
	
	//query
    $sql = "SELECT Utente.Matricola, Utente.Nome, Utente.Cognome, Libro.Titolo, Libro.ISBN,
	Prestito.Data_uscita, Prestito.Restituito, Dipartimento.Nome, Dipartimento.Via, Dipartimento.Numero_civico, 
	Dipartimento.Codice_postale, Dipartimento.Città
	FROM Utente, Prestito, Libro, Dipartimento
	WHERE Utente.Matricola = Prestito.Matricola AND Libro.Codice_libro = Prestito.Codice_libro AND 
	Libro.Codice_dipartimento = Dipartimento.Codice_dipartimento
	ORDER BY Prestito.Data_uscita DESC;
	";
    
    $result = mysqli_query($link, $sql);
    

	//creo una tabella che dopo verrà visualizzata in html
    while ($row = mysqli_fetch_array($result)) {
		$state="Non restituito";
		if($row[6]==1){
			$state="Restituito";
		}
		

		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td>
		<td>$row[4]</td><td>$row[5]</td><td>$state</td>
		<td>$row[7]</td><td>$row[8], N.$row[9], $row[11], $row[10]</td></tr>";
    }
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Storico prestiti</title>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

		<style>
			body {
				max-width: 1400px;
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
			<h1 style="text-align:center">Storico dei prestiti</h1>
        </fieldset>
		

		<table style="width:100%;">
  		<tr>
    	<th>Matricola</th>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Titolo Libro</th>
    	<th>ISBN</th>
		<th>Data del prestito</th>
		<th>Stato</th>
		<th>Nome del dipartimento</th>
		<th>Indirizzo del dipartimento</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


