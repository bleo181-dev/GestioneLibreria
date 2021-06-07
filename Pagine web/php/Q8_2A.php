<?php 
	$codice=$_POST["codice"];

include_once('connessione.php');
	
	
    $sql = "SELECT COUNT(Prestito.Codice) AS Numero_prestiti
            FROM Prestito, Libro, Dipartimento
            WHERE Dipartimento.Codice_dipartimento = ".$codice." AND 
            Prestito.Codice_libro = Libro.Codice_libro AND 
            Libro.Codice_dipartimento = Dipartimento.Codice_dipartimento    
	    ";
    
    $result = mysqli_query($link, $sql);
    

    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html.$row[0];
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
		</style>
    </head>

    <body>

        <fieldset>
			<h1 style="text-align:center">Numero di prestiti effettuati nel dipartimento:</h1>
            <h2 style="margin-left:48%; color:red"> <?php echo $Html?> </h2>
        </fieldset>
			
		  


    </body>

</html>


