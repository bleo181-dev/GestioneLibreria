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
		$Html =  $Html."<tr><td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$state</td><td>$row[6]</td><td>$row[7], N.$row[8], $row[10], $row[9]</td></tr>";
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
				max-width: 80%;
			}

			table, td, th {
				text-align:center;
				width: 100%;
				vertical-align: middle;
			}

			.main_div {
                text-align:center;
                right: 0%;
                height: 100%;
                left: 0%;
				top:0%;
                width: 60px;
                background-color: rgb(19, 48, 90);
				border: 1px #0096bfab solid;
  				
  				

                
            }

			a[type="menu"] {

				border: 1px #0096bfab solid;
  				border: 3px var(--focus) solid;
  				border-radius: 10px;
				padding: 5px;

            }
		</style>
    </head>

    <body>


	<div class="main_div" style="position:fixed;">
			<hr style="width: 30px;">
		<a href="../index.html"><img src="../immagini/home.png"/></a><hr style="width: 30px;">
		<a href="../Q5.php"><img src="../immagini/back.png"/></a><hr style="width: 30px;">
		
		<br>
		
		<a type="menu" href="../Q1.html">Q1</a><br><br>
		<a type="menu" href="../Q2.php">Q2</a> <br><br>
		<a type="menu" href="../Q3.html">Q3</a> <br><br>
		<a type="menu" href="../Q4.php">Q4</a> <br><br>
		<a style="color: rgb(219, 80, 15);" type="menu" href="../Q5.php">Q5</a> <br><br>
		<a type="menu" href="../Q6.php">Q6</a> <br><br>
		<a type="menu" href="../Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="../Q8_1.html">Q8.1</a> <br><br>
		<a type="menu" href="../Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="../Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="../QueryExtra1.html">QE1</a> <br><br>
		<a type="menu" href="../QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		</div>

        <fieldset>
			<h1 style="text-align:center">Storico utente selezionato</h1>
		<p style="text-align: center">
		Utente con matricola: <b><?php echo $matricola;?></b>
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


