<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <title>Viajescolombia</title>

    

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
  </head>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">🌴Viajescolombia</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Hoteles.php">Hoteles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Viajes.php">Aereolineas</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="Viajes.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Destinos</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="Ciudad.php">Ciudad</a>
              <a class="dropdown-item" href="Playa.php">Playa</a>
              <a class="dropdown-item" href="Ejecafetero.php">Eje Cafetero</a>
            </div>
          </li>

          <?php
          require_once "database.php";
          session_start();
          
          if (isset($_SESSION["user"])) {

            echo "<li class='nav-item'><a class='nav-link' href='paquetes.php'>Paquetes de viaje</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='reserva.php'>Reservar</a></li>";
            
          }

          ?>
        </ul>

        <div class="nav-item text-end">
        <?php
            
            if (isset($_SESSION["user"])) {

              if (isset($_SESSION["idcargo"])) {
                if($_SESSION["idcargo"] == 1)
                {
                  echo "<a type='button' class='btn btn-warning' href='administration.php'>Administración</a>&nbsp;&nbsp;";
                }
              }

              echo "<a type='button' class='btn btn-outline-light me-2' href='userprofile.php'>Mi perfil</a>&nbsp;&nbsp;";
                echo "<a href='logout.php' type='button' class='btn btn-outline-light me-2'>Cerrar sesion</a>";
                

                echo "<img src='./imagenes/user.png' width='32' height='32' class='rounded-circle'><a href='userprofile.php'>&nbsp; ";
                echo $_SESSION["nombre"] ;
                echo "</a>";
                
                
            }
            ?>
        </div>

        <div class="text-end">
          <?php
              if (!isset($_SESSION["user"])) {
                echo "<a type='button' class='btn btn-outline-light me-2' href='login.php'>Login</a>&nbsp;&nbsp;";
                echo "<a type='button' class='btn btn-warning' href='Registrate.php'>Registrate</a>";
                }

          ?>
      
        </div>

       
        
      </div>
    </nav>
</html>