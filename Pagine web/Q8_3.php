<?php 

include_once('php/connessione.php');
	
	//query
    $sql = "SELECT Autore.Codice_autore, Autore.Nome, Autore.Cognome , Autore.Data_nascita, Autore.Luogo_nascita, COUNT(Libro.Codice_libro)  AS Numero_libri
            FROM Scrive, Libro, Autore
            WHERE Scrive.Codice_autore = Autore.Codice_autore AND
            Scrive.Codice_libro = Libro.Codice_libro
            GROUP BY Autore.Codice_autore
        ";
    
    $result = mysqli_query($link, $sql);
    

	//creo una tabella che dopo verrà visualizzata in html
    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
    }
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Numero libri autore</title>
		
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
        <p style="text-align:center"> 
			Numero di libri per autore
		</p>
            </fieldset>
		

		<table style="width:100%;">
  		<tr>
    	<th>Codice autore</th>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Data di nascita</th>
		<th>Luogo di nascita</th>
		<th>Numero di libri scritti</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


