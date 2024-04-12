
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editar perfil</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>

	<?php require 'Partial/header.php' ?>

    <?php 
  

        if (isset($_POST["submit"])) {
            // Collect updated data from the form
            $updated_name = $_POST['Nombre'];
            $updated_email = $_POST['Email'];
            $updated_password = $_POST['Password'];
            $updated_id = $_POST['id'];
            
            // Update user data in the database
            require_once "database.php";
            $update_query = "UPDATE clientes SET Nombre='$updated_name', Email='$updated_email', Contrasena='$updated_password' WHERE ID_Cliente = $updated_id";
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
                $email = $row->Email;
                $password = $row->Contrasena;
            
            }
        
        }
    ?>
   
   <form action="userprofile.php" method="post">
        <div class="inpute">
            <input type="text" name="Nombre" value="<?php echo $userName; ?>" placeholder="Nombre:">
        </div>
        <div class="inpute">
            <input type="email" name="Email" placeholder="Email:" value="<?php echo $email; ?>">
        </div>
        <div class="inpute">
            <input type="password" name="Password" placeholder="Contraseña:" value="<?php echo $password; ?>">
        </div>

        <input type="hidden" name="id" value="<?php echo $user_id; ?>"/>
       
        <div class="inputi">
            <input type="submit" value="Guardar cambios" name="submit">
        </div>
    </form>

</body>
