<?php 

include_once('php/connessione.php');

$Data1=$_POST["data1"];
$Data2=$_POST["data2"];
$Data1G=$_GET["data1"];
$Data2G=$_GET["data2"];
$index=$_GET["index"];

if(!empty($Data1G)){
	$Data1=$Data1G;
}
if(!empty($Data2G)){
	$Data2=$Data2G;
}

$giorni=30;
$countTotPrestiti=0;
$flagResult=0;


	$TuplePerPagina=50; //numero di tuple per pagina


	if(empty($index)){
		$index=0;
	}


	$IndexToGo=$index*$TuplePerPagina;


if(empty($Data1) && empty($Data2)){
  //seconda query
  $sql = "SELECT Utente.Matricola, Utente.Nome, Utente.Cognome, Utente.Numero_telefono, Utente.Via, Utente.Numero_civico, Utente.Codice_postale, Utente.Città, Libro.Titolo, Libro.ISBN, Prestito.Data_uscita, Prestito.Restituito, Dipartimento.Nome, Dipartimento.Via, Dipartimento.Numero_civico, Dipartimento.Codice_postale, Dipartimento.Città
FROM Utente, Prestito, Libro, Dipartimento
WHERE Utente.Matricola = Prestito.Matricola AND
Libro.Codice_libro = Prestito.Codice_libro AND
Libro.Codice_dipartimento = Dipartimento.Codice_dipartimento AND Prestito.Restituito = 0
AND Prestito.Data_uscita > date_sub(current_date(), INTERVAL '$giorni' DAY)
ORDER BY Prestito.Data_uscita;";
$flagResult=0;

	

}else{

if ( !empty($Data1) && empty($Data2) ){
	$Data2=date('Y-m-d');
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
$flagResult=1;

} //chiusura else


//variabili per generare le pagine-------------------------
$result = mysqli_query($link, $sql);
$countP=0;
$Npage=0;
$TotTupleT=0;
//contiamo il numero di pagine da generare-----------------
while (mysqli_fetch_array($result)) {
	$countP ++;
	$TotTupleT++;
}
if(($countP % $TuplePerPagina) !=0){
	$Npage++;
}
$countP=(int)($countP/$TuplePerPagina);
$Npage+=$countP;

//----------------------------------------------------------

$result = mysqli_query($link, $sql);
$countS=0;
	$countG=0;

	$htmlPage="";

	for($i=0; $i<$Npage; $i++){
		$p=$i+1;

		$htmlPage=$htmlPage."<a type='page' href='Q7.php?index=$i&&data1=$Data1&&data2=$Data2'>$p</a>";

	}
	$htmlPage=$htmlPage."</table>";


//creo una tabella che dopo verrà visualizzata in html
while ($row = mysqli_fetch_array($result)) {
	$countTotPrestiti ++;
	$countG++;

		if($countG > $IndexToGo){
			$countS ++;
			if($countS<=$TuplePerPagina){//stampo tot tuple per pagina
	$state="Non restituito";
	if($row[11]==1){
		$state="Restituito";
	}

	$date = strtotime("+$giorni day", strtotime("$row[10]")); //calcola la data di restituzione del libro
	$dataRientro = date("Y-m-d", $date);
	

	$Html =  $Html."<tr><td>$row[10]</td><td>$dataRientro</td><td>$state</td>
	<td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td>
	<td>$row[4], N.$row[5], $row[7], $row[6]</td>
	<td>$row[8]</td><td>$row[9]</td>
	<td>$row[12]</td><td>$row[13], N.$row[14], $row[16], $row[15]</td></tr>";
		}
	}
}

if($flagResult==0){
	$ResultForHTML="Prestiti prossimi in scadenza: ".$countTotPrestiti;
}else{
	$ResultForHTML="Prestiti trovati da ".$Data1." a ".$Data2.": ".$countTotPrestiti;
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
				max-width: 85%;
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
			a[type="page"] {

				border: 1px #0096bfab solid;
				border: 3px var(--focus) solid;
				border-radius: 10px;
				padding: 5px;
				line-height: 3;

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
		<a href="index.html"><img src="immagini/home.png"/></a><hr style="width: 30px;">
		<br>
		<a type="menu" href="Q1.html">Q1</a><br><br>
		<a type="menu" href="Q2.php">Q2</a> <br><br>
		<a type="menu" href="Q3.html">Q3</a> <br><br>
		<a type="menu" href="Q4.php">Q4</a> <br><br>
		<a type="menu" href="Q5.php">Q5</a> <br><br>
		<a type="menu" href="Q6.php">Q6</a> <br><br>
		<a style="color: rgb(219, 80, 15);" type="menu" href="Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="Q8_1.html">Q8.1</a> <br><br>
		<a type="menu" href="Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="QueryExtra1.html">QE1</a> <br><br>
		<a type="menu" href="QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		<a><img src="immagini/logo_miniPNG.png"/></a>
		</div>

		<form action="Q7.php" method="POST">
			<fieldset>
			
			<h1 style="text-align:center">Prestiti effettuati in un range di date</h1>
        	<p style="text-align:center"> 
				Ricerca dei prestiti per data, se viene inserito solo il 'primo campo data' il 'secondo' viene generato automaticamente inserendo la data odierna. <br>
				 Se non vengono specificate le date sono stampati tutti i prestiti prossimi in scadenza. 
			</p>
                <div class="date" aling="center">
					<p style="text-align:center">La data di restituzione è fissata a 30 giorni dalla data di uscita</p>
                    <input  style="text-align:center" type="date" name="data1" placeholder="Prima data">
                    <input  style="text-align:center" type="date" name="data2" placeholder="Seconda data">
                    <input style="width: 99.4%; " type="submit" value="Invia" />
                </div>

		<br>
		<div>
		<h4 style="text-align:center">Pagina <?php echo $index+1; ?> di <?php echo $Npage; ?></h4>
		</div>
            </fieldset>
		</form>
			<h3><?php echo $ResultForHTML ?></h3>
		<hr>

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

		<div  style="text-align:center"> 
		<?php echo $htmlPage; ?>
		</div>
		<div>
		<a type="im" style="position:fixed" href="#"> <img src="immagini/su.png"/> </a>
		</div>

    </body>

</html>
