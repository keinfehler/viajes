
<body>
<?php
include('partial/header.php');


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
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Registrate para realizar una reserva</h1>
          	      
      <div class="formulario">
            

            <form action="Registrate.php" method="post">
              <div class="inpute">
                  <input class="form-control"  type="text" name="Nombre" placeholder="Nombre:">
              </div>
              <div class="inpute">
                  <input class="form-control"  type="email" name="Email" placeholder="Email:">
              </div>
              <div class="inpute">
                  <input class="form-control"  type="password" name="Contraseña" placeholder="Contraseña:">
              </div>
              <div class="inpute">
                  <input class="form-control"  type="password" name="Repita Contraseña" placeholder="Repita Contraseña:">
              </div>
              <div class="inputi">
                  
                  <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Registrate</button>
              </div>
          </form>
      </div>

        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
       
        
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
