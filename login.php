<?php

if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css\estilos.css"></link>

    
</head>


<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      text-align: center;
    }

    input[type="search"] {
      width: 70%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-right: 10px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .centered-table {
  margin: 20px auto;
  text-align: center;
}

.centered-table table {
  width: 80%;
  margin: 0 auto;
}

.centered-table th, .centered-table td {
  padding: 10px;
}

.centered-table th {
  background-color: #007bff;
  color: #fff;
}

.centered-table tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

 .add-reservation-form {
      margin-top: 50px;
    }
    .add-reservation-form label {
      color: blue;
      font-size: 18px;
      font-weight: bold;
    }
    .add-reservation-form input[type="date"],
    .add-reservation-form select {
      width: 50%;
      font-size: 16.5px;
      padding: 1.5px;
      box-sizing: border-box;
      font-weight: bold;
    }

  </style>

<body>
  

</html>
    
    <?php require 'Partial/header.php' ?>

     

    <div class="login-container">
        <?php
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


    <div class="formulario">
         <h2>Bienvenido de nuevo</h2>
                <h3>Inicia sesión con tu cuenta para reservar un paquete de viaje</h3>
                  
            <form action="login.php" method="post">
       
        <div class="inpute">
            <input type="email" placeholder="Email:" name="email">
        </div>
        <div class="inpute">
            <input type="password" placeholder="Contraseña:" name="password">
        </div>
        <div class="inputi">
            <input type="submit" value="Login" name="login">
        </div>
      </form>
     <div class="recordar"><p>No tienes cuenta?<div class="registrarse"> <a href="Registrate.php">Registrate aqui</a></p></div></p></div>
    </div>

</body>
<br>
<br>





</html>


