<?php 

include_once('php/connessione.php');

$Data1=$_POST["data1"];
$Data2=$_POST["data2"];
$giorni=$_POST["giorni"];
if(empty($giorni)){
	$giorni=30;
}
if($giorni<7){
	$giorni=7;
}
if($giorni>90){
	$giorni=90;
}

if(empty($Data1) && empty($Data2)){
  //seconda query
  $sql = "SELECT Utente.Matricola, Utente.Nome, Utente.Cognome, Utente.Numero_telefono, Utente.Via, Utente.Numero_civico, Utente.Codice_postale, Utente.Città, Libro.Titolo, Libro.ISBN, Prestito.Data_uscita, Prestito.Restituito, Dipartimento.Nome, Dipartimento.Via, Dipartimento.Numero_civico, Dipartimento.Codice_postale, Dipartimento.Città
FROM Utente, Prestito, Libro, Dipartimento
WHERE Utente.Matricola = Prestito.Matricola AND
Libro.Codice_libro = Prestito.Codice_libro AND
Libro.Codice_dipartimento = Dipartimento.Codice_dipartimento AND Prestito.Restituito = 0
AND Prestito.Data_uscita > date_sub(current_date(), INTERVAL '$giorni' DAY)
ORDER BY Prestito.Data_uscita;";

	

}else{

if ( !empty($Data1) && empty($Data2) ){
	$Data2=date('Y-m-d');
	echo "La seconda data è stata inserita automaticamente in quanto il campo era vuoto :".$Data2;
}

	$primaData = strtotime($Data1);
	$secondaData = strtotime($Data2);

		if ($primaData > $secondaData){ 
			echo "Parametri sbagliati: la prima data inserita viene dopo la seconda!";
			exit();
		} 

	//query
$sql = "SELECT Utente.Matricola, Utente.Nome, Utente.Cognome, Utente.Numero_telefono, Utente.Via, Utente.Numero_civico, Utente.Codice_postale, Utente.Città, Libro.Titolo, Libro.ISBN, Prestito.Data_uscita, Prestito.Restituito, Dipartimento.Nome, Dipartimento.Via, Dipartimento.Numero_civico, Dipartimento.Codice_postale, Dipartimento.Città
FROM Utente, Prestito, Libro, Dipartimento
WHERE Utente.Matricola = Prestito.Matricola AND Libro.Codice_libro = Prestito.Codice_libro AND Libro.Codice_dipartimento = Dipartimento.Codice_dipartimento
AND Prestito.Data_uscita BETWEEN '$Data1' AND '$Data2'
ORDER BY Prestito.Data_uscita;
";

} //chiusura else

$result = mysqli_query($link, $sql);


//creo una tabella che dopo verrà visualizzata in html
while ($row = mysqli_fetch_array($result)) {

	$state="Non restituito";
	if($row[11]==1){
		$state="Restituito";
	}

	$date = strtotime("+$giorni day", strtotime("$row[10]")); //calcola la data di restituzione del libro
	$dataRientro = date("Y-m-d", $date);

	$Html =  $Html."<td>$row[10]</td><td>$dataRientro</td><td>$state</td>
	<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td>
	<td>$row[4], N.$row[5], $row[7], $row[6]</td>
	<td>$row[8]</td><td>$row[9]</td>
	<td>$row[12]</td><td>$row[13], N.$row[14], $row[16], $row[15]</td></tr>";
}
	
	
mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">

		<title>Ricerca prestiti per data</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

		<style>
			body {
				max-width: 1500px;
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

			table, td, th {
				text-align:center;
				width: 100%;
				vertical-align: middle;
			}
		</style>
    </head>

    <body>
		<form action="Q7.php" method="POST">
			<fieldset>
			<h1 style="text-align:center">Prestiti effettuati in un range di date</h1>
        	<p style="text-align:center"> 
				Ricerca dei prestiti per data, se viene inserito solo il 'primo campo data' il 'secondo' viene generato automaticamente insarendo la data odierna. Se non vengono specificate le date fa si che vengano stampati tutti i prestiti. 
			</p>
                <div class="date" aling="center">
					<input style="width:98.3%; text-align:center;" type="number" name="giorni" min= "7" max= "90" placeholder="Il libro deve essere restituito in: 'NumGiorni'">
					<p style="text-align:center">Se il campo viene omesso il numero di giorni di default sarà 30g </p>
                    <input  style="text-align:center" type="date" name="data1" placeholder="Prima data">
                    <input  style="text-align:center" type="date" name="data2" placeholder="Seconda data">
                    <input style="width: 99.4%; " type="submit" value="Invia" />
                </div>
            </fieldset>
		</form>

		<table style="width:100%">
		<tr>
		<th>Data uscita</th>
		<th>Data scadenza prestito</th>
		<th>Stato</th>
    	<th>Matricola</th>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Numero di telefono</th>
		<th>Indirizzo</th>
    	<th>Titolo</th>
    	<th>ISBN</th>
		<th>Nome dipartimento</th>
		<th>Indirizzo</th>
  		</tr>
		  <?php echo $Html?>

		</table>

    </body>

</html>
