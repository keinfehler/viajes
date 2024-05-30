
<body>
<?php
include('partial/header.php');

if (isset($_POST["login"])) {


   $email = $_POST["email"];
   $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM clientes WHERE Email = '$email'";

    

    $result = mysqli_query($conn, $sql);

    
    while ($row = mysqli_fetch_object($result)){
        $pass = $row->Contrasena;
        $nombre = $row->Nombre;
        $id = $row->ID_Cliente;
        $cargo = $row->ID_cargo;
    }

    if (isset ($pass)){
        if ($password == $pass) {
            session_start();
            $_SESSION["user"] = "yes";
            $_SESSION["nombre"] = $nombre;
            $_SESSION["idcliente"] = $id;
            $_SESSION["idcargo"] = $cargo;
            
            header("Location: reserva.php");
            die();
        }else{
            echo "Contraseña Incorrecta";
        }
    }else{
        echo "Correo Incorrecto";
    }
}
?>

  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Iniciar sesión</h1>
          
          <div class="formulario">
         
        <form action="login.php" method="post">
       
            <div class="form-floating">
                <input class="form-control" type="email" placeholder="Email:" name="email">
            </div>
            <div class="form-floating">
                <input class="form-control" type="password" placeholder="Contraseña:" name="password">
            </div>
            <div class="form-floating">
                <button class="btn btn-primary w-100 py-2" type="submit" name="login">Login</button>
            </div>
        </form>
     <div class="recordar"><p>No tienes cuenta?<div class="registrarse"> <a href="Registrate.php">Registrate aqui</a></p></div></p></div>
    </div>
        </div>
      </div>

      <div class="container">
       
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
