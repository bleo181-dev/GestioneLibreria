<?php
	$Data1=$_POST["data1"];
    $Data2=$_POST["data2"];
    $Gen=$_POST["gen"];

	include_once('connessione.php');

    $sqlM = "SELECT Libro.Codice_libro, Libro.Titolo, count(Prestito.Codice) AS Letto_Da
            FROM Utente, Prestito, Libro  
            WHERE Utente.Matricola = Prestito.Matricola AND
            Libro.Codice_libro = Prestito.Codice_libro AND
            Utente.Sesso = 'M' AND 
            Utente.Data_nascita BETWEEN '".$Data1."' AND '".$Data2."'
            GROUP BY Libro.Codice_libro
            HAVING count(Prestito.Codice) =(
            SELECT MAX(Migliore)
            FROM ( 
                SELECT Libro.Codice_libro, count(Prestito.Codice) AS Migliore
                FROM Utente, Prestito, Libro 
                WHERE Utente.Matricola = Prestito.Matricola AND
                Libro.Codice_libro = Prestito.Codice_libro AND
                Utente.Sesso = 'M' AND 
                Utente.Data_nascita BETWEEN '".$Data1."' AND '".$Data2."'
                GROUP BY Libro.Codice_libro
                ) as MAX )
        ";

    $sqlF = "SELECT Libro.Codice_libro, Libro.Titolo, count(Prestito.Codice) AS Letto_Da
                FROM Utente, Prestito, Libro  
                WHERE Utente.Matricola = Prestito.Matricola AND
                Libro.Codice_libro = Prestito.Codice_libro AND
                Utente.Sesso = 'F' AND 
                Utente.Data_nascita BETWEEN '".$Data1."' AND '".$Data2."'
                GROUP BY Libro.Codice_libro
                HAVING count(Prestito.Codice) =(
                SELECT MAX(Migliore)
                FROM ( 
                    SELECT Libro.Codice_libro, count(Prestito.Codice) AS Migliore
                    FROM Utente, Prestito, Libro 
                    WHERE Utente.Matricola = Prestito.Matricola AND
                    Libro.Codice_libro = Prestito.Codice_libro AND
                    Utente.Sesso = 'F' AND 
                    Utente.Data_nascita BETWEEN '".$Data1."' AND '".$Data2."'
                    GROUP BY Libro.Codice_libro
                    ) as MAX )
            ";


    $result = mysqli_query($link, $sqlM);

        while ($row = mysqli_fetch_array($result)) {
                $HtmlM =  $HtmlM."<tr style='color: #0066ff'><td><b>$row[1]</b></td> <td ><b>$row[2]</b></td></tr>";
            }

    $result = mysqli_query($link, $sqlF);

        while ($row = mysqli_fetch_array($result)) {
                $HtmlF =  $HtmlF."<tr  style='color: pink'><td><b>$row[1]</b></td> <td ><b>$row[2]</b></td></tr>";
            }
    

    mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Storico prestiti</title>

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
		<a href="../QueryExtra1.html"><img src="../immagini/back.png"/></a><hr style="width: 30px;">
		
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
		<a style="color: rgb(219, 80, 15);" type="menu" href="../QueryExtra1.html">QE1</a> <br><br>
		<a type="menu" href="../QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		</div>

        <fieldset>
        
			<h1 style="text-align:center"> Libri più letti da maschi e femmine da: <?php echo $Gen ?> </h1>
        </fieldset>


        <h2 style="color: #0066ff"> Maschi </h2>
        <div class="TabM">    
            <table style="width:100%; color: blue;">
            <tr >
            <th>Titolo libro</th>
            <th>Letto da quanti maschi</th>
            </tr>
            <?php echo $HtmlM?>
            </table>
        </div>
        
            <br>
          
        <h2 style="color: pink"> Femmine </h2>
        <div class="TabF">    
            <table style="width:100%; color: #ff0066; ">
            <tr>
            <th>Titolo libro</th>
            <th>Letto da quante femmine</th>
            </tr>
            <?php echo $HtmlF?>
            </table>
        </div>
    </body>

</html>
