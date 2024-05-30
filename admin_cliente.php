
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin cliente</title>
    <link rel="stylesheet" type="text/css" href="css\estilos.css"></link>

	
	
<style>

/* Estilos para el cuerpo de la página */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Estilos para el contenedor del formulario */
.form_container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Estilos para los campos de entrada */
.inpute {
    margin-bottom: 15px;
}

.inpute input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Estilos para el botón de submit */
.inputi input[type="submit"] {
    width: auto;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.inputi input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Estilos para el título */
.title {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

</style>

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

<br>
	<br>
	<br>
    <h2 class="title">Cliente: <?php echo $user_id ?>  </h2>


    <form class="form_container" action="admin_cliente.php" method="post">
        <div class="inpute">
            <input type="text" name="Nombre" value="<?php echo $userName; ?>" placeholder="Nombre:">
        </div>
        <div class="inpute">
        <input type="text" name="Apellido" value="<?php echo $userApellido; ?>" placeholder="Apellido:"> <!-- Nuevo campo para el apellido -->
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