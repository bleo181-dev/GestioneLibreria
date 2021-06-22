<?php 

include_once('php/connessione.php');
$index=$_GET["index"];
$TuplePerPagina=50;//numero di tuple per pagina


if(empty($index)){
	$index=0;
}


$IndexToGo=$index*$TuplePerPagina;
	
	//query
    $sql = "SELECT *
	FROM Libreria.Utente";

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
		$htmlPage=$htmlPage."<a type='page' href='Q4.php?index=$i'>$p</a>";
	}
    

	//creo una tabella che dopo verrà visualizzata in html
    while ($row = mysqli_fetch_array($result)) {
		$countG++;

		if($countG > $IndexToGo){
			$countS ++;
			if($countS<=$TuplePerPagina){//stampo tot tuple per pagina
		$Html =  $Html."<tr><td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td><td>$row[3]</td><td>$row[4], N.$row[5], $row[7], $row[6]</td><td>$row[8]</td><td>$row[9]</td></tr>";
			}
		}
	}
	    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
		        
		<title>Elenco utenti</title>
		
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
			a[type="im"] {

				right: 0%;
				height: 100%;

				top:80%;
				width: 60px;

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
		<a style="color: rgb(219, 80, 15);" type="menu" href="Q4.php">Q4</a> <br><br>
		<a type="menu" href="Q5.php">Q5</a> <br><br>
		<a type="menu" href="Q6.php">Q6</a> <br><br>
		<a type="menu" href="Q7.php">Q7</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="Q8_1.html">Q8.1</a> <br><br>
		<a type="menu" href="Q8_2.php">Q8.2</a> <br><br>
		<a type="menu" href="Q8_3.php">Q8.3</a> <br><br><hr style="width: 30px;"><br>
		<a type="menu" href="QueryExtra1.html">QE1</a> <br><br>
		<a type="menu" href="QueryExtra2.php">QE2</a> <br><br><hr style="width: 30px;">
		<a><img src="immagini/logo_miniPNG.png"/></a>
		</div>
		
        <fieldset>
		
			<h1 style="text-align:center">Elenco degli utenti della biblioteca</h1>
			<h4 style="text-align:center">Pagina <?php echo $index+1; ?> di <?php echo $Npage; ?></h4>
            </fieldset>
		
		<h3>Totale utenti trovati: <?php echo $TotTupleT; ?></h3>
		<table style="width:100%;">
  		<tr>
    	<th>Matricola</th>
    	<th>Nome</th>
    	<th>Cognome</th>
		<th>Numero di telefono</th>
		<th>Indirizzo</th>
		<th>Sesso</th>
		<th>Data di nascita</th>
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


