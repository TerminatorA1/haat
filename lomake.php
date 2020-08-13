<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tilauslomake</title>

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
                <?php  if (isset($_SESSION['username'])) : ?>
                  <li class="nav-item"><a class="nav-item nav-link" href="lomake.php">Tarjouspyyntölomake</a></li>
                  <li class="nav-item"><a class="nav-item nav-link" href="omatt.php">Oma tilaus</a></li>
                  <li class="nav-item"><a class="nav-item nav-link" href="user.php">Omat tiedot</a></li>
                <?php endif ?>

            </ul>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <?php  if (isset($_SESSION['username'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" id="welcomeUser">Tervetuloa <?php echo $_SESSION["username"] ?>!</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="index?logout='1'" style="color:rgb(52, 235, 113)">Kirjaudu Ulos</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="login">Kirjaudu Sisään</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="register" style="color:rgb(52, 235, 113)"><b>Luo Käyttäjä!</b></a></li>
                <?php endif ?>

            </ul>
        </div>
    </nav>



    <div class="login-form-1">
        <div class="">
            <h3>Tee tarjouspyyntö/tilaus</h3>
            <form action="lomake.php" method="post">
                <div class="container">
                    <p style="font-size:18px"><b>Tilaukseen tai tarjouspyyntöön tarvittavat tiedot</b></p>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-12">
                            <label for="">Hääpaikka</label>
                            <input type="text" class="form-control" placeholder="Hääpaikka" name="haapaikka" value="" />
                        </div>
                        <div class="col-md-12">
                            <label for="">Esiintyjät</label>
                            <input type="text" class="form-control" placeholder="Esiintyjät" name="esitys" value="" />
                        </div>
                        <div class="col-md-12">
                            <label for="">Tarjoilut</label>
                            <input type="text" class="form-control" placeholder="Tarjoilut" name="tarjoilu" value="" />
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-12">
                          <label for="">Henkilömäärä, aikuisia, lapsia</label>
                            <input type="text" class="form-control" placeholder="Aikuisia" name="aikuinen" value="" />
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Lapsia (0-17v)" name="lapsi" value="" />
                        </div>
                        <div class="col-md-12">
                            <label for="">Lisätietoja</label>
                            <input type="text" class="form-control" placeholder="Lisätiedot" name="lisatieto" value="" />
                        </div>
                            <div class="col-md-12">
                                <label for="">Sähköpostisoitteesi</label>
                                <input type="text" class="form-control" placeholder="Sähköpostiosoite" name="email" value="" />
                            </div>

                    </div>

                    
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btnSubmit btn-block" name="lomake" value="Lähetä tarjouspyyntölomake/tilaus" />
                        </div>
                    </div>
                    <?php include('errors.php'); ?>
                    </table>

                </div>
            </form>
        </div>
    </div>




</html>
