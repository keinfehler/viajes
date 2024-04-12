
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Administración</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>

	<?php require 'Partial/header.php' ?>
    <?php require_once "database.php";?>

    

  <center>
  <h2 class="title">Reservas </h2>
    <section>
      <article>
        <table border="1" bgcolor="#D6EAF8">
          <tr>
            
            
            <th class="tbl">Inicio</th>
            <th class="tbl">Fin</th>
            <th class="tbl">Precio</th>
            <th class="tbl"></th>
      
          </tr>

          <?php
                
                 $sql6 = "SELECT * FROM reservas";
                 $result6 = mysqli_query($conn, $sql6);
           while ($row = mysqli_fetch_object($result6)){
              /*
              echo "<tr><td class='tb'>" ;
              echo $row->ID_reserva;
              echo "</td>";

              
              echo "<td class='tb'>" ;
              echo $row->ID_cliente;
              echo "</td>";
              */
            
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
              echo "<form method='post' action='administration.php'> <input type='hidden' name='id_reserva' value='$row->ID_reserva' /> <input name='anular' type='submit' value='anular'/> </form>";
              echo "</td></tr>";

           }
          ?>
        </table>
      </article>
    </section>
  
  </center>

    
</body>
