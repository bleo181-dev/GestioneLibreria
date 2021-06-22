<?php

include_once('php/connessione.php');

//query per i maschi
    $sql = "SELECT Utente.Matricola, Utente.Nome, Utente.Cognome, Utente.Numero_telefono, Utente.Data_nascita, Utente.Via, Utente.Numero_civico, count(Utente.Matricola) as furti
	FROM Utente, Prestito
	WHERE Utente.Matricola = Prestito.Matricola AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY) AND Utente.Sesso = 'M'
	GROUP BY Utente.Matricola
	HAVING count(Utente.Matricola)=( 
		SELECT MAX(NumFurti) 
		FROM ( 
			SELECT Utente.Matricola, count(Utente.Matricola) as NumFurti
			FROM Utente, Prestito
			WHERE Utente.Matricola = Prestito.Matricola AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY) AND Utente.Sesso = 'M'
			GROUP BY Utente.Matricola) AS Conteggio)
	ORDER BY Utente.Matricola;
	";


    $result = mysqli_query($link, $sql);


    while ($row = mysqli_fetch_array($result)) {
		$Html = $Html."<tr><td><h3>$row[0]</h3></td><td> Si fa chiamare: <b> $row[1] $row[2] </b> <br>
		<br> Ultima residenza nota: <br> <b>Via $row[5] $row[6] </b> <br><br> Telefono: <b>$row[3]</b> <br>
		<br> Nato il <b>$row[4]</b> </td> <td> <b>$row[7]</b>  furti</td> 
		<td>
		<form action='php/Q_extra2.php' method='POST'>
		<input type='hidden' value='$row[0]' name='matricola'>
		<input type='hidden' value='M' name='sesso'>
		<input style=' width: 100%; height:200px;' type='submit' value='Refurtiva'>
		</form></td></tr>";
    }


	//query per le femmine
	$sql = "SELECT Utente.Matricola, Utente.Nome, Utente.Cognome, Utente.Numero_telefono, Utente.Data_nascita, Utente.Via, Utente.Numero_civico, count(Utente.Matricola) as furti
	FROM Utente, Prestito
	WHERE Utente.Matricola = Prestito.Matricola AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY) AND Utente.Sesso = 'F'
	GROUP BY Utente.Matricola
	HAVING count(Utente.Matricola)=( 
		SELECT MAX(NumFurti) 
		FROM ( 
			SELECT Utente.Matricola, count(Utente.Matricola) as NumFurti
			FROM Utente, Prestito
			WHERE Utente.Matricola = Prestito.Matricola AND Prestito.Restituito = 0 AND Prestito.Data_uscita < date_sub(current_date(), INTERVAL 30 DAY) AND Utente.Sesso = 'F'
			GROUP BY Utente.Matricola) AS Conteggio)
	ORDER BY Utente.Matricola;
	";


	$result = mysqli_query($link, $sql);


    while ($row = mysqli_fetch_array($result)) {
		$Html2 =  $Html2."<tr><td><h4>$row[0]</h4></td><td> Si fa chiamare: <b> $row[1] $row[2] </b> <br>
		<br> Ultima residenza nota: <br> <b>Via $row[5] $row[6] </b> <br><br> Telefono: <b>$row[3]</b> <br>
		<br> Nato il <b>$row[4]</b> </td> <td> <b>$row[7]</b> furti</td> 
		<td>
		<form action='php/Q_extra2.php' method='POST'>
		<input type='hidden' value='$row[0]' name='matricola'>
		<input type='hidden' value='F' name='sesso'>
		<input style=' width: 100%; height:200px;' type='submit' value='Refurtiva'>
		</form></td></tr>";
	}

    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Furti</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

		<style>
			body {
				max-width: 90%;
			}

			fieldset {
  				border: 1px #0096bfab solid;
  				border: 1px var(--focus) solid;
  				border-radius: 6px;
  				margin-bottom: 12px;
  				padding: 10px;
			}

            .date input{
                float:left;
                width:47.7%;
            }

			h3 {
  				margin: 0px;
  				background-image: url('immagini/escobar.png');
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
  				margin: 0px;
  				background-image: url('immagini/nairobi2.jpg');
				background-repeat: no-repeat;
  				color: #ffffff;
  				font-size: 220%;
  				font-weight: normal;
  				line-height: 300px;
  				text-align: center;
				width: 200px;
  				height: 180px;
				  				
			}

			table, td, th {
				text-align:center;
				width: 100%;
				vertical-align: middle;
			}
			
			* {
				box-sizing: border-box;
			}

			.row {
				margin-left:-5px;
				margin-right:-5px;
			}
			
			.column {
				float: left;
				width: 50%;
				padding-left: 7px;
			}

			/* Clearfix (clear floats) */
			.row::after {
			content: "";
			clear: both;
			display: table;
			}

			table {
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
			border: 1px solid #ddd;
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
		<a href="index.html"><img src="immagini/home.png"/></a><hr style="width: 30px;">
		<br>
		
		<a type="menu" href="Q1.html">Q1</a><br><br>
		<a type="menu" href="Q2.php">Q2</a> <br><br>
		<a type="menu" href="Q3.html">Q3</a> <br><br>
		<a type="menu" href="Q4.php">Q4</a> <br><br>
		<a type="menu" href="Q5.php">Q5</a> <br><br>
		<a type="menu" href="Q6.php">Q6</a> <br><br>
		<a type="menu" href="Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="Q8_1.html">Q8.1</a> <br><br>
		<a type="menu" href="Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="QueryExtra1.html">QE1</a> <br><br>
		<a style="color: rgb(219, 80, 15);" type="menu" href="QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		<a><img src="immagini/logo_miniPNG.png"/></a>
		</div>

			<fieldset>
			
			<h1 style="text-align:center">Utenti che hanno compiuto più furti</h1>
        	<p style="text-align: center"> 
				Qui elencati gli studenti frequentanti le librerie universitarie con più libri non restituiti. <br>
				La direzione sta valutando di implementare un sistema di taglie con numerosi CFU come ricompensa per stimolare il rientro dei libri rubati.
			</p>
            </fieldset>

				<div class="row">
				<div class="column">
					<h2>Ladro/i ancora a piede libero</h2>
						<table style="width:100%;">
							<tr>
								<th style='width: 160px'>Matricola</th>
								<th >Dati noti del ricercato</th>
								<th >Ricercato per</th>
								<th ></th>
							</tr>
								<?php echo $Html?>
						</table>
				</div>
				<div class="column">
					<h2>Ladra/e ancora a piede libero</h2>
						<table style="width:100%;">
							<tr>
								<th style='width: 210px'>Matricola</th>
								<th >Dati noti del ricercato</th>
								<th >Ricercata per</th>
								<th></th>
							</tr>
								<?php echo $Html2?>
						</table>
				</div>
				</div>


    </body>

</html>
