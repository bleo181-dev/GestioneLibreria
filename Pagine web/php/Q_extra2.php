<?php

include_once('connessione.php');
$Matricola=$_POST["matricola"];
$Sesso=$_POST["sesso"];
		
		$sql = "SELECT Utente.Matricola, Libro.Titolo, Prestito.Data_uscita
				FROM Utente, Prestito, Libro
				WHERE Utente.Matricola = Prestito.Matricola AND Libro.Codice_libro = Prestito.Codice_libro AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY)
				HAVING Utente.Matricola IN (
						SELECT Utente.Matricola
						FROM Utente, Prestito
						WHERE Utente.Matricola = '$Matricola' AND Utente.Matricola = Prestito.Matricola AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY) 
						HAVING count(Utente.Matricola)=( 
							SELECT MAX(NumFurti) 
							FROM ( 
								SELECT Utente.Matricola, count(Utente.Matricola) as NumFurti
								FROM Utente, Prestito
								WHERE Utente.Matricola = '$Matricola' AND Utente.Matricola = Prestito.Matricola AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY) 
								GROUP BY Utente.Matricola) AS Conteggio))
				ORDER BY Utente.Matricola;
				";
		
		$refurtiva = mysqli_query($link, $sql);

		if($Sesso == "M"){
			$Header = "<h3>$Matricola</h3><h1 style='text-align:center'> Ricercato per: </h1>";
		}else if($Sesso == "F"){
			$Header = "<h4>$Matricola</h4><h1 style='text-align:center'> Ricercata per: </h1>";
		}
		
		while($row = mysqli_fetch_array($refurtiva)){
			$Html = $Html." <p style='text-align:center'>Non ha riportato il libro <b> $row[1] </b> dal <b> $row[2] </b> </p> ";
		}

    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Refurtiva</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

		<style>
			body {
				max-width: 80%;
			}

			fieldset {
  				border: 1px #0096bfab solid;
  				border: 1px var(--focus) solid;
  				border-radius: 6px;
  				margin-bottom: 12px;
  				padding: 10px;
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


			h3 {
				margin-left: 45%;
  				background-image: url('../immagini/escobar.png');
				background-repeat: no-repeat;
  				color: #000000;
  				font-size: 250%;
  				font-weight: normal;
  				line-height: 410px;
  				text-align: center;
				width: 150px;
  				height: 225px;				
			}

			h4 {
  				margin-left: 43%;
  				background-image: url('../immagini/nairobi2.jpg');
				background-repeat: no-repeat;
  				color: #ffffff;
  				font-size: 220%;
  				font-weight: normal;
  				line-height: 300px;
  				text-align: center;
				width: 200px;
  				height: 180px;
				  				
			}

		</style>
    </head>

    <body>

	<div class="main_div" style="position:fixed;">
			<hr style="width: 30px;">
		<a href="../index.html"><img src="../immagini/home.png"/></a><hr style="width: 30px;">
		<a href="../QueryExtra2.php"><img src="../immagini/back.png"/></a><hr style="width: 30px;">
		
		<br>
		
		<a type="menu" href="../Q1.html">Q1</a><br><br>
		<a type="menu" href="../Q2.php">Q2</a> <br><br>
		<a type="menu" href="../Q3.html">Q3</a> <br><br>
		<a type="menu" href="../Q4.php">Q4</a> <br><br>
		<a type="menu" href="../Q5.php">Q5</a> <br><br>
		<a type="menu" href="../Q6.php">Q6</a> <br><br>
		<a type="menu" href="../Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="../Q8_1.html">Q8.1</a> <br><br>
		<a type="menu" href="../Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="../Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="../QueryExtra1.html">QE1</a> <br><br>
		<a style="color: rgb(219, 80, 15);"  type="menu" href="../QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		</div>


			<fieldset>
			<?php echo $Header?>
			
            </fieldset>
            
                <?php echo $Html?>								
						
    </body>

</html>
