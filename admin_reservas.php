
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Reservas</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>


<?php 
require 'Partial/header.php';
require_once "database.php";

$id_reserva_buscar = '';

if (isset($_POST["submit"])) {
    $id_reserva_buscar = $_POST['id_reserva'];
}

?>

<br>
	<br>
	<br>
    <h2 class="title">Reservas </h2>
    <h2 class="title">Buscar </h2>
    <form action="admin_reservas.php" method="post">
        <label>ID Reserva</label>
        <input type="text" name="id_reserva"/>
        <input type="submit" value="Buscar..." name="submit">
    </form>
  <center>
  
    <section>
      <article>
        <table border="1" bgcolor="#D6EAF8">
          <tr>
            
            <th class="tbl">ID Reserva</th>
            <th class="tbl">ID Cliente</th>
            <th class="tbl">Inicio</th>
            <th class="tbl">Fin</th>
            <th class="tbl">Precio</th>
            <th class="tbl"></th>
      
          </tr>

          <?php

                $sql6 =  "SELECT * FROM reservas";
                if ($id_reserva_buscar <> '')
                    $sql6 =  "SELECT * FROM reservas WHERE ID_reserva = $id_reserva_buscar";

                 
                 
                 
                 

                 $result6 = mysqli_query($conn, $sql6);
           while ($row = mysqli_fetch_object($result6)){
              
              echo "<tr><td class='tb'>" ;
              echo $row->ID_reserva;
              echo "</td>";

              
              echo "<td class='tb'>" ;
              echo $row->ID_cliente;
              echo "</td>";
              
            
              echo "<td class='tb'>" ;
              echo $row->Fecha_inicio;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Fecha_fin;
              echo "</td>";
              
              /*
              echo "<td class='tb'>" ;
              echo $row->ID_paquete;
              echo "</td>";
              */
              echo "<td class='tb'>" ;
              echo $row->Precio_total;
              echo " Euros </td>";

          
              echo "<td class='tb'>" ;
              echo "<a href='admin_reserva.php?id_reserva=$row->ID_reserva&action=editar'>Editar</a> "; 
              echo "<a href='admin_reserva.php?id_reserva=$row->ID_reserva&action=eliminar'>Eliminar</a>"; 
              echo "</td></tr>";

           }
          ?>
        </table>
      </article>
    </section>
  
  </center>

    
</body>
</html>