<?php 
	$nomeL=$_POST["nomeL"];
	
	include_once('connessione.php');
	
	
    $sql = "SELECT Libro.Codice_libro, Libro.Titolo, Libro.ISBN, Libro.Lingua, Libro.Anno_pubblicazione, Libro.Codice_dipartimento 
	FROM Libreria.Libro 
	WHERE Titolo LIKE '%".$nomeL."%'";
    
    $result = mysqli_query($link, $sql);
    

    while ($row = mysqli_fetch_array($result)) {
		$Html =  $Html."<tr><td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
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

			a[type="im"] {

				right: 0%;
				height: 100%;

				top:80%;
				width: 60px;

			}
		</style>
    </head>

    <body>

	<div class="main_div" style="position:fixed;">
			<hr style="width: 30px;">
		<a href="../index.html"><img src="../immagini/home.png"/></a><hr style="width: 30px;">
		
		<br>
		
		<a style="color: rgb(219, 80, 15);" type="menu" href="../Q1.html">Q1</a><br><br>
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
		<a type="menu" href="../QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		<a><img src="../immagini/logo_miniPNG.png"/></a>
		</div>

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
    	<th>Titolo</th>
    	<th>ISBN</th>
		<th>Lingua</th>
		<th>Anno pubblicazione</th>
  		</tr>
		  <?php echo $Html?>

		</table>
		<div>
		<a type="im" style="position:fixed" href="#"> <img src="../immagini/su.png"/> </a>
		</div>
    </body>
	

</html>


