<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>

	<?php require 'Partial/header.php' ?>

		      
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["Nombre"];
           $email = $_POST["Email"];
           $password = $_POST["Contraseña"];
           $passwordRepeat = $_POST["Repita_Contraseña"];
           
           $passwordHash = $password;//password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"se requieren todos los campos");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email no valido");
           }
           if (strlen($password)<1) {
            array_push($errors,"La contraseña debe ser al menos de 8 caracteres");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Contraseña no coincide");
           }
           require_once "database.php";
           $sql = "SELECT * FROM clientes WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email ya existe!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO clientes (Nombre, Email, Contrasena) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Registro exitoso.</div>";
                header("Location: login.php");
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        
      <div class="formulario">
            <h2>Registrate para realizar una reserva</h2>

            <form action="Registrate.php" method="post">
              <div class="inpute">
                  <input type="text" name="Nombre" placeholder="Nombre:">
              </div>
              <div class="inpute">
                  <input type="email" name="Email" placeholder="Email:">
              </div>
              <div class="inpute">
                  <input type="password" name="Contraseña" placeholder="Contraseña:">
              </div>
              <div class="inpute">
                  <input type="password" name="Repita Contraseña" placeholder="Repita Contraseña:">
              </div>
              <div class="inputi">
                  <input type="submit" value="Registrate" name="submit">
              </div>
          </form>


        
      

</body>

</html>



