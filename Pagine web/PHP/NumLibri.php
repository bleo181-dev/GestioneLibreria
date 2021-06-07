<?php
	$Anno=$_POST["anno"];

	include_once('connessione.php');

    $sql = "SELECT COUNT(Libro.Codice_libro)
            FROM Libro
            WHERE Libro.Anno_pubblicazione = '$Anno';
	          ";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
		    $Html =  $Html."$row[0]";
    }

    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Numero libri anno</title>

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
			<h1 style="text-align:center"> Numero di libri pubblicati nel <?php echo $Anno ?></h1>
        <h2 style="margin-left: 48%; color:red"><?php echo $Html?></h2>
        </fieldset>

		</table>

    </body>

</html>
