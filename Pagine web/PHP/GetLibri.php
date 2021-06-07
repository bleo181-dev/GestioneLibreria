<?php 
	$nomeL=$_POST["nomeL"];
	
	include_once('connessione.php');
	
	
    $sql = "SELECT Libro.Codice_libro, Libro.Titolo, Libro.ISBN, Libro.Lingua, Libro.Anno_pubblicazione, Libro.Codice_dipartimento 
	FROM Libreria.Libro 
	WHERE Titolo LIKE '%".$nomeL."%'";
    
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
		        
		<title>Ricerca libro</title>
		
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
		<form action="GetLibri.php" method="POST">
		<fieldset>
			<h1 style="text-align:center">Ricerca libro</h1>
		<p style="text-align: center">
			Ricerca di un libro inserendo il titolo (anche parziale) <br>
			nel caso in cui nessun parametro venga specificato deve essere presentata la lista completa dei libri.
		</p>
				<input  style="width: 98.3%; " type="text" name="nomeL" placeholder="Scrivi qui il nome del libro">
        <input style="width: 100%; " type="submit" value="Invia" />
            </fieldset>
		</form>

		<table style="width:100%">
  		<tr>
    	<th>Codice</th>
    	<th>Titolo Libro</th>
    	<th>ISBN</th>
		<th>Lingua</th>
		<th>Anno pubblicazione</th>
		<th>Codice Dipartimento</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


