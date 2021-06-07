<?php 
	$nome=$_POST["nome"];
    $cognome=$_POST["cognome"];
    $matricola=$_POST["matricola"];

	include_once('php/connessione.php');
	
	
    $sql = "SELECT *
	FROM Libreria.Utente 
	WHERE Utente.Matricola LIKE '%".$matricola."%' AND Utente.Nome LIKE '%".$nome."%' AND Utente.Cognome LIKE '%".$cognome."%'";
    
    $result = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4], N.$row[5], $row[7], $row[6]</td><td>$row[8]</td><td>$row[9]</td><td>
		<form action='php/getPrestiti.php' method='POST'>
		<input type='hidden' value='$row[0]' name='matricola'><input type='submit' value='Prestiti'>
		</form></td></tr>";
    }
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Ricerca utente-storico</title>
		
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
		<form action="Q5.php" method="POST">
        <fieldset>
			<h1 style="text-align:center">Ricerca utente e storico</h1>
		<p style="text-align: center">
		Ricerca di un utente della biblioteca e il suo storico dei prestiti 
		(compresi quelli in corso)
		</p>
		  		<input style="width:98.3%" type="text" name="nome" placeholder="Scrivi qui il nome dell'utente">
                <input  style="width:98.3%" type="text" name="cognome" placeholder="Scrivi qui il cognome dell'Utente">
                <input  style="width:98.3%" type="text" name="matricola" placeholder="Scrivi qui la matricola dell'utente">
        <input style="width: 100%; " type="submit" value="Invia" />
            </fieldset>
		</form>

		<table style="width:100%">
		<tr>
    	<th>Matricola</th>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Numero di telefono</th>
		<th>Indirizzo</th>
		<th>Sesso</th>
		<th>Data di nascita</th>
		<th>Storico prestiti</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


