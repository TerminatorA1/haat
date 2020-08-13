<?php include('server.php') ?>
<?php
  if (isset($_GET['logout'])) {
      $_SESSION = array();
  	  session_destroy();
      header("location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hääsivusto</title>

    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light scrolling-navbar fixed-top">
        <div class="navbar-header d-flex col-1 justify-content-start">
            <a class="navbar-brand" href="index.php"><b>Hääsivusto</b></a>
            <a class="navbar-brand" href="paikka.php"><b>Hääpaikat</b></a>
            <a class="navbar-brand" href="show.php"><b>Esiintyjät</b></a>
            <a class="navbar-brand" href="tarjoilu.php"><b>Tarjoilut</b></a>
            <a class="navbar-brand" href="yhteystiedot.php"><b>Yhteystiedot</b></a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler mr-auto">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php  if (isset($_SESSION['email'])) : ?>
                  <li class="nav-item"><a class="nav-item nav-link" href="lomake.php">Tarjouspyyntölomake</a></li>
                  <li class="nav-item"><a class="nav-item nav-link" href="omatt.php">Oma tilaus</a></li>
                  <li class="nav-item"><a class="nav-item nav-link" href="user.php">Omat Tiedot</a></li>
                <?php endif ?>

            </ul>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <?php  if (isset($_SESSION['email'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="index.php?logout='1'" style="color:rgb(52, 235, 113)">Kirjaudu Ulos</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="login.php">Kirjaudu Sisään</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="register.php" style="color:rgb(52, 235, 113)"><b>Luo Käyttäjä!</b></a></li>
                <?php endif ?>

            </ul>
        </div>
    </nav>
    <div class="login-container pt-5">
        <h1 style="font-size:48px" class="text-center pb-5">Esiintyjät</h1>
        <div>
            <div class="row">
                    <p class="sideText">
                        <br>
                        <img src="./images/show.jpg" alt="hawaii" width="800" height="400">
                        <br>
                        <br>
                        Meiltä saat varattua esiintyjät ja musiikin häihisi.
                        <br>
                        1. DJ (sisältää äänentoistolaitteet), 6 tuntia, 500,-
                        <br>
                        2. DJ ja karaoke, 6 tuntia, 700,-
                        <br>
                        3. Houseband Humppa, 4 tuntia, 1000,-
                        <br>
                        4. Houseband Rock, 4 tuntia, 1200,-
                        <br>
                        5. Elastinen ja bändi, 3 tuntia, 5000,-
                        <br>
                        6. Joku muu, sopimuksen mukaan.
                        <br>
                        Jotta pystyt näkemään hinnat ja vaihtoehdot, sinun pitää ensin kirjautua sisään.
                        <br>

                        <?php if(isset($_SESSION['email'])) : ?>
                            Alla oleva painikkeen kautta pääset tilaukseen ja tarjouspyyntölomakkeeseen!
                        <?php else: ?>
                            Paina alla olevaa painiketta jotta voit luoda itsellesi käyttäjätilin.
                            Jos sinulla on jo käyttäjätili, paina Kirjaudu Sisään painiketta ruudun yläreunasta.
                        <?php endif ?>
                    </p>
            </div>
        </div>
        <div class="text-center mt-5">
            <?php if(isset($_SESSION['email'])) : ?>
                <form action="lomake.php">
                    <button href="lomake.php" type="submit" class="btn btn-primary btn-lg aloitaButton" style="border-radius:30px; font-size:30px;">Aloita tarjouspyynnön/tilauksen tekeminen</button>
                </form>
            <?php else: ?>
                <form action="register.php">
                    <button href="register.php" type="submit" class="btn btn-primary btn-lg aloitaButton" style="border-radius:30px; font-size:30px;">Uudet asiakkaat tätä kautta</button>
                </form>
            <?php endif ?>
        </div>
        <p class="mt-5" style="color:white">Made by: Atte V.</p>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="index.js"></script>

</body>

</html>
