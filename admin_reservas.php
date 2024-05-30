<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Reservas</title>
  <link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
  
  
</head>
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

.container input[type="text"] {
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.container input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
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

$id_reserva_buscar = '';

if (isset($_POST["submit"])) {
    $id_reserva_buscar = $_POST['id_reserva'];
}

?>

<br>
  <br>
  <br>
  <div class="container">
    <h2 class="title">Reservas </h2>
    <h2 class="title">Buscar </h2>
    <form action="admin_reservas.php" method="post">
        <label>ID Reserva</label>
        <input type="text" name="id_reserva"/>
        <br>
        <br>
        <input type="submit" value="Buscar..." name="submit">
    </form>
  </div>
  <center>
  
    <section>
      <article>
        <table border="1" bgcolor="#D6EAF8">
          <tr>
            
            <th class="tbl">ID Reserva</th>
            <th class="tbl">Nombre</th>
             <th class="tbl">Inicio</th>
            <th class="tbl">Fin</th>
            <th class="tbl">Paquete</th>
            <th class="tbl">Descripcíon</th>
                       <th class="tbl">Destino</th>
             <th class="tbl">Temporada</th>
            <th class="tbl">Precio</th>
            <th class="tbl"></th>
      
          </tr>

          <?php


 $sql6 = "SELECT r.ID_reserva, c.Nombre, r.Fecha_inicio, r.Fecha_fin, p.Nombre_paquete, p.Descripcion, d.Nombre_destino, t.Nombre_Temporada, r.Precio_total FROM reservas r
                        INNER JOIN clientes c ON r.ID_cliente = c.ID_cliente
                        INNER JOIN paquetes p ON r.ID_paquete = p.ID_paquete
                           INNER JOIN destinos d ON p.ID_destino = d.ID_destino
                            INNER JOIN temporadas t ON r.ID_temporada = t.ID_temporada";

                if ($id_reserva_buscar <> '')
                    $sql6 .= " WHERE r.ID_reserva = $id_reserva_buscar";

                   $sql6 .= " ORDER BY r.ID_reserva DESC";
                          
                           
                 

                 $result6 = mysqli_query($conn, $sql6);
           while ($row = mysqli_fetch_object($result6)){
              
              echo "<tr><td class='tb'>";
              echo $row->ID_reserva;
              echo "</td>";

              
                       

               echo "<td class='tb'>";
                    echo $row->Nombre;
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

               echo "<td class='tb'>";
               echo $row->Nombre_paquete;
               echo "</td>";


               echo "<td class='tb'>";
               echo $row->Descripcion;
               echo "</td>";


                 echo "<td class='tb'>";
               echo $row->Nombre_destino;
               echo "</td>";

                 echo "<td class='tb'>";
               echo $row->Nombre_Temporada;
               echo "</td>";


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