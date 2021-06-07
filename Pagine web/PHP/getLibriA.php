<?php 
	$codice=$_POST["codice"];

include_once('connessione.php');
	
	
    $sql = "SELECT Libro.Codice_libro, Libro.Titolo, Libro.ISBN, Libro.Lingua, Libro.Anno_pubblicazione, Libro.Codice_dipartimento
	FROM Libro, Autore, Scrive 
	WHERE Autore.Codice_autore = '$codice' AND Autore.Codice_autore = Scrive.Codice_autore AND  Scrive.Codice_libro = Libro.Codice_libro
	ORDER BY Anno_pubblicazione;
	";
    
    $result = mysqli_query($link, $sql);
    

    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
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
    	<th>Titolo</th>
    	<th>ISBN</th>
		<th>Lingua</th>
		<th>Anno pubblicazione</th>
		<th>Codice dipartimento</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


