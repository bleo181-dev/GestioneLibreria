<?php 
	$nome=$_POST["nome"];
    $cognome=$_POST["cognome"];
    $codice=$_POST["codice"];
    $data=$_POST["data"];
    $luogo=$_POST["luogo"];

	include_once('connessione.php');
	
	
    $sql = "SELECT Autore.Codice_autore, Autore.Nome, Autore.Cognome, Autore.Data_nascita, Autore.Luogo_nascita
	FROM Libreria.Autore 
	WHERE Autore.Codice_autore LIKE '%".$codice."%' AND Autore.Nome LIKE '%".$nome."%' AND Autore.Cognome LIKE '%".$cognome."%' AND Autore.Data_nascita LIKE '%".$data."%' AND Autore.Luogo_nascita LIKE '%".$luogo."%'";
    
    $result = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
    }
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Ricerca autore</title>
		
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
		<form action="LibriAutore.php" method="POST">
        <fieldset>
			<h1 style="text-align:center">Ricerca di un autore con uno o più parametri</h1>
		<p style="text-align: center"> 
			Ricerca degli autori inserendo uno o più parametri (anche parziali)
		</p>
		  		<input  style="width: 98.3%; " type="text" name="nome" placeholder="Scrivi qui il nome dell'autore">
                <input  style="width: 98.3%; " type="text" name="cognome" placeholder="Scrivi qui il cognome dell'autore">
                <input  style="width: 98.3%; " type="text" name="codice" placeholder="Scrivi qui il codice dell'autore">
                <input  style="width: 98.3%; " type="text" name="data" placeholder="Scrivi qui la data dell'autore">
                <input  style="width: 98.3%; " type="text" name="luogo" placeholder="Scrivi qui il luogo di nascita dell'autore">
        		<input style="width: 100%; " type="submit" value="Invia" />
            </fieldset>
		</form>

		<table style="width:100%">
  		<tr>
    	<th>Codice</th>
    	<th>nome</th>
    	<th>cognome</th>
		<th>datat nascita</th>
		<th>luogo nascita</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>


