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
				max-width: 80%;
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
		<a href="../Q8_2.php"><img src="../immagini/back.png"/></a><hr style="width: 30px;">
		
		<br>
		
		<a type="menu" href="../Q1.html">Q1</a><br><br>
		<a type="menu" href="../Q2.php">Q2</a> <br><br>
		<a type="menu" href="../Q3.html">Q3</a> <br><br>
		<a type="menu" href="../Q4.php">Q4</a> <br><br>
		<a type="menu" href="../Q5.php">Q5</a> <br><br>
		<a type="menu" href="../Q6.php">Q6</a> <br><br>
		<a type="menu" href="../Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="../Q8_1.html">Q8.1</a> <br><br>
		<a style="color: rgb(219, 80, 15);" type="menu" href="../Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="../Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="../QueryExtra1.html">QE1</a> <br><br>
		<a type="menu" href="../QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		</div>

        <fieldset>
            
			<h1 style="text-align:center">Numero di prestiti effettuati nel dipartimento:</h1>
            <h2 style="margin-left:48%; color:red"> <?php echo $Html?> </h2>
        </fieldset>
			
		  


    </body>

</html>


