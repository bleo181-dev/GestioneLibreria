<?php 
	$nome=$_POST["nome"];
    $cognome=$_POST["cognome"];
    $data=$_POST["data"];
    $luogo=$_POST["luogo"];

	include_once('connessione.php');
	

	$sql = "SELECT Autore.Codice_autore, Autore.Nome, Autore.Cognome, Autore.Data_nascita, Autore.Luogo_nascita
	FROM Libreria.Autore 
	WHERE Autore.Nome LIKE '%".$nome."%' AND Autore.Cognome LIKE '%".$cognome."%' AND Autore.Data_nascita LIKE '%".$data."%' AND Autore.Luogo_nascita LIKE '%".$luogo."%'";


    
    
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
		        
		<title>Ricerca autore</title>
		
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
		
		<a type="menu" href="../Q1.html">Q1</a><br><br>
		<a type="menu" href="../Q2.php">Q2</a> <br><br>
		<a style="color: rgb(219, 80, 15);"  type="menu" href="../Q3.html">Q3</a> <br><br>
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


		<form action="LibriAutore.php" method="POST">
        <fieldset>
			<h1 style="text-align:center">Ricerca di un autore con uno o pi?? parametri</h1>
		<p style="text-align: center"> 
			Ricerca degli autori inserendo uno o pi?? parametri (anche parziali)
		</p>
		  		<input  style="width: 98.3%; " type="text" name="nome" placeholder="Scrivi qui il nome dell'autore">
                <input  style="width: 98.3%; " type="text" name="cognome" placeholder="Scrivi qui il cognome dell'autore">
                <input  style="width: 98.3%; " type="text" name="data" placeholder="Scrivi qui la data dell'autore">
                <input  style="width: 98.3%; " type="text" name="luogo" placeholder="Scrivi qui il luogo di nascita dell'autore">
        		<input style="width: 100%; " type="submit" value="Invia" />
            </fieldset>
		</form>

		<table style="width:100%">
  		<tr>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Data di nascita</th>
		<th>Luogo di nascita</th>
  		</tr>
		  <?php echo $Html?>

		</table>
		<div>
		<a type="im" style="position:fixed" href="#"> <img src="../immagini/su.png"/> </a>
		</div>
    </body>

</html>


