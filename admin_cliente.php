
<body>
<?php
include('partial/header.php');
$user_id = $_GET['id_usuario']; 
$action = $_GET['action'];

if($action == "eliminar")
{
    
    $delete_query = "DELETE FROM clientes WHERE ID_Cliente = $user_id";
    mysqli_query($conn, $delete_query);


  
    header("Location: admin_clientes.php");
}


if (isset($_POST["submit"])) {
    // Collect updated data from the form
    $updated_name = $_POST['Nombre'];
    $updated_apellido = $_POST['Apellido'];
    $updated_email = $_POST['Email'];
    $updated_password = $_POST['Password'];
    $updated_id = $_POST['id'];
    $updated_cargo = $_POST['adminCheckbox'];
    
    $update_query = "UPDATE clientes SET Nombre='$updated_name', Email='$updated_email', Contrasena='$updated_password', ID_cargo='$updated_cargo'  WHERE ID_Cliente = $updated_id";
    mysqli_query($conn, $update_query);

  
    header("Location: admin_clientes.php");
    
}

$userName = "";
$userApellido = "";
$email = "";
$password ="";
$cargo ="";
$ckeckedAdmin = "";

if (isset($_SESSION["user"])) {
    $query = "SELECT * FROM clientes WHERE ID_Cliente = $user_id";
    $result = mysqli_query($conn, $query);

    $usuario = array();


    while ($row = mysqli_fetch_object($result)){
        
        $userName = $row->Nombre;
        $userApellido = $row->Apellido;
        $email = $row->Email;
        $password = $row->Contrasena;
        $cargo = $row->ID_cargo;
    }

}
?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Cliente: <?php echo $user_id ?>  </h1>
  
        </div>
      </div>

      <div class="container">
      <div class="container col-xxl-8 px-4 py-5">
    <h2 class="title"></h2>


    <form class="form_container" action="admin_cliente.php" method="post">
        <div class="form-floating">
            <input  class="form-control" type="text" name="Nombre" value="<?php echo $userName; ?>" placeholder="Nombre:">
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

        <div class="form-floating">
        <input  type="checkbox" id="adminCheckbox" name="adminCheckbox" value="1" <?php if ($cargo == 1) { echo "checked='checked'"; } ?> >
        <label for="adminCheckbox"> Administrador</label><br>

        </div>
        <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
       
        <div class="inputi">
            
                     
            <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Guardar cambios</button>
        </div>

    </form>
</div>
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
