

<?php
	// Connessione
	$link = mysqli_connect("127.0.0.1", "lorenzo", "lorenzo34", "Libreria");

	// Controllo se è avvenuta la connessione al database:
	if (!$link) { // if ($link == NULL)
		echo "Assicurati di aver utilizzato dei dati d'accesso corretti"."<br/>". "per modificare user e password modifica il file: /PHP-HTML/php/connessione.php"."<br/><br/>";
		echo "Si è verificato un errore: Non riesco a collegarmi al database <br/>";
		echo "Codice errore: " . mysqli_connect_errno() . "<br/>";
		echo "Messaggio errore: " . mysqli_connect_error() . "<br/>";
		
		exit;
	}
    ?>
