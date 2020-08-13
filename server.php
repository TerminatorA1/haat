<?php
session_start();


$username = "";
$errors = array();

// Yhdistetään tietokantaan
$db = mysqli_connect('localhost', 'id13429911_haatuser', 'KeudaKeskus1!', 'id13429911_haat');

// Rekisteröinti systeemi
if (isset($_POST['reg_user'])) {
  // Otetaan kaikki muuttujat formista
  $etunimi = mysqli_real_escape_string($db, $_POST['etunimi']);
  $sukunimi = mysqli_real_escape_string($db, $_POST['sukunimi']);
  $lahiosoite = mysqli_real_escape_string($db, $_POST['lahiosoite']);
  $postinro = mysqli_real_escape_string($db, $_POST['postinro']);
  $postitoimipaikka = mysqli_real_escape_string($db, $_POST['postitoimipaikka']);
  $puhelin = mysqli_real_escape_string($db, $_POST['puhelin']);

  // Käytetään kirjautumiseen
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // Katotaan että kaikissa on teksti
  if (empty($etunimi)) { array_push($errors, "Etunimi on pakollinen!"); }
  if (empty($password_1)) { array_push($errors, "Salasana on pakollinen!"); }
  if (strlen($password_1) < 4) { array_push($errors, "Salasanan pitää olla vähintään 4 merkkiä!");}
  if ($password_1 != $password_2) {
	array_push($errors, "Salasanat eivät ole samat!");
  }

  if(empty($sukunimi)) { array_push($errors, "Sukunimi on pakollinen!"); }
  if(empty($lahiosoite)) { array_push($errors, "Osoite on pakollinen!"); }
  if(empty($postinro)) { array_push($errors, "Postinumero on pakollinen!"); }
  if(empty($postitoimipaikka)) { array_push($errors, "Postitoimipaikka on pakollinen!"); }
  if(empty($puhelin)) { array_push($errors, "Puhelinnumero on pakollinen!"); }
  if(empty($email)) { array_push($errors, "Sähköposti on pakollinen!"); }

  // Tarkistetaan että onko tietokannassa samalla sähköpostilla oleva käyttäjä
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  // Jos käyttäjä löytyy
  if ($user) {
     array_push($errors, "Sähköposti on käytössä toisella käyttäjätilillä!");

 }

  // Jos ei ole mitään virheitä, rekisteröidään käyttäjä
  if (count($errors) == 0) {
  	$password = ($password_1); // Encryptataan salasana, jotta ei tallenneta salasanaa suoraan

  	$query = "INSERT INTO users(userId, etunimi, sukunimi, lahiosoite, postinro, postitoimipaikka, puhelin, email, pasword)
    VALUES('0', '$etunimi', '$sukunimi', '$lahiosoite', '$postinro', '$postitoimipaikka', '$puhelin', '$email', '$password');";
  	mysqli_query($db, $query);
    $_SESSION['etunimi'] = $etunimi;
    $_SESSION['sukunimi'] = $sukunimi;
    $_SESSION['lahiosoite'] = $lahiosoite;
    $_SESSION['postinro'] = $postinro;
    $_SESSION['postitoimipaikka'] = $postitoimipaikka;
    $_SESSION['puhelin'] = $puhelin;
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Kirjauduttu sisään!";
  	header('location: index.php');
  }
}

// Lomakkeen lähetys
if (isset($_POST['lomake'])) {
  // Otetaan kaikki muuttujat formista
  $haapaikka = mysqli_real_escape_string($db, $_POST['haapaikka']);
  $tarjoilu = mysqli_real_escape_string($db, $_POST['tarjoilu']);
  $esitys = mysqli_real_escape_string($db, $_POST['esitys']);
  $aikuinen = mysqli_real_escape_string($db, $_POST['aikuinen']);
  $lapsi = mysqli_real_escape_string($db, $_POST['lapsi']);
  $lisatieto = mysqli_real_escape_string($db, $_POST['lisatieto']);

  // Käytetään kirjautumiseen
  $email = mysqli_real_escape_string($db, $_POST['email']);




  	$query = "INSERT INTO users(haapaikka, tarjoilu, esitys, aikuinen, lapsi, lisatieto, email)
    VALUES('$haapaikka', '$tarjoilu', '$esitys', '$aikuinen', '$lapsi', '$lisatieto', '$email');";
  	mysqli_query($db, $query);
    $_SESSION['haapaikka'] = $haapaikka;
    $_SESSION['tarjoilu'] = $tarjoilu;
    $_SESSION['esitys'] = $esitys;
    $_SESSION['aikuinen'] = $aikuinen;
    $_SESSION['lapsi'] = $lapsi;
    $_SESSION['lisatieto'] = $lisatieto;
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Kirjauduttu sisään!";
  	header('location: index.php');
  }


// Kirjautumis systeemi
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Sähköpostiosoite on pakollinen!");
  }
  if (empty($password)) {
  	array_push($errors, "Salasana on pakollinen!");
  }

  if (count($errors) == 0) {
  	$password = ($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
		$set = mysqli_fetch_array($results);
		$_SESSION['userinfo'] = $set;
		$_SESSION['userid'] = $set['userId'];
		$_SESSION['etunimi'] = $set['etunimi'];
		$_SESSION['sukunimi'] = $set['sukunimi'];
		$_SESSION['lahiosoite'] = $set['lahiosoite'];
		$_SESSION['postinro'] = $set['postinro'];
		$_SESSION['postitoimipaikka'] = $set['postitoimipaikka'];
		$_SESSION['puhelin'] = $set['puhelin'];
  	    	$_SESSION['email'] = $email;
  	    	$_SESSION['success'] = "Kirjauduttu sisään!";
		header('location: index.php');
  	}else {
  		array_push($errors, "Käyttäjätunnus tai salasana on väärä!");
  	}
  }
}

// Päivitetään käyttäjän tiedot
if (isset($_POST['update_info'])) {
    if(isset($_SESSION['email'])) {

        $etunimi = mysqli_real_escape_string($db, $_POST['etunimi']);
        $sukunimi = mysqli_real_escape_string($db, $_POST['sukunimi']);
        $lahiosoite = mysqli_real_escape_string($db, $_POST['lahiosoite']);
        $postinro = mysqli_real_escape_string($db, $_POST['postinro']);
        $postitoimipaikka = mysqli_real_escape_string($db, $_POST['postitoimipaikka']);
        $puhelin = mysqli_real_escape_string($db, $_POST['puhelin']);
        $email = mysqli_real_escape_string($db, $_POST['email']);



        // Jos käyttäjä löytyy
        if(!$email == $_SESSION['email']){
            // Tarkistetaan että onko tietokannassa samalla sähköpostilla oleva käyttäjä
            $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) {
               array_push($errors, "Sähköposti on käytössä toisella käyttäjätilillä!");
            }
        }


        if (count($errors) == 0) {
            $query = "UPDATE users SET etunimi = '$etunimi', sukunimi = '$sukunimi', lahiosoite = '$lahiosoite', postinro = '$postinro', postitoimipaikka = '$postitoimipaikka', puhelin = '$puhelin', email = '$email' WHERE userId = '".$_SESSION['userId']."' ";
            $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
            $_SESSION['etunimi'] = $etunimi;
            $_SESSION['sukunimi'] = $sukunimi;
            $_SESSION['lahiosoite'] = $lahiosoite;
            $_SESSION['postinro'] = $postinro;
            $_SESSION['postitoimipaikka'] = $postitoimipaikka;
            $_SESSION['puhelin'] = $puhelin;
      	    $_SESSION['email'] = $email;
            header('location: index.php');

        }

    }
}


?>
