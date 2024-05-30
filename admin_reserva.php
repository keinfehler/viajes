
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Reserva</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	 <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container form {
            text-align: center;
        }

        .container input[type="date"],
        .container select {
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .container input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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
    $updated_cliente = $_POST['select_cliente'];
    $updated_temporada = $_POST['select_temporada'];

    $sql4 = "SELECT * FROM paquetes WHERE ID_paquete = '$updated_paquete'";
    $result5 = mysqli_query($conn, $sql4);
    while ($row = mysqli_fetch_object($result5)){
    $precio_total = $precio_total + $row->Precio_total;
    
    }

    $update_query = "UPDATE reservas SET Fecha_inicio='$updated_inicio', Fecha_fin='$updated_fin', Precio_total='$precio_total', ID_paquete='$updated_paquete', ID_cliente='$updated_cliente', id_temporada='$updated_temporada' WHERE ID_reserva='$id_reserva'";
    mysqli_query($conn, $update_query);
    header("Location: admin_reservas.php");
}


$inicio = "";
$fin = "";
$paquete ="";
$cliente = "";
$temporada = "";



if (isset($_SESSION["user"])) {
    $query = "SELECT * FROM reservas WHERE ID_reserva = $id_reserva";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_object($result)){
        
        $inicio = $row->Fecha_inicio;
        $fin = $row->Fecha_fin;
        $paquete = $row->ID_paquete;
        $cliente = $row->ID_cliente;
         $temporada = $row->id_temporada;
    }
    }



?>



<br>
	<br>
	<br>
   <div class="container">
    <h2 class="title">Reserva: <?php echo $id_reserva ?>  </h2>

    <form action="admin_reserva.php" method="post">
            
              <br>
              <label>Inicio:</label>
              <input type="date" name="fecha_inicio" id="fecha_inicio"  value="<?php echo $inicio; ?>"  />
                          <br>
                            <br>
              <label>Fin:</label>
              <input type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $fin; ?>"  />
           
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
              <br>
        <br>
        <label>Cliente:</label>
        <br>
        <br>
        <select name="select_cliente" id="select_cliente">
            <?php
            $sqlC = "SELECT ID_cliente, Nombre FROM clientes";
            $resultC = mysqli_query($conn, $sqlC);
            while ($row_cliente = mysqli_fetch_object($resultC)) {
                $isSelectedC = "";
                if ($row_cliente->ID_cliente === $cliente) {
                    $isSelectedC = "selected";
                }
                echo '<option ' . $isSelectedC . ' value="' . $row_cliente->ID_cliente . '">' . $row_cliente->Nombre . '</option>';
            }
            ?>
            </select>
            <br>
             <label>Temporada:</label>
             <br>
            <select name="select_temporada" id="select_temporada">
    <?php
    $sqlP = "SELECT ID_temporada, Nombre_Temporada FROM temporadas";
    $resultP = mysqli_query($conn, $sqlP);
    while ($row_temporada = mysqli_fetch_object($resultP)) {
        $isSelectedP = "";
        if ($row_temporada->ID_temporada == $temporada) {
            $isSelectedP = "selected";
        }
        echo '<option ' . $isSelectedP . ' value="' . $row_temporada->ID_temporada . '">' . $row_temporada->Nombre_Temporada . '</option>';
    }
    ?>
</select>
        <br>
        <br>
            <input type="hidden" name="id_reserva" value="<?php echo $id_reserva; ?>"/>
           
            <input type="submit" value="Guardar cambios" name="submit">
           
        </form>
         </div>

</body>
</html>