<?php 
	$nome=$_POST["nome"];
    $cognome=$_POST["cognome"];
    $matricola=$_POST["matricola"];


	include_once('php/connessione.php');

	
	
	
	if(empty($matricola)){
	$sql = "SELECT *
	FROM Libreria.Utente 
	WHERE Utente.Nome LIKE '%".$nome."%' AND Utente.Cognome LIKE '%".$cognome."%'";
	}else{
		$sql = "SELECT *
		FROM Libreria.Utente 
		WHERE Utente.Matricola = '$matricola' AND Utente.Nome LIKE '%".$nome."%' AND Utente.Cognome LIKE '%".$cognome."%'";
	}
	

    
    $result = mysqli_query($link, $sql);

	
    $TotTupleT=0;
    while ($row = mysqli_fetch_array($result)) {
		$TotTupleT++;
		$Html =  $Html."<tr><td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4], N.$row[5], $row[7], $row[6]</td><td>$row[8]</td><td>$row[9]</td><td>
		<form action='php/getPrestiti.php' method='POST'>
		<input type='hidden' value='$row[0]' name='matricola'><input type='submit' style=' width: 100%;' value='Prestiti'>
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

			a[type="im"] {

				right: 0%;
				height: 100%;

				top:80%;
				width: 60px;

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
		<a href="index.html"><img src="immagini/home.png"/></a><hr style="width: 30px;">
		<br>
		<a type="menu" href="Q1.html">Q1</a><br><br>
		<a type="menu" href="Q2.php">Q2</a> <br><br>
		<a type="menu" href="Q3.html">Q3</a> <br><br>
		<a type="menu" href="Q4.php">Q4</a> <br><br>
		<a style="color: rgb(219, 80, 15);" type="menu" href="Q5.php">Q5</a> <br><br>
		<a type="menu" href="Q6.php">Q6</a> <br><br>
		<a type="menu" href="Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="Q8_1.html">Q8.1</a> <br><br>
		<a type="menu" href="Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="QueryExtra1.html">QE1</a> <br><br>
		<a type="menu" href="QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		<a><img src="immagini/logo_miniPNG.png"/></a>
		</div>

		<form action="Q5.php" method="POST">
        <fieldset>
		
			<h1 style="text-align:center">Ricerca utente e storico</h1>
		<p style="text-align: center">
		Ricerca di un utente della biblioteca e il suo storico dei prestiti 
		(compresi quelli in corso)
		</p>
		  		<input style="width:98.3%" type="text" name="nome" placeholder="Scrivi qui il nome dell'utente">
                <input  style="width:98.3%" type="text" name="cognome" placeholder="Scrivi qui il cognome dell'utente">
                <input  style="width:98.3%" type="text" name="matricola" placeholder="Scrivi qui la matricola dell'utente">
        <input style="width: 100%; " type="submit" value="Invia" />
		<br>
		
            </fieldset>
		</form>
		<h3>Totale risultati trovati: <?php echo $TotTupleT; ?></h3>
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
		<div  style="text-align:center"> 
		<?php echo $htmlPage; ?>
		</div>
		<div>
		<a type="im" style="position:fixed" href="#"> <img src="immagini/su.png"/> </a>
		</div>

    </body>

</html>


