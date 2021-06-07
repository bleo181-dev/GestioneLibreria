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
                $HtmlM =  $HtmlM."<td>$row[1]</td> <td >$row[2]</td></tr>";
            }

    $result = mysqli_query($link, $sqlF);

        while ($row = mysqli_fetch_array($result)) {
                $HtmlF =  $HtmlF."<td>$row[1]</td> <td>$row[2]</td></tr>";
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
