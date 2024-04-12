
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Paquetes - Viajes Colombia</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
</head>

<body>
  <?php require_once "database.php";?>
	<?php require 'Partial/header.php'   ?>
  
  <?php
  
  
  if (isset($_POST["reserva"])) {
      

    
      
    $finicio = $_POST["fecha_inicio"];
    $ffin = $_POST["fecha_fin"];
    $precio_total = 0;//$_POST["Contraseña"];
    $id_paquete = $_POST["select_paquete"];
    $id_cliente = 10;//$_SESSION["idcliente"];
    $id_empleado = 30;
       
    $sql4 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ('$finicio', '$ffin', '$precio_total', '$id_paquete', '$id_cliente','$id_empleado')";
    //$sql3 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ( ?, ?, ?, ? ,? ,? )";
    $stmt3 = mysqli_stmt_init($conn);
    $prepareStmt3 = mysqli_stmt_prepare($stmt3,$sql4);
    if ($prepareStmt3) {
    
        mysqli_stmt_execute($stmt3);
        echo "<div class='alert alert-success'>Reserva exitoso.</div>";
    }else{
        die("Algo ha fallado!");
    }
    
  }
  
  ?>
<body>
  <br>
  <br>
  <br>
  
<h2 class="title">Informacion de los paquetes disponibles</h2>
  <center>
     
    <section>
      <article>
        <table border="1" bgcolor="#D6EAF8">
          <tr>
            <th class="tbl">Nombre</th>
            <th class="tbl">Descripcion</th>
            <th class="tbl">Destino</th>
            <th class="tbl">Tipo</th>
            <th class="tbl">Precio</th>
            
      
          </tr>

          <?php
                 $sql = "SELECT paquetes.Nombre_paquete, paquetes.Descripcion, destinos.Nombre_Destino, paquetes.Precio_total, destinos.Descripcion as Tipo FROM paquetes, destinos WHERE paquetes.ID_Destino = destinos.ID_Destino";
                 $result = mysqli_query($conn, $sql);
           while ($row = mysqli_fetch_object($result)){
              echo "<tr><td class='tb'>" ;
              echo $row->Nombre_paquete;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Descripcion;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Nombre_Destino;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Tipo;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Precio_total;
              echo " Euros </td>";
             
              

           }
          ?>
        </table>

      </article>
    </section>
  
  </center>
  <?php

  
        if (isset($_SESSION["user"])) {
          
          echo "<center><h2><a href='reserva.php'>Reserva ya!!</a></h2></center>";
          }else 
          {
            echo "<center><h2><a href='login.php'>Reserva ya!!</a></h2></center>";

          }
  ?>
  

</body>
</html>