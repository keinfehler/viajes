 <header>
      <img style="padding: 50px;" src="imagenes\siguenos.jpg." alt="siguenos" width="170" height="50" align="right"/>
        <img style="padding: 50px;" src="imagenes\avion.jpg" alt="avion" width="100" height="80" align="left"/>
                <h1 style="padding: 60px; font-size:30px; font-style:normal; text-align: left; color: #3633FF ;">Tours Viajes Colombia</h1>
        <?php

session_start();

if (isset($_SESSION["user"])) {
    echo "<h1>Bienvenido:";
    echo $_SESSION["nombre"] ;
    //echo $_SESSION["idcliente"] ;
    echo " - <a href='logout.php'>Cerrar sesion</a></h1>";
    

}




?>
 </header>
  <nav id="menu">
    <ul>
    <li><a href="index.php">Inicio</a></li>
    
    <li><a href="Viajes.php">Viajes</a>
    
    <ul>
    <li><a href="Ciudad.php">Ciudad</a></li>
    <li><a href="Playa.php">Playa</a></li>
    <li><a href="Ejecafetero.php">Eje Cafetero</a></li>
    </ul>
    </li>
    <li><a href="Hoteles.php">Hoteles</a></li>
    <?php
    if (isset($_SESSION["user"])) {

        echo "<li><a href='paquetes.php'>Paquetes de viaje</a></li>";
        echo "<li><a href='reserva.php'>Reservar</a></li>";
        echo "<li><a href='userprofile.php'>Mi perfil</a></li>";

        if (isset($_SESSION["idcargo"])) {
          if($_SESSION["idcargo"] == 1)
          {
            echo "<li><a href='administration.php'>Administración</a></li>";
          }
        }
    }
    ?>
    <?php
    if (!isset($_SESSION["user"])) {
        echo "<li><a href='login.php'>Login</a></li>";
        
        }
       
    ?>
    
    </ul>
  </nav>

 