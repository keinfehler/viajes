
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Reserva</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>


<?php 
require 'Partial/header.php';
require_once "database.php";
$id_reserva = $_GET['id_reserva']; 
$action = $_GET['action'];

if($action == "eliminar")
{
    
    $delete_query = "DELETE FROM reservas WHERE ID_reserva = $id_reserva";
    mysqli_query($conn, $delete_query);

  
    header("Location: admin_reservas.php");
}



if (isset($_POST["submit"])) {

    $id_reserva = $_POST['id_reserva'];
    $updated_inicio = $_POST['fecha_inicio'];
    $updated_fin = $_POST['fecha_fin'];
    $precio_total = 0;

    $updated_paquete = $_POST['select_paquete'];

    $sql4 = "SELECT * FROM paquetes WHERE ID_paquete = '$updated_paquete'";
    $result5 = mysqli_query($conn, $sql4);
    while ($row = mysqli_fetch_object($result5)){
    $precio_total = $precio_total + $row->Precio_total;
    
    }

    $update_query = "UPDATE reservas SET Fecha_inicio='$updated_inicio', Fecha_fin='$updated_fin', Precio_total='$precio_total', ID_paquete='$updated_paquete' WHERE ID_reserva='$id_reserva'";
    mysqli_query($conn, $update_query);
    header("Location: admin_reservas.php");
}


$inicio = "";
$fin = "";
$paquete ="";


if (isset($_SESSION["user"])) {
    $query = "SELECT * FROM reservas WHERE ID_reserva = $id_reserva";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_object($result)){
        
        $inicio = $row->Fecha_inicio;
        $fin = $row->Fecha_fin;
        $paquete = $row->ID_paquete;
    }

}

?>



<br>
	<br>
	<br>
    <h2 class="title">Reserva: <?php echo $id_reserva ?>  </h2>

    <form action="admin_reserva.php" method="post">
            <div class="inpute">
              <br>
              <label>Inicio:</label>
              <input type="date" name="fecha_inicio" id="fecha_inicio"  value="<?php echo $inicio; ?>"  />
            </div>
              <br>
              <div class="inpute">
              <br>
              <label>Fin:</label>
              <input type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $fin; ?>"  />
            </div>
            <div>
              <br>
              <br>
              <label>Paquete:</label>
              <br>
              <br>
              <select name="select_paquete" id="select_paquete">
              
                <?php
                    $sql2= "SELECT paquetes.ID_paquete,paquetes.Nombre_paquete, paquetes.Descripcion, destinos.Nombre_Destino, paquetes.Precio_total, destinos.Descripcion as Tipo FROM paquetes, destinos WHERE paquetes.ID_Destino = destinos.ID_Destino";
                    $result2 = mysqli_query($conn, $sql2);
                     while ($row = mysqli_fetch_object($result2)){
                        $isSelected = "";
                        if($row->ID_paquete === $paquete)
                        {
                            $isSelected = "selected";
                        }

                      echo '<option '.$isSelected.' value="'.$row->ID_paquete.'">'.$row->Nombre_paquete.' - '.$row->Descripcion.' - '.$row->Nombre_Destino. ' - '.$row->Tipo. ' - ' .$row->Precio_total.  ' EUROS </option>';
                     
                     }
                  ?>
  
                </select>
             
            </div>
            <input type="hidden" name="id_reserva" value="<?php echo $id_reserva; ?>"/>
            <div class="inputi">
            <input type="submit" value="Guardar cambios" name="submit">
            </div>
        </form>

</body>
</html>