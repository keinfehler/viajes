
<body>
<?php
include('partial/header.php');
if (isset($_POST["submit"])) {
    // Collect updated data from the form
    $updated_name = $_POST['Nombre'];
    $updated_apellido = $_POST['Apellido'];
    $updated_email = $_POST['Email'];
    $updated_password = $_POST['Password'];
    $updated_id = $_POST['id'];
    
    // Update user data in the database
    require_once "database.php";
    $update_query = "UPDATE clientes SET Nombre='$updated_name', Apellido='$updated_apellido', Email='$updated_email', Contrasena='$updated_password' WHERE ID_Cliente = $updated_id";
    mysqli_query($conn, $update_query);

    // Redirect to profile page or display success message
    //header("Location: profile.php?user_id=$user_id");
    //echo "<div class='alert alert-success'>Cambios exitosos</div>";
  
    header("Location: userprofile.php");
    $_SESSION["nombre"] = $updated_name;
    $_SESSION["idcliente"] = $updated_id;
    session_start();
    //session_destroy();
}


$userName = "";
$userApellido = ""; 
$email = "";
$password ="";

if (isset($_SESSION["user"])) {

    $user_id = $_SESSION["idcliente"]; // current user
    require_once "database.php";
    $query = "SELECT * FROM clientes WHERE ID_Cliente = $user_id";
    $result = mysqli_query($conn, $query);

    $usuario = array();


    while ($row = mysqli_fetch_object($result)){
        
        $userName = $row->Nombre;
        $userApellido = $row->Apellido;
        $email = $row->Email;
        $password = $row->Contrasena;
    
    }

}
?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Editar perfil</h1>
          
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        
        <div class="container col-xxl-8 px-4 py-5">
  <div class="formulario">
   <form class="formulario" action="userprofile.php" method="post">
        <div class="form-floating">
            <input class="form-control" type="text" name="Nombre" value="<?php echo $userName; ?>" placeholder="Nombre:">
        </div>
          <div class="form-floating">
            <input class="form-control" type="text" name="Apellido" value="<?php echo $userApellido; ?>" placeholder="Apellido:"> <!-- Nuevo campo para el apellido -->
        </div>

        <div class="form-floating">
            <input class="form-control" type="email" name="Email" placeholder="Email:" value="<?php echo $email; ?>">
        </div>
        <div class="form-floating">
            <input class="form-control" type="password" name="Password" placeholder="Contraseña:" value="<?php echo $password; ?>">
        </div>

        <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
       
        <div class="form-floating">
            <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Guardar cambios</button>
        </div>

    </form>
  </div>
     </div>
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
