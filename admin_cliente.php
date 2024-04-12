
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin cliente</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>


<?php 
require 'Partial/header.php';
require_once "database.php";

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
            $updated_email = $_POST['Email'];
            $updated_password = $_POST['Password'];
            $updated_id = $_POST['id'];
            $updated_cargo = $_POST['adminCheckbox'];
            
            $update_query = "UPDATE clientes SET Nombre='$updated_name', Email='$updated_email', Contrasena='$updated_password', ID_cargo='$updated_cargo'  WHERE ID_Cliente = $updated_id";
            mysqli_query($conn, $update_query);

          
            header("Location: admin_clientes.php");
            
        }

        $userName = "";
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
                $email = $row->Email;
                $password = $row->Contrasena;
                $cargo = $row->ID_cargo;
            }
        
        }
?>

<br>
	<br>
	<br>
    <h2 class="title">Cliente: <?php echo $user_id ?>  </h2>


    <form action="admin_cliente.php" method="post">
        <div class="inpute">
            <input type="text" name="Nombre" value="<?php echo $userName; ?>" placeholder="Nombre:">
        </div>
        <div class="inpute">
            <input type="email" name="Email" placeholder="Email:" value="<?php echo $email; ?>">
        </div>
        <div class="inpute">
            <input type="password" name="Password" placeholder="Contraseña:" value="<?php echo $password; ?>">
        </div>

        
        <input type="checkbox" id="adminCheckbox" name="adminCheckbox" value="1" <?php if ($cargo == 1) { echo "checked='checked'"; } ?> >
        <label for="adminCheckbox"> Administrador</label><br>

        <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
       
        <div class="inputi">
            <input type="submit" value="Guardar cambios" name="submit">
        </div>
    </form>

</body>
</html>