
<body>
<?php
include('partial/header.php');
$id_reserva_buscar = '';

if (isset($_POST["submit"])) {
    $id_reserva_buscar = $_POST['id_reserva'];
}

?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Reservas</h1>
          <p></p>
          
        </div>
      </div>

      <div class="container">
       
    <h2 class="title">Buscar reservas</h2>

<form action="admin_reservas.php" class="Formulario" method="post">
    <div class="form-floating">
      <label>ID Reserva</label>
      <input class="form-control" type="text" name="id_reserva"/>
    </div>
    <div class="form-floating">
      <button type="submit"  name="submit" class="btn btn-primary w-100 py-2">Buscar...</button>
    </div>
</form>



<section>
  <article>
    <table class="table">
      <tr>
        
        <th class="tbl">ID Reserva</th>
        <th class="tbl">Nombre</th>
         <th class="tbl">Inicio</th>
        <th class="tbl">Fin</th>
        <th class="tbl">Paquete</th>
        <th class="tbl">Descripcíon</th>
                   <th class="tbl">Destino</th>
         <th class="tbl">Temporada</th>
         <th class="tbl">Estado</th>
          <th class="tbl">comercial</th>
        <th class="tbl">Precio</th>
        <th class="tbl"></th>
  
      </tr>

      <?php


$sql6 = "SELECT r.ID_reserva, c.Nombre, co.Nombre_comercial, r.Fecha_inicio, r.Fecha_fin, p.Nombre_paquete, p.Descripcion, d.Nombre_destino, t.Nombre_Temporada, r.Precio_total, o.Estado FROM reservas r
                    INNER JOIN clientes c ON r.ID_cliente = c.ID_cliente
                    INNER JOIN paquetes p ON r.ID_paquete = p.ID_paquete
                    INNER JOIN destinos d ON p.ID_destino = d.ID_destino
                    INNER JOIN temporadas t ON r.ID_temporada = t.ID_temporada
                    LEFT JOIN ofertas o ON  o.ClienteID = r.ID_Cliente AND o.PaqueteID = r.ID_Paquete And O.comercialID = O.comercialID
                    LEFT JOIN comerciales co ON co.ComercialID = o.ComercialID";

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

             echo "<td class='tb'>";
           echo $row->Estado;
           echo "</td>";

            echo "<td class='tb'>";
           echo $row->Nombre_comercial;
           echo "</td>";


          echo "<td class='tb'>" ;
          echo $row->Precio_total;
          echo " Euros </td>";

          echo "<td class='tb'>" ;
          echo "<a class='btn btn-primary' href='admin_reserva.php?id_reserva=$row->ID_reserva&action=editar'>Editar</a> "; 
          echo "</td>";

      
          echo "<td class='tb'>" ;
          echo "<a  class='btn btn-primary' href='admin_reserva.php?id_reserva=$row->ID_reserva&action=eliminar'>Eliminar</a>"; 
          echo "</td></tr>";

       }
      ?>
    </table>
  </article>
</section>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
